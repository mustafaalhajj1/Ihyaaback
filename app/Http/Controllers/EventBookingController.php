<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventBookingController extends Controller
{
    public function store(Request $r)
    {
        return EventBooking::create([
            'user_id'=>auth()->id(),
            'event_id'=>$r->event_id
        ]);
    }

    public function index()
    {
        return EventBooking::with(['user','event'])->get();
    }
}