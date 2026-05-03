<?php

namespace App\Http\Controllers;

use App\Models\BookRating;
use Illuminate\Http\Request;

class BookRatingController extends Controller
{
    // 🔹 عرض جميع التقييمات
    public function index()
    {
        $ratings = BookRating::with(['user', 'book'])->get();

        return response()->json([
            'status' => true,
            'data' => $ratings
        ], 200);
    }

    // 🔹 إضافة تقييم
    public function store(Request $request)
    {
        $data = $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating'  => 'required|integer|min:1|max:5'
        ]);

        // منع المستخدم من تقييم نفس الكتاب أكثر من مرة (اختياري لكن مهم)
        $existing = BookRating::where('user_id', auth()->id())
                              ->where('book_id', $data['book_id'])
                              ->first();

        if ($existing) {
            return response()->json([
                'status' => false,
                'message' => 'You already rated this book'
            ], 400);
        }

        $rating = BookRating::create([
            'user_id' => auth()->id(),
            'book_id' => $data['book_id'],
            'rating'  => $data['rating']
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Rating added successfully',
            'data' => $rating
        ], 201);
    }

    // 🔹 عرض تقييم واحد
    public function show($id)
    {
        $rating = BookRating::with(['user', 'book'])->findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $rating
        ], 200);
    }

    // 🔹 تحديث تقييم
    public function update(Request $request, $id)
    {
        $rating = BookRating::findOrFail($id);

        $data = $request->validate([
            'rating' => 'required|integer|min:1|max:5'
        ]);

        $rating->update([
            'rating' => $data['rating']
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Rating updated successfully',
            'data' => $rating
        ], 200);
    }

    // 🔹 حذف تقييم
    public function destroy($id)
    {
        $rating = BookRating::findOrFail($id);
        $rating->delete();

        return response()->json([
            'status' => true,
            'message' => 'Rating deleted successfully'
        ], 200);
    }
}