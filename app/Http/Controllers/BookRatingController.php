<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookRatingController extends Controller
{
    public function store(Request $r)
    {
        return BookRating::create([
            'user_id'=>auth()->id(),
            'book_id'=>$r->book_id,
            'rating'=>$r->rating
        ]);
    }
}