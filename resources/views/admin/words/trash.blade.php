@extends('layouts.app')


@section('content')
<section id="words-trash" class="my-5">
    <h1 class="mb-5">Termini da cancellare:</h1>
    {{--Tabella--}}
    <table class="table table-dark">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Titolo</th>
            <th scope="col">Descrizione</th>
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
              <td>
                <div class="d-flex flex-column">
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

                  <a href="{{ route('admin.words.show', $word->id)}}" class="btn btn-primary">
                    <i class="far fa-eye"></i>
                  </a>
      
                  {{--# RESTORE --}}
                  <form action="{{route('admin.words.restore', $word->id)}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-arrows-rotate"></i></button>
                  </form>
      
                  {{--# DESTROY --}}
                  <form action="{{route('admin.words.drop', $word->id)}}" 
                    method="POST" class="delete-form" data-word="{{$word->title}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                  </form>
                </div>
              </td>
            </tr>
              @empty
                <h1>Non ci sono progetti da mostrare</h1>
              @endforelse
              
        </tbody>
      </table> 
      <a href="{{route('admin.words.index')}}" class="btn btn-secondary">Progetti attivi</a>
</section>
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