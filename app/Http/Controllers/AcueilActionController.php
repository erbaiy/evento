<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class AcueilActionController extends Controller
{
    public function search(Request $request)
    {
        $searchString = $request->input('search_string');

        if (empty($searchString)) {
            // Retrieve all the data
            $events = Event::all();
        } else {
            // Perform the search query using your logic
            $events = Event::where('title', 'like', '%' . $searchString . '%')->get();
        }

        // Return the search results as a view
        return view('front-office.search-results', compact('events'));
    }
}
