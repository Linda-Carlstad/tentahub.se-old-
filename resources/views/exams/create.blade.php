@extends('layouts.app')
@section( 'title', 'Lägg till ny tenta' )
@section('content')

    <section class="section">
        <div class="column">
            <h1 class="title">Ladda upp tenta</h1>
            <hr>
        </div>
        <div class="columns">
            <div class="column is-half is-widescreen">
                <h3 class="title is-3">Automatisk uppladdning</h3>
                <form class="form-group" action="{{ route( 'exams.store' ) }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <input type="hidden" id="recaptcha-automatic" name="recaptcha" value="{{ env( 'GOOGLE_RECAPTCHA_KEY' ) }}">
                    <input type="hidden" id="created_from-automatic" name="created_from" value="{{ Request::ip() }}">
                    <input type="hidden" name="type" value="automatic">
                    <div id="file-upload-automatic" class="file has-name">
                        <label class="file-label">
                            <input class="file-input" type="file" name="exam" accept="application/pdf" required>
                            <span class="file-cta">
                            <span class="file-icon">
                                <i class="fas fa-upload"></i>
                            </span>
                            <span class="file-label">
                                Välj en fil...
                            </span>
                        </span>
                            <span class="file-name">
                            Ingen fil uppladdad
                        </span>
                        </label>
                    </div>
                    <br>
                    <div class="field">
                        <div class="control">
                            <label class="checkbox" for="check">
                                <input type="checkbox" name="check" id="check-automatic" required>
                                Jag godkänner att mina uppgifter kommer att hanteras enligt detta <a target="_blank" class="has-text-underline" href="{{ route( 'policy' ) }}">avtal</a>.
                            </label>
                            <hr>
                            <small>
                                När du laddar upp en tentamen så godkänner du att all information kopplad till den tentamen lagras hos oss.
                                Denna webbplats är skyddad av reCAPTCHA, Googles
                                <a target="_blank" class="has-text-underline" href="https://policies.google.com/privacy">sekretesspolicy</a> och
                                <a target="_blank" class="has-text-underline" href="https://policies.google.com/terms">användarvillkor</a> gäller.
                            </small>
                        </div>
                    </div>
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
            <div class="column is-half is-widescreen">
                <h3 class="title is-3">Manuell uppladdning</h3>
                <form class="form-group" action="{{ route( 'exams.store' ) }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <input type="hidden" id="recaptcha-manual" name="recaptcha" value="{{ env( 'GOOGLE_RECAPTCHA_KEY' ) }}">
                    <input type="hidden" id="created_from-manual" name="created_from" value="{{ Request::ip() }}">
                    <input type="hidden" name="type" value="manual">
                    <div class="field">
                        <label class="label" for="name">Namn</label>
                        <input class="input {{ $errors->has('name') ? 'is-danger' : '' }}" type="text" id="name" name="name" value="{{ old( 'name' ) }}" required autofocus>
                        @error( 'name' )
                            <span class="has-text-danger" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label" for="course_id">Kurs</label>
                        <div class="select {{ $errors->has('association_id') ? 'is-danger' : '' }}">
                            <select id="course_id" name="course_id">
                                <option selected disabled>Välj kurs...</option>
                                @foreach( $universities as $university )
                                    @foreach( $university->associations as $association )
                                        @foreach( $association->courses as $course )
                                            <option {{ $course->id === old( 'course_id' ) ? 'selected' : '' }} value="{{ $course->id }}">
                                                {{ $course->name }} - {{ $course->code }} ({{ $university->name }} - {{ $association->name  }})
                                            </option>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="field has-file">
                        <label class="label">Tentamen</label>
                        <div id="file-upload-manual" class="file has-name">
                            <label class="file-label">
                                <input class="file-input" type="file" name="exam" accept="application/pdf" required>
                                <span class="file-cta">
                            <span class="file-icon">
                                <i class="fas fa-upload"></i>
                            </span>
                            <span class="file-label">
                                Välj en fil...
                            </span>
                        </span>
                                <span class="file-name">
                            Ingen fil uppladdad
                        </span>
                            </label>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label" for="date">Datum</label>
                        <input class="input {{ $errors->has('date') ? 'is-danger' : '' }}" type="text" id="date" name="date" value="{{ old( 'date' ) }}" required>
                        @error( 'points' )
                        <span class="has-text-danger" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label" for="grade">Betyg</label>
                        <input class="input {{ $errors->has('grade') ? 'is-danger' : '' }}" type="text" id="grade" name="grade" value="{{ old( 'grade' ) }}" required>
                        @error( 'grade' )
                            <span class="has-text-danger" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label" for="points">Poäng</label>
                        <input class="input {{ $errors->has('points') ? 'is-danger' : '' }}" type="number" id="points" step=".5" name="points" value="{{ old( 'points' ) }}" required>
                        @error( 'points' )
                            <span class="has-text-danger" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="field">
                        <div class="control">
                            <label class="checkbox" for="check">
                                <input type="checkbox" name="check" id="check-manual" required>
                                Jag godkänner att mina uppgifter kommer att hanteras enligt detta <a target="_blank" class="has-text-underline" href="{{ route( 'policy' ) }}">avtal</a>.
                            </label>
                            <hr>
                            <small>
                                När du laddar upp en tentamen så godkänner du att all information kopplad till den tentamen lagras hos oss.
                                Denna webbplats är skyddad av reCAPTCHA, Googles
                                <a target="_blank" class="has-text-underline" href="https://policies.google.com/privacy">sekretesspolicy</a> och
                                <a target="_blank" class="has-text-underline" href="https://policies.google.com/terms">användarvillkor</a> gäller.
                            </small>
                        </div>
                    </div>
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
