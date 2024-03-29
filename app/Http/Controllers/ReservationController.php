<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketEmail;
use App\Models\Category;
use Illuminate\Support\Str;





class ReservationController extends Controller
{
    public function index()
    {
        $events = Event::where('status', 'valide')->paginate(4);
        $categories = Category::all();

        return view('front-office.index', compact('categories', 'events'));
    }


    public function detail(Request $request)
    {
        $event = Event::where('status', 'valide')->where('id', $request->event_id)->first();

        return view('front-office.detail', compact('event'));
    }

    public function galory()
    {
        $images = Event::all();
        // $images = $event->images;
        return view('front-office.galory', compact('images'));
    }

    public function reserve(Request $request)
    {
        $event = new Reservation;
        $event->user_id = $request->user_id;
        $event->event_id = $request->event_id;
        $event->reservation_date = now();

        $statusevent = Event::find($request->event_id);

        if ($statusevent->typeAccept == 'auto') {
            $event->status = 'accepted';
            $check = $event->save();

            if ($check) {
                // Create a new ticket record
                $ticket = new Ticket;
                $ticket->reservation_id = $event->id;
                $ticket->token = Str::random(10); // Generate a random token for the ticket
                $ticket->save();

                // Generate the ticket HTML

                $ticketHtml = view('emails.ticket', compact('event', 'ticket'))->render();

                // Send ticket email to the user
                $user = User::find($request->user_id);
                $isSend = Mail::to($user->email)->send(new TicketEmail($ticketHtml));

                // Decrement the available places for the event
                $statusevent->places -= 1;
                $statusevent->save();

                return redirect()->back()->with('success', 'Event reserved successfully check your tickets in your email');
            } else {
                return redirect()->back()->with('error', 'Failed to reserve event');
            }
        } else {
            $check = $event->save();

            if ($check) {
                // Decrement the available places for the event
                $statusevent->places -= 1;
                $statusevent->save();

                return redirect()->back()->with('success', 'Event reserved successfully');
            } else {
                return redirect()->back()->with('error', 'Failed to reserve event');
            }
        }
    }

    // Accept or refuse the reservation by organizater
    public function getAllReservation()
    {
        $reservations = Reservation::join('events', 'reservations.event_id', '=', 'events.id')
            ->where('reservations.status', 'refuse')
            ->where('events.user_id', session('id'))
            ->paginate(4);

        return view('back-office.reservationAction', compact('reservations'));
    }
    public function acceptReservation(Request $request)
    {
        $validatedData = $request->validate([
            'reservation_id' => 'required',
            'action' => 'required',
        ]);

        $event = Reservation::find($validatedData['reservation_id']);

        if ($event) {
            $event->update(['status' => $validatedData['action']]);
            if ($event) {
                $ticket = new Ticket;

                $ticket->reservation_id = $event->id;
                $ticket->token = Str::random(10); // Generate a random token for the ticket
                $ticket->save();

                // Generate the ticket HTML
                $ticketHtml = view('emails.ticket', compact('event', 'ticket'))->render();

                // Send ticket email to the user
                $user = User::find($event->user_id);
                $isSent = Mail::to($user->email)->send(new TicketEmail($ticketHtml));

                return redirect()->back()->with('success', 'Event reserved successfully. Check your tickets in your email.');
            }
        }

        return redirect()->back()->with('error', 'Something is wrong with the reservation.');
    }


    public function refuseReservation(Request $request)
    {
        $reservation = Reservation::find($request->reservation_id);

        if (!$reservation) {
            return redirect()->back()->with('error', 'Reservation not found.');
        }

        $reservation->delete();

        return redirect()->back()->with('success', 'Reservation deleted successfully.');
    }
}
