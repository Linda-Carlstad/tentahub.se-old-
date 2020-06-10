@extends( 'layouts.app' )
@section( 'title', $course->name )
@section( 'content' )

    <section class="section">
        <div class="column is-widescreen">
            <h1 class="title">{{ $course->name }} - {{ $course->code }}</h1>
            <h2 class="subtitle">Poäng: {{ $course->points }}hp</h2>
            <p class="is-half">{{ $course->description }}</p>
            @if( $course->url )
                <a target="_blank" rel="noreferrer" href="{{ $course->url }}">{{ $course->url }}</a>
            @endif
            <hr>
            <h3 class="subtitle is-3">Tentor</h3>
            @if( $exams->isEmpty() )
                <p>Inga tentor att visa. Lägg till en!</p>
                <br>
            @else
                <div class="columns is-multiline">
                    @foreach( $exams as $exam )
                        @include( 'partials.exams.card', $exam )
                    @endforeach
                </div>
            @endif
            <a class="button is-primary" href="{{ route( 'exams.create' ) }}">
                Lägg till tenta
            </a>
            @auth
                @if( Auth::user()->role === 'super' || Auth::user()->role === 'admin' && Auth::user()->association->university->slug == $course->association->university->slug || Auth::user()->role === 'moderator' && Auth::user()->association->slug == $course->association_id )
                    <hr>
                    <h3 class="subtitle is-4">Ändra uppgifter</h3>
                    <a class="button is-primary" href="{{ route( 'courses.edit', $course->slug ) }}">Ändra uppggifter</a>
                @endif
            @endauth
            <hr>
            <a class="button is-primary" onclick="window.history.go(-1); return false;">Tillbaka</a>
        </div>
    </section>

@endsection
