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
                <p class="text-center">Antal föreningar: {{ $total }}</p>
                <br>
                <a class="button is-primary" href="{{ route( 'exams.index' ) }}">Tentor</a>
            </div>
        </div>
    </section>

@endsection
