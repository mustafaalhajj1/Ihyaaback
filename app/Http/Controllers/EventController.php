<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // 🔹 عرض جميع الفعاليات
    public function index()
    {
        $events = Event::with(['hall', 'authors'])->get();

        return response()->json([
            'status' => true,
            'data' => $events
        ], 200);
    }

    // 🔹 إنشاء فعالية
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'   => 'required|string|max:255',
            'date'    => 'required|date',
            'time'    => 'required',
            'hall_id' => 'required|exists:halls,id'
        ]);

        $event = Event::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Event created successfully',
            'data' => $event
        ], 201);
    }

    // 🔹 عرض فعالية واحدة
    public function show($id)
    {
        $event = Event::with(['hall', 'authors'])->findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $event
        ], 200);
    }

    // 🔹 تحديث فعالية
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $data = $request->validate([
            'title'   => 'sometimes|string|max:255',
            'date'    => 'sometimes|date',
            'time'    => 'sometimes',
            'hall_id' => 'sometimes|exists:halls,id'
        ]);

        $event->update($data);

        // إعادة تحميل العلاقات
        $event->load(['hall', 'authors']);

        return response()->json([
            'status' => true,
            'message' => 'Event updated successfully',
            'data' => $event
        ], 200);
    }

    // 🔹 حذف فعالية
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return response()->json([
            'status' => true,
            'message' => 'Event deleted successfully'
        ], 200);
    }
}