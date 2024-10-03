<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255|unique:categories,title,' . $id,
        ]);

        try {
            // Cari kategori berdasarkan ID
            $category = Categories::findOrFail($id);

            // Update kategori
            $category->update([
                'title' => $request->input('title'),
            ]);

            // Berhasil update
            notify()->success('Category updated successfully!');
        } catch (\Exception $e) {
            // Gagal update
            notify()->error('Failed to update category. Please try again.');
        }

        return redirect()->route('category');
    }
}
