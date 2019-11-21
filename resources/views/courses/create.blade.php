@extends( 'layouts.app' )
@section( 'title', 'Lägg ett nytt universitet' )
@section( 'content' )

    <section class="section">
        <div class="column is-half">
            <h1 class="title">Skapa ny kurs</h1>
            <p>Alla fält markerade med <strong>*</strong> är obligatoriska</p>
            <hr>
            <form class="" method="POST" action="{{ route( 'courses.store' ) }}">
                @csrf
                <div class="field">
                    <label class="label">Namn *</label>
                    <div class="control">
                        <input class="input" name="name" type="text" autofocus required>
                    </div>
                    @error( 'name' )
                    <span class="has-text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="field">
                    <label class="label">Kod * <button type="button" data-tooltip="Exempel: ISGC00">?</button></label>
                    <div class="control">
                        <input class="input" name="code" type="text" required>
                    </div>
                    @error( 'code' )
                    <span class="has-text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="field">
                    <label class="label">Poäng *</label>
                    <div class="control">
                        <input class="input" name="points" type="number" required>
                    </div>
                    @error( 'points' )
                    <span class="has-text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                @if( Auth::user()->role >= 'admin' )
                    <div class="field">
                        <label class="label">Förening *</label>
                        <div class="control">
                            <div class="select">
                                <select id="association_id" name="association_id">
                                    <option selected disabled>Välj universitet...</option>
                                    @foreach( $universities as $university )
                                        @if( !$university->associations->isEmpty() )
                                            <option disabled>---{{ $university->name }}---</option>
                                        @endif
                                        @foreach( $university->associations as $association )
                                            <option value="{{ $association->id }}">{{ $association->name }}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                @elseif( Auth::user()->role === 'admin' )
                    <div class="form-group row">
                        <label for="association_id">Förening</label>
                        <select class="form-control" id="association_id" name="association_id">
                            @foreach( Auth::user()->association->university->associations as $association )
                                <option value="{{ $association->id }}">{{ $association->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @else
                    <input type="hidden" name="association_id" value="{{ Auth::user()->association->id }}">
                @endif
                <div class="field">
                    <label class="label">Beskrivning</label>
                    <div class="control">
                        <textarea class="textarea" rows="1" name="description" type="text"></textarea>
                    </div>
                    @error( 'description' )
                    <span class="has-text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="field">
                    <label class="label">Länk</label>
                    <div class="control">
                        <input class="input" name="url" type="text">
                    </div>
                    @error( 'url' )
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
