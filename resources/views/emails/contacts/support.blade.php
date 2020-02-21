@extends( 'layouts.mail' )
@section( 'content' )

    <h2>Ämne: {{ $request->subject }}</h2>
    <p>Namn: {{ $request->name }}</p>
    <br>
    <p>Meddelande:</p>
    <p>{{ $request->text }}</p>

@endsection
