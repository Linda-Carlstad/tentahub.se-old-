@extends('layouts.app')
@section( 'title', 'Tentor' )
@section('content')

    <section class="about section columns level">
        <ul>
            @foreach( $exams as $exam )
                <li>
                    <a href="{{ route( 'exams.show', $exam->id ) }}">
                        {{ $exam->name }}
                    </a>
                    -
                    <a href="{{ route( 'exams.download', $exam->id ) }}">
                        Ladda ner
                    </a>
                </li>
            @endforeach
        </ul>
    </section>

@endsection
