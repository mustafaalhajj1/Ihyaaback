<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    // 🔹 عرض كل المفضلة (يمكن تعديلها لاحقًا لتكون خاصة بالمستخدم)
    public function index()
    {
        $favorites = Favorite::with(['user', 'book'])->get();

        return response()->json([
            'status' => true,
            'data' => $favorites
        ], 200);
    }

    // 🔹 إضافة كتاب للمفضلة
    public function store(Request $request)
    {
        $data = $request->validate([
            'book_id' => 'required|exists:books,id'
        ]);

        // منع التكرار
        $exists = Favorite::where('user_id', auth()->id())
                          ->where('book_id', $data['book_id'])
                          ->exists();

        if ($exists) {
            return response()->json([
                'status' => false,
                'message' => 'Book already in favorites'
            ], 400);
        }

        $favorite = Favorite::create([
            'user_id' => auth()->id(),
            'book_id' => $data['book_id']
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Added to favorites',
            'data' => $favorite
        ], 201);
    }

    // 🔹 عرض عنصر واحد
    public function show($id)
    {
        $favorite = Favorite::with(['user', 'book'])->findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $favorite
        ], 200);
    }

    // 🔹 حذف من المفضلة
    public function destroy($id)
    {
        $favorite = Favorite::findOrFail($id);
        $favorite->delete();

        return response()->json([
            'status' => true,
            'message' => 'Removed from favorites'
        ], 200);
    }
}