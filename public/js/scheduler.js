class Event {
    static init() {
        Event.innerHtmlReservation();
        Event.toolTip();
    }
    static innerHtmlReservation() {

        scheduler.templates.event_bar_text = function (start, end, event) {
            return "<div class='event_reservation_id'>" +
                event.reservation_id + "</div>" +
                "<div class='event_customer_name'>" +
                event.customer_name + "</div>";
        };
    }
    static toolTip() {
        var eventDateFormat = scheduler.date.date_to_str("%d %m %Y");

        scheduler.templates.tooltip_text = function (start, end, event) {
            var room = Helper.getRoom(event.room) || {
                label: ""
            };

            var html = [];
            html.push("Reserva: <b>" + event.text + "</b>");
            html.push("Habitación: <b>" + room.label + "</b>");
            html.push("Check-in: <b>" + eventDateFormat(start) + "</b>");
            html.push("Check-out: <b>" + eventDateFormat(end) + "</b>");
            html.push(Helper.getBookingStatus(event.status));
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
            y_property: "room_id",
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
        LightBox.setLabels();
    }

    static configuration() {
        scheduler.config.lightbox.sections = [{
                map_to: "customer_id",
                name: "customer_id",
                type: "select",
                options: scheduler.serverList("customers")
            },
            {
                map_to: "time",
                name: "time",
                type: "calendar_time"
            },
            {
                map_to: 'adults',
                name: "adults",
                type: "select",
                options: scheduler.serverList("adults")
            },
            {
                map_to: "children",
                name: "children",
                type: "select",
                options: scheduler.serverList("children")
            },
            {
                map_to: "room_id",
                name: "room_id",
                type: "select",
                options: scheduler.serverList("visibleRooms")
            },
            {
                map_to: "currency_id",
                name: "currency_id",
                type: "select",
                options: scheduler.serverList("currencies")
            },
            {
                map_to: "warranty_id",
                name: "warranty_id",
                type: "select",
                options: scheduler.serverList("warranties")
            },
            {
                map_to: "payment_id",
                name: "payment_id",
                type: "select",
                options: scheduler.serverList("payments")
            },
            {
                name: "night_price",
                height: 30,
                type: "textarea",
                map_to: "night_price",
            },
            {
                name: "total_to_bill",
                height: 30,
                type: "textarea",
                map_to: "total_to_bill"
            },
            {
                map_to: "status_id",
                name: "status_id",
                type: "radio",
                options: scheduler.serverList("reservationStatuses")
            }
        ];

        scheduler.attachEvent("onBeforeLightbox", function (id) {
            var ev = scheduler.getEvent(id);
            return true;
        });

        scheduler.attachEvent("onDateChanged", function (value, date) {
            LightBox.setTotalToBillWhenChangesAreDetected();
        });

        scheduler.attachEvent("onLightbox", function () {

            var time = scheduler.formSection("time");

            var inputs = time.node.getElementsByTagName("input");
            time.node.getElementsByTagName("select")[0].style.display = "none";
            time.node.getElementsByTagName("select")[1].style.display = "none";

            var section = scheduler.formSection('total_to_bill');
            section.control.disabled = true;

            LightBox.setAttributeDataName('customer_id');
            LightBox.setAttributeDataName('room_id');
            LightBox.setAttributeDataName('adults');
            LightBox.setAttributeDataName('children');
            LightBox.setAttributeDataName('currency_id');
            LightBox.setAttributeDataName('warranty_id');
            LightBox.setAttributeDataName('payment_id');
            LightBox.setAttributeDataName('night_price');
            LightBox.setAttributeDataName('total_to_bill');

            $('*[data-name="night_price"]').on("change keyup paste", function () {
                LightBox.setTotalToBillWhenChangesAreDetected();
            })
        });

        scheduler.templates.lightbox_header = function (start, end, ev) {
            return "Reserva"
        };

        scheduler.config.buttons_left = ["dhx_save_btn", "dhx_cancel_btn"];
        scheduler.config.buttons_right = [];
    }

    static getNightPrice() {
        scheduler.attachEvent("onBeforeLightbox", function (id) {
            var rooms = scheduler.serverList('rooms');
            var ev = scheduler.getEvent(id);
            if (typeof ev.reservation_id === 'undefined') {
                ev.nightPrice = rooms.find(room => room.room_id === 7).price;
            } else {
                ev.nightPrice = ev.night_price;
            }
            return true;
        });
    }


    /**
     *
     * @param {string} section Section Name. Value of map_to of scheduler.config.lightbox.sections
     * @param {string} value Value of the data-name attribute
     */
    static setAttributeDataName(section) {
        return scheduler.formSection(section).node.firstChild.setAttribute('data-name', section)
    }


    static setLabels() {
        scheduler.locale.labels.section_customer_id = 'Titular';
        scheduler.locale.labels.section_time = 'Fechas';
        scheduler.locale.labels.section_adults = 'Adultos';
        scheduler.locale.labels.section_children = 'Niños';
        scheduler.locale.labels.section_room_id = 'Habitaciones';
        scheduler.locale.labels.section_currency_id = 'Moneda';
        scheduler.locale.labels.section_warranty_id = 'Garantía';
        scheduler.locale.labels.section_payment_id = 'Pago';
        scheduler.locale.labels.section_night_price = 'Precio x noche';
        scheduler.locale.labels.section_total_to_bill = 'Total';
        scheduler.locale.labels.section_status_id = 'Estado';
    }

    static setTotalToBillWhenChangesAreDetected() {
        var nightPriceSection = scheduler.formSection("night_price");
        var nightPrice = nightPriceSection.node.getElementsByTagName('textarea')[0].value;

        var start_date = moment([$('.dhx_readonly')[0].value], 'DD-MM-YYYY');
        var end_date = moment([$('.dhx_readonly')[1].value], 'DD-MM-YYYY');
        var days = end_date.diff(start_date, 'days') + 1;

        $('*[data-name="total_to_bill"]')[0].value = days * nightPrice;
    }
}

var dp;
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

    dp = new dataProcessor("/scheduler");
    dp.init(scheduler);
    dp.setTransactionMode("REST", false);
    dp.attachEvent("onAfterUpdate", function (id, action, tid, response) {
        location.reload();
    })
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

//needs to be attached to the 'save' button
function save_form() {
    var ev = scheduler.getEvent(scheduler.getState().lightbox_id);
    scheduler.endLightbox(true, custom_form);
}
//needs to be attached to the 'cancel' button
function close_form(argument) {
    scheduler.endLightbox(false, custom_form);
}
