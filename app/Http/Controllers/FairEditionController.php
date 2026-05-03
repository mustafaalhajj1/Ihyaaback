<?php

namespace App\Http\Controllers;

use App\Models\FairEdition;
use Illuminate\Http\Request;

class FairEditionController extends Controller
{
    // 🔹 عرض جميع الدورات
    public function index()
    {
        $editions = FairEdition::all();

        return response()->json([
            'status' => true,
            'data' => $editions
        ], 200);
    }

    // 🔹 إنشاء دورة جديدة
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:2100'
        ]);

        $edition = FairEdition::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Fair edition created successfully',
            'data' => $edition
        ], 201);
    }

    // 🔹 عرض دورة واحدة
    public function show($id)
    {
        $edition = FairEdition::findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $edition
        ], 200);
    }

    // 🔹 تحديث دورة
    public function update(Request $request, $id)
    {
        $edition = FairEdition::findOrFail($id);

        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'year' => 'sometimes|integer|min:1900|max:2100'
        ]);

        $edition->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Fair edition updated successfully',
            'data' => $edition
        ], 200);
    }

    // 🔹 حذف دورة
    public function destroy($id)
    {
        $edition = FairEdition::findOrFail($id);
        $edition->delete();

        return response()->json([
            'status' => true,
            'message' => 'Fair edition deleted successfully'
        ], 200);
    }
}