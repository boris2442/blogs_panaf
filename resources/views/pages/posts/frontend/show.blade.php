@extends('layouts.layout')

@section('content')
    <div class="container mx-auto max-w-3xl p-4">

        <!-- Article -->
        <div class="mb-8 rounded-xl border shadow overflow-hidden">
            @if($post->thumbnail)
                <img src="/{{ $post->thumbnail }}"
                    class="h-64 w-full object-cover hover:scale-105 transition-transform duration-300" alt="{{ $post->title }}"
                    loading="lazy">
            @endif

            <div class="p-6">
                <h1 class="mb-4 text-3xl font-bold text-[var(--primary-blue)] dark:text-[var(--dark-gold)]">
                    {{ $post->title }}
                </h1>

                <div class="mb-4 text-sm text-gray-500 dark:text-gray-400">
                    Par <span class="font-semibold text-xs">{{ $post->user->name }}</span> •
                    {{ $post->created_at->diffForHumans() }}
                </div>

                <div class="mb-6 text-gray-700 dark:text-gray-300 leading-relaxed">
                    {!! nl2br(e($post->content)) !!}
                </div>
            </div>
        </div>

        <!-- Commentaires -->
        <div class="mb-6">
            <h2 class="mb-4 text-xl font-semibold text-[var(--primary-blue)] dark:text-[var(--dark-gold)]">
                Commentaires ({{ $post->comments->count() }})
            </h2>

            @forelse($post->comments as $comment)
                <div class="mb-3 rounded-lg border p-3 bg-gray-50 dark:bg-gray-800">
                    <div class="flex justify-between items-center mb-1 text-sm text-gray-500 dark:text-gray-400">
                        <span class="font-semibold text-xs ">
                            <i>{{ $comment->user ? $comment->user->name : 'Utilisateur supprimé' }}</i></span>
                        <span class="text-xs "> publier le :<i>{{ $comment->created_at->diffForHumans() }}</i></span>
                    </div>
                    <p class="text-gray-700 dark:text-gray-300">{{ $comment->body }}</p>
                </div>
            @empty
                <p class="text-gray-500 dark:text-gray-400">Aucun commentaire pour le moment.</p>
            @endforelse
        </div>

        <!-- Formulaire Commentaire -->
        @auth
            <form action="{{ route('comments.store', $post->slug) }}" method="POST" class="relative">
                @csrf

                <div class="relative">
                    <!-- Textarea avec padding à droite pour le bouton -->
                    <textarea name="body" rows="2"
                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600 px-4 py-3 pr-12 focus:border-[var(--primary-blue)] focus:ring  resize-none dark:bg-gray-900 dark:text-gray-200"
                        rows="4"
                        
                        placeholder="Écrire un commentaire..." required></textarea>

                    <!-- Bouton submit flottant à droite à l'intérieur du textarea -->
                    <button type="submit"
                        class="absolute top-1/2 right-2 -translate-y-1/2 flex h-8 w-8 items-center justify-center rounded-full bg-blue-400 text-white hover:bg-blue-700 dark:bg-[var(--dark-gold)] dark:hover:bg-yellow-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>

                @error('body')
                    <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                @enderror
            </form>
        @else
            <p class="text-gray-500 dark:text-gray-400">Vous devez être connecté pour commenter.</p>
        @endauth

    </div>
@endsection