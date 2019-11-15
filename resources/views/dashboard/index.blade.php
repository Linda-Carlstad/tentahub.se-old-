@section('title', 'Startsida')
@extends('layouts.app')

@section('content')

    <section class="hero is-primary is-fullwidth has-text-centered">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">Hejsan, {{ Auth::user()->name }}</h1>
                <h3 class="subtitle">Välkommen tillbaka!</h3>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="columns level">
            <div class="column is-half is-widescreen level-item">
                <h2 class="title is-3">Vad vill du göra idag?</h2>
                <h3 class="subtitle is-5">Välj ett alternativ nedan:</h3>
                <div class="buttons">
                    <a class="button is-primary">Saker</a>
                    <a class="button is-primary">Saker</a>
                    <a class="button is-primary">Saker</a>
                </div>
            </div>
            <div class="column is-half is-widescreen level-item">
                <figure class="image">
                    <img src="https://via.placeholder.com/400x400.png/09f/fff" />
                </figure>
            </div>
        </div>
    </section>


@endsection
