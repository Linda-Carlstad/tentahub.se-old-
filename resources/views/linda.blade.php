@extends('layouts.app')

@if (\Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show text-center">
        <h1>{!! \Session::get('success') !!}</h1>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="jumbotron text-center">
  <h1 class="display-2">Tentaportal för Linda</h1>
  <p class="lead">Här kan du ladda ner tentasvar och dela med dig anonymt av dina egna svar</p>
  <hr class="my-4">
  <p>Antal tentor från din förening just nu:</p>
</div>

<form class="form-group col-2" action="" enctype="multipart/form-data" method="POST">
<input type="file" name="image" value="">
<input type="hidden" name="_token" value="{{ csrf_token()}}">
<br>
<button class="btn btn-primary" type="submit" name="button">Upload Exam</button>
</form>
