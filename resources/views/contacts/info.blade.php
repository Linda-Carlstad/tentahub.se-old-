@extends('layouts.app')
@section('title', 'Kontakta oss')

@section('content')

    <section class="section">
        <div class="columns">
            <div class="column is-half is-widescreen">
                <h1 class="title">Kontakta oss</h1>
                <p>
                    Du är självklart välkommen att ringa till oss eller så kan du använda dig av
                    formuläret nedan för att komma i kontakt med oss
                </p>
                <hr>
                <form class="{{ route( 'contact' ) }}" method="post">
                    @csrf
                    <input type="hidden" name="type" value="info">
                    <input type="hidden" id="recaptcha" name="recaptcha" value="{{ env( 'GOOGLE_RECAPTCHA_KEY' ) }}">

                    <div class="field">
                        <label for="name" class="label">Namn</label>
                        <div class="control">
                            <input id="name" class="input {{ $errors->has('name') ? ' is-danger' : '' }}" type="text" placeholder="Namn" name="name" value="{{ old( 'name' ) }}" required autofocus>
                            @error( 'email' )
                            <span class="has-text-danger" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="field">
                        <label for="email" class="label">E-postadress</label>
                        <div class="control">
                            <input id="email" class="input {{ $errors->has('email') ? ' is-danger' : '' }}" type="email" placeholder="E-postadress" name="email" value="{{ old( 'email' ) }}" required>
                            @error( 'email' )
                            <span class="has-text-danger" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="field">
                        <label for="subject" class="label">Ämne</label>
                        <div class="control">
                            <input id="subject" class="input {{ $errors->has('subject') ? ' is-danger' : '' }}" type="text" placeholder="Ämne" name="subject" value="{{ old( 'subject' ) }}" required>
                            @error( 'subject' )
                            <span class="has-text-danger" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="field">
                        <label for="text" class="label">Meddelande</label>
                        <div class="control">
                            <textarea id="text" class="input {{ $errors->has('text') ? ' is-danger' : '' }}" placeholder="Meddelande" name="text" value="{{ old( 'text' ) }}" required></textarea>
                            @error( 'text' )
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
                                Jag samtycker till att mina uppgifter lagras och behandlas enligt följande
                                <a class="has-text-underline" href="{{ route( 'policy' ) }}" target="_blank">avtal</a>.
                            </label>
                        </div>
                    </div>
                    <p>
                        Denna webbplats är skyddad av reCAPTCHA och Googles
                        <a target="_blank" class="has-text-underline" href="https://policies.google.com/privacy">sekretesspolicy</a> och
                        <a target="_blank" class="has-text-underline" href="https://policies.google.com/terms">användarvillkor</a> gäller.
                    </p>
                    <br>
                    <div class="field is-grouped">
                        <div class="control">
                            <button class="button is-primary" type="submit">Skicka</button>
                        </div>
                        <div class="control">
                            <a class="button is-light" href="{{ url()->previous() }}">Avbryt</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection
