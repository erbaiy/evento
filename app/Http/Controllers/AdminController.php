<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $searchTerm = "invalide";
        $events = Event::where('status', 'like', '%' . $searchTerm . '%')->get();
        return view('back-office.events.handelEvents', compact('events'));
    }
    public function action(Request $request)
    {

        if ($request->valide) {
            $events = Event::find($request->id);
            $events->status = $request->valide;
            $events->update();
            return redirect()->back();
        } else {
            $events = Event::find($request->id);
            $events->delete();
            return redirect()->back();
        }
    }
}
