<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;

use function Pest\Laravel\get;

class AcueilActionController extends Controller
{
    // public function search(Request $request)
    // {
    //     $searchString = $request->input('search_string');



    //     if (empty($searchString)) {
    //         // Retrieve all the data

    //         $events = Event::all();
    //     } else {
    //         // Perform the search query using your logic
    //         $events = Event::where('title', 'like', '%' . $searchString . '%')->get();
    //     }

    //     // Return the search results as a view

    //     return view('front-office.search-results', compact('events'));
    // }
    // public function filter(Request $request)
    // {
    //     $categories = Category::all();

    //     // Search by category
    //     $query = Event::where('status', 'valide');

    //     if ($request->has('category')) {
    //         $search = $request->category;
    //         $query->where('category_id', $search);
    //     }

    //     // Apply pagination
    //     $events = $query->simplePaginate(3);

    //     return view('front-office.index', compact('categories', 'events'));
    // }


    public function EventsByCategory($categoryId, $textsearch)
    {
        $events = Event::query();

        if ($categoryId != 0) {
            $events->where('category_id', $categoryId);
        }

        if ($textsearch != 0) {
            $events->where(function ($query) use ($textsearch) {
                $query->where('title', 'like', '%' . $textsearch . '%')
                    ->orWhere('description', 'like', '%' . $textsearch . '%');
            });
        }

        $events = $events->latest()->get();

        return view('front-office.search-results', compact('events'));
    }
}
