<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);
        return view('pages.posts/index', compact('posts'));
    }



    public function create()
    {

        return view('pages.posts.create');
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        // Slug unique
        $slug = Str::slug($request->title);
        if (Post::where('slug', $slug)->exists()) {
            $slug .= '-' . time();
        }

        $data['slug'] = $slug;
        $data['user_id'] = auth()->id();

        // Upload image dans public/posts/images
        if ($request->hasFile('thumbnail')) {
            $filename = time() . '-' . Str::random(6) . '.' . $request->thumbnail->extension();
            $request->thumbnail->move(public_path('posts/images'), $filename);
            $data['thumbnail'] = 'posts/images/' . $filename;
        }

        Post::create($data);

        return back()->with('success', 'Article créé avec succès.');
    }

    public function show(Post $post)
    {
        $post->load('user', 'comments.user');
        return view('pages.posts/show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('pages.posts.edit', [
            'post' => $post
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        // Slug unique (si changement de titre)
        if ($post->title !== $request->title) {
            $slug = Str::slug($request->title);

            if (Post::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
                $slug .= '-' . time();
            }

            $data['slug'] = $slug;
        }

        // Image
        if ($request->hasFile('thumbnail')) {

            if ($post->thumbnail && file_exists(public_path($post->thumbnail))) {
                unlink(public_path($post->thumbnail));
            }

            $filename = time() . '-' . Str::random(6) . '.' . $request->thumbnail->extension();
            $request->thumbnail->move(public_path('posts/images'), $filename);

            $data['thumbnail'] = 'posts/images/' . $filename;
        }

        $post->update($data);

        // return back()->with('success', 'Article mis à jour.');
        return redirect()->route('admin.posts.index')->with('success', 'Article mis à jour.');
    }

    public function destroy(Post $post)
    {
        if ($post->thumbnail && file_exists(public_path($post->thumbnail))) {
            unlink(public_path($post->thumbnail));
        }

        $post->delete();

        return back()->with('success', 'Article supprimé.');
    }
}
