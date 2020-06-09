@extends( 'layouts.mail' )
@section( 'title', 'Ny användare' )
@section( 'content' )

    <h3>Hejsan {{ $user->name }}</h3>
    <p>
        Den här e-postadressen har blivit registrerad på <a href="https://tentahub.se">https://tentahub.se</a>.
        <br><br>
        <b>E-postadress:</b> {{ $user->email }}
        <br>
        <b>Lösenord:</b> {{ $password }}
    </p>

    <a class="button is-primary" href="{{ config( 'app.url' ) }}/logga-in">Logga in</a>

@endsection
