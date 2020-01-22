class Companion {

    static init() {
        // var form = document.getElementById('storeCompanion');
        // if (form.attachEvent) {
        //     form.attachEvent("submit", Companion.store);
        // } else {
        //     form.addEventListener("submit", Companion.store);
        // }
        $('#storeCompanion').submit(function (e) {
            e.preventDefault();
            Companion.store(e);
            return false;
        })
    }
    static store(e) {
        $('#companionModal').modal('show');
        console.log(e);
        axios.post('/reservation-companion', {
                'name': $('[name=name]').val(),
                'dni': $('[name=document]').val(),
                'age': $('[name=age]').val(),
                'relationship': $('[name=relationship]').val(),
                'reservation_id': $('[name=reservation_id]').val(),
                'assigned_room_id': $('[name=room_id]').val()
            })
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });
        return false;
    }
}
