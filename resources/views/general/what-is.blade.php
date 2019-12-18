@extends('layouts.app')
@section( 'title', 'Vad är ' . env( 'APP_NAME' ) . '?' )
@section('content')

    <section class="about section columns level">
        <div class="column is-half is-widescreen level-item">
            <h1 class="title">Vad är {{ env( 'APP_NAME' ) }}?</h1>
            <p>Vi finns för dig</p>
            <hr>
            <p>
                Tentahub är ett initiativ av Linda Carlstad.cccccdd
            </p>
        </div>
        <div class="column is-half is-widescreen has-text-centered level-item">
            <figure class="">
                <img src="{{ asset( 'img/logo.png' ) }}" />
            </figure>
        </div>
    </section>

@endsection
