<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventRatingController extends Controller
{
    public function store(Request $r)
    {
        return EventRating::create([
            'user_id'=>auth()->id(),
            'event_id'=>$r->event_id,
            'rating'=>$r->rating
        ]);
    }
}