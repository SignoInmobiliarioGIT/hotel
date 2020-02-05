@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<div id="scheduler_here" class="dhx_cal_container"
    style='width:100%; height:800px;'>
    <div class="dhx_cal_navline">
        <div class="dhx_cal_prev_button">&nbsp;</div>
        <div class="dhx_cal_next_button">&nbsp;</div>
        <div class="dhx_cal_today_button"></div>
        <div class="dhx_cal_date"></div>
        <select id="room_filter" onchange='showRooms(this.value)'
            class="custom-select m-2" style="width:100px"></select>
    </div>
    <div class="dhx_cal_header">
    </div>
    <div class="dhx_cal_data">
    </div>
</div>
@include('scheduler.companions')
@stop

@section('css')
<link rel="stylesheet" href="/css/scheduler.css">
@stop

@section('js')
<script src="/js/my-app.js"></script>
<script>
    var dp;
    window.onload = function () {


    Companion.init();
    Grid.init();

    scheduler.attachEvent("onParse", function () {
    showRooms("all");

    var roomSelect = document.querySelector("#room_filter");
    var types = scheduler.serverList("roomTypes");
    var typeElements = ["<option value='all'>Todas</option>"];
    types.forEach(function (type) {
    typeElements.push("<option value='" + type.key + "'>" + type.label + "</option>");
    });
    roomSelect.innerHTML = typeElements.join("")

    });

    scheduler.templates.event_class = function (start, end, event) {
    return "event_" + (event.status || "");
    };

    LightBox.init();
    Event.init();

    dp = new dataProcessor("/scheduler");
    dp.init(scheduler);
    dp.setTransactionMode("REST", false);

    dp.attachEvent("onAfterUpdate", function (id, action, tid, response) {
    location.reload();
    })
    }

    window.showRooms = function showRooms(type) {
    var allRooms = scheduler.serverList("rooms");
    var visibleRooms;
    if (type == 'all') {
    visibleRooms = allRooms.slice();
    } else {
    visibleRooms = allRooms
    .filter(function (room) {
    return room.type == type;
    });
    }

    scheduler.updateCollection("visibleRooms", visibleRooms);
    }
</script>
@stop
