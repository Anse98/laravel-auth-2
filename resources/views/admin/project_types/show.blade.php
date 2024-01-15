@extends('layouts.app')

@section('content')
    <section>
        <div class="container py-4">
            <h1 class="color-red">{{$project_type->name}}</h1>
        </div>
        <div class="d-flex align-items-center gap-3 pb-3 justify-content-between container">
            <div>
              <a class="btn modify-button-bg text-light btn-sm" href="{{route('admin.projects.edit', $project_type->id)}}">Modifica</a>
              <div class="index" id="modal-delete-{{ $project_type->id }}">
                <div class="delete-notification py-3 px-4">
                  <p class="mb-5 border-bottom text-light"><b>Sei sicuro di voler eliminare questo elemento?</b></p>
                  <div class="d-flex justify-content-around">
                    <form action="{{route('admin.project_types.destroy', $project_type->id)}}" method="POST">
                      @csrf
                      @method('DELETE')

                      {{-- Pulsante elimina --}}
                      <input type="submit" value="Elimina" class="btn btn-danger btn-sm">
                    </form>
                    
                    {{-- Pulsante annulla --}}
                    <span class="btn btn-primary btn-sm" onclick="hideModal('{{ $project_type->id }}')">Annulla</span>
                  </div>
              </div>
            </div>
          
            <span class="btn btn-danger btn-sm" onclick="deleteNotification('{{ $project_type->id }}')">Elimina</span>
        </div>

        <div>
            <a class="btn btn-dark
             btn-sm text-light" href="{{route('admin.project_types.index')}}">Torna ai Tipi di Progetto</a>
          </div>

          <script>
  
            function deleteNotification(project_typeId) {
              const deleteMenu = document.getElementById('modal-delete-' + project_typeId);
              deleteMenu.classList.add("d-block");
            }
          
            function hideModal(project_typeId) {
              const deleteMenu = document.getElementById('modal-delete-' + project_typeId);
          
              deleteMenu.classList.remove('d-block');
            }
          
                
        </script>

    </section>
@endsection