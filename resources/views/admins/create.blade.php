@section('title', 'Skapa användare')
@extends('layouts.app')

@section('content')

    <h1>Skapa ny användare</h1>
    <form class="" action="{{ '/users' }}" method="post">
        @csrf

        <div class="form-group row">
            <label for="name">Namn</label>
            <input id="name" type="text" placeholder="Namn" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="" required autofocus>

            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name' ) }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group row">
            <label for="email">Email</label>
            <input id="email" type="email" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="" required autofocus>

            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email' ) }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group row">
            <label for="role">Roll</label>
            <select class="form-control" id="role" name="role">
                <option value="moderator">Moderator</option>
                @if( $user->role === 'super' )
                    <option value="admin">Admin</option>
                @endif
            </select>

            @if ($errors->has('role'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('role' ) }}</strong>
                </span>
            @endif
        </div>

        @if( $user->role === 'super' )
            <div class="form-group row">
                <label for="association_id">Förening</label>
                <select class="form-control" id="association_id" name="association_id">
                    @foreach( $universities as $university )
                        @if( !$university->associations->isEmpty() )
                            <option disabled>---{{ $university->name }}---</option>
                        @endif
                        @foreach( $university->associations as $association )
                            <option value="{{ $association->id }}">{{ $association->name }}</option>
                        @endforeach
                    @endforeach
                </select>
                @if ($errors->has('association_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('association_id' ) }}</strong>
                    </span>
                @endif
            </div>
        @else
            <div class="form-group row">
                <label for="association_id">Förening</label>
                <select class="form-control" id="association_id" name="association_id">
                        @foreach( $user->association->university->associations as $association )
                            <option value="{{ $association->id }}">{{ $association->name }}</option>
                        @endforeach
                </select>
                @if ($errors->has('association_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('association_id' ) }}</strong>
                    </span>
                @endif
            </div>
        @endif

        <div class="form-group row mb-0">
            <div class="col-lg-8 offset-lg-2">
                <button type="submit" class="btn btn-primary ml-0">
                    Save
                </button>
            </div>
        </div>
    </form>

@endsection
