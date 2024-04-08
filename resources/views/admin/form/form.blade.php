
@extends('layouts.app')
 @section('content')
    
    <h1 class="text-center py-3">
        @if (Route::is('admin.words.create')) Aggiungi nuovo termine
        @else Modifica {{$word->title}} @endif 
    </h1>

     {{-- banner validazione del form  --}}
    @include('admin.form.validation')

    {{-- Impostazioni del form --}}
        @if ($word->exists)
    <form action="{{route('admin.words.update', $word->id  ) }}" method="post" 
        class="flex container py-4 justify-content-center">
    @method('put')
        @else
    <form action="{{route('admin.words.store')}}" method="post" 
    class="flex container py-4 justify-content-center">
        @endif
    @csrf

    <div class="d-flex ">
        <div class="input-group mb-3 w-50 p-1 d-flex">
            <div class="w-100">
                <label class="form-label label fw-bold" for="title">Titolo:</label>
            </div>
            {{-- FORM - TITOLO --}}
            <input type="text" required id="title" name="title" class="form-control @error('title') is-invalid @elseif(old('title')) is-valid @enderror" 
            value="{{old('title', $word->title)}}" 
            placeholder="Inserisci titolo...">
            @error('title')
            <div class="invalid-feedback">
                {{$message}}
            </div>   
            @else        
            <div class="valid-feedback">
                Campo corretto
            </div>      
            @enderror       
        </div>
    
        {{-- FORM - SLUG --}}
        <div class="input-group mb-3 w-50 p-1 d-flex">
            <div class="w-100">
                <label class="form-label label fw-bold" for="slug">Slug:</label>
            </div>
            <input type="text" id="slug" name="slug" class="form-control" 
            value="{{$word->slug}}" 
            readonly>    
        </div>
    </div>

    {{-- FORM - DESCRIPTION --}}
    <div class="input-group mb-3 w-100 p-1">
        <label class="form-label label fw-bold" for="description">Descrizione:</label>
        <textarea id="description" name="description" id="description" cols="50" rows="3" 
                class="w-100 @error('description') is-invalid @elseif(old('description')) is-valid @enderror">
                {{old('description', $word->description)}}
        </textarea>
    </div>

    {{-- FORM - LINKS --}}
    <div class="input-group mb-3 w-50 p-1 d-flex">
        <label class="form-label label fw-bold">Links:</label>
        <div class="form-group @error('links') is-invalid @enderror">
            @foreach ($links as $link)
            <div class="form-check form-check-inline">
                <input class="form-check-input " type="checkbox" id="link_{{$link->id}}" 
                name="links[]" value="{{$link->id}}" @if (in_array($link->id, old('links', $prev_links ?? []))) checked @endif>
                <label class="form-check-label" for="link_{{$link->id}}">{{$link->title}}</label>
            </div>
            @endforeach
        </div>
        @error('links')
        <div class="invalid-feedback">
            {{$message}}
        </div>       
        @enderror       
    </div>

    {{-- FORM - TAGS --}}
    <div class="input-group mb-3 w-50 p-1 d-flex">
        <label class="form-label label fw-bold">Tags:</label>
        <div class="form-group @error('tags') is-invalid @enderror">
            @foreach ($tags as $tag)
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="tag_{{$tag->id}}" 
                name="tags[]" value="{{$tag->id}}" @if (in_array($tag->id, old('tags', $prev_tags ?? []))) checked @endif>
                <label class="form-check-label" for="tag_{{$tag->id}}">{{$tag->title}}</label>
            </div>
            @endforeach 
        </div>
        @error('tag_id')
        <div class="invalid-feedback">
            {{$message}}
        </div>   
        @enderror        
    </div>

    <div class="w-100 pt-4">
        <button type="submit" class="btn btn-success me-3">Salva</button>
        <button type="reset" class="btn btn-danger">Svuota</button>
    </div>

    </form>
    
    @include('admin.form.slug')
@endsection
