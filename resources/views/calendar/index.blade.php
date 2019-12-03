@php

@endphp
<div class="row">
    <div class="col-md-6">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Seleccione una fecha</h3>
            </div>
            <div class="card-body">
                <input class="form-control form-control-sm" type="text"
                    name="birthday">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Seleccione un período</h3>
            </div>
            <div class="card-body">
                <div class="btn-group d-flex">
                    <a href="{{ route('dashboard', ['size' => 7, 'dd' => $dd, 'mm' => $mm, 'yyyy' => $yy]) }}"
                        type="button"
                        class="btn btn-info btn-sm {{ $size == 7 ? 'active' : '' }}">7
                        días</a>
                    <a href="{{ route('dashboard', ['size' => 15, 'dd' => $dd, 'mm' => $mm, 'yyyy' => $yy]) }}"
                        type="button"
                        class="btn btn-info btn-sm {{ $size == 15 ? 'active' : '' }}">15
                        días</a>
                    <a href="{{ route('dashboard', ['size' => 30, 'dd' => $dd, 'mm' => $mm, 'yyyy' => $yy]) }}"
                        type="button"
                        class="btn btn-info btn-sm {{ $size == 30 ? 'active' : '' }}">30
                        días</a>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="col-12" style="height: 800px">
    <div id="scheduler_here" class="dhx_cal_container"
        style='width:100%; height:100%;'>
        <div class="dhx_cal_navline">
            <div class="dhx_cal_date"></div>
        </div>
        <div class="dhx_cal_header">
            Hab
        </div>
        <div class="dhx_cal_data">
        </div>
        <div class="collection_label"
            style="position: absolute; top: 61px; width: 52px; height: 40px;text-align: center;line-height: 40px;">
            <div class="timeline_item_separator"></div>
            <div class="timeline_item_cell">Hab</div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    var dd = {{$dd}};
    var mm = {{$mm}};
    var yy = {{$yy}};
    var size = {{$size}};
    var reservations = @JSON($reservations);
    var rooms = @JSON($rooms);
    var date_pick= dd + '/' + mm + '/' + yy;
    var date_pick_scheduler = yy + '/' + mm + '/' + dd;
</script>
@endpush
