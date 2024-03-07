<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class AcueilActionController extends Controller
{
    public function search(Request $request)
    {

        dd('gfjh');
        $searchTerm = $request->input('searchTerm');


        $events = Event::where('title', 'LIKE', "%$searchTerm%")
            ->orWhere('description', 'LIKE', "%$searchTerm%")
            ->get();

        // return view('front-office.app.dataSearch', compact('events'));
        if ($events->count() >= 1) {
            return view('front-office.index', compact('events'))->render();
        } else {
            response()->json([
                'error' => 'No events found'
            ]);
        };
    }
}
