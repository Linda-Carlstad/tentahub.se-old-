@extends('layouts.app')
@section( 'title', 'Återställ ditt lösenord här' )
@section('content')

    <section class="section">
        <div class="columns level">
            <div class="column is-half is-widescreen level-item">
                <h1 class="title">Återställ ditt lösenord här</h1>
                <p>Dags att återställa ditt lösenord, se till att komma ihåg det. :)</p>
                <br>
                <form method="POST" action="{{ route( 'password.update' ) }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="field">
                        <label for="email" class="label">E-postadress</label>
                        <div class="control">
                            <input placeholder="E-postadress" id="email" type="email" class="input {{ $errors->has('url') ? ' is-danger' : '' }}" name="email" value="{{ $email ?? old( 'email' ) }}" required autocomplete="email" autofocus>
                        </div>
                        @error( 'email' )
                            <span class="has-text-danger" role="alert">
                                    {{ $message }}
                                </span>
                        @enderror
                    </div>
                    <div class="field">
                        <label for="password" class="label">Lösenord</label>
                        <div class="control">
                            <input class="input {{ $errors->has('url') ? ' is-danger' : '' }}" name="password" type="password" placeholder="Lösenord" required>
                            @error( 'password' )
                                <span class="has-text-danger" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="field">
                        <label for="password-confirm" class="label">Verifiera lösenordet</label>
                        <div class="control">
                            <input id="password-confirm" class="input @error( 'password-confirm' ) is-danger @enderror" name="password-confirm" type="password" placeholder="Lösenord" required>
                            @error( 'password-confirm' )
                                <span class="has-text-danger" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="field is-grouped">
                        <div class="control">
                            <button class="button is-primary" type="submit">Återställ lösenordet</button>
                        </div>
                        <div class="control">
                            <a class="button is-light" href="{{ url()->previous() }}">Avbryt</a>
                        </div>
                    </div>
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
