@extends('layouts.app')

@section('content')

    <h1>Inställningar</h1>
    <form class="" action="{{ '/user/' . Auth()->user()->id }}" method="post">
        @csrf
        {{ method_field( 'patch' ) }}
        <input type="hidden" name="type" value="info">

        <div class="form-group row">
            <label for="name">Namn</label>
            <input id="name" type="text" placeholder="Namn" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ Auth()->user()->name }}" required autofocus>

            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name' ) }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group row">
            <label for="email">Email</label>
            <input id="email" type="text" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" email="email" value="{{ Auth()->user()->email }}" required autofocus>

            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email' ) }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group row">
            <label for="name">Förening</label>
            <input id="name" type="text" placeholder="Förening" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ Auth()->user()->name }}" required autofocus>

            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name' ) }}</strong>
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
    <form class="" action="{{ '/user/' . Auth()->user()->id }}" method="post">
        @csrf
        {{ method_field( 'patch' ) }}
        <input type="hidden" name="type" value="security">

        <div class="form-group row">
            <label for="password">Lösenord</label>
            <input id="password" type="text" placeholder="Lösenord" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" password="password" value="" required autofocus>

            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password' ) }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group row">
            <label for="newPassword">Nytt lösenord:</label>
            <input id="newPassword" type="text" placeholder="Nytt lösenord" class="form-control{{ $errors->has('newPassword') ? ' is-invalid' : '' }}" newPassword="newPassword" value="" required autofocus>

            @if ($errors->has('newPassword'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('newPassword' ) }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group row">
            <label for="confirmPassword">Bekräfta lösenord:</label>
            <input id="confirmPassword" type="text" placeholder="Bekräfta lösenord" class="form-control{{ $errors->has('confirmPassword') ? ' is-invalid' : '' }}" confirmPassword="confirmPassword" value="" required autofocus>

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
