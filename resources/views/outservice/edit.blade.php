@extends('adminlte::page')

@section('title', 'Habitación Fuera de Servicio - Editar')

@section('content_header')
    <h1>{{ $title }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('outservice.update', $outservice->id) }}" method="POST">
                
                {{ method_field('PUT') }}
                {{ csrf_field() }}

                <div class="form-row mb-4">
                    <div class="col-xs-12 col-sm-6 col-lg-4">
                        <label for="dateRange">Fecha</label>
                    <input type="text" name="dateRange" class="form-control form-control-sm" id="dateRange" value="{{ (old('dateRange')) ? old('dateRange') : $dateRangeFormat }}" placeholder="Fecha" required="required" tabindex="1">
                    </div>
                    <div class="col-xs-12 sm-6 col-lg-3">
                        <button type="button" class="btn btn-success btn-sm btn-block" id="btn-filter-rooms-available" style="margin-top: 31px;">Filtrar Habitaciones</button>
                    </div>
                </div>
                <div class="form-row my-3">
                    <div class="col">
                        <label for="room">Habitación</label>
                        <select name="room" class="custom-select custom-select-sm" id="room" required="required" tabindex="2">
                        </select>
                    </div>
                    <div class="col">
                        <label for="description">Descripción</label>
                        <textarea name="description" class="form-control form-control-sm" rows="3" id="description" required="required" tabindex="3">{{ (old('description')) ? old('description') : $outservice->description }}</textarea>
                    </div>
                </div>
                <div class="form-row mt-5">
                    <div class="col">
                        <button type="submit" class="btn btn-primary float-right">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
    <script src="/js/my-app.js"></script>
    <script>
        window.onload = function () {
            let dates = new DateRangePicker({tag:'#dateRange'});
            dates.init();
            new Customer()
        }
    </script>
    <script>
        $(function () {

            var roomIdSelected = '{{ $outservice->room_id }}';

            setTimeout(() => {
                getDateRangeOutservice();                
            }, 500)

            $('#btn-filter-rooms-available').on('click', function(event) {                
                getDateRangeOutservice();                
            });

            function getDateRangeOutservice()
            {
                var dateRange = $('#dateRange').val();

                if(dateRange)
                {
                    var  arrDateRange = dateRange.split(' - ');

                    //VALIDATE DATE
                    if(arrDateRange.length == 2) {

                        if(roomIdSelected !== null) {
                            var url = "/api/get-rooms-available/" + arrDateRange[0] + '/' + arrDateRange[1] + '/' + roomIdSelected;
                        } else {
                            var url = "/api/get-rooms-available/" + arrDateRange[0] + '/' + arrDateRange[1];
                        }

                        $.get(url, function (data, textStatus, jqXHR) {
                            loadAvailableRooms(data);
                        });
                    }
                }
            }

            function loadAvailableRooms(rooms)
            {
                var options = '<option value="">Selecciona una habitación</option>';

                $.each(rooms, function (key, room) { 
                    if(room.id == roomIdSelected) {
                        options += '<option value="' + room.id + '" selected>' + room.name + '</option>';
                        roomIdSelected = null;
                    } else {
                        options += '<option value="' + room.id + '">' + room.name + '</option>';
                    }
                });

                $('select[name="room"]').html(options);
            }
        });
    </script>
@stop
