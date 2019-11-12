@extends('layouts.app')
@section( 'title', 'Glömt ditt lösenord?' )
@section('content')

    <section class="section">
        <div class="columns level">
            <div class="column is-half is-widescreen level-item">
                <h1 class="title">Glömt ditt lösenord?</h1>
                <p>Det är okej, det händer alla ibland. Här kan du återställa ditt lösenord.</p>
                <br>
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="field">
                        <label class="label">E-postadress</label>
                        <div class="control">
                            <input class="input @error( 'email' ) is-danger @enderror" type="email" placeholder="E-postadress" name="email" value="{{ old( 'email' ) }}">
                            @error( 'email' )
                                <span class="has-text-danger" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="field is-grouped">
                        <div class="control">
                            <button class="button is-primary" type="submit">Skicka</button>
                        </div>
                        <div class="control">
                            <button class="button is-light" href="{{ url()->previous() }}">Avbryt</button>
                        </div>
                    </div>
                    <a class="is-link" href="{{ route( 'login-form' ) }}">Logga in istället?</a>
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
