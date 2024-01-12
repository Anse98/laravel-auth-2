@extends('layouts.app')

@section('content')
    <section>
        <div class="container py-4">
          <div class="d-flex justify-content-between align-items-center">
            <h1 class="py-4 color-red">Lista dei progetti</h1>
            <span class="btn main-button-background btn-sm p-1"><a href="{{ route('admin.projects.create') }}" class="text-decoration-none text-light btn btn-sm ">Aggiungi un progetto</a></span>
          </div>
            <table class="table table-dark">
                <thead>
                    <tr>
                      <th class="py-4">ID</th>
                      <th class="py-4">Titolo</th>
                      <th class="py-4">Url immagine</th>
                      <th class="py-4">Slug</th>
                      <th class="py-4">Tipo di progetto</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($projects as $project)
                        <tr>
                          <td class="py-3"><span class="color-red">{{ $project->id }}</span></td>
                          <td class="py-3">
                              <a class="text-decoration-none btn btn-sm main-button-background" href="{{ route('admin.projects.show', $project->id) }}">{{$project->title}}</a>
                          </td>
                          <td class="py-3"><span class="text-white-50">{{ $project->thumb }}</span></td>
                          <td class="py-3"><span class="text-white-50">{{ $project->slug }}</span></td>
                          <td class="py-3"><span class="text-white-50">
                            {{isset($project->type) ? $project->type->name : '-'}}</span>
                          </td>
                          <td>
                            <div class="d-flex gap-3 py-3">
  
                                {{-- Pulsante modifica --}}
                                <span><a href="{{route('admin.projects.edit', $project->id)}}" class="btn modify-button-bg btn-sm text-light">Modifica</a></span>
  
                                {{-- Modale --}}
                                <div class="index" id="modal-delete-{{ $project->id }}">
                                  <div class="delete-notification py-3 px-4">
                                      <p class="mb-5 border-bottom"><b>Sei sicuro di voler eliminare questo elemento?</b></p>
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
                          </td>
                        </tr>
                    @empty
                        <tr>
                          <td colspan="6">
                            Nessun progetto trovato
                          </td>
                        </tr>
                    @endforelse
                  </tbody>
                </table>
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