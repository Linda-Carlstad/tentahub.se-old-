@extends( 'layouts.app' )
@section( 'title', $exception->getStatusCode() )
@section( 'content' )

    <section class="d-flex align-items-center justify-content-center py-5">
        <div class="text-center">
            @yield( 'error' )
            <br>
            <a class="btn btn-primary mt-4" href="{{ url()->previous() }}">Gå tillbaka</a>
        </div>
    </section>

@endsection
