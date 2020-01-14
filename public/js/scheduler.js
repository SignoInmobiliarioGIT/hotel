class Event {
    static init() {
        Event.innerHtmlReservation();
        Event.toolTip();
    }
    static innerHtmlReservation() {
        var eventDateFormat = scheduler.date.date_to_str("%d %m %Y");

        scheduler.templates.event_bar_text = function (start, end, event) {
            var paidStatus = Helper.getPaidStatus(event.is_paid);
            var startDate = eventDateFormat(event.start_date);
            var endDate = eventDateFormat(event.end_date);
            return [event.text + "<br />",
                startDate + " - " + endDate,
                "<div class='booking_status booking-option'>" + Helper.getBookingStatus(event.status) + "</div>",
                "<div class='booking_paid booking-option'>" + paidStatus + "</div>"
            ].join("");
        };
    }
    static toolTip() {
        var eventDateFormat = scheduler.date.date_to_str("%d %m %Y");

        scheduler.templates.tooltip_text = function (start, end, event) {
            var room = Helper.getRoom(event.room) || {
                label: ""
            };

            var html = [];
            html.push("Booking: <b>" + event.text + "</b>");
            html.push("Room: <b>" + room.label + "</b>");
            html.push("Check-in: <b>" + eventDateFormat(start) + "</b>");
            html.push("Check-out: <b>" + eventDateFormat(end) + "</b>");
            html.push(Helper.getBookingStatus(event.status) + ", " + Helper.getPaidStatus(event.is_paid));
            return html.join("<br>")
        };
    }
}

class Grid {
    static init() {
        Grid.addMultipleColumnLeftTimeline();
        Grid.configuration();
        scheduler.locale.labels.timeline_scale_header = Grid.headerHTML();
        Grid.highLightWeekend();
    }

    static headerHTML() {
        return "<div class='timeline_item_separator'></div>" +
            "<div class='timeline_item_cell'>Hab.</div>" +
            "<div class='timeline_item_separator'></div>" +
            "<div class='timeline_item_cell'>Tipo</div>" +
            "<div class='timeline_item_separator'></div>" +
            "<div class='timeline_item_cell room_status'>Estado</div>";

    }

    static addMultipleColumnLeftTimeline() {
        scheduler.attachEvent("onTemplatesReady", function () {

            scheduler.templates.timeline_scale_label = function (key, label, section) {
                var roomStatus = Helper.getRoomStatus(section.status);
                return ["<div class='timeline_item_separator'></div>",
                    "<div class='timeline_item_cell'>" + label + "</div>",
                    "<div class='timeline_item_separator'></div>",
                    "<div class='timeline_item_cell'>" + Helper.getRoomType(section.type) + "</div>",
                    "<div class='timeline_item_separator'></div>",
                    "<div class='timeline_item_cell room_status'>",
                    "<span class='room_status_indicator room_status_indicator_" + section.status + "'></span>",
                    "<span class='status-label'>" + roomStatus.label + "</span>",
                    "</div>"
                ].join("");
            };

        });
    }
    static highLightWeekend() {
        scheduler.addMarkedTimespan({
            days: [0, 6],
            zones: "fullday",
            css: "timeline_weekend"
        });
    }

    static configuration() {
        scheduler.locale.labels.timeline_tab = "Timeline";
        scheduler.locale.labels.section_custom = "Section";

        scheduler.createTimelineView({
            name: "timeline",
            x_unit: "day",
            x_date: "%j",
            x_step: 1,
            x_size: 31,
            section_autoheight: false,
            y_unit: scheduler.serverList("visibleRooms"),
            y_property: "room",
            render: "bar",
            round_position: true,
            dy: 60,
            event_dy: "full",
            second_scale: {
                x_unit: "month",
                x_date: "%F, %Y"
            }
        });

        scheduler.config.date_format = "%d-%m-%Y";
        scheduler.setLoadMode("day");

        scheduler.init('scheduler_here', moment().subtract(7, "days"), "timeline");

        scheduler.load("/scheduler", "json");

        // var dp = new dataProcessor("/scheduler");
        // dp.init(scheduler);
        // dp.setTransactionMode("REST", false);
    }
}

class Helper {
    static getRoomType(key) {
        return Helper.findInArray(scheduler.serverList("roomTypes"), key).label;
    }

    static getRoomStatus(key) {
        return Helper.findInArray(scheduler.serverList("roomStatuses"), key);
    }

    static getRoom(key) {
        return Helper.findInArray(scheduler.serverList("rooms"), key);
    }

    static getBookingStatus(key) {
        var bookingStatus = Helper.findInArray(scheduler.serverList("bookingStatuses"), key);
        return !bookingStatus ? '' : bookingStatus.label;
    }

    static getPaidStatus(isPaid) {
        return isPaid ? "paid" : "not paid";
    }

    static findInArray(array, key) {
        for (var i = 0; i < array.length; i++) {
            if (key == array[i].key)
                return array[i];
        }
        return null;
    }
}

class LightBox {

    static init() {
        LightBox.configuration();
    }

    static configuration() {
        scheduler.config.lightbox.sections = [{
                map_to: "customer_id",
                name: "Titular",
                type: "select",
                options: scheduler.serverList("customers")
            },
            // {
            //     map_to: 'adults',
            //     name: "Adultos",
            //     type: "select",
            //     options: scheduler.serverList("adults")
            // },
            // {
            //     map_to: "children",
            //     name: "Niños",
            //     type: "select",
            //     options: scheduler.serverList("children")
            // },
            // {
            //     map_to: "room_id",
            //     name: "Habitación",
            //     type: "select",
            //     options: scheduler.serverList("visibleRooms")
            // },
            // {
            //     map_to: "currency_id",
            //     name: "Moneda",
            //     type: "select",
            //     options: scheduler.serverList("currencies")
            // },
            // {
            //     map_to: "warranty_id",
            //     name: "Garantía",
            //     type: "select",
            //     options: scheduler.serverList("warranty")
            // },
            // {
            //     map_to: "status",
            //     name: "Estado",
            //     type: "radio",
            //     options: scheduler.serverList("bookingStatuses")
            // },
            // {
            //     map_to: "is_paid",
            //     name: "Pagado",
            //     type: "checkbox",
            //     checked_value: true,
            //     unchecked_value: false
            // },
            {
                map_to: "time",
                name: "Fechas",
                type: "calendar_time"
            }
        ];

        scheduler.templates.lightbox_header = function (start, end, ev) {
            return "Reserva"
        };
    }
}

window.onload = function () {
    Grid.init();

    scheduler.attachEvent("onParse", function () {
        showRooms("all");

        var roomSelect = document.querySelector("#room_filter");
        var types = scheduler.serverList("roomTypes");
        var typeElements = ["<option value='all'>All</option>"];
        types.forEach(function (type) {
            typeElements.push("<option value='" + type.key + "'>" + type.label + "</option>");
        });
        roomSelect.innerHTML = typeElements.join("")

    });

    scheduler.templates.event_class = function (start, end, event) {
        return "event_" + (event.status || "");
    };



    LightBox.init();
    Event.init();
}



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
}
