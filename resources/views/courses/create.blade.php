@extends( 'layouts.app' )
@section( 'title', 'Lägg till ny kurs' )
@section( 'content' )

    <section class="section">
        <div class="column is-half">
            <h1 class="title">Lägg till ny kurs</h1>
            <p>Alla fält markerade med <strong>*</strong> är obligatoriska</p>
            <hr>
            <form class="" method="POST" action="{{ route( 'courses.store' ) }}">
                @csrf
                <div class="field">
                    <label for="name" class="label">Namn *</label>
                    <div class="control">
                        <input id="name" class="input {{ $errors->has('name') ? 'is-danger' : '' }}" name="name" type="text" value="{{ old( 'name' ) }}" autofocus required>
                    </div>
                    @error( 'name' )
                        <span class="has-text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="field">
                    <label for="code" class="label">Kod * <button type="button" data-tooltip="Exempel: ISGC00">?</button></label>
                    <div class="control">
                        <input id="code" class="input {{ $errors->has('code') ? 'is-danger' : '' }}" name="code" type="text" value="{{ old( 'code' ) }}" required>
                    </div>
                    @error( 'code' )
                        <span class="has-text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="field">
                    <label for="points" class="label">Poäng *</label>
                    <div class="control">
                        <input id="points" class="input {{ $errors->has('points') ? 'is-danger' : '' }}" name="points" type="number" step="0.5" value="{{ old( 'points' ) }}" required>
                    </div>
                    @error( 'points' )
                        <span class="has-text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                @if( Auth::user()->role === 'super' || Auth::user()->role === 'admin'  )
                    <div class="field">
                        <label for="association_id" class="label">Förening *</label>
                        <div class="control">
                            <div class="select {{ $errors->has('association_id') ? 'is-danger' : '' }}">
                                <select id="association_id" name="association_id">
                                    @if( Auth::user()->role === 'super' )

                                        <option selected disabled>Välj universitet...</option>
                                        @foreach( $universities as $university )
                                            @if( !$university->associations->isEmpty() )
                                                <option disabled>---{{ $university->name }}---</option>
                                            @endif
                                            @foreach( $university->associations as $association )
                                                <option {{ old( 'association_id' ) === $association->id ? 'selected' : '' }} value="{{ $association->id }}">{{ $association->name }}</option>
                                            @endforeach
                                        @endforeach
                                    @else
                                        @foreach( Auth::user()->association->university->associations as $association )
                                            <option {{ old( 'association_id' ) === $association->id ? 'selected' : '' }}  value="{{ $association->id }}">{{ $association->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="university_id" value="{{ Auth::user()->university->id }}">
                @else
                    <input type="hidden" name="association_id" value="{{ Auth::user()->association->id }}">
                    <input type="hidden" name="university_id" value="{{ Auth::user()->university->id }}">
                @endif
                <div class="field">
                    <label for="url" class="label">Länk</label>
                    <div class="control">
                        <input id="url" class="input {{ $errors->has('url') ? 'is-danger' : '' }}" name="url" type="text" value="{{ old( 'url' ) }}">
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
                        <textarea id="description" class="textarea {{ $errors->has('description') ? 'is-danger' : '' }}" rows="2" name="description" type="text">{{ old( 'description' ) }}</textarea>
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
