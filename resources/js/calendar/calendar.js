require('./dhtmlxscheduler');
require('./dhtmlxscheduler_timeline');
require('./dhtmlxscheduler_collision');



window.onload = function () {
    scheduler.config.dblclick_create = false;
    scheduler.config.details_on_create = false;
    scheduler.config.details_on_dblclick = false;

    scheduler.config.drag_resize = false;
    scheduler.config.drag_move = false;
    scheduler.config.drag_create = false;
    scheduler.attachEvent("onDblClick", function () {
        return false
    });

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

    scheduler.createTimelineView({
        fit_events: true,
        name: "timeline",
        y_property: "room",
        render: 'bar',
        x_unit: "day",
        x_date: "%d",
        x_size: (typeof syze === 'undefined') ? '15' : size,
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
    scheduler.config.lightbox.sections = [{
            name: "description",
            height: 130,
            map_to: "text",
            type: "textarea",
            focus: true
        },
        {
            name: "custom",
            height: 23,
            type: "select",
            options: scheduler.serverList("rooms"),
            map_to: "room"
        },
        {
            name: "time",
            height: 72,
            type: "time",
            map_to: "auto"
        }
    ];

    // scheduler.attachEvent('onEventCreated', function (event_id) {
    // var ev = scheduler.getEvent(event_id);
    // ev.status = 1;
    // ev.is_paid = false;
    // ev.text = 'new booking';
    // });

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
}
