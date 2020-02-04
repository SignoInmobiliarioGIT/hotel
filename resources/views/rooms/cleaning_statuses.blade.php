@extends('adminlte::page')

@section('title', 'Estado de limpieza')

@section('content_header')
<h1>{{$title}}</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <table id="cleaningStatuses" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/scheduler.css">
@stop

@section('js')
<script src="/js/my-app.js"></script>
<script>
    $(document).ready(function() {
        $('#cleaningStatuses').DataTable();
    });
</script>
@stop
