@extends('layouts.app')

@if (\Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show text-center">
        <h1>{!! \Session::get('success') !!}</h1>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if (\Session::has('danger'))
    <div class="alert alert-danger alert-dismissible fade show text-center">
        <h1>{!! \Session::get('danger') !!}</h1>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="jumbotron text-center">
  <h1 class="display-2">Tentaportal för Linda</h1>
  <p class="lead">Här kan du ladda ner tentasvar och dela med dig anonymt av dina egna svar</p>
  <hr class="my-4">
  <p>Antal tentor från din förening just nu: {{ $total }}</p>
</div>

<table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Filnamn</th>
                    <th>Ladda ner</th>
                    <th>Preview</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($exams as $exam)
                    <tr>
                        <td>{{ $exam->file_name }}</td>
                        <td>
                        <a href="{{ url( 'download' ) }}" class="btn btn-link">
                                Ladda Ner
                        </a>
                        </td>
                        <td>
                        <a href="{{ asset('storage/exams/' . $exam->file_name )}}" class="btn btn-link" target="_blank">
                                Preview
                        </a>
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>


<form class="form-group col-2" action="" enctype="multipart/form-data" method="POST">
@csrf 
<input type="file" name="exam" value="">
<br>
<button class="btn btn-primary" type="submit">Upload Exam</button>
</form>
