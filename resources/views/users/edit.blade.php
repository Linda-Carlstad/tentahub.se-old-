@section('title', 'Uppdatera ' . $user->name ? $user->name : $user->id )
@extends('layouts.app')
@section('content')

    <section class="section">
        <div class="columns level">
            <div class="column is-half is-widescreen level-item">
                <h1 class="title">Uppdatera användaren: {{ $user->name ? $user->name : $user->id }}</h1>
                <p>Alla fält markerade med <strong>*</strong> är obligatoriska</p>
                <hr>
                <form class="" action="{{ route( 'users.update', $user->id ) }}" method="post">
                    @csrf
                    @method( 'PATCH' )
                    <input type="hidden" name="type" value="admin">
                    <input type="hidden" name="email" value="{{ $user->email }}">
                    <input type="hidden" name="association_id" value="{{ $user->association->id }}">

                    <div class="field">
                        <label for="name" class="label">Namn *</label>
                        <div class="control">
                            <input id="name" class="input" type="text" name="name" placeholder="Namn" value="{{ $user->name }}" required />
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
                            <input id="email" class="input" type="text" name="email" placeholder="Namn" value="{{ $user->email }}" required />
                        </div>
                        @error( 'email' )
                        <span class="has-text-danger" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="field">
                        <div class="control">
                            <label class="checkbox" for="valid">
                                <input type="checkbox" name="valid" id="valid" value="1" {{ $user->valid === 1 ? 'checked' : '' }}>
                                Aktiverad profil
                            </label>
                        </div>
                        @error( 'valid' )
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
                                    <option {{ $user->role === 'moderator' ? 'selected' : '' }} value="moderator">Moderator</option>
                                    @if( Auth::user()->role === 'super' )
                                        <option {{ $user->role === 'admin' ? 'selected' : '' }} value="admin">Admin</option>
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
                    <div class="field">
                        <label for="association_id" class="label">Förening *</label>
                        <div class="control">
                            <div class="select {{ $errors->has('association_id') ? 'is-danger' : '' }}">
                                <select id="association_id" name="association_id" required>
                                    @if( Auth::user()->role === 'super' )

                                        <option selected disabled>Välj förening...</option>
                                        @foreach( $universities as $university )
                                            @if( !$university->associations->isEmpty() )
                                                <option disabled>- {{ $university->name }}</option>
                                            @endif
                                            @foreach( $university->associations as $association )
                                                <option {{ $user->association_id == $association->id ? 'selected' : '' }} value="{{ $association->id }}">{{ $association->name }}</option>
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
                    <div class="field is-grouped">
                        <div class="control">
                            <button class="button is-link">Ändra</button>
                        </div>
                        <div class="control">
                            <a href="{{ url()->previous() }}" class="button is-link is-light">Avbryt</a>
                        </div>
                    </div>
                </form>
                @if( Auth::user()->role === 'super' || Auth::user()->role === 'admin' && Auth::user()->association->university->id === $course->association->university->id )
                    @if( $user->role != 'super' )
                        <hr>
                        <form onSubmit="return confirm('Är su säker på att du vill ta bort {{ $user->name }}? Denna åtgärd är permanent.');" action="{{ route( 'users.destroy', $user->id ) }}" method="post">
                            @csrf
                            {{ method_field( 'delete' ) }}
                            <h4>Ta bort {{ $user->name }}?</h4>
                            <p>Denna åtgärd är permanent.</p>
                            <button type="submit" class="button is-primary">
                                Ta bort
                            </button>
                        </form>
                    @endif
                @endif
            </div>
        </div>
    </section>

@endsection
