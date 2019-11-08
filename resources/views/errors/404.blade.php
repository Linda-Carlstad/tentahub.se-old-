@extends( 'layouts.error' )
@section( 'error' )

        <img class="img-fluid text-center" src="https://http.cat/{{ $exception->getStatusCode() }}"/>

@endsection
