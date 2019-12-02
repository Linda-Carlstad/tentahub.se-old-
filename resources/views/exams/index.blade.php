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
                            <p class="list-item">
                                <a href="{{ route( 'exams.show', $exam->id ) }}">
                                    {{ $exam->name }}
                                </a>
                                -
                                <a href="{{ route( 'exams.download', $exam->id ) }}">
                                    Ladda ner
                                </a>
                            </p>
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
