class Companion {

    static init() {
        $('#storeCompanion').submit(function (e) {
            e.preventDefault();
            Companion.store(e);
            return false;
        })
    }
    static store(e) {
        $('#companionModal').modal('show');
        axios.post('/reservation-companion', {
                'name': $('[name=name]').val(),
                'dni': $('[name=document]').val(),
                'age': $('[name=age]').val(),
                'relationship': $('[name=relationship]').val(),
                'reservation_id': $('[name=reservation_id]').val(),
                'assigned_room_id': $('[name=room_id]').val()
            })
            .then(function (response) {
                var data = JSON.parse(response.config.data)
                $('#companionsModal tbody').append('<tr><td>' + data.name + '</td><td>' + data.dni + '</td><td>' + data.age + '</td><td>' + data.relationship + '</td><td>' + Companion.setButtonDestroy(response.data.last_id) + '</td></tr>');
                Companion.setOnClickDestroy();
            })
            .catch(function (error) {
                console.log(error);
            });
        return false;
    }
    static setButtonDestroy(companion_id) {
        return '<button data-companion_id="' + companion_id + '" type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>';
    }
    static setOnClickDestroy() {
        $('[data-companion_id]').on('click', function () {

            axios.delete('reservation-companion/' + $(this).attr('data-companion_id'))
                .then(function (response) {
                    console.log('destroy');
                });
            $(this).closest('tr').hide();
        })
    }
}
