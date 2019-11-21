@extends( 'layouts.app' )
@section( 'title', $university->name )
@section( 'content' )

    <section class="section">
        <div class="column is-half">
            <h1 class="title">Ändra uppgifter för {{ $university->name }}</h1>
            <p>Alla fält markerade med <strong>*</strong> är obligatoriska</p>
            <hr>
            <form class="" method="POST" action="{{ route( 'universities.update', $university->id ) }}">
                @csrf
                {{ method_field( 'patch' ) }}
                <div class="field">
                    <label class="label">Namn *</label>
                    <div class="control">
                        <input class="input" name="name" type="text" autofocus required value="{{ $university->name }}">
                    </div>
                    @error( 'name' )
                    <span class="has-text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="field">
                    <label class="label">Initialer * <button type="button" data-tooltip="Exempel: Karlstads Universitet blir KAU">?</button></label>
                    <div class="control">
                        <input class="input" name="nickname" type="text" required value="{{ $university->nickname }}">
                    </div>
                    @error( 'nickname' )
                    <span class="has-text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="field">
                    <label class="label">Beskrivning</label>
                    <div class="control">
                        <textarea class="textarea" rows="1" name="description" type="text">{{ $university->description }}</textarea>
                    </div>
                    @error( 'description' )
                    <span class="has-text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="field">
                    <label class="label">Stad *</label>
                    <div class="control">
                        <input class="input" name="city" type="text" required value="{{ $university->city }}">
                    </div>
                    @error( 'city' )
                    <span class="has-text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="field">
                    <label class="label">Land *</label>
                    <div class="control">
                        <input class="input" name="country" type="text" required value="{{ $university->country }}">
                    </div>
                    @error( 'country' )
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
        </div>
    </section>

@endsection
