<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;

class BookController extends Controller
{
    public function index()
    {
        return Book::with(['authors','categories','publishers'])->get();
    }

    public function store(Request $r)
    {
        $r->validate(['title'=>'required']);
        return Book::create($r->all());
    }

    public function show($id)
    {
        return Book::with(['authors','categories','publishers'])->findOrFail($id);
    }

    public function update(Request $r,$id)
    {
        $b = Book::findOrFail($id);
        $b->update($r->all());
        return $b;
    }

    public function destroy($id) { Book::destroy($id); }
}