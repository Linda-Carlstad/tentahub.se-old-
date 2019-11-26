@section('title', 'Inställningar')
@extends('layouts.app')
@section('content')

    <section class="section">
        <div class="columns level">
            <div class="column is-half is-widescreen level-item">
                <h1 class="title">Inställningar</h1>

                @if( $user->valid )
                    <h2 class="title is-5">Byt namn</h2>
                    <form class="" action="{{ '/user/' . $user->id }}" method="post">
                        @csrf
                        @method( 'PATCH' )
                        <input type="hidden" name="type" value="info">

                        <div class="field">
                            <label for="name" class="label">Namn</label>
                            <div class="control">
                                <input id="name" class="input" type="text" name="name" placeholder="Namn" required />
                            </div>
                            @error( 'name' )
                                <span class="has-text-danger" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
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
                    <hr>
                @endif

                <h2 class="title is-5">Byt lösenord</h2>
                <form class="" action="{{ '/user/' . $user->id }}" method="post">
                    @csrf
                    @method( 'PATCH' )
                    <input type="hidden" name="type" value="security">

                    <div class="field">
                        <label for="password" class="label">Lösenord</label>
                        <div class="control">
                            <input id="password" class="input {{ $errors->has('password') ? ' is-danger' : '' }}" type="password" name="password" placeholder="Lösenord" required>
                        </div>
                        @error( 'password' )
                        <span class="has-text-danger" role="alert">
                        {{ $message }}
                    </span>
                        @enderror
                    </div>
                    <div class="field">
                        <label for="newPassword" class="label">Nytt lösenord</label>
                        <div class="control">
                            <input id="newPassword" class="input {{ $errors->has('newPassword') ? ' is-danger' : '' }}" type="password" name="newPassword" placeholder="Nytt lösenord" required>
                        </div>
                        @error( 'newPassword' )
                        <span class="has-text-danger" role="alert">
                        {{ $message }}
                    </span>
                        @enderror
                    </div>
                    <div class="field">
                        <label for="confirmPassword" class="label">Bekräfta lösenord</label>
                        <div class="control">
                            <input id="confirmPassword" class="input {{ $errors->has('confirmPassword') ? ' is-danger' : '' }}" type="password" name="confirmPassword" placeholder="Bekräfta lösenord" required>
                        </div>
                        @error( 'confirmPassword' )
                            <span class="has-text-danger" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
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
            </div>
            <div class="column is-half is-widescreen level-item">

            </div>
        </div>
    </section>
    <hr>
    <section class="column has-text-centered">
        <p>
            Vill du byta email?
            <br>
            <a href="{{ route( 'contacts.support' ) }}">Kontakta supporten här</a>
        </p>
    </section>
@endsection
