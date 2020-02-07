@extends('adminlte::page')

@section('title', $title)

@section('content_header')
<h1>{{$title}}</h1>
@stop

@section('content')
@include('reservations/partials/table')
@stop

@section('css')
@stop

@section('js')
<script src="js/my-app.js"></script>
<script>
    $(function () {
        DataTable.init('#reservations');
    })
</script>
@stop
