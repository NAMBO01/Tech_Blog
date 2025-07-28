<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::withCount('posts')->paginate(10);
        return view('admin.admin_tags', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags',
            'slug' => 'nullable|string|max:255|unique:tags',
            'description' => 'nullable|string',
        ]);

        $tag = new Tag();
        $tag->name = $request->name;
        $tag->slug = $request->slug ?? Str::slug($request->name);
        $tag->description = $request->description;
        $tag->save();

        return redirect()->route('admin.admin_tags')
            ->with('success', 'Thẻ đã được tạo thành công.');
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $tag->id,
            'slug' => 'nullable|string|max:255|unique:tags,slug,' . $tag->id,
            'description' => 'nullable|string',
        ]);

        $tag->name = $request->name;
        $tag->slug = $request->slug ?? Str::slug($request->name);
        $tag->description = $request->description;
        $tag->save();

        return redirect()->route('admin.admin_tags')
            ->with('success', 'Thẻ đã được cập nhật thành công.');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('admin.admin_tags')
            ->with('success', 'Thẻ đã được xóa thành công.');
    }

    public function show(Tag $tag)
    {
        $posts = $tag->posts()
            ->where('status', 'published')
            ->with(['author', 'category'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('tags.show', compact('tag', 'posts'));
    }
}
