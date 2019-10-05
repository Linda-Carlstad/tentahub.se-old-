@extends('layouts.app')
@section('title', 'Kontakt')

@section('content')

    <div class="text-center">
        <h2>Kontakta supporten</h2>
        <p>
            Support kontaktformulär :)
        </p>
    </div>
    <form class="" action="/kontakta-email" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Namn</label>
            <input class="form-control" type="text" name="name" placeholder="Namn">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="subject">Ämne</label>
            <input class="form-control" type="text" name="subject" placeholder="Ämne">
        </div>
        <div class="form-group">
            <label for="text">Meddelande</label>
            <textarea class="form-control" type="text" name="text" placeholder="Meddelande" rows="5"></textarea>
        </div>
        <div class="form-group ml-4">
            <input class="form-check-input" type="checkbox" name="policy" required>
            <label class="form-check-label" for="policy">
                Jag samtycker till att mina uppgifter lagras och behandlas enligt följande
                <a href="{{ route( 'policy' ) }}" target="_blank">avtal</a>.
            </label>
        </div>
        <button type="submit" class="btn btn-red btn-expand">Skicka</button>
    </form>

@endsection
