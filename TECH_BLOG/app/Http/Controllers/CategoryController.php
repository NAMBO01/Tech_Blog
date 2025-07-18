<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('posts')->latest()->paginate(10);
        return view('admin.admin_cate', compact('categories'));
    }

    public function create()
    {
        abort_unless(auth()->user()->isAdmin(), 403);
        $categories = Category::all();
        $fields = Field::where('status', true)->get();
        return view('admin.categories.create', compact('categories', 'fields'));
    }

    public function store(Request $request)
    {
        abort_unless(auth()->user()->isAdmin(), 403);
        $request->validate([
            'name' => 'required|max:255|unique:categories',
            'slug' => 'required|max:255|unique:categories',
            'description' => 'nullable',
            'parent_id' => 'nullable|exists:categories,id',
            'field_id' => 'nullable|exists:fields,id'
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'parent_id' => $request->parent_id,
            'field_id' => $request->field_id
        ]);

        return redirect()->route('admin.admin_cate')
            ->with('success', 'Danh mục đã được tạo thành công.');
    }

    public function edit(Category $category)
    {
        abort_unless(auth()->user()->isAdmin(), 403);
        $categories = Category::where('id', '!=', $category->id)->get();
        $fields = Field::where('status', true)->get();
        return view('admin.categories.edit', compact('category', 'categories', 'fields'));
    }

    public function update(Request $request, Category $category)
    {
        abort_unless(auth()->user()->isAdmin(), 403);
        $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $category->id,
            'slug' => 'required|max:255|unique:categories,slug,' . $category->id,
            'description' => 'nullable',
            'parent_id' => 'nullable|exists:categories,id',
            'field_id' => 'nullable|exists:fields,id'
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'parent_id' => $request->parent_id,
            'field_id' => $request->field_id
        ]);

        return redirect()->route('admin.admin_cate')
            ->with('success', 'Danh mục đã được cập nhật thành công.');
    }

    public function destroy(Category $category)
    {
        abort_unless(auth()->user()->isAdmin(), 403);
        // Kiểm tra xem có danh mục con không
        if ($category->children()->count() > 0) {
            return redirect()->route('admin.admin_cate')
                ->with('error', 'Không thể xóa danh mục này vì nó có danh mục con.');
        }

        // Kiểm tra xem có bài viết nào thuộc danh mục này không
        if ($category->posts()->count() > 0) {
            return redirect()->route('admin.admin_cate')
                ->with('error', 'Không thể xóa danh mục này vì nó có bài viết.');
        }

        try {
            $category->delete();
            return redirect()->route('admin.admin_cate')
                ->with('success', 'Danh mục đã được xóa thành công.');
        } catch (\Exception $e) {
            return redirect()->route('admin.admin_cate')
                ->with('error', 'Có lỗi xảy ra khi xóa danh mục: ' . $e->getMessage());
        }
    }
}
