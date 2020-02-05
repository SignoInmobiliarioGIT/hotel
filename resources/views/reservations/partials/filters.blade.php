<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Filtros</h3>
    </div>
    <div class="card-body">
        <form action="/reservation" method="get">
            <div class="row">
                <div class="col-3">
                    <input type="text" name="dateRange"
                        class="form-control my-daterangepicker"
                        value="{{$dateRange}}"> </div>
                <div class="col-5">
                    <button type="submit" class="btn btn-primary"><i
                            class="fas fa-filter mx-2"></i>Filtrar</button>
                </div>
            </div>
        </form>

    </div>
    <!-- /.card-body -->
</div>

@section('js')
<script>
    $(function () {
        $('.my-daterangepicker').daterangepicker({
        autoUpdateInput: true,
        applyClass: 'btn-sm btn-primary',
        cancelClass: 'btn-sm btn-default',
        locale: {
        format: 'DD-MM-YYYY',
        applyLabel: 'Aplicar',
        cancelLabel: 'Limpiar',
        fromLabel: 'Desde',
        toLabel: 'Hasta',
        customRangeLabel: 'Seleccionar rango',
        daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre',
        'Diciembre'
        ],
        firstDay: 1
        },
        opens: 'left',
        minYear: 2015,
        maxYear: parseInt(moment().format('YYYY'), 10)
        }, function (start, end, label) {
        // var years = moment().diff(start, 'years');
        // alert("You are " + years + " years old!");
        // console.log(start + '-' + end);
        });
        });
</script>
@endsection
