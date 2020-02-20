<div class="modal fade" id="modalConfirmation">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-modal-confirmation" method="POST">
                @method('DELETE')
                @csrf
                <!-- Modal Header -->
                <div class="modal-header no-bd">
                    <h5 class="modal-title">Confirmar Acción</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <h5 class="text-center">¿Estás seguro que desea continuar con la acción seleccionada?</h5>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer no-bd">                        
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                </div>
            </form>
        </div>
    </div>
</div>