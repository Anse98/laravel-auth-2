@extends('layouts.app')

@section('content')
<div class="container py-3">
    <h2 class="fs-4 text-secondary my-4 text-light">
        {{ __('Benvenuto') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card text-bg-dark">
                <div class="card-header">{{ Auth::user()->name }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('Hai loggato con successo !') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
