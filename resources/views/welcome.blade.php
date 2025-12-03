@extends('layouts.layout')

@section('content')
    <div class="container mx-auto max-w-5xl p-4">

        <h1 class="mb-8 text-3xl font-bold text-[var(--primary-blue)] dark:text-[var(--dark-gold)]">
            Nos Articles
        </h1>

        <!-- Grid Articles -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($posts as $post)
                <div class="overflow-hidden rounded-xl border shadow hover:shadow-lg transition duration-300">
                    @if($post->thumbnail)
                        <a href="{{ route('posts.show', $post->slug) }}">
                            <img src="/{{ $post->thumbnail }}" loading="lazy"
                                class="h-48 w-full object-cover hover:scale-105 transition-transform duration-300"
                                alt="{{ $post->title }}">
                        </a>
                    @else
                        <div class="h-48 w-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                            <span class="text-gray-500">Pas d'image</span>
                        </div>
                    @endif

                    <div class="p-4 flex flex-col justify-between">
                        <div>
                            <h2 class="mb-1 text-xl font-semibold text-gray-800 dark:text-gray-200">
                                {{ $post->title }}
                            </h2>

                            <p class="mb-3 text-gray-600 dark:text-gray-400 line-clamp-3 text-sm">
                                {{ Str::limit(strip_tags($post->content), 150) }}
                            </p>
                        </div>

                        <div class="flex justify-between items-center text-xs text-gray-500">
                            <span>Par {{ $post->user->name }}</span>
                            <span>{{ $post->created_at->diffForHumans() }}</span>
                        </div>

                        <a href="{{ route('posts.show', $post->slug) }}"
                            class="mt-3 inline-block rounded-lg bg-blue-600 px-3 py-1 text-sm font-semibold text-white hover:bg-blue-700 dark:bg-[var(--dark-gold)] dark:hover:bg-yellow-600">
                            Lire l'article →
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $posts->links() }}
        </div>

    </div>
@endsection