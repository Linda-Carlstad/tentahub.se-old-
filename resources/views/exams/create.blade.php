@extends('layouts.app')
@section( 'title', 'Lägg till ny tenta' )
@section('content')

    <section class="section">
        <div class="coulmns">
            <div class="column is-half is-widescreen">
                <h1 class="title">Ladda upp tenta</h1>
                <form class="form-group" action="{{ route( 'exams.store' ) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="hidden" id="recaptcha" name="recaptcha" value="{{ env( 'GOOGLE_RECAPTCHA_KEY' ) }}">
                    <div class="field">
                        <label class="label" for="name">Namn</label>
                        <input class="input {{ $errors->has('name') ? ' is-danger' : '' }}" type="text" id="name" name="name">
                        @error( 'name' )
                        <span class="has-text-danger" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label" for="grade">Betyg</label>
                        <input class="input {{ $errors->has('grade') ? ' is-danger' : '' }}" type="text" id="grade" name="grade">
                        @error( 'grade' )
                        <span class="has-text-danger" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label" for="points">Poäng</label>
                        <input class="input {{ $errors->has('points') ? ' is-danger' : '' }}" type="number" id="points" name="points">
                        @error( 'points' )
                        <span class="has-text-danger" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label" for="course_id">Kurs</label>
                        <div class="select {{ $errors->has('association_id') ? ' is-danger' : '' }}">
                            <select id="course_id" name="course_id">
                                <option selected disabled>Välj kurs...</option>
                                @foreach( $universities as $university )
                                    @foreach( $university->associations as $association )
                                        @foreach( $association->courses as $course )
                                            <option value="{{ $course->id }}">
                                                {{ $course->name }} - {{ $course->code }} ({{ $university->name }} - {{ $association->name  }})
                                            </option>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="file-upload" class="file has-name">
                        <label class="file-label">
                            <input class="file-input" type="file" name="exam" accept="application/pdf" required>
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
                    <small>
                        Denna webbplats är skyddad av reCAPTCHA och Googles
                        <a target="_blank" class="has-text-underline" href="https://policies.google.com/privacy">sekretesspolicy</a> och
                        <a target="_blank" class="has-text-underline" href="https://policies.google.com/terms">användarvillkor</a> gäller.
                    </small>
                    <br>
                    <br>
                    <div class="field is-grouped">
                        <div class="control">
                            <button class="button is-link">Lägg till</button>
                        </div>
                        <div class="control">
                            <a href="{{ url()->previous() }}" class="button is-link is-light">Avbryt</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection
