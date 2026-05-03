<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return Notification::where('user_id',auth()->id())->get();
    }

    public function store(Request $r)
    {
        return Notification::create($r->all());
    }
}