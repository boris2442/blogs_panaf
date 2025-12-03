<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Ajouter un commentaire
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        // Créer le commentaire
        Comment::create([
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'body' => $request->body,
        ]);

        return back()->with('success', 'Votre commentaire a été ajouté.');
    }
}
