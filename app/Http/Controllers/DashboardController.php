<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Reservation;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function adminStatstique()
    {
        $organizer = User::where('role', 'organizer')->get()->count();
        $users = User::where('role', 'user')->get()->count();
        $reservation = Reservation::all()->count();
        $categories = Category::all()->count();
        $events = Event::all()->count();
        $tikets = Ticket::all()->count();




        return view('back-office.dashboard.adminStatstique', compact('organizer', 'tikets', 'users', 'reservation', 'categories', 'events'));
    }
    public function organizerStatstique()
    {

        $reservationCount = Reservation::join('users', 'reservations.user_id', '=', 'users.id')
            ->where('users.id', session('id'))
            ->count();

        $eventCount = Event::join('users', 'events.user_id', '=', 'users.id')
            ->where('users.id', session('id'))
            ->count();

        return view('back-office.dashboard.organizerStatstique', compact('eventCount', 'reservationCount'));
    }
}
