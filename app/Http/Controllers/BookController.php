<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;

class BookController extends Controller
{
    // 🔹 عرض جميع الكتب
    public function index()
    {
        $books = Book::with(['authors', 'categories', 'publishers'])->get();

        return response()->json([
            'status' => true,
            'data' => BookResource::collection($books)
        ], 200);
    }

    // 🔹 إنشاء كتاب
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'publication_year' => 'nullable|integer',
            'language' => 'nullable|string|max:50'
        ]);

        $book = Book::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Book created successfully',
            'data' => new BookResource($book)
        ], 201);
    }

    // 🔹 عرض كتاب واحد
    public function show($id)
    {
        $book = Book::with(['authors', 'categories', 'publishers'])
                    ->findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => new BookResource($book)
        ], 200);
    }

    // 🔹 تحديث كتاب
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $data = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'publication_year' => 'nullable|integer',
            'language' => 'nullable|string|max:50'
        ]);

        $book->update($data);

        // إعادة تحميل العلاقات
        $book->load(['authors', 'categories', 'publishers']);

        return response()->json([
            'status' => true,
            'message' => 'Book updated successfully',
            'data' => new BookResource($book)
        ], 200);
    }

    // 🔹 حذف كتاب
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json([
            'status' => true,
            'message' => 'Book deleted successfully'
        ], 200);
    }
}