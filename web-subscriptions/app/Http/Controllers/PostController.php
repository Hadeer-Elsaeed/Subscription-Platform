<?php

namespace App\Http\Controllers;

use App\Models\Website;
use Illuminate\Http\Request;
use App\Events\PostPublished;


class PostController extends Controller
{

    // Endpoint to create a post for a website
    public function store(Request $request, Website $website)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        if ($website->posts()->where('title', $validated['title'])->exists()) {
            return response()->json(['message' => 'Post with this title already exists for this website.'], 422);
        }

        $post = $website->posts()->create($validated);
        // publish event for the post created
        event(new PostPublished($post));

        return response()->json([
            'message' => 'Post created successfully and event is fired.',
            'post' => $post,
        ], 201);
    }
}
