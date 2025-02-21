<div class="modal fade" id="modal-eliminar-{{$reg->id}}" tabindex="-1" aria-labelledby="modalLabel{{$reg->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <form action="{{ route('usuarios.destroy', $reg->id) }}" method="post">
                @csrf
                @method('DELETE') 

                <div class="modal-header bg-danger text-white rounded-top-4">
                    <h4 class="modal-title fw-bold" id="modalLabel{{$reg->id}}">Eliminar Usuario</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body text-center">
                    <p class="fs-5">¿Está seguro de eliminar al usuario <strong>{{$reg->name}}</strong>?</p>
                    <p class="text-muted">Correo: <strong>{{$reg->email}}</strong></p>
                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary rounded-pill shadow-sm" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-danger rounded-pill shadow-sm">
                        <i class="fas fa-trash-alt"></i> Eliminar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
