@extends( 'layouts.app' )
@section( 'title', Auth::user()->name )
@section( 'content' )

    <section class="hero is-fullwidth has-text-centered">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">Hejsan, {{ Auth::user()->name }}</h1>
                <h3 class="subtitle">Välkommen tillbaka!</h3>
            </div>
        </div>
    </section>
    <hr>
    <section class="hero is-medium has-text-centered">
        <div class="hero-body">
            @if( Auth::user()->valid )
                <h1 class="title">Vad vill du göra idag?</h1>
                <h2 class="subtitle">Välj ett alternativ nedan:</h2>
                <div class="buttons is-centered">
                    <a href="{{ route( 'courses.index') }}" class="button is-primary">Redigera Kurser</a>
                    <a href="{{ route( 'exams.index') }}" class="button is-primary">Redigera Tentor</a>
                </div>
            @else
                <h1 class="title">Byt lösenord</h1>
                <h2 class="subtitle">För att börja använda {{ config( 'app.name' ) }}, behöver ni byta lösenord.</h2>
                <div class="buttons is-centered">
                    <a href="{{ route( 'profile.settings') }}" class="button is-primary">Inställningar</a>
                </div>
            @endif
        </div>
    </section>

@endsection
