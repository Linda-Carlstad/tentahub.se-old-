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
                        <label class="label">E-postadress</label>
                        <div class="control">
                            <input placeholder="E-postadress" id="email" type="email" class="input @error( 'email' ) is-danger @enderror" name="email" value="{{ $email ?? old( 'email' ) }}" required autocomplete="email" autofocus>
                        </div>
                        @error( 'email' )
                            <span class="has-text-danger" role="alert">
                                    {{ $message }}
                                </span>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label">Lösenord</label>
                        <div class="control">
                            <input class="input @error( 'password' ) is-danger @enderror" name="password" type="password" placeholder="Lösenord" required>
                            @error( 'password' )
                                <span class="has-text-danger" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Verifiera lösenordet</label>
                        <div class="control">
                            <input class="input @error( 'password-confirm' ) is-danger @enderror" name="password-confirm" type="password" placeholder="Lösenord" required>
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
                            <button class="button is-light" href="{{ '/' }}">Avbryt</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="column is-half is-widescreen level-item has-text-centered">
                <figure class="image">
                    <img src="https://via.placeholder.com/400x400.png/09f/fff" />
                </figure>
            </div>
        </div>
    </section>

@endsection
