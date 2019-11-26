@extends('layouts.app')
@section( 'title', 'Vi bakom ' . env( 'APP_NAME' ) )
@section('content')

    <section class="about section columns level">
        <div class="column is-half is-widescreen level-item">
            <h1 class="title">Vi bakom {{ env( 'APP_NAME' ) }}</h1>
            <p>Lär känna oss lite bätte</p>
            <hr>
            <p>
                Contrary to popular belief, Lorem Ipsum is not simply random text.
                It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.
                Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia,
                looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage,
                and going through the cites of the word in classical literature, discovered the undoubtable source.
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
