<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Publisher;
use Illuminate\Http\Request;

class UserPublisherController extends Controller
{
    // 🔹 عرض كل الناشرين الذين يتابعهم المستخدم
    public function index($userId)
    {
        $user = User::with('publishers')->findOrFail($userId);

        return response()->json([
            'status' => true,
            'data' => $user->publishers
        ], 200);
    }

    // 🔹 ربط User مع Publishers (متابعة ناشرين)
    public function store(Request $request, $userId)
    {
        $data = $request->validate([
            'publisher_ids' => 'required|array',
            'publisher_ids.*' => 'exists:publishers,id'
        ]);

        $user = User::findOrFail($userId);

        $user->publishers()->syncWithoutDetaching($data['publisher_ids']);

        return response()->json([
            'status' => true,
            'message' => 'Publishers attached to user successfully'
        ], 201);
    }

    // 🔹 عرض ناشر معين للمستخدم
    public function show($userId, $publisherId)
    {
        $user = User::findOrFail($userId);

        $publisher = $user->publishers()->findOrFail($publisherId);

        return response()->json([
            'status' => true,
            'data' => $publisher
        ], 200);
    }

    // 🔹 تحديث (استبدال كامل للناشرين)
    public function update(Request $request, $userId)
    {
        $data = $request->validate([
            'publisher_ids' => 'required|array',
            'publisher_ids.*' => 'exists:publishers,id'
        ]);

        $user = User::findOrFail($userId);

        $user->publishers()->sync($data['publisher_ids']);

        return response()->json([
            'status' => true,
            'message' => 'User publishers updated successfully'
        ], 200);
    }

    // 🔹 إلغاء متابعة ناشر
    public function destroy($userId, $publisherId)
    {
        $user = User::findOrFail($userId);

        $user->publishers()->detach($publisherId);

        return response()->json([
            'status' => true,
            'message' => 'Publisher removed from user successfully'
        ], 200);
    }
}