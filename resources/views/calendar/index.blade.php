@section('css')
<link rel="stylesheet" type="text/css"
    href="./css/dhtmlxscheduler/dhtmlxscheduler.css">
@endsection
@php
$size = isset($_GET['size']) ? $_GET['size'] : 15;
$dd = isset($_GET['dd']) ? $_GET['dd'] : $now->day;
$mm = isset($_GET['mm']) ? $_GET['mm'] : $now->month;
$yy = isset($_GET['yyyy']) ? $_GET['yyyy'] : $now->year;
@endphp

<div class="row text-center">
    <div class="col-md-5 offset-md-1">
        <input type="text" name="birthday" />
    </div>
    <div class="col-md-6">
        <ul class="nav nav-pills" role="tablist">
            <li role="presentation" class="{{ $size == 7 ? 'active' : '' }}"><a
                    href="{{ route('dashboard', ['size' => 7, 'dd' => $dd, 'mm' => $mm, 'yyyy' => $yy]) }}">7
                    dias</a></li>
            <li role="presentation" class="{{ $size == 15 ? 'active' : '' }}">
                <a
                    href="{{ route('dashboard', ['size' => 15, 'dd' => $dd, 'mm' => $mm, 'yyyy' => $yy]) }}">15
                    dias</a></li>
            <li role="presentation" class="{{ $size == 30 ? 'active' : '' }}">
                <a
                    href="{{ route('dashboard', ['size' => 30, 'dd' => $dd, 'mm' => $mm, 'yyyy' => $yy]) }}">30
                    dias</a></li>
        </ul>
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
@section('scripts')
<script type="text/javascript" src="./js/dhtmlxscheduler/dhtmlxscheduler.js">
</script>
<script type="text/javascript"
    src="./js/dhtmlxscheduler/dhtmlxscheduler_timeline.js">
</script>
<script type="text/javascript"
    src="./js/dhtmlxscheduler/dhtmlxscheduler_collision.js"></script>
<script type="text/javascript" src="./js/calendar/calendar.js"></script>
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
@endsection
