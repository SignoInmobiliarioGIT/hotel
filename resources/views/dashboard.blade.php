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
@stop
