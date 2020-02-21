@extends( 'layouts.mail' )
@section( 'content' )

    <h3>Ämne: {{ $request->subject }}</h3>
    <p>Namn: {{ $request->name }}</p>
    <br>
    <p>Meddelande:</p>
    <p>{{ $request->text }}</p>

@endsection
