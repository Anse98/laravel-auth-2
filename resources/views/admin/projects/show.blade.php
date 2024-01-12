@extends('layouts.app')

@section('content')
    <section>
        <div class="container py-5">
            <h1 class="color-red pb-2"> {{$project->title}}</h1>

            @if($project->type)
            <h3 class="badge border mb-5">{{ $project->type->name }}</h3>
            @endif

            <ul class="d-flex gap-2 ps-0">
              @foreach ($project->technologies as $technology)
                  <li class="badge rounded-pill text-bg-dark">{{$technology->name}}</li>
              @endforeach
            </ul>

            <p class="text-light pb-5">{{$project->description}}</p>

            <div class="d-flex align-items-center gap-3 pb-3 justify-content-between">
              <div>
                <a class="btn modify-button-bg text-light btn-sm" href="{{route('admin.projects.edit', $project->id)}}">Modifica</a>
                <div class="index" id="modal-delete-{{ $project->id }}">
                  <div class="delete-notification py-3 px-4">
                    <p class="mb-5 border-bottom text-light"><b>Sei sicuro di voler eliminare questo elemento?</b></p>
                    <div class="d-flex justify-content-around">
                      <form action="{{route('admin.projects.destroy', $project->id)}}" method="POST">
                        @csrf
                        @method('DELETE')

                        {{-- Pulsante elimina --}}
                        <input type="submit" value="Elimina" class="btn btn-danger btn-sm">
                      </form>
                      
                      {{-- Pulsante annulla --}}
                      <span class="btn btn-primary btn-sm" onclick="hideModal('{{ $project->id }}')">Annulla</span>
                    </div>
                </div>
              </div>
            
              <span class="btn btn-danger btn-sm" onclick="deleteNotification('{{ $project->id }}')">Elimina</span>
            </div>
            <div>
              <a class="btn btn-dark
               btn-sm text-light" href="{{route('admin.projects.index')}}">Torna ai Progetti</a>
            </div>
            </div>

        </div>

       
    </section>

    <script>
  
        function deleteNotification(projectId) {
          const deleteMenu = document.getElementById('modal-delete-' + projectId);
          deleteMenu.classList.add("d-block");
        }
      
        function hideModal(projectId) {
          const deleteMenu = document.getElementById('modal-delete-' + projectId);
      
          deleteMenu.classList.remove('d-block');
        }
      
            
    </script>

@endsection