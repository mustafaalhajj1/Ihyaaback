<?php

namespace App\Http\Controllers;

use App\Models\BookComment;
use Illuminate\Http\Request;

class BookCommentController extends Controller
{
    // 🔹 عرض جميع التعليقات
    public function index()
    {
        $comments = BookComment::with(['user', 'book'])->get();

        return response()->json([
            'status' => true,
            'data' => $comments
        ], 200);
    }

    // 🔹 إضافة تعليق
    public function store(Request $request)
    {
        $data = $request->validate([
            'book_id' => 'required|exists:books,id',
            'comment' => 'required|string'
        ]);

        $comment = BookComment::create([
            'user_id' => auth()->id(),
            'book_id' => $data['book_id'],
            'comment' => $data['comment']
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Comment created successfully',
            'data' => $comment
        ], 201);
    }

    // 🔹 عرض تعليق واحد
    public function show($id)
    {
        $comment = BookComment::with(['user', 'book'])->findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $comment
        ], 200);
    }

    // 🔹 تحديث تعليق
    public function update(Request $request, $id)
    {
        $comment = BookComment::findOrFail($id);

        $data = $request->validate([
            'comment' => 'required|string'
        ]);

        $comment->update([
            'comment' => $data['comment']
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Comment updated successfully',
            'data' => $comment
        ], 200);
    }

    // 🔹 حذف تعليق
    public function destroy($id)
    {
        $comment = BookComment::findOrFail($id);
        $comment->delete();

        return response()->json([
            'status' => true,
            'message' => 'Comment deleted successfully'
        ], 200);
    }
}