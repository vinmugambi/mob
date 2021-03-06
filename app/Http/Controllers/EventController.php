<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Booking;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use App\Models\Event;
use App\Models\User;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    private function events_user_has_booked()
    {
        $user_bookings = Auth::user()->bookings;
        $ids_of_booked_events = array();

        foreach ($user_bookings as $booking) {
            array_push($ids_of_booked_events, $booking["event_id"]);
        }

        return $ids_of_booked_events;
    }

    private function event_bookings($id)
    {
        $bookings = Event::find($id)->bookings;
        foreach ($bookings as $booking) {
            $booking["user"] = User::find($booking["user_id"]);
        }

        return $bookings;
    }

    private function bookings_count($id, $owner_id)
    {
        if (Auth::id() == $owner_id) {
            return $this->event_bookings($id);
        } else return Event::find($id)->bookings()->count();
    }

    public function index()
    {
        $user_id = Auth::id();
        $unbooked_event_by_others = Event::where("user_id", "!=", $user_id)->whereNotIn("id", $this->events_user_has_booked())->get();

        return Inertia::render('Dashboard', [
            "events" => $unbooked_event_by_others
        ]);
    }

    public function mine()
    {
        $my_events = Auth::user()->events;

        foreach ($my_events as $event) {
            $event["bookings"] = $this->event_bookings($event["id"]);
        }
        return Inertia::render("event/MyEvents", ["events" => $my_events]);
    }

    public function create()
    {
        return Inertia::render("event/Create");
    }

    public function store(StoreEventRequest $request)
    {

        $event = $request->validated();
        $path = $request->file('image')->storePublicly('avatars', 's3');
        $event["image"] = Storage::disk("s3")->url($path);
        Auth::user()->events()->create($event);

        return Redirect::route('myevents')->with('success', 'Event created.');
    }

    private function has_user_booked_this_event($id)
    {
        return in_array($id, $this->events_user_has_booked());
    }

    private function user_booking_for_this_event($id)
    {
        if ($this->has_user_booked_this_event($id)) {
            return Auth::user()->bookings()->where("event_id", $id)->get()->first();
        } else return false;
    }

    public function show($id)
    {
        $event = Event::find($id);
        return Inertia::render("event/Show", [
            "event" => $event,
            "booking" => $this->user_booking_for_this_event($id),
            "bookings" => $this->bookings_count($id, $event["user_id"]),
            "owner" => User::find($event["user_id"])
        ]);
    }


    public function edit($id)
    {
        return Inertia::render("event/Edit", ["event" => Event::find($id)]);
    }

    public function update(UpdateEventRequest $request, $id)
    {
        $event = Event::find($id);
        $event_update_req = $request->validated();


        if (!Gate::allows('update-event', $event)) {
            abort(403);
        }
        if ($event_update_req["image"]) {
            $path = $request->file('image')->storePublicly('avatars', 's3');
            $event_update_req["image"] = Storage::disk("s3")->url($path);
        }

        $event->update($event_update_req);

        return Redirect::route("myevents")->with('success', 'Event updated.');
    }

    public function destroy($id)
    {
        $event = Event::find($id);

        if (!Gate::allows('update-event', $event)) {
            abort(403);
        }

        $event->delete();
        return Redirect::route("myevents")->with('success', 'Event deleted');
    }
}
