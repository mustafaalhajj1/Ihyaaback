<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index() { return Event::with('hall')->get(); }

    public function store(Request $r)
    {
        $r->validate([
            'title'=>'required',
            'date'=>'required',
            'time'=>'required',
            'hall_id'=>'required'
        ]);

        return Event::create($r->all());
    }

    public function show($id)
    {
        return Event::with('hall')->findOrFail($id);
    }

    public function update(Request $r,$id)
    {
        $e = Event::findOrFail($id);
        $e->update($r->all());
        return $e;
    }

    public function destroy($id) { Event::destroy($id); }
}