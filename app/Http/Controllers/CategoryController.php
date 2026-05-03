<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // 🔹 عرض جميع التصنيفات
    public function index()
    {
        $categories = Category::all();

        return response()->json([
            'status' => true,
            'data' => $categories
        ], 200);
    }

    // 🔹 إنشاء تصنيف
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $category = Category::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Category created successfully',
            'data' => $category
        ], 201);
    }

    // 🔹 عرض تصنيف واحد
    public function show($id)
    {
        $category = Category::findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $category
        ], 200);
    }

    // 🔹 تحديث تصنيف
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $data = $request->validate([
            'name' => 'sometimes|string|max:255'
        ]);

        $category->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Category updated successfully',
            'data' => $category
        ], 200);
    }

    // 🔹 حذف تصنيف
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json([
            'status' => true,
            'message' => 'Category deleted successfully'
        ], 200);
    }
}