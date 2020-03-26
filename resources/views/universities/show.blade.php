@extends( 'layouts.app' )
@section( 'title', $university->name )
@section( 'content' )

    <section class="section">
        <div class="column is-half is-widescreen">
            <h1 class="title">{{ $university->name }}</h1>
            <p>{{ $university->description }}</p>
            <a target="_blank" href="{{ $university->url }}">{{ $university->url }}</a>
            <hr>
            @if( $associations->isNotEmpty() )
                <h3 class="subtitle is-3">Föreningar:</h3>
                <ul>
                    @foreach( $associations as $association )
                        <li>-
                            <a href="{{ route( 'associations.full', [ $university->slug, $association->slug ] ) }}">
                                {{ $association->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <br>
                @auth
                    @if( Auth::user()->role === 'super' || Auth::user()->role >= 'admin' && Auth::user()->association->univerity == $university )
                        <a class="button is-primary" href="{{ route( 'associations.create' ) }}">Lägg till förening</a>
                    @endif
                @endauth
            @else
                <h3 class="subtitle">Inga föreningar har lagts till på det här universitetet.</h3>
                @auth
                    @if( Auth::user()->role === 'super' || Auth::user()->role >= 'admin' && Auth::user()->association->univerity == $university )
                        <a class="button is-primary" href="{{ route( 'associations.create' ) }}">Lägg till förening</a>
                    @endif
                @endauth
            @endif
            @auth
                @if( Auth::user()->role === 'super' || Auth::user()->role >= 'admin' && Auth::user()->association->univerity == $university )
                    <hr>
                    <h3 class="subtitle is-4">Ändra uppgifter</h3>
                    <a class="button is-primary" href="{{ route( 'universities.edit', $university->slug ) }}">Ändra uppggifter</a>
                @endif
            @endauth
            <hr>
            <a class="button is-primary" onclick="window.history.go(-1); return false;">Tillbaka</a>
        </div>
    </section>

@endsection
