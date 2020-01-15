@extends( 'layouts.app' )
@section( 'title', 'Redigera tenta ' . $exam->name )
@section( 'content' )

    <section class="section exam">
        <div class="columns">
            <div class="column is-half is-widescreen">
                <h1 class="title">Redigera tenta {{ $exam->name }}</h1>
                <hr>
                <form class="form-group" action="{{ route( 'exams.update', $exam->id ) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method( 'patch' )
                    <input type="hidden" id="recaptcha" name="recaptcha" value="{{ env( 'GOOGLE_RECAPTCHA_KEY' ) }}">
                    <input type="hidden" id="created_from" name="created_from" value="{{ $exam->created_from }}">
                    <input type="hidden" id="changed_from" name="changed_from" value="{{ Request::ip() }}">
                    <input type="hidden" id="type" name="type" value="{{ $exam->type }}">

                    <div class="field">
                        <label class="label" for="name">Namn *</label>
                        <input class="input {{ $errors->has('name') ? ' is-danger' : '' }}" type="text" id="name" name="name" value="{{ $exam->name }}" required>
                        @error( 'name' )
                        <span class="has-text-danger" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label" for="course_id">Kurs *</label>
                        <div class="select {{ $errors->has('association_id') ? ' is-danger' : '' }}">
                            <select id="course_id" name="course_id" required>
                                <option selected disabled>Välj kurs...</option>
                                @foreach( $universities as $university )
                                    @foreach( $university->associations as $association )
                                        @foreach( $association->courses as $course )
                                            <option value="{{ $course->id }}" {{ $exam->course->id == $course->id ? 'selected' : '' }}>
                                                {{ $course->name }} - {{ $course->code }} ({{ $university->name }} - {{ $association->name  }})
                                            </option>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label" for="date">Datum</label>
                        <input class="input {{ $errors->has('date') ? 'is-danger' : '' }}" type="text" id="date" name="date" value="{{ $exam->date }}">
                        @error( 'points' )
                        <span class="has-text-danger" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label" for="grade">Betyg</label>
                        <input class="input {{ $errors->has('grade') ? ' is-danger' : '' }}" type="text" id="grade" name="grade" value="{{ $exam->grade }}">
                        @error( 'grade' )
                        <span class="has-text-danger" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label" for="points">Poäng</label>
                        <input class="input {{ $errors->has('points') ? ' is-danger' : '' }}" type="number" id="points" step=".5" name="points" value="{{ $exam->points }}">
                        @error( 'points' )
                        <span class="has-text-danger" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <p>Det går inte att byta fil. För att göra det måste ni ta ladda upp tentan på nytt.</p>
                    <hr>
                    <div class="field">
                        <div class="control">
                            <small>
                                När du uppdaterar en tentamen så godkänner du att all information kopplad till den tentamen lagras hos oss.
                                Denna webbplats är skyddad av reCAPTCHA, Googles
                                <a target="_blank" class="has-text-underline" href="https://policies.google.com/privacy">sekretesspolicy</a> och
                                <a target="_blank" class="has-text-underline" href="https://policies.google.com/terms">användarvillkor</a> gäller.
                            </small>
                        </div>
                    </div>
                    <br>
                    <div class="field is-grouped">
                        <div class="control">
                            <button class="button is-link">Uppdatera</button>
                        </div>
                        <div class="control">
                            <a href="{{ url()->previous() }}" class="button is-link is-light">Avbryt</a>
                        </div>
                    </div>
                </form>
                <hr>
                <form onsubmit="return confirm('Vill du verkligen ta bort den här tentan?');" action="{{ route( 'exams.destroy', $exam->id ) }}" method="post">
                    @csrf
                    @method( 'delete' )
                    <h2 class="title is-3">Ta bort tenta</h2>
                    <p>Denna åtgärd är permanent.</p>
                    <button type="submit" class="button is-primary">
                        Ta bort
                    </button>
                </form>
            </div>
        </div>
    </section>

@endsection
