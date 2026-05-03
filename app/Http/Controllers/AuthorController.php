<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    // 🔹 عرض جميع المؤلفين
    public function index()
    {
        $authors = Author::all();

        return response()->json([
            'status' => true,
            'data' => $authors
        ], 200);
    }

    // 🔹 إنشاء مؤلف جديد
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $author = Author::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Author created successfully',
            'data' => $author
        ], 201);
    }

    // 🔹 عرض مؤلف واحد
    public function show($id)
    {
        $author = Author::findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $author
        ], 200);
    }

    // 🔹 تحديث المؤلف
    public function update(Request $request, $id)
    {
        $author = Author::findOrFail($id);

        $data = $request->validate([
            'name' => 'sometimes|string|max:255'
        ]);

        $author->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Author updated successfully',
            'data' => $author
        ], 200);
    }

    // 🔹 حذف المؤلف
    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();

        return response()->json([
            'status' => true,
            'message' => 'Author deleted successfully'
        ], 200);
    }
}