<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    // 🔹 عرض كل الصلاحيات الخاصة بدور معين
    public function index($roleId)
    {
        $role = Role::with('permissions')->findOrFail($roleId);

        return response()->json([
            'status' => true,
            'data' => $role->permissions
        ], 200);
    }

    // 🔹 ربط Role مع Permissions
    public function store(Request $request, $roleId)
    {
        $data = $request->validate([
            'permission_ids' => 'required|array',
            'permission_ids.*' => 'exists:permissions,id'
        ]);

        $role = Role::findOrFail($roleId);

        // إضافة بدون حذف القديم
        $role->permissions()->syncWithoutDetaching($data['permission_ids']);

        return response()->json([
            'status' => true,
            'message' => 'Permissions attached to role successfully'
        ], 201);
    }

    // 🔹 عرض Permission معين داخل Role
    public function show($roleId, $permissionId)
    {
        $role = Role::findOrFail($roleId);

        $permission = $role->permissions()->findOrFail($permissionId);

        return response()->json([
            'status' => true,
            'data' => $permission
        ], 200);
    }

    // 🔹 تحديث كل permissions الخاصة بـ Role (استبدال كامل)
    public function update(Request $request, $roleId)
    {
        $data = $request->validate([
            'permission_ids' => 'required|array',
            'permission_ids.*' => 'exists:permissions,id'
        ]);

        $role = Role::findOrFail($roleId);

        $role->permissions()->sync($data['permission_ids']);

        return response()->json([
            'status' => true,
            'message' => 'Role permissions updated successfully'
        ], 200);
    }

    // 🔹 حذف Permission من Role
    public function destroy($roleId, $permissionId)
    {
        $role = Role::findOrFail($roleId);

        $role->permissions()->detach($permissionId);

        return response()->json([
            'status' => true,
            'message' => 'Permission removed from role successfully'
        ], 200);
    }
}