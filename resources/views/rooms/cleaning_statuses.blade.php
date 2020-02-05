@extends('adminlte::page')

@section('title', $title)

@section('content_header')
<h1>{{$title}}</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <table id="cleaningStatuses" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Habitación</th>
                    <th>Estado de servicio</th>
                    <th>Estado de limpieza</th>
                    <th>Cambiar estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room)
                <tr>
                    <td>{{$room->name}}</td>
                    <td>{{$room->stateOfService->description}}</td>
                    <td>{{$room->cleaningStatus->description}}</td>
                    <td>
                        <select class="custom-select">
                            <option selected>Cambiar estado</option>
                            @foreach ($cleaning_status as $state)
                            <option value="{{$state->id}}">
                                {{$state->description}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Habitación</th>
                    <th>Estado de servicio</th>
                    <th>Estado de limpieza</th>
                    <th>Cambiar estado</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')
<script src="/js/my-app.js">
</script>
<script>
    $(document).ready(function() {
$('#cleaningStatuses').DataTable();
});
</script>
@stop
