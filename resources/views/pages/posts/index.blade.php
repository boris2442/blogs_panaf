@extends('layouts.layout')

@section('content')
    <div class="container mx-auto max-w-5xl p-4">

        <h1 class="mb-6 text-3xl font-bold text-[var(--primary-blue)] dark:text-[var(--dark-gold)]">
            Tous les articles
        </h1>

        <!-- Bouton créer un article -->
        <div class="mb-5 flex justify-end">
            <a href="{{ route('admin.posts.create') }}"
                class="rounded-lg bg-[var(--primary-blue)] px-4 py-2 font-semibold text-white hover:bg-blue-700 dark:bg-[var(--dark-gold)] dark:hover:bg-yellow-600">
                + Nouvel article
            </a>
        </div>

        <!-- Grid Articles -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">

            @foreach($posts as $post)
                <div class="overflow-hidden rounded-xl border shadow">
                    <img src="/{{ $post->thumbnail }}" class="h-40 w-full object-cover" alt="Image du post">

                    <div class="p-4">
                        <h2 class="mb-2 text-xl font-semibold text-gray-800 dark:text-gray-200">
                            {{ $post->title }}
                        </h2>

                        <p class="mb-3 line-clamp-2 text-sm text-gray-600 dark:text-gray-400">
                            {{ Str::limit(strip_tags($post->content), 120) }}
                        </p>

                        <div class="mb-3 text-xs text-gray-500">
                            Par <span class="font-semibold">{{ $post->user->name }}</span>,
                            {{ $post->created_at->diffForHumans() }}
                        </div>

                        <div class="flex justify-between items-center">
                            <!-- Lire -->
                            <a href="{{ route('admin.posts.show', $post->slug) }}"
                                class="text-sm font-medium text-[var(--primary-blue)] hover:underline dark:text-[var(--dark-gold)]">
                                Lire →
                            </a>

                            <!-- Edit/Delete -->
                            <div class="flex gap-2">
                                <a href="{{ route('admin.posts.edit', $post->slug) }}"
                                    class="text-sm font-medium text-yellow-600 hover:underline">
                                    Éditer
                                </a>

                                <form action="{{ route('admin.posts.destroy', $post->slug) }}" method="POST"
                                    onsubmit="return confirm('Voulez-vous vraiment supprimer cet article ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm font-medium text-red-600 hover:underline">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
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