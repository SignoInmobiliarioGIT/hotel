<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Resultados</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover dataTable compact nowrap"
            id="reservations">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Desde</th>
                    <th>Hasta</th>
                    <th>Titular</th>
                    <th>Habitaciones</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                <tr>
                    <td scope="row">{{$reservation->id}}</td>
                    <td>{{$reservation->from_date}}</td>
                    <td>{{$reservation->to_date}}</td>
                    <td>{{$reservation->customer->name}}</td>
                    <td>
                        @foreach ($reservation->rooms as $room)
                        {{$room->name}}
                        @endforeach
                    </td>
                    <td>
                        <a href="http://"><i
                                class="fas fa-eye mx-2 text-success"></i></a><a
                            href="http://"><i
                                class="fas fa-edit mx-2 text-warning"></i></a><a
                            href="http://"><i
                                class="fas fa-trash-alt mx-2 text-danger"></i></a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
