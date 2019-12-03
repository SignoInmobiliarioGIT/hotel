<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Filtros</h3>
    </div>
    <div class="card-body">
        <form action="/reservations" method="get">
            <div class="row">
                <div class="col-3">
                    <input type="text" name="dateRange"
                        class="form-control my-daterangepicker">
                </div>
                <div class="col-5">
                    <button type="submit"
                        class="btn btn-primary">Filtrar</button>
                </div>
            </div>
        </form>

    </div>
    <!-- /.card-body -->
</div>
