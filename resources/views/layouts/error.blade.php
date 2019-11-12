@extends( 'layouts.app' )
@section( 'title', $exception->getStatusCode() )
@section( 'content' )

    <section class="error section">
        <div class="columns is-centered">
            <div class="column is-half is-widescreen has-text-centered">
                @yield( 'error' )
                <br>
                <a class="button is-medium is-primary" href="{{ url()->previous() }}">Gå tillbaka</a>
            </div>
        </div>
    </section>

@endsection
