@extends('layouts.app')
@section( 'title', 'Linda Carlstad tentaportal' )
@section( 'content' )

    <section class="section hero is-small has-text-centered">
        <div class="hero-body">
            <h1 class="title">Linda Carlstad tentaportal</h1>
            <p>Här kan du ladda ner tentasvar och dela med dig anonymt av dina egna svar</p>
            <hr>
            <p>Antal tentor från din förening just nu:</p>
        </div>
    </section>
    <section class="section">
        <h2 class="title is-3">Ladda upp din tenta:</h2>
        <form class="form-group" action="" enctype="multipart/form-data" method="POST">
            @csrf
            <div id="file-upload" class="file has-name">
                <label class="file-label">
                    <input class="file-input" type="file" name="exam" accept="application/pdf">
                    <span class="file-cta">
                        <span class="file-icon">
                            <i class="fas fa-upload"></i>
                        </span>
                        <span class="file-label">
                            Choose a file…
                        </span>
                    </span>
                    <span class="file-name">
                        No file uploaded
                    </span>
                </label>
            </div>
            <br>
            <button class="button is-primary" type="submit">Upload Exam</button>
        </form>
    </section>
@endsection
