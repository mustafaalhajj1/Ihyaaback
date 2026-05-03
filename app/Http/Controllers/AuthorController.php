<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index() { return Author::all(); }

    public function store(Request $r)
    {
        $r->validate(['name'=>'required']);
        return Author::create($r->all());
    }

    public function show($id) { return Author::findOrFail($id); }

    public function update(Request $r,$id)
    {
        $a = Author::findOrFail($id);
        $a->update($r->all());
        return $a;
    }

    public function destroy($id) { Author::destroy($id); }
}