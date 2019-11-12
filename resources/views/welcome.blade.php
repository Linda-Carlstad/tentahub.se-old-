@extends('layouts.app')

@section('content')

    <section class="hero is-large has-text-centered">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Tentahub
                </h1>
                <h2 class="subtitle">
                    by <a href="https://lindacarlstad.se">LINDA Carlstad</a>
                </h2>
                <p class="">Här kan du ladda ner tentasvar och dela med dig anonymt av dina egna svar</p>
                <hr class="">
                <p>Nedan hittar du tillgängliga föreningar.</p>
                <a class="button is-primary is-medium" href="{{ route( 'linda' ) }}">Linda Carlstad</a>
                <a class="button is-primary is-medium" href="#" role="button">Mexika</a>
                <a class="button is-primary is-medium" href="#" role="button">Seke</a>
            </div>
        </div>
    </section>

@endsection
