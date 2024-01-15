@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div class="title">
                <h1 class="py-4 color-red">Tecnologie</h1>
            </div>
            <table class="table table-dark">
                <thead>
                    <tr>
                      <th class="py-4">ID</th>
                      <th class="py-4">Tecnologia</th>
                      <th class="py-4">Slug</th>
                      <th class="py-4 text-center"><span class="btn main-button-background btn-sm p-1"><a href="" class="text-decoration-none text-light btn btn-sm ">Aggiungi una Tecnologia</a></span></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($technologies as $technology)
                        <tr>

                          <td class="py-3"><span class="color-red">{{ $technology->id }}</span></td>

                          <td class="py-3"><a class="text-decoration-none btn btn-sm main-button-background" href="">{{$technology->name}}</a></td>

                          <td class="py-3"><span class="text-white-50">{{ $technology->slug }}</span></td>

                          <td class="py-3"><span class="text-white-50">
                            <div class="d-flex gap-3 py-3 justify-content-center">
  
                                {{-- Pulsante modifica --}}
                                <span><a href="" class="btn modify-button-bg btn-sm text-light">Modifica</a></span>
  
                                {{-- Modale --}}
                                <div class="index" id="modal-delete-{{ $technology->id }}">
                                  <div class="delete-notification py-3 px-4">
                                      <p class="mb-5 border-bottom"><b>Sei sicuro di voler eliminare questo elemento?</b></p>
                                      <div class="d-flex justify-content-around">
                                        <form action="" method="POST">
                                          @csrf
                                          @method('DELETE')
  
                                          {{-- Pulsante elimina --}}
                                          <input type="submit" value="Elimina" class="btn btn-danger btn-sm">
                                        </form>
                                        
                                        {{-- Pulsante annulla --}}
                                        <span class="btn btn-primary btn-sm" onclick="hideModal('{{ $technology->id }}')">Annulla</span>
                                      </div>
                                  </div>
                                </div>
                              
                              <span class="btn btn-danger btn-sm" onclick="deleteNotification('{{ $technology->id }}')">Elimina</span>
                            </div>
                          </td>

                        </tr>
                    @empty
                        <tr>
                          <td colspan="4">
                            Nessuna Tecnologia trovata
                          </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <script>
  
        function deleteNotification(typeId) {
          const deleteMenu = document.getElementById('modal-delete-' + typeId);
          deleteMenu.classList.add("d-block");
        }
      
        function hideModal(typeId) {
          const deleteMenu = document.getElementById('modal-delete-' + typeId);
      
          deleteMenu.classList.remove('d-block');
        }
      
            
    </script>
    
@endsection