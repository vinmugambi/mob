<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use App\Models\Booking;
use App\Models\Event;
use Illuminate\Support\Facades\Redirect;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Auth::user()->bookings;
        $booked_events = array();

        foreach ($bookings as $booking) {
            $event = Event::where("id", $booking["event_id"])->first();
            $event["booking_id"] = $booking["id"];
            array_push($booked_events, $event);
        }

        return Inertia::render('event/Bookings', [
            "events" => $booked_events,

        ]);
    }

    public function store(BookingRequest $request)
    {
        $event_id = $request->validated()["id"];
        // Auth::user()->bookings()->create(["event_id" => $event_id]);
        $booking = new Booking;
        $booking->event_id = $event_id;
        $booking->user_id = Auth::id();

        $booking->save();
        return Redirect::back()->with('success', 'Event booked');

    }

    public function destroy($id)
    {
        $booking = Booking::find($id);
        if (!Gate::allows('cancel-booking', $booking)) {
            abort(403);
        }
        $booking->delete();
        return Redirect::route("booking.index")->with('success', 'Event booking cancelled');
    }
}
