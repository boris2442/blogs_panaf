<nav class="bg-[var(--primary-blue)] p-4 text-white flex justify-between items-center">
    <div class="flex items-center space-x-4">
        <a href="/" class="font-bold hover:underline text-blue-400">Accueil</a>
        <a href="{{ route('posts.index') }}" class="font-bold hover:underline text-blue-400">Blogs</a>

        @auth
            {{-- <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a> --}}
            {{-- <a href="{{ route('profile') }}" class="hover:underline">Profil</a> --}}

            {{-- Liens admin uniquement --}}
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.posts.index') }}" class="hover:underline text-blue-400">Gestion des Posts</a>
                <a href="{{ route('admin.posts.create') }}" class="hover:underline text-blue-400">Créer un Post</a>
                <a href="{{ route('admin.users.index') }}" class="hover:underline text-blue-400">Gestion des Utilisateurs</a>
            @endif
        @endauth
    </div>

    <div>
        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="hover:underline text-red-400">Déconnexion</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="hover:underline text-blue-400">Se connecter</a>
            <a href="{{ route('register') }}" class="hover:underline ml-2 text-blue-400">S’inscrire</a>
        @endauth
    </div>
</nav>