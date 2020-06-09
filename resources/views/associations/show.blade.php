@extends( 'layouts.app' )
@section( 'title', $association->name )
@section( 'content' )

    <section class="section">
        <div class="column is-half is-widescreen">
            <h1 class="title">{{ $association->name }}</h1>
            <p>
                {{ $association->description }}
                <br>
                Webbsida: <a target="_blank" href="{{ $association->url }}">{{ $association->url }}</a>
                <br>
                Tillhör universitet:
                <a href="{{ route( 'universities.full', $association->university->slug ) }}">{{ $association->university->name }}</a>
            </p>
            <hr>
            @if( $courses->isNotEmpty() )
                <h3 class="subtitle is-3">Kurser</h3>
                <ul>
                    @foreach( $courses as $course )
                        <li>-
                            @if( $course->university && empty( $course->association ) )
                                <a href="{{ route( 'courses.partial',
                                            [ $course->university->slug,
                                              $course->slug ] ) }}">
                                    {{ $course->name }} ({{ $course->code }})
                                </a>
                            @else
                                <a href="{{ route( 'courses.full',
                                        [ $course->association->university->slug,
                                          $course->association->slug,
                                          $course->slug ] ) }}">
                                    {{ $course->name }} ({{ $course->code }})
                                </a>
                            @endif
                        </li>
                    @endforeach
                </ul>
                @auth
                    @if( Auth::user()->role === 'super' || Auth::user()->role === 'admin' && Auth::user()->association_id == $association->slug || Auth::user()->role === 'moderator' && Auth::user()->association_id == $association->slug )
                        <br>
                        <a class="button is-primary" href="{{ route( 'courses.create' ) }}">Lägg till kurs</a>
                    @endif
                @endauth
            @else
                <h3 class="subtitle">Inga kurser har lagts till på den här föreningen.</h3>
                @auth
                    @if( Auth::user()->role === 'super' || Auth::user()->role === 'admin' && Auth::user()->association_id == $association->slug || Auth::user()->role === 'moderator' && Auth::user()->association_id == $association->slug )
                        <a class="button is-primary" href="{{ route( 'courses.create' ) }}">Lägg till kurs</a>
                    @endif
                @endauth
            @endif
            @auth
                @if( Auth::user()->role === 'super' || Auth::user()->role === 'admin' && Auth::user()->association_id === $association->slug || Auth::user()->role === 'moderator' && Auth::user()->association_id === $association->slug )
                    <hr>
                    <h3 class="subtitle is-4">Ändra uppgifter</h3>
                    <a class="button is-primary" href="{{ route( 'associations.edit', $association->slug ) }}">Ändra uppggifter</a>
                @endif
            @endauth
            <hr>
            <a class="button is-primary" onclick="window.history.go(-1); return false;">Tillbaka</a>
        </div>
    </section>

@endsection
