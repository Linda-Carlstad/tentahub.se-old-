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
            @if( $universities->isEmpty() )
                <p>Inga universitet att visa.</p>
                <br>
            @else
            <div class="columns is-multiline">
                @foreach( $universities as $university )
                    <div class="column is-half is-widescreen">
                    <div class="card">
                        <div class="card-content">
                            <a href="{{ route( 'universities.full', $university->slug ) }}" class="title is-5">
                                {{ $university->name }} - {{ $university->nickname }}
                            </a>
                            <p>
                                Föreningar: {{ $university->associations->count() }}
                            </p>
                        </div>
                        <footer class="card-footer">
                            <a href="{{ route( 'universities.full', $university->slug ) }}" class="card-footer-item">
                                Läs mer
                            </a>
                            @auth
                                @if( Auth::user()->role == 'super' )
                                    <a href="{{ route( 'universities.edit', $university->slug ) }}" class="card-footer-item">
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
