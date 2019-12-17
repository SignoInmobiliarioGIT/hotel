import MyLightBox from './my-light-box';

window.onload = function () {

    scheduler.templates.event_bar_text = function (start, end, ev) {
        return 'Reserva N° ' + ev.id + '<br>' + ev.customer;
    };

    scheduler.config.dblclick_create = true;
    scheduler.config.details_on_create = false;
    scheduler.config.details_on_dblclick = false;

    scheduler.config.drag_resize = true;
    scheduler.config.drag_move = true;
    scheduler.config.drag_create = true;

    window.showRooms = function showRooms(type) {
        var allRooms = scheduler.serverList("rooms");
        var visibleRooms;
        if (type == 'all') {
            visibleRooms = allRooms.slice();
        } else {
            visibleRooms = allRooms
                .filter(function (room) {
                    return room.type == type;
                });
        }

        scheduler.updateCollection("visibleRooms", visibleRooms);
    };

    //===============
    //Configuration
    //===============

    scheduler.serverList("roomTypes");
    scheduler.serverList("roomStatuses");
    scheduler.serverList("bookingStatuses");
    scheduler.serverList("rooms");
    scheduler.serverList("reservations");

    scheduler.createTimelineView({
        fit_events: true,
        name: "timeline",
        y_property: "room_id",
        render: 'bar',
        x_unit: "day",
        x_date: "%d",
        x_size: (typeof size === 'undefined') ? '15' : size,
        dy: 52,
        dx: 52,
        event_dy: 48,
        section_autoheight: false,
        round_position: true,

        y_unit: scheduler.serverList("visibleRooms"),
        second_scale: {
            x_unit: "month",
            x_date: "%F %Y"
        }
    });


    //===============
    //Data loading
    //===============
    scheduler.locale.labels.section_template = '';

    scheduler.config.lightbox.sections = [{
        name: "template",
        height: 200,
        type: "template",
        map_to: "my_template"
    }, ];







    scheduler.attachEvent("onParse", function () {
        showRooms("all");

        var roomSelect = document.querySelector("#room_filter");
        var types = scheduler.serverList("roomTypes");
        var typeElements = ["<option value='all'>All</option>"];
        types.forEach(function (type) {
            typeElements.push("<option value='" + type.key + "'>" + type.label + "</option>");
        });

        if (roomSelect != null)
            roomSelect.innerHTML = typeElements.join("")
    });

    scheduler.attachEvent("onEventCollision", function (ev, evs) {
        for (var i = 0; i < evs.length; i++) {
            if (ev.room != evs[i].room) continue;
            dhtmlx.message({
                type: "error",
                text: "This room is already booked for this date."
            });
        }
        return true;
    });

    scheduler.init('scheduler_here',
        (typeof date_pick_scheduler === 'undefined') ? '' : date_pick_scheduler, "timeline");

    scheduler.parse(JSON.stringify({
        "data": reservations,
        "collections": {
            "rooms": rooms
        }
    }), "json");

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('input[name="birthday"]').val(date_pick);

    $('input[name="birthday"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1901,
        maxYear: parseInt(moment().format('YYYY'), 10),
        locale: {
            format: 'DD/MM/YYYY'
        }
    }, function (start, end, label) {
        window.location.replace('?size=' + size + "&dd=" + start.format('DD') + "&mm=" + start.format('MM') + "&yyyy=" + start.format('YYYY'));
    });





    scheduler.attachEvent("onBeforeLightbox", function (id, e) {
        var ev = scheduler.getEvent(id);
        scheduler.config.buttons_left = ["cancel"];
        scheduler.locale.labels["cancel"] = "Cancelar";
        scheduler.resetLightbox();

        scheduler.attachEvent("onLightboxButton", function (button_id, node, e) {
            if (button_id == "cancel") {
                scheduler.endLightbox(false);
            }

            if (button_id == "more_info") {
                window.location.replace("/reservations");
            }
        });

        if (typeof ev.customer === 'undefined') {

            scheduler.templates.lightbox_header = function (start, end, ev) {
                return 'Nueva Reserva';
            };

            scheduler.config.buttons_right = ["save"];
            scheduler.locale.labels["save"] = "Grabar";

            let roomData;

            $.each(rooms, function (index, room) {
                if (room.value == ev.room_id) {
                    roomData = {
                        "name": room.label,
                        "category": room.category
                    }
                }
            })
            MyLightBox.templateNew(ev, roomData)

        } else {
            scheduler.config.buttons_right = ["more_info"];
            scheduler.locale.labels["more_info"] = "+ INFO";

            scheduler.templates.lightbox_header = function (start, end, ev) {
                return 'Reserva N° ' + ev.id;
            };


            MyLightBox.templateEdit(ev);
        }

        return true;
    });
}
