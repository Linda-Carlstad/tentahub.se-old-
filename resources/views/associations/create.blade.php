@extends( 'layouts.app' )
@section( 'title', 'Lägg till ny förening' )
@section( 'content' )

    <section class="section">
        <div class="column is-half">
            <h1 class="title">Lägg till ny förening</h1>
            <p>Alla fält markerade med <strong>*</strong> är obligatoriska</p>
            <hr>
            <form class="" method="POST" action="{{ route( 'associations.store' ) }}">
                @csrf
                <div class="field">
                    <label for="name" class="label">Namn *</label>
                    <div class="control">
                        <input id="name" class="input {{ $errors->has('name') ? ' is-danger' : '' }}" name="name" type="text" value="{{ old( 'name' ) }}" autofocus required>
                    </div>
                    @error( 'name' )
                        <span class="has-text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                @if( Auth::user()->role === 'super' )
                    <div class="field">
                        <label for="university_id" class="label">Universitet *</label>
                        <div class="control">
                            <div class="select {{ $errors->has('university_id') ? ' is-danger' : '' }}">
                                <select id="university_id" name="university_id">
                                    <option selected disabled>Välj universitet...</option>
                                    @foreach( $universities as $university )
                                        <option value="{{ $university->id }}" {{ old( 'university_id' ) === $university->id ? 'selected' : '' }} {{ Auth::user()->association->university->id == $university->id ? 'selected' : '' }}>{{ $university->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error( 'university_id' )
                            <span class="has-text-danger" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                @else
                    <input type="hidden" name="university_id" value="{{ Auth::user()->association->university->id }}">
                @endif
                <div class="field">
                    <label for="url" class="label">Webbsida</label>
                    <div class="control">
                        <input id="url" class="input {{ $errors->has('url') ? ' is-danger' : '' }}" name="url" type="text" value="{{ old( 'url' ) }}">
                    </div>
                    @error( 'url' )
                        <span class="has-text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="field">
                    <label for="description" class="label">Beskrivning</label>
                    <div class="control">
                        <textarea id="description" class="textarea {{ $errors->has('description') ? ' is-danger' : '' }}" rows="2" name="description" type="text">{{ old( 'description' ) }}</textarea>
                    </div>
                    @error( 'description' )
                        <span class="has-text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
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
    </section>

@endsection
