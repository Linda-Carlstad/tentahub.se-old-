@extends( 'layouts.app' )
@section( 'title', 'Universitet' )
@section( 'content' )

    <section class="section">
        <h1 class="title">Universitet</h1>
        <p>Se alla universitet nedan</p>
        @auth
            @if( Auth::user()->role === 'super' )
                <a class="button is-primary" href="{{ route( 'universities.create' ) }}">Lägg till universitet</a>
            @endif
        @endauth
        <hr>
        <div class="columns is-multiline">
            @if( $universities->isEmpty() )
                <p>Inga universitet att visa.</p>
                <br>
            @else
                @foreach( $universities as $university )
                    <div class="column is-half is-widescreen">
                    <div class="card">
                        <div class="card-content">
                            <p class="title is-5">
                                {{ $university->name }} ({{ $university->nickname }})
                            </p>
                            <p class="subtitle">
                                {{ $university->city }}
                            </p>
                        </div>
                        <footer class="card-footer">
                            <a href="{{ route( 'universities.full', $university->slug ) }}" class="card-footer-item">
                                Läs mer
                            </a>
                            @auth
                                @if( Auth::user()->role == 'super' )
                                    <a href="{{ route( 'universities.edit', $university->id ) }}" class="card-footer-item">
                                        Redigera
                                    </a>
                                @endif
                            @endauth
                        </footer>
                    </div>
                    </div>
                @endforeach
            @endif
        </div>
    </section>

@endsection
