@extends('layouts.app')
@section( 'title', 'Logga in' )
@section('content')

    <section class="section">
        <div class="columns level">
            <div class="column is-half is-widescreen level-item">
                <h1 class="title">Logga in</h1>
                <p>Logga in för att komma åt all kakor. Ja, det finns kakor.</p>
                <br>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="field">
                        <label for="email" class="label">E-postadress</label>
                        <div class="control">
                            <input id="email" class="input {{ $errors->has('email') ? ' is-danger' : '' }}" type="email" placeholder="E-postadress" name="email" value="{{ old( 'email' ) }}" required autofocus>
                            @error( 'email' )
                                <span class="has-text-danger" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="field">
                        <label for="password" class="label">Lösenord</label>
                        <div class="control">
                            <input id="password" class="input {{ $errors->has('url') ? ' is-danger' : '' }}" type="password" name="password" placeholder="Lösenord" required>
                            @error( 'password' )
                                <span class="has-text-danger" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <label class="checkbox" for="remember_token">
                                <input type="checkbox" name="remember_token" id="remember_token">
                                Kom ihåg mig!
                            </label>
                        </div>
                    </div>
                    <div class="field is-grouped">
                        <div class="control">
                            <button class="button is-primary" type="submit">Logga in</button>
                        </div>
                        <div class="control">
                            <a class="button is-light" href="{{ route( 'dashboard' ) }}">Avbryt</a>
                        </div>
                    </div>
                    <a class="is-link" href="{{ route( 'password.request' ) }}">Glömt ditt lösenord?</a>
                </form>
            </div>
            <div class="column is-half is-widescreen level-item has-text-centered">
                <figure class="image">
                    <img src="{{ asset( '/img/logo.png' ) }}" />
                </figure>
            </div>
        </div>
    </section>

@endsection
