<div class="modal fade" id="companionsModal" tabindex="-1" role="dialog"
    aria-labelledby="companionsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="companionsModalLabel">Acompañantes
                </h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="conpanions">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Documento</th>
                            <th scope="col">Edad</th>
                            <th scope="col">Relación</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

                <hr>
                <h5>Ingresar acompañante</h5>
                <form id="storeCompanion" action="#" method="GET">
                    <div class="form-row align-items-center">
                        <div class="col-auto col-form-label-sm">
                            <input type="text" class="form-control"
                                placeholder="Nombre y apellido" name="name"
                                required>
                        </div>
                        <div class="col-auto col-form-label-sm">
                            <input type="text" class="form-control"
                                placeholder="Documento" name="document"
                                required>
                        </div>
                        <div class="col-auto col-form-label-sm">
                            <input type="text" class="form-control"
                                placeholder="Edad" name="age">
                        </div>
                        <div class="col-auto col-form-label-sm">
                            <input type="text" class="form-control"
                                placeholder="Relación" name="relationship">
                        </div>
                        <div class="col-auto">
                            <button type="submit"
                                class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
