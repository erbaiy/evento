<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;

use function Pest\Laravel\get;

class AcueilActionController extends Controller
{
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
