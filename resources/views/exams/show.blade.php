@extends('layouts.app')
@section( 'title', 'Tenta ' . $exam->name )
@section('content')

    <section class="section exam">
        <div class="columns">
            <div class="column is-half is-widescreen">
                <h1 class="title">{{ $exam->name }}</h1>
                <a href="{{ url()->previous() }}">Gå tillbaka</a>
            </div>
        </div>
    </section>

@endsection
