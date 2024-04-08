@extends('layouts.app')
@section('content')

<div class="jumbotron p-5 my-5 bg-light rounded-3 shadow ">
    <div class="container py-5">
        <h1 class="display-5 fw-bold text-center">
            BENVENUTO SUL TUO GLOSSARIO <br>
            <a href="{{route('admin.words.index') }}" class="btn btn-primary">Vai al Glossario</a>
        </h1>
    </div>
</div>
@endsection