<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    // 🔹 عرض جميع الناشرين
    public function index()
    {
        $publishers = Publisher::with('books')->get();

        return response()->json([
            'status' => true,
            'data' => $publishers
        ], 200);
    }

    // 🔹 إنشاء ناشر
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $publisher = Publisher::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Publisher created successfully',
            'data' => $publisher
        ], 201);
    }

    // 🔹 عرض ناشر واحد
    public function show($id)
    {
        $publisher = Publisher::with('books')->findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $publisher
        ], 200);
    }

    // 🔹 تحديث ناشر
    public function update(Request $request, $id)
    {
        $publisher = Publisher::findOrFail($id);

        $data = $request->validate([
            'name' => 'sometimes|string|max:255'
        ]);

        $publisher->update($data);

        // إعادة تحميل العلاقات
        $publisher->load('books');

        return response()->json([
            'status' => true,
            'message' => 'Publisher updated successfully',
            'data' => $publisher
        ], 200);
    }

    // 🔹 حذف ناشر
    public function destroy($id)
    {
        $publisher = Publisher::findOrFail($id);
        $publisher->delete();

        return response()->json([
            'status' => true,
            'message' => 'Publisher deleted successfully'
        ], 200);
    }
}