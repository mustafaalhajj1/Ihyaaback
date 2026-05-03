<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function store(Request $r)
    {
        return Favorite::create([
            'user_id'=>auth()->id(),
            'book_id'=>$r->book_id
        ]);
    }
}
