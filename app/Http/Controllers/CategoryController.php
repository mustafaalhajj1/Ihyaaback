<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() { return Category::all(); }

    public function store(Request $r)
    {
        return Category::create($r->validate(['name'=>'required']));
    }

    public function show($id) { return Category::findOrFail($id); }

    public function update(Request $r,$id)
    {
        $c = Category::findOrFail($id);
        $c->update($r->all());
        return $c;
    }

    public function destroy($id) { Category::destroy($id); }
}