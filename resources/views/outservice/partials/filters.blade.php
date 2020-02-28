<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Filtros</h3>
    </div>
    <div class="card-body">
        <form action="/outservice" method="GET">
            <div class="row">
                <div class="col-3">
                    <input type="text" name="dateRange" class="form-control my-daterangepicker" value="{{$dateRange}}">
                </div>
                <div class="col-5">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-filter mx-2"></i>Filtrar</button>
                </div>
            </div>
        </form>
    </div>
    <!-- /.card-body -->
</div>
