
@extends('layouts.app')
 @section('content')
 <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Titolo</th>
      <th scope="col">Descrizione</th>
      <th scope="col">Slug</th>
    </tr>
  </thead>
  <tbody>
      @forelse ($words as $word)
      <tr>
        <th scope="row">{{$word->id}}</th>
        <td>{{$word->title}}</td>
        <td>{{$word->description}}</td>
        <td>{{$word->slug}}</td>
      </tr>
        @empty
          <h1>Non ci sono progetti da mostrare</h1>
        @endforelse
  </tbody>
</table> 
 @endsection
