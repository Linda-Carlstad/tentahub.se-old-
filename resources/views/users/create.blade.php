@section('title', 'Skapa envändare')
@extends('layouts.app')

@section('content')

    <section class="section">
        <div class="column is-half">
            <h1 class="title">Skapa envändare</h1>
            <p>Alla fält är obligatoriska</p>
            <hr>
            <form class="" method="POST" action="{{ route( 'users.store' ) }}">
                @csrf
                <div class="field">
                    <label for="name" class="label">Namn *</label>
                    <div class="control">
                        <input id="name" class="input {{ $errors->has('name') ? 'is-danger' : '' }}" name="name" type="text" value="{{ old( 'name' ) }}" autofocus required>
                    </div>
                    @error( 'name' )
                    <span class="has-text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="field">
                    <label for="email" class="label">Email *</label>
                    <div class="control">
                        <input id="email" class="input {{ $errors->has('email') ? 'is-danger' : '' }}" name="email" type="email" value="{{ old( 'email' ) }}" required>
                    </div>
                    @error( 'email' )
                    <span class="has-text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="field">
                    <label for="role" class="label">Roll *</label>
                    <div class="control">
                        <div class="select {{ $errors->has('role') ? 'is-danger' : '' }}">
                            <select id="role" name="role" required>
                                <option {{ old( 'role' ) === 'moderator' ? 'selected' : '' }} value="moderator">Moderator</option>
                                @if( Auth::user()->role === 'super' )
                                    <option {{ old( 'role' ) === 'admin' ? 'selected' : '' }} value="admin">Admin</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    @error( 'role' )
                    <span class="has-text-danger" role="alert">
                                {{ $message }}
                            </span>
                    @enderror
                </div>
                @if( Auth::user()->role === 'super' || Auth::user()->role === 'admin'  )
                    <div class="field">
                        <label for="association_id" class="label">Förening *</label>
                        <div class="control">
                            <div class="select {{ $errors->has('association_id') ? 'is-danger' : '' }}">
                                <select id="association_id" name="association_id">
                                    @if( Auth::user()->role === 'super' )

                                        <option selected disabled>Välj förening...</option>
                                        @foreach( $universities as $university )
                                            @if( !$university->associations->isEmpty() )
                                                <option disabled>---{{ $university->name }}---</option>
                                            @endif
                                            @foreach( $university->associations as $association )
                                                <option {{ old( 'association_id' ) === $association->id ? 'selected' : '' }} value="{{ $association->id }}">{{ $association->name }}</option>
                                            @endforeach
                                        @endforeach
                                    @else
                                        @foreach( Auth::user()->association->university->associations as $association )
                                            <option {{ old( 'association_id' ) === $association->id ? 'selected' : '' }}  value="{{ $association->id }}">{{ $association->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                @else
                    <input type="hidden" name="association_id" value="{{ Auth::user()->association->id }}">
                @endif
                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-link">Lägg till</button>
                    </div>
                    <div class="control">
                        <a href="{{ url()->previous() }}" class="button is-link is-light">Avbryt</a>
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection
