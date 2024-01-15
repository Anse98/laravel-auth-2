@extends('layouts.app')

@section('content')
    <section>
        <div class="container py-4">
            <h1 class="my-4 text-light">Crea un nuovo Tipo di Progetto</h1>

            <form action="{{ route('admin.project_types.update', $project_type->id) }}" method="POST">
                
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label color-grey">Nome del Tipo di Progetto</label>
                    <input type="text" required class="form-control text-bg-dark" name="name" id="name" placeholder="ES: Urbanistico" value="{{old('name', $project_type->name)}}">
                </div>
                
                <div>
                    <input type="submit" class="btn main-button-background text-light btn-sm p-2" value="Conferma Modifiche">
                </div>
            </form>

            @if($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </section>
@endsection