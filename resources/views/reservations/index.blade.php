@extends('adminlte::page')

@section('title', 'Reservas')

@section('content_header')
<h1>{{$title}}</h1>
@stop

@section('content')
{{-- @include('reservations/partials/filters') --}}
@include('reservations/partials/table')
@stop

@section('css')
@stop

@section('js')

@stop
