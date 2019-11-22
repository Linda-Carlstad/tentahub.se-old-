@extends( 'layouts.app' )
@section( 'title', 'Universitet' )
@section( 'content' )

    <section class="section">
        <h1 class="title">Kurser</h1>
        <p>Se alla kurser nedan</p>
        @auth
            @if( Auth::user()->role >= 'moderator' )
                <a class="button is-primary" href="{{ route( 'courses.create' ) }}">Lägg till kurs</a>
            @endif
        @endauth
        <hr>
        <div class="columns is-multiline">
        @foreach( $courses as $course )
            <div class="column is-half is-widescreen">
            <div class="card">
                <div class="card-content">
                    <p class="title is-5">
                        {{ $course->name }} ({{ $course->code }})
                    </p>
                    <p>
                        <a href="{{ route( 'associations.show', $course->association->id ) }}">
                            {{ $course->association->name }}
                        </a>
                        -
                        <a href="{{ route( 'universities.show', $course->association->university->id ) }}">
                            {{ $course->association->university->name }}
                        </a>
                    </p>
                </div>
                <footer class="card-footer">
                    <a href="{{ route( 'courses.show', $course->id ) }}" class="card-footer-item">
                        Läs mer
                    </a>
                    @auth
                        @if( Auth::user()->role === 'super' || Auth::user()->role >= 'moderator' && Auth::user()->association === $course->association )
                            <a href="{{ route( 'courses.edit', $course->id ) }}" class="card-footer-item">
                                Redigera
                            </a>
                        @endif
                    @endauth
                </footer>
            </div>
            </div>
        @endforeach
        </div>
    </section>

@endsection
