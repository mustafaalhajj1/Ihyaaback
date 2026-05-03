<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookCategoryController extends Controller
{
    // 🔹 عرض كل التصنيفات لكتاب
    public function index($bookId)
    {
        $book = Book::with('categories')->findOrFail($bookId);

        return response()->json([
            'status' => true,
            'data' => $book->categories
        ]);
    }

    // 🔹 ربط كتاب مع تصنيفات
    public function store(Request $request, $bookId)
    {
        $request->validate([
            'category_ids' => 'required|array'
        ]);

        $book = Book::findOrFail($bookId);

        $book->categories()->syncWithoutDetaching($request->category_ids);

        return response()->json([
            'status' => true,
            'message' => 'Categories attached successfully'
        ]);
    }

    // 🔹 عرض تصنيف معين داخل كتاب
    public function show($bookId, $categoryId)
    {
        $book = Book::findOrFail($bookId);

        $category = $book->categories()->findOrFail($categoryId);

        return response()->json([
            'status' => true,
            'data' => $category
        ]);
    }

    // 🔹 تحديث التصنيفات (استبدال)
    public function update(Request $request, $bookId)
    {
        $request->validate([
            'category_ids' => 'required|array'
        ]);

        $book = Book::findOrFail($bookId);

        $book->categories()->sync($request->category_ids);

        return response()->json([
            'status' => true,
            'message' => 'Categories updated successfully'
        ]);
    }

    // 🔹 حذف علاقة معينة
    public function destroy($bookId, $categoryId)
    {
        $book = Book::findOrFail($bookId);

        $book->categories()->detach($categoryId);

        return response()->json([
            'status' => true,
            'message' => 'Category detached successfully'
        ]);
    }
}