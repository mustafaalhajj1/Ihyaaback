<?php

namespace App\Http\Controllers;

use App\Models\Booth;
use Illuminate\Http\Request;

class BoothController extends Controller
{
    // 🔹 عرض كل الأجنحة
    public function index()
    {
        $booths = Booth::with(['publisher', 'hall'])->get();

        return response()->json([
            'status' => true,
            'data' => $booths
        ], 200);
    }

    // 🔹 إنشاء جناح
    public function store(Request $request)
    {
        $data = $request->validate([
            'location_description' => 'required|string',
            'publisher_id' => 'required|exists:publishers,id',
            'hall_id' => 'required|exists:halls,id'
        ]);

        $booth = Booth::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Booth created successfully',
            'data' => $booth
        ], 201);
    }

    // 🔹 عرض جناح واحد
    public function show($id)
    {
        $booth = Booth::with(['publisher', 'hall'])->findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $booth
        ], 200);
    }

    // 🔹 تحديث جناح
    public function update(Request $request, $id)
    {
        $booth = Booth::findOrFail($id);

        $data = $request->validate([
            'location_description' => 'sometimes|string',
            'publisher_id' => 'sometimes|exists:publishers,id',
            'hall_id' => 'sometimes|exists:halls,id'
        ]);

        $booth->update($data);

        // إعادة تحميل العلاقات
        $booth->load(['publisher', 'hall']);

        return response()->json([
            'status' => true,
            'message' => 'Booth updated successfully',
            'data' => $booth
        ], 200);
    }

    // 🔹 حذف جناح
    public function destroy($id)
    {
        $booth = Booth::findOrFail($id);
        $booth->delete();

        return response()->json([
            'status' => true,
            'message' => 'Booth deleted successfully'
        ], 200);
    }
}