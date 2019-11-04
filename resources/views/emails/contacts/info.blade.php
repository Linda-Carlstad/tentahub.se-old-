@extends( 'layouts.mail' )
@section( 'content' )

    <h3>{{ $request->subject }}</h3>
    <p>{{ $request->name }}</p>
    <br>
    <p>{{ $request->text }}</p>

@endsection
