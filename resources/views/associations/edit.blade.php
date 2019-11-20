@extends( 'layouts.app' )
@section( 'title', $association->name )
@section( 'content' )

    <section class="section">
        <div class="column is-half">
            <h1 class="title">Ändra uppgifter för {{ $association->name }}</h1>
            <p>Alla fält är obligatoriska</p>
            <hr>
            <form class="" method="POST" action="{{ route( 'associations.update', $association->id ) }}">
                @csrf
                {{ method_field( 'patch' ) }}
                <div class="field">
                    <label class="label">Namn *</label>
                    <div class="control">
                        <input class="input" name="name" type="text" autofocus required value="{{ $association->name }}">
                    </div>
                    @error( 'name' )
                    <span class="has-text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                @if( Auth::user()->role === 'super' )
                    <div class="field">
                        <label class="label">Universitet *</label>
                        <div class="control">
                            <div class="select">
                                <select id="university_id" name="university_id">
                                    <option selected disabled>Välj universitet...</option>
                                    @foreach( $universities as $university )
                                        <option value="{{ $university->id }}" {{ Auth::user()->association->university->id == $university->id ? 'selected' : '' }}>{{ $university->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                @else
                    <input type="hidden" name="university_id" value="{{ Auth::user()->association->university->id }}">
                @endif
                <div class="field">
                    <label class="label">Webbsida</label>
                    <div class="control">
                        <input class="input" name="url" type="text" required value="{{ $association->url }}">
                    </div>
                    @error( 'url' )
                    <span class="has-text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="field">
                    <label class="label">Beskrivning</label>
                    <div class="control">
                        <textarea class="textarea" rows="1" name="description" type="text">{{ $association->description }}</textarea>
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
        </div>
    </section>

@endsection
