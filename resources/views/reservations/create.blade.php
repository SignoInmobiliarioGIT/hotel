@extends('adminlte::page')

@section('title', 'Reserva - Crear')

@section('content_header')
<h1>{{$title}}</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form>
            <div class="form-row">
                <div class="col">
                    <label for="dateRange">Fecha</label>
                    <input type="text" class="form-control form-control-sm"
                        placeholder="Fecha" id="dateRange" name="dateRange">
                </div>
                <div class="col">
                    <label for="numberOfRooms">Cantidad de habitaciones</label>
                    <input type="text" class="form-control form-control-sm"
                        placeholder="Habitaciones..." id="numberOfRooms"
                        name="number_of_rooms">
                </div>
                <div class="col">
                    <label for="roomCategory">Categoría</label>
                    <select class="custom-select custom-select-sm"
                        id="roomCategory" name="room_category_id" disabled>
                        <option selected>Seleccione...</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>
            <div class="form-row mt-3">
                <div class="col">
                    <label for="customer">Titular</label>
                    <input type="text" class="form-control form-control-sm"
                        placeholder="Buscar titular..." id="search_customer">
                </div>
                <div class="col">
                    <button type="button"
                        class="btn btn-success btn-sm btn-block"
                        style="margin-top: 31px;">Buscar titular</button>
                </div>
                <div class="col">
                    <button type="button"
                        class="btn btn-primary btn-sm btn-block"
                        style="margin-top: 31px;">Crear
                        titular</button>
                </div>

            </div>
            <div class="form-row mt-3">
                <div class="col">
                    <label for="adults">Adultos</label>
                    <input type="text" class="form-control form-control-sm"
                        placeholder="Adultos..." name="adults" id="adults">
                </div>
                <div class="col">
                    <label for="underAge">Menores</label>
                    <input type="text" class="form-control form-control-sm"
                        placeholder="Menores..." name="under_age" id="underAge">
                </div>
                <div class="col">
                    <label for="totalToBill">Total a pagar</label>
                    <input type="text" class="form-control form-control-sm"
                        placeholder="Total a pagar..." name="total_to_bill"
                        id="totalToBill">
                </div>

                <div class="col">
                    <label for="warrantyOptions">Método de pago</label>
                    <select class="custom-select custom-select-sm"
                        id="warrantyOptions" name="warranty_option_id">
                        <option selected>Método de pago...</option>
                        @foreach ($warranty_options as $item)
                        <option value="{{$item->id}}">{{$item->description}}
                        </option>
                        @endforeach>
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
<script src="/js/my-app.js">
</script>
<script>
    window.onload = function () {
        let dates = new DateRangePicker({tag:'#dateRange'});
        dates.init();
    }
</script>
@stop
