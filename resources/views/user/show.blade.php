@section('title', 'Profil')
@extends('layouts.app')

@section('content')

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

    @if( $user->role == 'super'  )



    @endif

@endsection
