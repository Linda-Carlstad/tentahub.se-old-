<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="{{ url( '/' ) }}">
        {{ env( 'APP_NAME' ) }}
        </a>

        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarMain">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarMain" class="navbar-menu">
        <div class="navbar-start">
            {{-- Left side of the navbar --}}
            @guest
                <a class="navbar-item" href="{{ route( 'about' ) }}">
                    Om oss
                </a>
                <a class="navbar-item" href="{{ route( 'what-is' ) }}">
                    Vad är {{ env( 'APP_NAME' ) }}?
                </a>
                <a class="navbar-item" href="{{ route( 'how-to-use' ) }}">
                    Hur funkar {{ env('APP_NAME') }}?
                </a>
            @endguest
            <a class="navbar-item" href="{{ route( 'universities.index' ) }}">
                Universitet
            </a>
            <a class="navbar-item" href="{{ route( 'associations.index' ) }}">
                Föreningar
            </a>
            <a class="navbar-item" href="{{ route( 'courses.index' ) }}">
                Kurser
            </a>
            <a class="navbar-item" href="{{ route( 'exams.index' ) }}">
                Tentor
            </a>
        </div>
        <hr class="is-hidden-desktop is-marginless">
        <a class="navbar-end">
            {{-- Right side of the navbar --}}
            @guest
                <div class="navbar-item">
                    <a class="button is-gradient" href="{{ route( 'login-form' ) }}">
                        Logga in
                    </a>
                </div>
            @else
                @if( Auth::user()->role === 'super' || Auth::user()->role === 'admin' )
                    <a class="navbar-item" href="{{ route( 'users.index' ) }}">
                        Användare
                    </a>
                @endif
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        {{ Auth::user()->name }}
                    </a>

                    <div class="navbar-dropdown">
                        <a class="navbar-item" href="{{ route( 'profile' ) }}">
                            Profil
                        </a>
                        <a class="navbar-item" href="{{ route( 'profile.settings' ) }}">
                            Inställningar
                        </a>
                        <hr class="navbar-divider">
                        <a class="navbar-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            Logga ut
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            @endguest
            <hr class="is-hidden-desktop is-marginless">
        </div>
    </div>
</nav>
