<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostUserController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get published posts with their categories
        $posts = Post::with('category')
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        // Get categories with post counts
        $categories = Category::withCount(['posts' => function ($query) {
            $query->where('status', 'published');
        }])->take(6)->get();

        // Get total counts for hero stats
        $totalPosts = Post::where('status', 'published')->count();
        $totalCategories = Category::count();

        return view('welcome', compact('posts', 'categories', 'totalPosts', 'totalCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
