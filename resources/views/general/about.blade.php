@extends('layouts.app')
@section( 'title', 'Vi bakom ' . env( 'APP_NAME' ) )
@section('content')

    <section class="about section columns level">
        <div class="column is-half is-widescreen level-item">
            <h1 class="title">Vi bakom {{ env( 'APP_NAME' ) }}</h1>
            <p>Lär känna oss lite bätte</p>
            <hr>
            <p>
            Föreningen för dataingenjörer, programvarutekniker och civilingenjörer i Informationsteknologi.
                <br>
                <br>
                Utvecklat av <a target="_blank" href="https://lindacarlstad.se">Linda Carlstad</a>.
            </p>
        </div>
        <div class="column is-half is-widescreen has-text-centered level-item">
            <figure class="">
                <img src="{{ asset( 'img/logo.png' ) }}" />
            </figure>
        </div>
    </section>

@endsection
