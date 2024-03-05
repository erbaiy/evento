<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('front-office.index', compact('events'));
    }

    public function reserve(Request $request)
    {

        // Validate the incoming request data
        $validatedData = $request->validate([
            'user_id' => 'required',
            'event_id' => 'required',
        ]);


        $event = new Reservation;
        $event->user_id = $validatedData['user_id'];
        $event->event_id = $validatedData['event_id'];
        $event->reservation_date = now();
        $event->save();
        return redirect()->back()->with('success', 'Event reserved successfully');
    }
}
