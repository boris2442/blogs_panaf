<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostFrontendController extends Controller
{
    // Afficher la liste des articles
    public function index()
    {
        // Récupérer les articles avec l'auteur, derniers en premier, pagination 9 par page
        $posts = Post::with('user')->latest()->paginate(9);

        return view('pages.posts.frontend.index', compact('posts'));
    }
    public function home()
    {
        // Récupérer les articles avec l'auteur, derniers en premier, pagination 9 par page
        $posts = Post::with('user')->latest()->paginate(9);

        return view('welcome', compact('posts'));
    }
    // Afficher un article et ses commentaires
    public function show(Post $post)
    {
        // Charger l'auteur et les commentaires avec leurs auteurs
        $post->load('user', 'comments.user');

        return view('pages.posts.frontend.show', compact('post'));
    }
}
