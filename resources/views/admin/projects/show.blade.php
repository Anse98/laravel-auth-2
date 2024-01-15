@extends('layouts.app')

@section('content')
      <section>
        <div class="container py-5 d-flex justify-content-center">
          <div class="card" style="width: 24rem;">
            @if($project->thumb)
            <img src="{{ asset('storage/'.$project->thumb)}}" 
            class="card-img-top" alt="">
            @else 
            <img src="{{Vite::asset('resources/img/no-image.jpg')}}" alt="">
            @endif
            <div class="card-body bg-dark-grey text-light text-center">
              <h5 class="card-title color-red">{{$project->title}}</h5>
              <p class="card-text ">{{$project->description}}</p>
            </div>

              <ul class="list-group list-group-flush">
                @if($project->type)
                <li class="list-group-item bg-dark-grey">
                  <div class="d-flex justify-content-center">
                    <span class="badge border"><a class="text-decoration-none text-light" href="{{route('admin.project_types.index')}}">{{ $project->type->name }}</a></span>
                  </div>
                </li>
                @endif

                @if(count($project->technologies) > 0)
                <li class="list-group-item bg-dark-grey text-light">
                  <div class="d-flex justify-content-center gap-2 flex-wrap">
                    @foreach ($project->technologies as $technology)
                      <span class="badge rounded-pill text-bg-dark"><a class="text-decoration-none text-light" href="{{route('admin.project_technologies.index')}}">{{$technology->name}}</a></span>
                    @endforeach
                  </div>
                </li>
                @endif
              </ul>
              <div class="d-flex gap-3 p-3 bg-dark-grey justify-content-between ">
                {{-- Pulsante modifica --}}
                <span><a href="{{route('admin.projects.edit',   $project->id)}}" class="btn modify-button-bg btn-sm text-light">Modifica</a>
                </span>

                {{-- Modale --}}
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