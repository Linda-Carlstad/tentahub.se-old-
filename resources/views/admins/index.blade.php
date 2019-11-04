@section('title', 'Listar användare')

@extends('layouts.app')
@section('content')

    @if( $users->isEmpty() )
        <p>Inga användare att visa!</p>
        <hr>
    @endif

    <ul>
        @foreach( $users as $user )
            <li>
                <a href="{{ 'users/' . $user->id  }}">{{ $user->name }} - {{ $user->role }}</a> -||- <a href="{{ '/admins/' . $user->id . '/edit' }}">Redigera</a>
            </li>
        @endforeach
    </ul>
    {{ $users->onEachSide(1)->links() }}

@endsection
