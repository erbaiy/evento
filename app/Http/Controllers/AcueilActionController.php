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
    public function filter(Request $request)
    {
        $category_id = $request->input('category_id'); // Get the selected category ID

        if (empty($category_id)) {
            // Retrieve all the data
            $events = Event::join('categories', 'events.category_id', '=', 'categories.id')
                ->select('events.*', 'categories.title as category_title')
                ->get();
        } else {
            // Retrieve events that belong to the selected category
            $events = Event::join('categories', 'events.category_id', '=', 'categories.id')
                ->select('events.*', 'categories.title as category_title')
                ->where('categories.id', $category_id)
                ->get();
        }

        // Return the search results as a view
        return view('front-office.filter-result', compact('events'));
    }
}
