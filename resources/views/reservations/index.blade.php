@extends('adminlte::page')

@section('title', 'Reservas')

@section('content_header')
<h1>Reservas</h1>
@stop

@section('content')
@include('reservations/partials/filters')
@stop

@section('css')
@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop
