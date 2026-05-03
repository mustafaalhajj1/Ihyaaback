<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // 🔹 عرض إشعارات المستخدم الحالي
    public function index()
    {
        $notifications = Notification::where('user_id', auth()->id())->get();

        return response()->json([
            'status' => true,
            'data' => $notifications
        ], 200);
    }

    // 🔹 إنشاء إشعار
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string'
        ]);

        $notification = Notification::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Notification created successfully',
            'data' => $notification
        ], 201);
    }

    // 🔹 عرض إشعار واحد
    public function show($id)
    {
        $notification = Notification::where('user_id', auth()->id())
                                    ->findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $notification
        ], 200);
    }

    // 🔹 تحديث إشعار (مثلاً تعليمه كمقروء)
    public function update(Request $request, $id)
    {
        $notification = Notification::where('user_id', auth()->id())
                                    ->findOrFail($id);

        $data = $request->validate([
            'is_read' => 'sometimes|boolean',
            'message' => 'sometimes|string'
        ]);

        $notification->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Notification updated successfully',
            'data' => $notification
        ], 200);
    }

    // 🔹 حذف إشعار
    public function destroy($id)
    {
        $notification = Notification::where('user_id', auth()->id())
                                    ->findOrFail($id);

        $notification->delete();

        return response()->json([
            'status' => true,
            'message' => 'Notification deleted successfully'
        ], 200);
    }
}