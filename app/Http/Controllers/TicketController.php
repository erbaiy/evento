<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = \App\Models\Ticket::all();
        return view('back-office.ticket.index', compact('tickets'));
    }
}
