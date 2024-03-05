<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $events = Event::where('status', 'valide')->get();
        return view('front-office.index', compact('events'));
    }

    public function reserve(Request $request)
    {


        // Validate the incoming request data
        $validatedData = $request->validate([
            'user_id' => 'required',
            'event_id' => 'required',
        ]);
        $statusevent=Event::();


        $event = new Reservation;
        $event->user_id = $validatedData['user_id'];
        $event->event_id = $validatedData['event_id'];
        $event->reservation_date = now();
        $event->save();
        return redirect()->back()->with('success', 'Event reserved successfully');
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

        $reservation = Reservation::find($validatedData['reservation_id']);

        if ($reservation) {
            $reservation->update(['status' => $validatedData['action']]);

            return redirect()->back()->with('success', 'Reservation accepted successfully');
        } else {
            // Handle the case when the reservation is not found
            return redirect()->back()->with('error', 'sommething is wrong with the reservation');
        }
    }
}
