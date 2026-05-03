<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // 🔹 عرض كل الأدوار مع الصلاحيات
    public function index()
    {
        $roles = Role::with('permissions')->get();

        return response()->json([
            'status' => true,
            'data' => $roles
        ], 200);
    }

    // 🔹 إنشاء Role
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name'
        ]);

        $role = Role::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Role created successfully',
            'data' => $role
        ], 201);
    }

    // 🔹 عرض Role واحد
    public function show($id)
    {
        $role = Role::with('permissions')->findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $role
        ], 200);
    }

    // 🔹 تحديث Role
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $data = $request->validate([
            'name' => 'sometimes|string|max:255|unique:roles,name,' . $id
        ]);

        $role->update($data);

        // إعادة تحميل العلاقات
        $role->load('permissions');

        return response()->json([
            'status' => true,
            'message' => 'Role updated successfully',
            'data' => $role
        ], 200);
    }

    // 🔹 حذف Role
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return response()->json([
            'status' => true,
            'message' => 'Role deleted successfully'
        ], 200);
    }
}
