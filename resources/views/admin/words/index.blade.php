
@extends('layouts.app')
 @section('content')
 <div class="d-flex justify-content-end gap-2 p-2">
  <a href="{{route('admin.words.trash')}}" class="btn btn-secondary">Vedi Cestino</a>
  <a href="{{route('admin.words.create')}}" class="btn btn-success"><i class="fa-solid fa-plus"></i>
  Aggiungi progetto
  </a>
</div>
 <table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Titolo</th>
      <th scope="col">Descrizione</th>
      <th scope="col">Links</th>
      <th scope="col">Tag</th>
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
        <td>
          <div class="d-flex flex-column">
            @forelse ($word->links as $link)
            <a href="{{ $link->url }}">{{ $link->title }}</a>
          @empty
            <span>Nessun link</span>
          @endforelse
          </div>
        </td>
        <td>
          <div class="d-flex flex-column">
            @forelse ($word->tags as $tag)
            <span class="badge" style="color:{{$tag->color}}">{{$tag->title}}</span>
          @empty
            <span>Nessun tag</span>
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
            <form action="{{ route('admin.words.destroy', $word->id) }}" 
              method="POST" class="delete-form" data-word="{{$word->title}}">
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

 {{--Scripts--}}
@section('scripts')
<script>
    const formsDelete= document.querySelectorAll('.delete-form');
    formsDelete.forEach(form => {
        form.addEventListener('submit', e => {
            e.preventDefault();
            const word = form.dataset.word;
            const confirmation = confirm(`Sei sicuro di voler eliminare il projetto ${word}?`);
            if(confirmation) form.submit();
        })
    });

</script>

@endsection
