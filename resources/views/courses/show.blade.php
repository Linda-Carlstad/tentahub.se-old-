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
            <h3 class="subtitle is-3">Tentor:</h3>
            @if( $exams->isEmpty() )
                <p>Inga tentor att visa. Lägg till en!</p>
                <br>
            @else
                <div class="list is-hoverable">
                    @foreach( $exams as $exam )
                        <div class="list-item">
                            <a href="{{ route( 'exams.show', $exam->id ) }}">
                                {{ $exam->name }}
                            </a>
                            -
                            <a href="{{ route( 'exams.download', $exam->id ) }}">
                                Ladda ner
                            </a>
                            @auth
                                @if( Auth::user()->role === 'super' || Auth::user()->role === 'admin' && Auth::user()->association->university->id === $course->association->university->id || Auth::user()->role === 'moderator' && Auth::user()->association->id === $course->association->id )
                                    <hr>
                                    <form class="form" action="{{ route( 'exams.destroy', $exam->id ) }}" method="post">
                                        @csrf
                                        @method( 'DELETE' )
                                        <button class="button is-link" type="submit">
                                            Ta bort
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    @endforeach
                </div>
            @endif
            <a class="button is-primary" href="{{ route( 'exams.create' ) }}">
                Lägg till tenta
            </a>
            @auth
                @if( Auth::user()->role === 'super' || Auth::user()->role === 'admin' && Auth::user()->association->university->id == $course->association->university->id || Auth::user()->role === 'moderator' && Auth::user()->association->id == $course->association_id )
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
