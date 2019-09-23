@extends('layouts.app')

@section('content')

    <p>{{ Auth()->user()->name }}</p>

@endsection
