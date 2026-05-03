<?php

namespace App\Http\Controllers;

use App\Models\EventRating;
use Illuminate\Http\Request;

class EventRatingController extends Controller
{
    // 🔹 عرض جميع التقييمات
    public function index()
    {
        $ratings = EventRating::with(['user', 'event'])->get();

        return response()->json([
            'status' => true,
            'data' => $ratings
        ], 200);
    }

    // 🔹 إضافة تقييم
    public function store(Request $request)
    {
        $data = $request->validate([
            'event_id' => 'required|exists:events,id',
            'rating'   => 'required|integer|min:1|max:5'
        ]);

        // منع تكرار التقييم لنفس المستخدم ونفس الحدث
        $exists = EventRating::where('user_id', auth()->id())
                             ->where('event_id', $data['event_id'])
                             ->exists();

        if ($exists) {
            return response()->json([
                'status' => false,
                'message' => 'You already rated this event'
            ], 400);
        }

        $rating = EventRating::create([
            'user_id'  => auth()->id(),
            'event_id' => $data['event_id'],
            'rating'   => $data['rating']
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
        $rating = EventRating::with(['user', 'event'])->findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $rating
        ], 200);
    }

    // 🔹 تحديث تقييم
    public function update(Request $request, $id)
    {
        $rating = EventRating::findOrFail($id);

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
        $rating = EventRating::findOrFail($id);
        $rating->delete();

        return response()->json([
            'status' => true,
            'message' => 'Rating deleted successfully'
        ], 200);
    }
}