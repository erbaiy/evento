<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\TicketEmail;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = \App\Models\Ticket::all();
        return view('back-office.ticket.index', compact('tickets'));
    }

    public function sendemail()
    {

        $ticketHtml = [
            'name' => 'younesse',
            'status' => 'active',
        ];

        $send = Mail::to('younesserbai@gmail.com')->send(new TicketEmail($ticketHtml));
        if ($send) {
            dd('Email sent successfully');
        } else {
            dd('Email not sent');
        }
    }
}
