<?php

namespace App\Http\Controllers;

use App\Models\EventComment;
use Illuminate\Http\Request;

class EventCommentController extends Controller
{
    // 🔹 عرض جميع التعليقات
    public function index()
    {
        $comments = EventComment::with(['user', 'event'])->get();

        return response()->json([
            'status' => true,
            'data' => $comments
        ], 200);
    }

    // 🔹 إضافة تعليق
    public function store(Request $request)
    {
        $data = $request->validate([
            'event_id' => 'required|exists:events,id',
            'comment'  => 'required|string'
        ]);

        $comment = EventComment::create([
            'user_id'  => auth()->id(),
            'event_id' => $data['event_id'],
            'comment'  => $data['comment']
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
        $comment = EventComment::with(['user', 'event'])->findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $comment
        ], 200);
    }

    // 🔹 تحديث تعليق
    public function update(Request $request, $id)
    {
        $comment = EventComment::findOrFail($id);

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
        $comment = EventComment::findOrFail($id);
        $comment->delete();

        return response()->json([
            'status' => true,
            'message' => 'Comment deleted successfully'
        ], 200);
    }
}