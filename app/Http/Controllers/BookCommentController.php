<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookCommentController extends Controller
{
    public function store(Request $r)
    {
        return BookComment::create([
            'user_id'=>auth()->id(),
            'book_id'=>$r->book_id,
            'comment'=>$r->comment
        ]);
    }
}