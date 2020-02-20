<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Resultados</h3>
    </div>
    <div class="card-body">
        <table class="table dataTable compact nowrap mb-3" id="outservices">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Desde</th>
                    <th>Hasta</th>
                    <th>Habitación</th>
                    <th>Descripción</th>
                    <th>Creado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($outservices as $outservice)
                    <tr>
                        <td scope="row">{{ $outservice->id }}</td>
                        <td>{{ $outservice->from_date->format('d-m-Y') }}</td>
                        <td>{{ $outservice->to_date->format('d-m-Y') }}</td>
                        <td>{{ $outservice->room->name }}</td>
                        <td>{{ $outservice->description }}</td>
                        <td>{{ $outservice->created_at->format('d-m-Y') }}</td>
                        <td>
                            <a href="{{ route('outservice.edit', $outservice->id) }}"><i class="fas fa-edit mx-2 text-warning"></i></a>
                            <a href="{{ route('outservice.destroy', $outservice->id) }}" class="btn-link-delete"><i class="fas fa-trash-alt mx-2 text-danger"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
