@extends('layouts.app')

@section('content')
    <section>
        <div class="container py-4">
            <div class="title">
                <h1 class="py-4 color-red">Tipi di Progetto</h1>
            </div>
            <table class="table table-dark">
                <thead>
                    <tr>
                      <th class="py-4">ID</th>
                      <th class="py-4">Tipo di progetto</th>
                      <th class="py-4">Slug</th>
                      <th class="py-4 text-center"><span class="btn main-button-background btn-sm p-1"><a href="{{ route('admin.project_types.create') }}" class="text-decoration-none text-light btn btn-sm ">Aggiungi un Tipo di Progetto</a></span></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($types as $type)
                        <tr>

                          <td class="py-3"><span class="color-red">{{ $type->id }}</span></td>

                          <td class="py-3"><a class="text-decoration-none btn btn-sm main-button-background" href="">{{$type->name}}</a></td>

                          <td class="py-3"><span class="text-white-50">{{ $type->slug }}</span></td>

                          <td class="py-3"><span class="text-white-50">
                            <div class="d-flex gap-3 py-3 justify-content-center">
  
                                {{-- Pulsante modifica --}}
                                <span><a href="{{route('admin.project_types.edit', $type->id)}}" class="btn modify-button-bg btn-sm text-light">Modifica</a></span>
  
                                {{-- Modale --}}
                                <div class="index" id="modal-delete-{{ $type->id }}">
                                  <div class="delete-notification py-3 px-4">
                                      <p class="mb-5 border-bottom"><b>Sei sicuro di voler eliminare questo elemento?</b></p>
                                      <div class="d-flex justify-content-around">
                                        <form action="{{route('admin.project_types.destroy', $type->id)}}" method="POST">
                                          @csrf
                                          @method('DELETE')
  
                                          {{-- Pulsante elimina --}}
                                          <input type="submit" value="Elimina" class="btn btn-danger btn-sm">
                                        </form>
                                        
                                        {{-- Pulsante annulla --}}
                                        <span class="btn btn-primary btn-sm" onclick="hideModal('{{ $type->id }}')">Annulla</span>
                                      </div>
                                  </div>
                                </div>
                              
                              <span class="btn btn-danger btn-sm" onclick="deleteNotification('{{ $type->id }}')">Elimina</span>
                            </div>
                          </td>

                        </tr>
                    @empty
                        <tr>
                          <td colspan="4">
                            Nessun progetto trovato
                          </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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