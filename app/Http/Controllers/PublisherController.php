<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function index() { return Publisher::with('books')->get(); }

    public function store(Request $r)
    {
        return Publisher::create($r->validate(['name'=>'required']));
    }

    public function show($id)
    {
        return Publisher::with('books')->findOrFail($id);
    }

    public function update(Request $r,$id)
    {
        $p = Publisher::findOrFail($id);
        $p->update($r->all());
        return $p;
    }

    public function destroy($id) { Publisher::destroy($id); }
}