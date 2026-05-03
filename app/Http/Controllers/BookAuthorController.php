<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class BookAuthorController extends Controller
{
    // 🔹 عرض جميع المؤلفين لكتاب
    public function index($bookId)
    {
        $book = Book::with('authors')->findOrFail($bookId);

        return response()->json([
            'status' => true,
            'data' => $book->authors
        ]);
    }

    // 🔹 ربط كتاب مع مؤلفين
    public function store(Request $request, $bookId)
    {
        $request->validate([
            'author_ids' => 'required|array'
        ]);

        $book = Book::findOrFail($bookId);

        $book->authors()->syncWithoutDetaching($request->author_ids);

        return response()->json([
            'status' => true,
            'message' => 'Authors attached successfully'
        ]);
    }

    // 🔹 عرض مؤلف معين داخل كتاب
    public function show($bookId, $authorId)
    {
        $book = Book::findOrFail($bookId);

        $author = $book->authors()->findOrFail($authorId);

        return response()->json([
            'status' => true,
            'data' => $author
        ]);
    }

    // 🔹 تحديث المؤلفين (استبدال كامل)
    public function update(Request $request, $bookId)
    {
        $request->validate([
            'author_ids' => 'required|array'
        ]);

        $book = Book::findOrFail($bookId);

        $book->authors()->sync($request->author_ids);

        return response()->json([
            'status' => true,
            'message' => 'Authors updated successfully'
        ]);
    }

    // 🔹 حذف علاقة مؤلف مع كتاب
    public function destroy($bookId, $authorId)
    {
        $book = Book::findOrFail($bookId);

        $book->authors()->detach($authorId);

        return response()->json([
            'status' => true,
            'message' => 'Author detached successfully'
        ]);
    }
}