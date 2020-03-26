@section('title', 'Profil')
@extends('layouts.app')

@section('content')

    <section class="hero is-fullwidth has-text-centered">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">Hejsan, {{ $user->name }}</h1>
                <h3 class="subtitle">Här är din profil, ta en titt!</h3>
            </div>
        </div>
    </section>
    <hr>
    <section class="section">
        <h4 class="title is-3">Förening:
            <a href="{{ route( 'associations.full',
                        [ $user->association->university->slug,
                        $user->association->slug ] ) }}">
                {{ $user->association->name }}
            </a>
        </h4>
        <h4 class="subtitle is-5">Tillhör universitet: <a href="{{ route( 'universities.show', $user->association->university->id ) }}">{{ $user->association->university->name }}</a></h4>
        <p><b>Statistik om din föreing:</b></p>
        <p>Kurser: {{ $user->association->courses->count() }}</p>
        <p>Tentor: {{ $user->association->exams->count() }}</p>
        <hr>
        <h2 class="title is-3">Redigera din profil</h2>
        <p>Vill du redigera din profil, klicka nedan.</p>
        <a class="button is-primary" href="{{ route( 'profile.settings' ) }}">Inställningar</a>
    </section>

@endsection
