@extends('adminlte::page')

@section('title', 'Habitaciones fuera de Servicio')

@section('content_header')
	<div class="row">
		<div class="col">
			<h1 class="float-left">Habitaciones Fuera de Servicio</h1>
		</div>
		<div class="col">
			<a href="{{ route('outservice.create') }}" class="btn btn-primary float-right"><i class="fas fa-plus mx-2"></i>Agregar</a>
		</div>
	</div>
@stop

@section('content')
	@include('outservice/partials/filters')
	@include('outservice/partials/table')
	@include('outservice/partials/modals')
@stop

@section('css')
	<style>
		.dt-buttons {
			margin-bottom: 20px;
		}
	</style>
@stop

@section('js')
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
	
	<script src="js/my-app.js"></script>
	<script>
	    $(function () {
			
			DataTableWithExport.init('#outservices');
			
	        var dateRangePicker = new DateRangePicker({tag: '.my-daterangepicker'});
	        dateRangePicker.init();

			$('.btn-link-delete').on('click', function(event) {
				event.preventDefault();

				var $link = $(this),
					$modalConfirmation = $('#modalConfirmation');
				
				$modalConfirmation.find('form').attr('action', $link.attr('href'));
				$('#modalConfirmation').modal('show');
			});
	    })
	</script>
@stop
