@extends('layouts.app')

@section('content')

    <p>{{ Auth()->user()->role }}</p>

@endsection
