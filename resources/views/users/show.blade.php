@section('title', 'Profil')
@extends('layouts.app')

@section('content')

    @if( Auth::user()->role > $user->role && Auth::user()->association_id == $user->association_id || Auth::user()->role == 'super' )
        <a href="{{ '/admins/' . $user->id . '/edit' }}" class="btn btn-primary">Redigera</a>
    @endif

    <h1>{{ $user->name }} - {{ $user->role }}</h1>
    <h3>{{ $user->email }}</h3>
    <p>Välkommen tillbaka!</p>

    <ul>
        <li>Förening: {{ $user->association->name }}</li>
        <li>Universitet: {{ $user->association->university->name }}</li>
    </ul>
    <hr>
    <h4>Kurser: {{ $user->association->courses->count() }}</h4>
    <h4>Tentor: {{ $user->association->exams->count() }}</h4>


@endsection
