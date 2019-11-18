<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="{{ url( '/' ) }}">
            {{ config('app.name', 'Tentahub') }}
        </a>

        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarMain">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarMain" class="navbar-menu">
        <div class="navbar-start">
            <a href="{{ route( 'dashboard' ) }}" class="navbar-item">
                {{ env( 'APP_NAME' )  }}
            </a>
            {{-- Left side of the navbar --}}
            <a class="navbar-item" href="{{ route( 'linda' ) }}">
                Linda
            </a>
        </div>
        <div class="navbar-end">
            {{-- Right side of the navbar --}}
            <div class="navbar-item">
                <div class="buttons">
                    @guest
                        <a class="button is-light" href="{{ route( 'login-form' ) }}">
                            Logga in
                        </a>
                    @else
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
                </div>
            </div>
        </div>
    </div>
</nav>
