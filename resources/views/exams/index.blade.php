@extends('layouts.app')
@section( 'title', 'Tentor' )
@section('content')

    <section class="section">
        <div class="columns level">
            <div class="column is-half is-widescreen">
                <h1 class="title">Tentor</h1>
                <hr>
                @if( $exams->isEmpty() )
                    <p>Inga tentor att visa. Lägg till en!</p>
                    <br>
                @else
                    <div class="list is-hoverable">
                        @foreach( $exams as $exam )
                            <div class="list-item">
                                <p class="exam">
                                    <a target="_blank" href="{{ route( 'exams.show', $exam->id ) }}">
                                        {{ $exam->name }}
                                    </a>
                                    -
                                    <a href="{{ route( 'exams.download', $exam->id ) }}">
                                        Ladda ner
                                    </a>
                                </p>
                                <br>
                                <a href="{{ route( 'courses.show', $exam->course->id ) }}">
                                    {{ $exam->course->name }} ({{ $exam->course->code }})
                                </a>
                                <br>
                                <a href="{{ route( 'associations.show', $exam->course->association->id ) }}">
                                    {{ $exam->course->association->name }}
                                </a>
                                -
                                <a href="{{ route( 'universities.show', $exam->course->association->university->id ) }}">
                                    {{ $exam->course->association->university->name }}
                                </a>
                                @auth
                                    @if( Auth::user()->role === 'super' || Auth::user()->role === 'admin' && Auth::user()->association->university->id === $course->association->university->id || Auth::user()->role === 'moderator' && Auth::user()->association->id === $course->association->id )
                                        <hr>
                                        <form onsubmit="return confirm('Vill du verkligen ta bort den här tentan?');" class="form" action="{{ route( 'exams.destroy', $exam->id ) }}" method="post">
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
            </div>
        </div>
    </section>

@endsection
