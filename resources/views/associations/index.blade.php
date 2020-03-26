@extends( 'layouts.app' )
@section( 'title', 'Föreningar' )
@section( 'content' )

    <section class="section">
        <h1 class="title">Föreningar</h1>
        <p>Se alla föreningar nedan</p>
        @auth
            @if( Auth::user()->role >= 'admin' )
                <a class="button is-primary" href="{{ route( 'associations.create' ) }}">Lägg till förening</a>
            @endif
        @endauth
        <hr>
            @if( $associations->isEmpty() )
                <p>Inga föreningar att visa.</p>
                <br>
            @else
            <div class="columns is-multiline">
                @foreach( $associations as $association )
                    <div class="column is-half is-widescreen">
                    <div class="card">
                        <div class="card-content">
                            <p class="title is-5">
                                {{ $association->name }}
                            </p>
                            <a href="{{ route( 'universities.full', $association->university->slug ) }}" class="link">
                                {{ $association->university->name }}
                            </a>
                        </div>
                        <footer class="card-footer">
                            <a href="{{ route( 'associations.show', $association->slug ) }}" class="card-footer-item">
                                Läs mer
                            </a>
                            @auth
                                @if( Auth::user()->role === 'super' || Auth::user()->role === 'admin' && Auth::user()->association->id === $association->id || Auth::user()->role === 'moderator' && Auth::user()->association->id === $association->id )
                                    <a href="{{ route( 'associations.edit', $association->slug ) }}" class="card-footer-item">
                                        Redigera
                                    </a>
                                @endif
                            @endauth
                        </footer>
                    </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>

@endsection
