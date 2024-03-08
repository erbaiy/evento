<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketEmail;
use Illuminate\Support\Str;





class ReservationController extends Controller
{
    public function index()
    {
        $events = Event::where('status', 'valide')->get();

        return view('front-office.index', compact('events'));
    }
    public function detail(Request $request)
    {
        $event = Event::where('status', 'valide')->where('id', $request->event_id)->first();

        return view('front-office.detail', compact('event'));
    }

    public function galory()
    {
        $images = Event::where('status', 'valid')->pluck('image');

        return view('front-office.galory', compact('images'));
    }


    // public function reserve(Request $request)
    // {
    //     $statusevent = Event::find($request->event_id);

    //     $event = new Reservation;
    //     $event->user_id = $request->user_id;
    //     $event->event_id = $request->event_id;
    //     $event->reservation_date = now();

    //     if ($statusevent->typeAccept == 'auto') {
    //         $event->status = 'accepted';
    //     }

    //     $event->save();

    //     return redirect()->back()->with('success', 'Event reserved successfully');
    // }


    // public function reserve(Request $request)
    // {
    //     $statusevent = Event::find($request->event_id);

    //     // dd($request->user_id);
    //     $event = new Reservation;
    //     $event->user_id = $request->user_id;
    //     $event->event_id = $request->event_id;
    //     $event->reservation_date = now();

    //     if ($statusevent->typeAccept == 'auto') {
    //         $event->status = 'accepted';
    //     }
    //     $check = $event->save();
    //     if ($check) {
    //         // Create a new ticket record
    //         $ticket = new Ticket;
    //         $ticket->reservation_id = $event->id;
    //         $ticket->token = Str::random(10); // Generate a random token for the ticket
    //         $ticket->save();

    //         // Generate the ticket HTML
    //         $ticketHtml = view('emails.ticket', compact('event', 'ticket'))->render();
    //         // Send ticket email to the user
    //         $user = User::find($request->user_id);
    //         $isSend = Mail::to($user->email)->send(new TicketEmail($ticketHtml));
    //         if ($isSend) {
    //             dd('send');
    //         } else {
    //             dd('not send');
    //         }

    //         return redirect()->back()->with('success', 'Event reserved successfully');
    //     } else {
    //         return redirect()->back()->with('error', 'Failed to reserve event');
    //     }
    // }
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
                // dd('your ticker is reserved');
                return redirect()->back()->with('success', 'Event reserved successfully check your tickets in your email');
            } else {
                // dd('your ticker is not reserved');
                return redirect()->back()->with('error', 'Failed to reserve event');
            }
        } else {
            // $event->status = 'manuelle';
            $check = $event->save();

            if ($check) {
                // dd('you are reserved');
                return redirect()->back()->with('success', 'Event reserved successfully');
            } else {
                // dd('your not reserved');
                return redirect()->back()->with('error', 'Failed to reserve event');
            }
        }
    }

    // Accept or refuse the reservation by organizater
    public function getAllReservation()
    {
        $reservations = Reservation::where('status', 'refuse')->get();
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
}




    // public function reserve(Request $request)
    // {


    //     // Validate the incoming request data
    //     // $validatedData = $request->validate([
    //     //     'user_id' => 'required',
    //     //     'event_id' => 'required',
    //     // ]);
    //     // dd($request->event_id);
    //     $statusevent = Event::find($request->event_id);
    //     if ($statusevent->typeAccept == 'auto') {
    //         // dd('yes its auto');
    //         $event = new Reservation;
    //         $event->user_id = $request->user_id;
    //         $event->event_id = $request->event_id;
    //         $event->status = 'accepted';
    //         $event->reservation_date = now();
    //         $event->save();
    //         return redirect()->back()->with('success', 'Event reserved successfully');
    //     } else {
    //         // dd('no its auto');
    //         $event = new Reservation;
    //         $event->user_id = $request->user_id;
    //         $event->event_id = $request->event_id;

    //         $event->reservation_date = now();
    //         $event->save();
    //         return redirect()->back()->with('success', 'Event reserved successfully');
    //     }
    // }