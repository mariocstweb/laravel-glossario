@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('HOME') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <a class="nav-link text-uppercase fw-bold text-dark" href="{{route('admin.words.index') }}">{{ __('Controlla i dati') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
