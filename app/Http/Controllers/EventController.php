<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $events = Event::all();
        return view('back-office.events.index', compact('events', 'categories'));
    }



    public function store(Request $request)
    {


        $validatedData = $request->validate([
            'title' => 'required',
            'image' => 'required',
            'description' => 'required',
            'date' => 'required|date',
            // 'status' => 'required',
            'typeAccept' => 'required',
            'location' => 'required',
            'category_id' => 'required|numeric',
            'places' => 'required|numeric',
        ]);
        // dd($validatedData);
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('assets/img'), $imageName);

        $event = new Event;
        $event->title = $validatedData['title'];
        $event->image = 'assets/img/' . $imageName;
        $event->description = $validatedData['description'];
        $event->date = $validatedData['date'];
        $event->user_id = $request->user_id;
        // $event->status = $validatedData['status'];
        $event->typeAccept = $validatedData['typeAccept'];
        $event->location = $validatedData['location'];
        $event->category_id = $validatedData['category_id'];
        $event->places = $validatedData['places'];
        $event->save();

        return redirect()->route('event.index')->with('success', 'Event created successfully.');
    }
    public function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();
        return redirect()->route('event.index')->with('success', 'Event deleted successfully.');
    }
}
