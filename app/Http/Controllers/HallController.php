<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use Illuminate\Http\Request;

class HallController extends Controller
{
    // 🔹 عرض جميع القاعات
    public function index()
    {
        $halls = Hall::all();

        return response()->json([
            'status' => true,
            'data' => $halls
        ], 200);
    }

    // 🔹 إنشاء قاعة
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $hall = Hall::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Hall created successfully',
            'data' => $hall
        ], 201);
    }

    // 🔹 عرض قاعة واحدة
    public function show($id)
    {
        $hall = Hall::findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $hall
        ], 200);
    }

    // 🔹 تحديث قاعة
    public function update(Request $request, $id)
    {
        $hall = Hall::findOrFail($id);

        $data = $request->validate([
            'name' => 'sometimes|string|max:255'
        ]);

        $hall->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Hall updated successfully',
            'data' => $hall
        ], 200);
    }

    // 🔹 حذف قاعة
    public function destroy($id)
    {
        $hall = Hall::findOrFail($id);
        $hall->delete();

        return response()->json([
            'status' => true,
            'message' => 'Hall deleted successfully'
        ], 200);
    }
}