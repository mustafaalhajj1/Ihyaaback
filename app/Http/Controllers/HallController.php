<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HallController extends Controller
{
    public function index() { return Hall::all(); }

    public function store(Request $r)
    {
        return Hall::create($r->validate(['name'=>'required']));
    }

    public function show($id) { return Hall::findOrFail($id); }

    public function update(Request $r,$id)
    {
        $h = Hall::findOrFail($id);
        $h->update($r->all());
        return $h;
    }

    public function destroy($id) { Hall::destroy($id); }
}