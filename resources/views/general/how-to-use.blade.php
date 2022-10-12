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
                <br>
                Linda äger!
            </p>
        </div>
        <div class="column is-half is-widescreen has-text-centered level-item">
            <figure class="">
                <img src="{{ asset( 'img/logo.png' ) }}" />
            </figure>
        </div>
    </section>

@endsection
