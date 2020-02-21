@section('title', 'Alla användare')
@extends('layouts.app')
@section('content')

    <section class="section">
        <h1 class="title">Användare</h1>
        <p>Se alla användare nedan</p>
        @if( Auth::user()->role === 'super' || Auth::user()->role === 'admin' || Auth::user()->role === 'moderator' )
            <a class="button is-primary" href="{{ route( 'users.create' ) }}">Lägg till användare</a>
        @endif
        <hr>
        @if( $users->isEmpty() )
            <p>Inga användare att visa!</p>
            <hr>
        @else
            <div class="columns">
                <div class="column is-3 level-item has-text-centered">
                    <h4 class="title is-4">Namn</h4>
                </div>
                <div class="column is-3 level-item has-text-centered">
                    <h4 class="title is-4">Roll</h4>
                </div>
                <div class="column is-3 level-item has-text-centered">
                    <h4 class="title is-4">E-post</h4>
                </div>
                <div class="column is-3 level-item has-text-centered">
                    <h4 class="title is-4">#</h4>
                </div>
            </div>
            <div class="columns level is-multiline">
                @foreach( $users as $user )
                    <div class="column is-3 level-item has-text-centered">
                        <p>{{ $user->name }}</p>
                    </div>
                    <div class="column is-3 level-item has-text-centered">
                        <p>{{ $user->role }}</p>
                    </div>
                    <div class="column is-3 level-item has-text-centered">
                        <p>{{ $user->email }}</p>
                    </div>
                    <div class="column is-3 level-item has-text-centered">
                        <a class="button is-primary" href="{{ route( 'users.show', $user->id ) }}">Visa</a> <a class="button is-secondary" href="{{ route( 'users.edit', $user->id ) }}">Redigera</a>
                    </div>
                @endforeach
            </div>

        @endif
    </section>


@endsection
