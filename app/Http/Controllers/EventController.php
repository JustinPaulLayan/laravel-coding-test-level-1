<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Mail\EventCreatedMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::where('name', 'LIKE', '%' . $request->name . '%')->paginate(5);
        return view('Events.index', ['events' => $events]);
    }

    public function show(Event $event)
    {
        return view('Events.show', ['event' => $event]);
    }
    
    public function create()
    {
        return view('Events.create');
    }

    public function store(StoreEventRequest $request)
    {
        Event::create($request->post());

        $description = "Event ".$request->name." is created";

        Mail::to(auth()->user()->email)->send(new EventCreatedMail($description));

        return redirect()->route('events')->with('success','Event has been created successfully.');
    }

    public function edit(Event $event)
    {
        return view('Events.edit', ['event' => $event]);
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->fill($request->post())->save();

        return redirect()->route('events')->with('success','Event Has Been updated successfully');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events')->with('success','Event has been deleted successfully');
    }
}
