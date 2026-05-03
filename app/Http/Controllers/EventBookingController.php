<?php

namespace App\Http\Controllers;

use App\Models\EventBooking;
use Illuminate\Http\Request;

class EventBookingController extends Controller
{
    // 🔹 عرض جميع الحجوزات
    public function index()
    {
        $bookings = EventBooking::with(['user', 'event'])->get();

        return response()->json([
            'status' => true,
            'data' => $bookings
        ], 200);
    }

    // 🔹 إنشاء حجز
    public function store(Request $request)
    {
        $data = $request->validate([
            'event_id' => 'required|exists:events,id'
        ]);

        // منع تكرار الحجز لنفس المستخدم ونفس الحدث
        $exists = EventBooking::where('user_id', auth()->id())
                              ->where('event_id', $data['event_id'])
                              ->exists();

        if ($exists) {
            return response()->json([
                'status' => false,
                'message' => 'You already booked this event'
            ], 400);
        }

        $booking = EventBooking::create([
            'user_id' => auth()->id(),
            'event_id' => $data['event_id']
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Booking created successfully',
            'data' => $booking
        ], 201);
    }

    // 🔹 عرض حجز واحد
    public function show($id)
    {
        $booking = EventBooking::with(['user', 'event'])->findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $booking
        ], 200);
    }

    // 🔹 تحديث الحجز (تغيير الحدث)
    public function update(Request $request, $id)
    {
        $booking = EventBooking::findOrFail($id);

        $data = $request->validate([
            'event_id' => 'required|exists:events,id'
        ]);

        $booking->update([
            'event_id' => $data['event_id']
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Booking updated successfully',
            'data' => $booking
        ], 200);
    }

    // 🔹 حذف الحجز
    public function destroy($id)
    {
        $booking = EventBooking::findOrFail($id);
        $booking->delete();

        return response()->json([
            'status' => true,
            'message' => 'Booking deleted successfully'
        ], 200);
    }
}