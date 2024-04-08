@extends('layouts.app')

@section('content')
<section class="p-3 my-5">
  <div class="d-flex justify-content-center">
    <div class="card d-flex justify-content-center">
    <div class="card-body bg-dark text-white">
      <h5 class="card-title">{{$word->title}}</h5>
      @forelse ($word->tags as $tag)
            <span style="color:{{$tag->color}}">{{$tag->title}}</span>
          @empty
            <span>Nessun tag</span>
          @endforelse
      <p class="card-text">{{$word->description}}</p>
      <div class="d-flex gap-2 justify-content-star">
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
</div>
<div class="d-flex justify-content-center">
  <a href="{{route('admin.words.index'
  )}}" class="btn btn-primary my-5">Torna indietro</a>
</div>
</section>
@endsection