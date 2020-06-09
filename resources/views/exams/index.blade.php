@extends('layouts.app')
@section( 'title', 'Tentor' )
@section('content')

    <section class="section exams">
        <h1 class="title">Tentor</h1>
        <a class="button is-primary" href="{{ route( 'exams.create' ) }}">
            Lägg till tenta
        </a>
        <hr>
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
    </section>

@endsection
