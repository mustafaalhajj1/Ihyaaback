<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    // 🔹 عرض جميع الصلاحيات
    public function index()
    {
        $permissions = Permission::all();

        return response()->json([
            'status' => true,
            'data' => $permissions
        ], 200);
    }

    // 🔹 إنشاء صلاحية
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name'
        ]);

        $permission = Permission::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Permission created successfully',
            'data' => $permission
        ], 201);
    }

    // 🔹 عرض صلاحية واحدة
    public function show($id)
    {
        $permission = Permission::findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $permission
        ], 200);
    }

    // 🔹 تحديث صلاحية
    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);

        $data = $request->validate([
            'name' => 'sometimes|string|max:255|unique:permissions,name,' . $id
        ]);

        $permission->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Permission updated successfully',
            'data' => $permission
        ], 200);
    }

    // 🔹 حذف صلاحية
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return response()->json([
            'status' => true,
            'message' => 'Permission deleted successfully'
        ], 200);
    }
}