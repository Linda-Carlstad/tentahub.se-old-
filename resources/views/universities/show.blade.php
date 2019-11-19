@extends( 'layouts.app' )
@section( 'title', $university->name )
@section( 'content' )

    <section class="section">
        <div class="column is-half is-widescreen">
            <h1 class="title">{{ $university->name }}</h1>
            <p>{{ $university->description }}</p>
            <hr>
            @if( $associations->isNotEmpty() )
                <h3 class="subtitle is-3">Föreningar:</h3>
                <ul>
                    @foreach( $associations as $association )
                        <li>
                            <a href="/">
                                {{ $association->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <h3 class="subtitle">Inga föreningar har lagts till på det här universitetet, vill du lägga till en ny?</h3>
                @if( Auth::user()->role === 'super' || Auth::user()->role >= 'admin' && Auth::user()->association->univerity == $university )
                    <a class="button is-primary" href="/">Lägg till förening</a>
                @endif
            @endif
            @if( Auth::user()->role === 'super' || Auth::user()->role >= 'admin' && Auth::user()->association->univerity == $university )
                <hr>
                <h3 class="subtitle is-4">Ändra uppgifter</h3>
                <a class="button is-primary" href="{{ route( 'universities.edit', $university->id ) }}">Ändra uppggifter</a>
            @endif
        </div>
    </section>

@endsection
