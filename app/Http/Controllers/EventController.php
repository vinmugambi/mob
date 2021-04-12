<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;

use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use App\Models\Event;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class EventController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
    
        return Inertia::render('Dashboard', [
            "events" => Event::where("user_id", "!=", $user_id)->get()
        ]);
    }

    public function mine()
    {
        return Inertia::render("event/MyEvents", ["events" => Auth::user()->events]);
    }

    public function create()
    {
        return Inertia::render("event/Create");
    }

    public function store(StoreEventRequest $request)
    {

        $event = $request->validated();
        $event["image"]  = $request->file("image")->storePublicly("images");
        Auth::user()->events()->create($event);
        
        return Redirect::route('myevents')->with('success', 'Event created.');
    }

    public function show($id)
    {
        return Inertia::render("event/Show", ["event" => Event::find($id)]);
    }


    public function edit($id)
    {
        return Inertia::render("event/Edit", ["event" => Event::find($id)]);
    }

    public function update(UpdateEventRequest $request, $id)
    {
        $event = Event::find($id);

        if (!Gate::allows('update-event', $event)) {
            abort(403);
        }

        $event->update(
            $request->validated()
        );

        return Redirect::back()->with('success', 'Event updated.');
    }

    public function destroy($id)
    {
        $event = Event::find($id);

        if (!Gate::allows('update-event', $event)) {
            abort(403);
        }

        $event->delete();
    }
}
