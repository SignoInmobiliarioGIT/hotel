<div class="card card-danger">
    <div class="card-header">
        <h3 class="card-title">Different Width</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-3">
                <input type="text" name="date_from" class="form-control"
                    placeholder=".col-3">
            </div>
            <div class="col-4">
                <input type="text" name="date_to" class="form-control"
                    placeholder=".col-3">
            </div>
            <div class="col-5">
                <input type="text" name="" class="form-control"
                    placeholder=".col-5">
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>

@section('js')
<script>
    $(function() {


        $('input[name="birthday"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1901,
        maxYear: parseInt(moment().format('YYYY'),10)
        }, function(start, end, label) {
            var years = moment().diff(start, 'years');
            alert("You are " + years + " years old!");
        });
    });
</script>

@endsection
