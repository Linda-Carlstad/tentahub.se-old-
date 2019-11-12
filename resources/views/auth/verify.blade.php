@extends('layouts.app')

@section('content')

    <section class="section">
        <div class="columns level">
            <div class="column is-half is-widescreen level-item">
                <h1 class="title">Verifiera din e-postadress här</h1>
                <p>
                    För att vi ska kunna veta att det är du, så behöver du verifiera din e-postadress!
                    Kolla i din inkorg så kan vi vara säkra på att det är du.
                    <br>
                    <br>
                    Fick du inget mail?
                    <br>
                    Klicka nedan för att skicka ett nytt verifieringsmail.
                </p>
                <br>
                <form>
                    @csrf
                    <button type="submit" class="button is-primary">Skicka igen</button>
                </form>
            </div>
            <div class="column is-half is-widescreen level-item has-text-centered">
                <figure class="image">
                    <img src="https://via.placeholder.com/400x400.png/09f/fff" />
                </figure>
            </div>
        </div>
    </section>

@endsection
