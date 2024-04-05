@extends('layouts.app')

@section('content')
<section class="p-3">
  <div class="d-flex justify-content-end">
    <a href="{{route('admin.words.index'
    )}}" class="btn btn-primary">Torna indietro</a>
    </div>
    <h1 class="text-center p-3">{{$word->title}}</h1> 
  <div class="d-flex justify-content-center">
    <div class="card d-flex justify-content-center">
    <div class="card-body">
      <h5 class="card-title">{{$word->title}}</h5>
      @forelse ($word->tags as $tag)
            <span style="color:{{$tag->color}}">{{$tag->title}}</span>
          @empty
            <span>Nessun tag</span>
          @endforelse
      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
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

    <p></p>
</section>
@endsection