@extends('adminlte::page')

@section('title', 'Reserva - Crear')

@section('content_header')
<h1>{{$title}}</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form>
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control form-control-sm"
                        placeholder="Fecha" id="dateRange">
                </div>
                <div class="col">
                    <select class="custom-select custom-select-sm">
                        <option selected>Categoría</option>

                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="col">
                    <input type="text" class="form-control form-control-sm"
                        placeholder="Titular">
                </div>
                <div class="col">
                    <button type="button"
                        class="btn btn-primary btn-sm btn-block">Crear
                        titular</button>
                </div>

            </div>
            <div class="row mt-4">
                <div class="col">
                    <select class="custom-select custom-select-sm">
                        <option selected>Personas</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="col">
                    <select class="custom-select custom-select-sm">
                        <option selected>Habitaciones</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="col">
                    <input type="text" class="form-control form-control-sm"
                        placeholder="Tarifa">
                </div>
                <div class="col">
                    <select class="custom-select custom-select-sm">
                        <option selected>Métod de pago</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="col">
                    <select class="custom-select custom-select-sm">
                        <option selected>Categoría de Cliente</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label for="observations">Observaciones</label>
                    <textarea class="form-control form-control-sm" rows="3"
                        id="observations"></textarea>
                </div>

            </div>
        </form>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
<script src="/js/scheduler.js">
</script>
<script>
    window.onload = function () {
DateRangePicker.init();
}
</script>
@stop
