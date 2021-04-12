<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;

use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use App\Models\Event;


use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [
            "events" => Event::all()
        ]);
    }

    public function mine()
    {
        $user_id = Auth::user()->events;
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

        return Auth::user()->events;
        // return Redirect::route('dashboard')->with('success', 'Contact created.');
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

        return Redirect::back()->with('success', 'Contact updated.');
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
