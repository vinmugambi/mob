<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Booking;

class BookingController extends Controller
{
    use RefreshDatabase;

    public function index()
    {
        // return Inertia::render("event/Bookings", [
        //     "events" => Auth::user()->bookings()->event
        // ]);

        $bookings = Auth::user()->bookings;
        $booked_events = array();
        return $bookings;

        //         foreach($bookings as $booking) {
        // $booked_events[$key] = Booking::find($bookins[$key])
        //         }
    }

    public function store(BookingRequest $request)
    {
        $event_id = $request->validated()["id"];
        // Auth::user()->bookings()->create(["event_id" => $event_id]);
        $booking = new Booking;
        $booking->event_id = $event_id;
        $booking->user_id = Auth::id();

        $booking->save();
    }

    public function destroy(BookingRequest $request)
    {
        $booking_id = $request->validated()["id"];
        $event = Event::find($booking_id);

        if (!Gate::allows('update-event', $event)) {
            abort(403);
        }
        $event->delete();
    }
}
