@extends( 'layouts.app' )
@section( 'title', $university->name )
@section( 'content' )

    <section class="section">
        <div class="column is-half">
            <h1 class="title">Ändra uppgifter för {{ $university->name }}</h1>
            <p>Alla fält markerade med <strong>*</strong> är obligatoriska</p>
            <hr>
            <form class="" method="POST" action="{{ route( 'universities.update', $university->slug ) }}">
                @csrf
                @method( 'PATCH' )
                <div class="field">
                    <label for="name" class="label">Namn *</label>
                    <div class="control">
                        <input id="name" class="input {{ $errors->has('name') ? 'is-danger' : '' }}" name="name" type="text" autofocus required value="{{ $university->name }}">
                    </div>
                    @error( 'name' )
                        <span class="has-text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="field">
                    <label for="nickname" class="label">Initialer * <button type="button" data-tooltip="Exempel: Karlstads Universitet blir KAU">?</button></label>
                    <div class="control">
                        <input id="nickname" class="input {{ $errors->has('nickname') ? 'is-danger' : '' }}" name="nickname" type="text" required value="{{ $university->nickname }}">
                    </div>
                    @error( 'nickname' )
                        <span class="has-text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="field">
                    <label for="city" class="label">Stad *</label>
                    <div class="control">
                        <input id="city" class="input {{ $errors->has('city') ? 'is-danger' : '' }}" name="city" type="text" required value="{{ $university->city }}">
                    </div>
                    @error( 'city' )
                        <span class="has-text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="field">
                    <label for="country" class="label">Land *</label>
                    <div class="control">
                        <input id="country" class="input {{ $errors->has('country') ? 'is-danger' : '' }}" name="country" type="text" required value="{{ $university->country }}">
                    </div>
                    @error( 'country' )
                        <span class="has-text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="field">
                    <label for="url" class="label">Länk till webbsida</label>
                    <div class="control">
                        <input id="url" class="input {{ $errors->has('url') ? 'is-danger' : '' }}" name="url" type="text" value="{{ $university->url }}">
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
                        <textarea id="description" class="textarea {{ $errors->has('description') ? 'is-danger' : '' }}" rows="2" name="description" type="text">{{ $university->description }}</textarea>
                    </div>
                    @error( 'description' )
                    <span class="has-text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-link">Ändra</button>
                    </div>
                    <div class="control">
                        <a href="{{ url()->previous() }}" class="button is-link is-light">Avbryt</a>
                    </div>
                </div>
            </form>
            @if( Auth::user()->role === 'super' )
                <hr>
                <form onSubmit="return confirm('Är su säker på att du vill ta bort {{ $university->name }}? Denna åtgärd är permanent.');" action="{{ route( 'universities.destroy', $university->id ) }}" method="post">
                    @csrf
                    {{ method_field( 'delete' ) }}
                    <h4>Ta bort {{ $university->name }}?</h4>
                    <p>Denna åtgärd är permanent.</p>
                    <button type="submit" class="button is-primary">
                        Ta bort
                    </button>
                </form>
            @endif
        </div>
    </section>

@endsection
