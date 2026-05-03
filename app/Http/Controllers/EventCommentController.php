<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventCommentController extends Controller
{
    public function store(Request $r)
    {
        return EventComment::create([
            'user_id'=>auth()->id(),
            'event_id'=>$r->event_id,
            'comment'=>$r->comment
        ]);
    }}