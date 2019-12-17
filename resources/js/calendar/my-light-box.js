    export function templateNew(ev, roomData) {

        ev.my_template = '<dl class="row">';
        ev.my_template += '<dt class="col-sm-3">Desde</dt>' +
            '<dd class="col-sm-3">' + moment(ev.start_date).format('DD/MM/YYYY') + '</dd>';
        ev.my_template += '<dt class="col-sm-3">Hasta</dt>' +
            '<dd class="col-sm-3">' + moment(ev.start_date).format('DD/MM/YYYY') +
            '</dd>';
        ev.my_template += '<dt class="col-sm-3">Categoría de la habitación</dt>' +
            '<dd class="col-sm-3">' + roomData.category + '</dd>';
        ev.my_template += '<dt class="col-sm-3">Habitación</dt>' +
            '<dd class="col-sm-3">' + roomData.name + '</dd>';
        ev.my_template += '</dl>';
    }

    export function templateEdit(ev) {

        ev.my_template = '<dl class="row">';
        ev.my_template += '<dt class="col-sm-3">Desde</dt>' +
            '<dd class="col-sm-3">' + moment(ev.start_date).format('DD/MM/YYYY') + '</dd>';
        ev.my_template += '<dt class="col-sm-3">Hasta</dt>' +
            '<dd class="col-sm-3">' + moment(ev.end_date).format('DD/MM/YYYY') + '</dd>';
        ev.my_template += '<dt class="col-sm-3">Categoría de la habitación</dt>' +
            '<dd class="col-sm-3">' + ev.room_category + '</dd>';
        ev.my_template += '<dt class="col-sm-3">Habitación</dt>' +
            '<dd class="col-sm-3">' + ev.room + '</dd>';
        ev.my_template += '</dl>';
        ev.my_template += '<hr>';

        ev.my_template += '<dl class="row">';
        ev.my_template += '<dt class="col-sm-3">Titular</dt>' +
            '<dd class="col-sm-3">' + ev.customer + '</dd>';

        ev.my_template += '<dt class="col-sm-3">Status</dt>' +
            '<dd class="col-sm-3">' + ev.status + '</dd>';

        ev.my_template += '<dt class="col-sm-3">Pago</dt>' +
            '<dd class="col-sm-3">' + ev.payment + '</dd>';
        ev.my_template += '<dt class="col-sm-3">Moneda</dt>' +
            '<dd class="col-sm-3">' + ev.currency + '</dd>';
        ev.my_template += '<dt class="col-sm-3">Garantía</dt>' +
            '<dd class="col-sm-3">' + ev.warranty + '</dd>';

        ev.my_template += '</dl>';
    }
