<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    public function index()
    {
        $fields = Field::withCount('posts')->oldest()->paginate(10);
        return view('admin.fields.index', compact('fields'));
    }

    public function create()
    {
        abort_unless(auth()->user()->isAdmin(), 403);
        return view('admin.fields.create');
    }

    public function store(Request $request)
    {
        abort_unless(auth()->user()->isAdmin(), 403);
        $request->validate([
            'name' => 'required|max:255|unique:fields',
            'slug' => 'required|max:255|unique:fields',
            'description' => 'nullable'
        ]);

        Field::create($request->all());

        return redirect()->route('admin.fields.index')
            ->with('success', 'Lĩnh vực đã được tạo thành công.');
    }

    public function edit(Field $field)
    {
        abort_unless(auth()->user()->isAdmin(), 403);
        return view('admin.fields.edit', compact('field'));
    }

    public function update(Request $request, Field $field)
    {
        abort_unless(auth()->user()->isAdmin(), 403);
        $request->validate([
            'name' => 'required|max:255|unique:fields,name,' . $field->id,
            'slug' => 'required|max:255|unique:fields,slug,' . $field->id,
            'description' => 'nullable'
        ]);

        $field->update($request->all());

        return redirect()->route('admin.fields.index')
            ->with('success', 'Lĩnh vực đã được cập nhật thành công.');
    }

    public function destroy(Field $field)
    {
        abort_unless(auth()->user()->isAdmin(), 403);
        $field->delete();

        return redirect()->route('admin.fields.index')
            ->with('success', 'Lĩnh vực đã được xóa thành công.');
    }
}
