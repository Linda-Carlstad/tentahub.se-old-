@section('title', 'Profil')
@extends('layouts.app')

@section('content')

    <section class="section">
        <h1 class="title">Användare: {{ $user->name }}</h1>
        <h4 class="subtitle is-4">Förening: <a class="has-text-underline" href="{{ route( 'associations.show', $user->association->slug ) }}">{{ $user->association->name }}</a> på <a class="has-text-underline" href="{{ route( 'universities.show', $user->association->university->slug ) }}">{{ $user->association->university->name }}</a></h4>
        <p><b>Statistik föreingen:</b></p>
        <p>Användare: {{ $user->association->users->count() }}</p>
        <p>Kurser: {{ $user->association->courses->count() }}</p>
        <p>Tentor: {{ $user->association->exams->count() }}</p>
        <hr>
        <h2 class="title is-3">Redigera användaren</h2>
        <p>Vill du redigera användaren, klicka nedan.</p>
        <a class="button is-primary" href="{{ route( 'users.edit', $user->id ) }}">Inställningar</a>
    </section>

@endsection
