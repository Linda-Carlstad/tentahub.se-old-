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
            <h1 class="title">Vad vill du göra idag?</h1>
            <h2 class="subtitle">Välj ett alternativ nedan:</h2>
            <div class="buttons is-centered">
                <a class="button is-primary">Saker</a>
                <a class="button is-primary">Saker</a>
                <a class="button is-primary">Saker</a>
            </div>
        </div>
    </section>

@endsection
