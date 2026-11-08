<nav class="navigation">
    <a href="{{ route('accueil') }}" class="logo">MediaHub</a>

    <ul class="nav-liens">
        <li><a href="{{ route('accueil') }}">Accueil</a></li>
        <li><a href="{{ route('contenus.index') }}">Contenus</a></li>
        <li><a href="{{ route('categories.index') }}">Catégories</a></li>
        <li><a href="{{ route('a-propos') }}">À propos</a></li>

        @auth
            @if (auth()->user()->role === 'admin')
                <li><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            @endif

            <li>
                <form method="POST" action="{{ route('deconnexion') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-deconnexion">
                        Déconnexion ({{ auth()->user()->name }})
                    </button>
                </form>
            </li>
        @endauth

        @guest
            <li><a href="{{ route('connexion') }}">Connexion</a></li>
            <li><a href="{{ route('inscription') }}" class="btn-inscription">Inscription</a></li>
        @endguest
    </ul>
</nav>