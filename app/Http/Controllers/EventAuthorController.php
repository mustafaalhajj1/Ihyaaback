<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Author;
use Illuminate\Http\Request;

class EventAuthorController extends Controller
{
    // 🔹 عرض كل المؤلفين لفعالية
    public function index($eventId)
    {
        $event = Event::with('authors')->findOrFail($eventId);

        return response()->json([
            'status' => true,
            'data' => $event->authors
        ], 200);
    }

    // 🔹 ربط فعالية مع مؤلفين
    public function store(Request $request, $eventId)
    {
        $data = $request->validate([
            'author_ids' => 'required|array',
            'author_ids.*' => 'exists:authors,id'
        ]);

        $event = Event::findOrFail($eventId);

        $event->authors()->syncWithoutDetaching($data['author_ids']);

        return response()->json([
            'status' => true,
            'message' => 'Authors attached to event successfully'
        ], 201);
    }

    // 🔹 عرض مؤلف معين داخل فعالية
    public function show($eventId, $authorId)
    {
        $event = Event::findOrFail($eventId);

        $author = $event->authors()->findOrFail($authorId);

        return response()->json([
            'status' => true,
            'data' => $author
        ], 200);
    }

    // 🔹 تحديث المؤلفين (استبدال كامل)
    public function update(Request $request, $eventId)
    {
        $data = $request->validate([
            'author_ids' => 'required|array',
            'author_ids.*' => 'exists:authors,id'
        ]);

        $event = Event::findOrFail($eventId);

        $event->authors()->sync($data['author_ids']);

        return response()->json([
            'status' => true,
            'message' => 'Event authors updated successfully'
        ], 200);
    }

    // 🔹 حذف علاقة مؤلف مع فعالية
    public function destroy($eventId, $authorId)
    {
        $event = Event::findOrFail($eventId);

        $event->authors()->detach($authorId);

        return response()->json([
            'status' => true,
            'message' => 'Author detached from event successfully'
        ], 200);
    }
}