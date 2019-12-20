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

                
                <h4 class="text-center">Antal: {{ $total }}</h4>
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Namn</th>
                    <th>Melodi</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($associations as $association)
                    <tr>
                        <td>{{ $association->name }}</td>
                        <td>
                            <a href="{{ url( 'song/' . $song->id . '/edit') }}" class="btn btn-link">
                                Redigera
                            </a>
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
                <!--
                <a class="button is-primary is-medium" href="#">Linda Carlstad</a>
                <a class="button is-primary is-medium" href="#" role="button">Mexika</a>
                <a class="button is-primary is-medium" href="#" role="button">Seke</a>
                -->
            </div>
        </div>
    </section>

@endsection
