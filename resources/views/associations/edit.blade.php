@extends( 'layouts.app' )
@section( 'title', $association->name )
@section( 'content' )

    <section class="section">
        <div class="column is-half">
            <h1 class="title">Ändra uppgifter för {{ $association->name }}</h1>
            <p>Alla fält markerade med <strong>*</strong> är obligatoriska</p>
            <hr>
            <form class="" method="POST" action="{{ route( 'associations.update', $association->slug ) }}">
                @csrf
                {{ method_field( 'patch' ) }}
                <div class="field">
                    <label for="name" class="label">Namn *</label>
                    <div class="control">
                        <input id="name" class="input {{ $errors->has('name') ? ' is-danger' : '' }}" name="name" type="text" autofocus required value="{{ $association->name }}">
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
                                        <option value="{{ $university->id }}" {{ $association->university_id === $university->id ? 'selected' : '' }}>{{ $university->name }}</option>
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
                        <input id="url" class="input {{ $errors->has('url') ? ' is-danger' : '' }}" name="url" type="text" value="{{ $association->url }}">
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
                        <textarea id="description" class="textarea {{ $errors->has('description') ? ' is-danger' : '' }}" rows="2" name="description" type="text">{{ $association->description }}</textarea>
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
                <form onSubmit="return confirm('Är su säker på att du vill ta bort {{ $association->name }}? Denna åtgärd är permanent.');" action="{{ route( 'associations.destroy', $association->id ) }}" method="post">
                    @csrf
                    {{ method_field( 'delete' ) }}
                    <h4>Ta bort {{ $association->name }}?</h4>
                    <p>Denna åtgärd är permanent.</p>
                    <button type="submit" class="button is-primary">
                        Ta bort
                    </button>
                </form>
            @endif
        </div>
    </section>

@endsection
