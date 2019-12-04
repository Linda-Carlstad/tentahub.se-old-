@extends('layouts.app')
@section( 'title', 'Tentor' )
@section('content')

    <section class="section exams">
        <h1 class="title">Tentor</h1>
        <hr>
        @if( $exams->isEmpty() )
            <p>Inga tentor att visa. Lägg till en!</p>
            <br>
        @endif
        @if( !$exams->isEmpty() )
            <div class="columns level is-multiline">
                @foreach( $exams as $exam )
                    <div class="column is-half is-widescreen">
                        <div class="list is-hoverable">
                            <div class="list-item">
                                <h4 class="title is-4">{{ $exam->name }}</h4>
                                <div class="field is-grouped">
                                    <p class="control">
                                        <a class="button is-primary" target="_blank" href="{{ route( 'exams.show', $exam->id ) }}">
                                            Visa
                                        </a>
                                    </p>
                                    <p class="control">
                                        <a class="button is-primary" href="{{ route( 'exams.download', $exam->id ) }}">
                                            Ladda ner
                                        </a>
                                    </p>
                                </div>
                                <p>
                                    Poäng: {{ $exam->points }}
                                    -
                                    Betyg: {{ $exam->grade }}
                                </p>
                                <hr>
                                Kurs:
                                <a class="has-text-underline" href="{{ route( 'courses.show', $exam->course->id ) }}">
                                    {{ $exam->course->name }} ({{ $exam->course->code }})
                                </a>
                                <br>
                                Förening:
                                <a href="{{ route( 'universities.show', $exam->course->association->university->id ) }}">
                                    {{ $exam->course->association->university->name }}
                                </a>
                                (<a href="{{ route( 'associations.show', $exam->course->association->id ) }}">
                                    {{ $exam->course->association->name }}
                                </a>)
                                @auth
                                    @if( Auth::user()->role === 'super' || Auth::user()->role === 'admin' && Auth::user()->association->university->id === $course->association->university->id || Auth::user()->role === 'moderator' && Auth::user()->association->id === $course->association->id )
                                        <hr>
                                        <div class="field is-grouped">
                                            <p class="control">
                                                <a class="button is-primary" href="{{ route( 'exams.edit', $exam->id ) }}">
                                                    Ändra
                                                </a>
                                            </p>
                                            <form onsubmit="return confirm('Vill du verkligen ta bort den här tentan?');" class="control" action="{{ route( 'exams.destroy', $exam->id ) }}" method="post">
                                                @csrf
                                                @method( 'DELETE' )
                                                <button class="button is-link" type="submit">
                                                    Ta bort
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        <a class="button is-primary" href="{{ route( 'exams.create' ) }}">
            Lägg till tenta
        </a>
    </section>

@endsection
