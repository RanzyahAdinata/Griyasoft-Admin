<?php

namespace App\Http\Controllers;


use App\Models\Event;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('kalender.index', compact('events'));
    }

    public function addEvent(Request $request)
    {
        $event = Event::create([
            'title' => $request->title,
            'start' => $request->start,
        ]);

        return response()->json($event);
    }

    public function updateEvent(Request $request)
    {
        $event = Event::findOrFail($request->eventId);
        $event->update([
            'title' => $request->editTitle,
            'start' => $request->editStart,
        ]);

        return response()->json($event);
    }

    public function deleteEvent(Request $request)
    {
        $event = Event::findOrFail($request->eventId);
        $event->delete();

        return response()->json(['message' => 'Event deleted successfully']);
    }
}
