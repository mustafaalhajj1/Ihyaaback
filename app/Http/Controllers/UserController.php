<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // 🔹 عرض كل المستخدمين مع الأدوار
    public function index()
    {
        $users = User::with('role')->get();

        return response()->json([
            'status' => true,
            'data' => $users
        ], 200);
    }

    // 🔹 عرض مستخدم واحد
    public function show($id)
    {
        $user = User::with('role')->findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $user
        ], 200);
    }

    // 🔹 تحديث مستخدم
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255|unique:users,email,' . $id,
            'role_id' => 'sometimes|exists:roles,id'
        ]);

        $user->update($data);

        // إعادة تحميل العلاقة
        $user->load('role');

        return response()->json([
            'status' => true,
            'message' => 'User updated successfully',
            'data' => $user
        ], 200);
    }

    // 🔹 حذف مستخدم
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'status' => true,
            'message' => 'User deleted successfully'
        ], 200);
    }
}