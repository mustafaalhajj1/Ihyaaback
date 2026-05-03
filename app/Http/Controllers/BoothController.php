<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BoothController extends Controller
{
    public function index() { return Booth::with('publisher')->get(); }

    public function store(Request $r)
    {
        return Booth::create($r->all());
    }

    public function show($id) { return Booth::findOrFail($id); }

    public function update(Request $r,$id)
    {
        $b = Booth::findOrFail($id);
        $b->update($r->all());
        return $b;
    }

    public function destroy($id) { Booth::destroy($id); }
}