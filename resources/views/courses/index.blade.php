@extends( 'layouts.app' )
@section( 'title', 'Universitet' )
@section( 'content' )

    <section class="section">
        <h1 class="title">Kurser</h1>
        <p>Se alla kurser nedan</p>
        @auth
            @if( Auth::user()->role === 'super' || Auth::user()->role === 'admin' || Auth::user()->role === 'moderator' )
                <a class="button is-primary" href="{{ route( 'courses.create' ) }}">Lägg till kurs</a>
            @endif
        @endauth
        <hr>
            @if( $courses->isEmpty() )
                <p>Inga kurser att visa.</p>
                <br>
            @else
            <div class="columns is-multiline">
                @foreach( $courses as $course )
                    <div class="column is-half is-widescreen">
                    <div class="card">
                        <div class="card-content">
                            @if( $course->university )
                                <a class="title is-5" href="{{ route( 'courses.partial',
                                                    [ $course->university->slug,
                                                      $course->slug ] ) }}" class="card-footer-item">
                                    {{ $course->name }} ({{ $course->code }})
                                </a>
                            @else
                                <a class="title is-5" href="{{ route( 'courses.full',
                                                [ $course->association->university->slug,
                                                  $course->association->slug,
                                                  $course->slug ] ) }}" class="card-footer-item">
                                    {{ $course->name }} ({{ $course->code }})
                                </a>
                            @endif
                            <p>
                                @if( $course->association )
                                    <a href="{{ route( 'associations.full', [
                                                    $course->association->university->slug, $course->association->slug
                                                ] ) }}">
                                        {{ $course->association->name }}
                                    </a>
                                -
                                    <a href="{{ route( 'universities.full', $course->association->university->slug ) }}">
                                        {{ $course->association->university->name }}
                                    </a>
                                @else
                                    <a href="{{ route( 'universities.full', $course->university->slug ) }}">
                                        {{ $course->university->name }}
                                    </a>
                                @endif
                            </p>
                        </div>
                        <footer class="card-footer">
                            @if( $course->association )
                                <a href="{{ route( 'courses.full',
                                                [ $course->association->university->slug,
                                                  $course->association->slug,
                                                  $course->slug ] ) }}" class="card-footer-item">
                                    Läs mer
                                </a>
                            @else
                                <a href="{{ route( 'courses.partial',
                                                    [ $course->university->slug,
                                                      $course->slug ] ) }}" class="card-footer-item">
                                    Läs mer
                                </a>
                            @endif
                            @auth
                                @if( Auth::user()->role === 'super' || Auth::user()->role === 'admin' && Auth::user()->association->university->id === $course->association->university->id || Auth::user()->role === 'moderator' && Auth::user()->association->id === $course->association->id )
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
        @endif
    </section>

@endsection
