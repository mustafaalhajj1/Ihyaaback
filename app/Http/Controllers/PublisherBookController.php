<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use App\Models\Book;
use Illuminate\Http\Request;

class PublisherBookController extends Controller
{
    // 🔹 عرض كل الكتب لناشر معين
    public function index($publisherId)
    {
        $publisher = Publisher::with('books')->findOrFail($publisherId);

        return response()->json([
            'status' => true,
            'data' => $publisher->books
        ], 200);
    }

    // 🔹 ربط كتب مع ناشر
    public function store(Request $request, $publisherId)
    {
        $data = $request->validate([
            'book_ids' => 'required|array',
            'book_ids.*' => 'exists:books,id'
        ]);

        $publisher = Publisher::findOrFail($publisherId);

        $publisher->books()->syncWithoutDetaching($data['book_ids']);

        return response()->json([
            'status' => true,
            'message' => 'Books attached to publisher successfully'
        ], 201);
    }

    // 🔹 عرض كتاب معين عند ناشر
    public function show($publisherId, $bookId)
    {
        $publisher = Publisher::findOrFail($publisherId);

        $book = $publisher->books()->findOrFail($bookId);

        return response()->json([
            'status' => true,
            'data' => $book
        ], 200);
    }

    // 🔹 تحديث الكتب (استبدال كامل)
    public function update(Request $request, $publisherId)
    {
        $data = $request->validate([
            'book_ids' => 'required|array',
            'book_ids.*' => 'exists:books,id'
        ]);

        $publisher = Publisher::findOrFail($publisherId);

        $publisher->books()->sync($data['book_ids']);

        return response()->json([
            'status' => true,
            'message' => 'Publisher books updated successfully'
        ], 200);
    }

    // 🔹 حذف علاقة كتاب مع ناشر
    public function destroy($publisherId, $bookId)
    {
        $publisher = Publisher::findOrFail($publisherId);

        $publisher->books()->detach($bookId);

        return response()->json([
            'status' => true,
            'message' => 'Book detached from publisher successfully'
        ], 200);
    }
}