@extends('layouts.app')

@section('content')
<h1 class="text-center p-3">{{$word->title}}</h1>
<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">{{$word->title}}</h5>
    <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <div class="d-flex gap-2 justify-content-between">
      <a href="{{route('admin.words.index')}}" class="btn btn-primary">Torna indietro</a>
      {{--# SHOW --}}
      <a href="{{ route('admin.words.show', $word->id)}}" class="btn btn-sm btn-primary">
        <i class="far fa-eye"></i>
      </a>

      {{--# EDIT --}}
      <a href="{{ route('admin.words.edit', $word->id)}}" class="btn btn-sm btn-secondary">
        <i class="fas fa-pencil"></i>
      </a>

      {{--# DESTROY --}}
      <form action="{{ route('admin.words.destroy', $word->id) }}" method="POST" id="delete-form">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger"><i class="far fa-trash-can"></i></button>
      </form>
    </div>
  </div>
</div>
@endsection