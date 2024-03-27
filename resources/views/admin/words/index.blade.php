
@extends('layouts.app')
 @section('content')
 <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Titolo</th>
      <th scope="col">Descrizione</th>
      <th scope="col">Slug</th>
      <th scope="col">Links</th>
      <th scope="col">Data creazione</th>
      <th scope="col">Ultima modifica</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
      @forelse ($words as $word)
      <tr>
        <th scope="row">{{$word->id}}</th>
        <td>{{$word->title}}</td>
        <td>{{$word->description}}</td>
        <td>{{$word->slug}}</td>
        <td>
          <div class="d-flex flex-column text-center">
            @forelse ($word->links as $link)
            <a href="{{ $link->url }}">{{ $link->title }}</a>
          @empty
            <span>Nessun link</span>
          @endforelse
          </div>
        </td>
        <td>{{$word->created_at}}</td>
        <td>{{$word->updated_at}}</td>
        <td>
          <div class="d-flex gap-2 justify-content-end">
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
        </td>
      </tr>
        @empty
          <h1>Non ci sono progetti da mostrare</h1>
        @endforelse
        
  </tbody>
</table> 
 @endsection
