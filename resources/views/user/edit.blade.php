@section('title', 'Inställningar')
@extends('layouts.app')

@section('content')

    <h1>Inställningar</h1>
    <form class="" action="{{ '/user/' . Auth::user()->id }}" method="post">
        @csrf
        @method( 'PUT' )
        <input type="hidden" name="type" value="info">

        <div class="form-group row">
            <label for="name">Namn</label>
            <input id="name" type="text" placeholder="Namn" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ Auth::user()->name }}" required autofocus>

            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name' ) }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group row">
            <label for="association_id">Förening</label>
            <input id="association_id" type="number" placeholder="Förening" class="form-control{{ $errors->has('association_id') ? ' is-invalid' : '' }}" name="association_id" value="{{ Auth::user()->association_id }}" required>

            @if ($errors->has('association_id'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('association_id' ) }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group row mb-0">
            <div class="col-lg-8 offset-lg-2">
                <button type="submit" class="btn btn-primary ml-0">
                    Save
                </button>
            </div>
        </div>
    </form>
    <hr>
    <h2>Byt lösenord</h2>
    <form class="" action="{{ '/user/' . Auth::user()->id }}" method="post">
        @csrf
        {{ method_field( 'patch' ) }}
        <input type="hidden" name="type" value="security">

        <div class="form-group row">
            <label for="password">Lösenord</label>
            <input id="password" type="password" placeholder="Lösenord" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="" required>

            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password' ) }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group row">
            <label for="newPassword">Nytt lösenord:</label>
            <input id="newPassword" type="password" placeholder="Nytt lösenord" class="form-control{{ $errors->has('newPassword') ? ' is-invalid' : '' }}" name="newPassword" value="" required>

            @if ($errors->has('newPassword'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('newPassword' ) }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group row">
            <label for="confirmPassword">Bekräfta lösenord:</label>
            <input id="confirmPassword" type="password" placeholder="Bekräfta lösenord" class="form-control{{ $errors->has('confirmPassword') ? ' is-invalid' : '' }}" name="confirmPassword" value="" required>

            @if ($errors->has('confirmPassword'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('confirmPassword' ) }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group row mb-0">
            <div class="col-lg-8 offset-lg-2">
                <button type="submit" class="btn btn-primary ml-0">
                    Save
                </button>
            </div>
        </div>
    </form>
    <div class="text-center">
        <p>
            Vill du byta email?
            <br>
            Kontakta supporten här <a href="{{ url( '/' ) }}">!!!!!!!!!!!!!!!!!! :) !!!!!!!!!!!!!!!!!</a>
        </p>
    </div>
@endsection
