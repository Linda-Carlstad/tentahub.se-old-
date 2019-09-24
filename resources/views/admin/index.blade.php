@extends('layouts.app')

@section('content')

    <p>Hello {{ Auth::user()->role }}</p>

@endsection
