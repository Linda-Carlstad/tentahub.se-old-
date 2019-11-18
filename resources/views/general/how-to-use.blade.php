@extends('layouts.app')
@section( 'title', 'Hur funkar ' . env( 'APP_NAME' ) . '?' )
@section('content')

    <section class="about section columns level">
        <div class="column is-half is-widescreen level-item">
            <h1 class="title">Så, hur funkar {{ env( 'APP_NAME' ) }}?</h1>
            <p>Använda {{ env( 'APP_NAME' ) }} smartare</p>
            <hr>
            <p>
                Contrary to popular belief, Lorem Ipsum is not simply random text.
                It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.
                Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia.
            </p>
            <br>
            <ul>
                <li>Saker 1</li>
                <li>Saker 2</li>
                <li>Saker 3</li>
            </ul>
        </div>
        <div class="column is-half is-widescreen has-text-centered level-item">
            <p>Lägg till en bild på appen</p>
            <figure class="">
                <img src="{{ asset( 'img/logo.png' ) }}" />
            </figure>
            <p>Lägg till en bild på appen</p>
        </div>
    </section>

@endsection
