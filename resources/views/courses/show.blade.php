@extends( 'layouts.app' )
@section( 'title', $course->name )
@section( 'content' )

    <section class="section">
        <div class="column is-half is-widescreen">
            <h1 class="title">{{ $course->name }} - {{ $course->code }}</h1>
            <p>{{ $course->points }}hp</p>
            <p>{{ $course->description }}</p>
            <a target="_blank" href="{{ $course->url }}">{{ $course->url }}</a>
            <hr>
            @if( $exams->isNotEmpty() )
                <h3 class="subtitle is-3">Tentor:</h3>
                <ul>
                    @foreach( $exams as $exam )
                        <li>
                            <a href="{{ route( 'exams.show', $exam->id ) }}">
                                {{ $exam->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <br>
                @if( Auth::user()->role === 'super' || Auth::user()->role >= 'moderator' && Auth::user()->exam->univerity == $course )
                    <a class="button is-primary" href="{{ route( 'exams.create' ) }}">Lägg till tenta</a>
                @endif
            @else
                <h3 class="subtitle">Inga tentor har lagts till på den här kursen, vill du lägga till en?</h3>
                @auth
                    @if( Auth::user()->role === 'super' || Auth::user()->role >= 'moderator' && Auth::user()->exam->univerity == $course )
                        <a class="button is-primary" href="{{ route( 'exams.create' ) }}">Lägg till tenta</a>
                    @endif
                @endauth
            @endif
            @auth
                @if( Auth::user()->role === 'super' || Auth::user()->role >= 'moderator' && Auth::user()->association == $course->association )
                    <hr>
                    <h3 class="subtitle is-4">Ändra uppgifter</h3>
                    <a class="button is-primary" href="{{ route( 'courses.edit', $course->id ) }}">Ändra uppggifter</a>
                @endif
            @endauth
            <hr>
            <a class="button is-primary" onclick="window.history.go(-1); return false;">Tillbaka</a>
        </div>
    </section>

@endsection
