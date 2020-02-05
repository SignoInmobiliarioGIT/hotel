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

        scheduler.init('scheduler_here', Grid.setDay(), "timeline");

        scheduler.load("/scheduler", "json");

        scheduler.attachEvent("onBeforeViewChange", function (oldMode, oldDate, mode, date) {
            if (oldMode != mode || +oldDate != +date) {
                scheduler.clearAll();
            }
            return true;
        });

    }


    static setDay() {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        if (urlParams.has('date')) {
            const dateUrl = moment(urlParams.get('date'), 'DD-MM-YYYY');
            return dateUrl.subtract(7, "days")
        }
        return moment().subtract(7, "days")
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
            },
            {
                name: "comments",
                height: 30,
                type: "textarea",
                map_to: "comments"
            },
        ];

        scheduler.attachEvent("onBeforeLightbox", function (id) {
            var ev = scheduler.getEvent(id);
            return true;
        });

        scheduler.attachEvent("onDateChanged", function (value, date) {
            LightBox.setTotalToBillWhenChangesAreDetected();
        });

        scheduler.attachEvent("onLightbox", function (id) {
            var ev = scheduler.getEvent(id);


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
            LightBox.setAttributeDataName('comments');

            $('*[data-name="night_price"]').on("change keyup paste", function () {
                LightBox.setTotalToBillWhenChangesAreDetected();
            })

            if (typeof ev.reservation_id == 'undefined') {
                LightBox.setPriceNight(ev);
                LightBox.setTotalToBillWhenChangesAreDetected();
                $('.companions_btn_set').hide();
            }
            if (typeof ev.reservation_id != 'undefined') {
                $('.companions_btn_set').show();
            }
        });

        scheduler.templates.lightbox_header = function (start, end, ev) {
            if (typeof ev.reservation_id == 'undefined') {
                return "Nueva reserva"
            } else {
                return "Reserva: " + ev.reservation_id;
            }
        };

        scheduler.config.buttons_right = ["dhx_save_btn", "dhx_cancel_btn"];

        scheduler.config.buttons_left = ["companions_btn"];
        scheduler.locale.labels["companions_btn"] = "Acompañantes";

        scheduler.attachEvent("onLightboxButton", function (button_id, node, e) {

            if (button_id == "companions_btn") {
                var ev = scheduler.getState().lightbox_id;
                var reservation_id = scheduler.getEvent(ev).reservation_id;
                var room_id = scheduler.getEvent(ev).room_id;
                $('#companionsModal').modal('show');
                $('#companionsModal tbody').empty();
                axios.get('scheduler/get-companions', {
                    params: {
                        'reservation_id': reservation_id
                    }
                }).then(function (response) {
                    $('#storeCompanion').append('<input type="hidden" name="reservation_id" value="' + reservation_id + '" />');
                    $('#storeCompanion').append('<input type="hidden" name="room_id" value="' + room_id + '" />');

                    $.each(response.data, function (index, value) {
                        $('#companionsModal tbody').append('<tr><td>' + value.name + '</td><td>' + value.dni + '</td><td>' + value.age + '</td><td>' + value.relationship + '</td><td>' + Companion.setButtonDestroy(value.id) + '</tr>');
                    })
                    Companion.setOnClickDestroy();

                })
            }
        });
    }

    static setPriceNight(ev) {
        var rooms = scheduler.serverList("rooms");
        var room = rooms.find(o => o.room_id === ev.room_id);
        $('*[data-name="night_price"]')[0].value = room.price;
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
        scheduler.locale.labels.section_comments = 'Comentario';
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

class Category {}

class Customer {
    constructor() {
        console.log('customer class')
    }
}

class DateRangePicker {

    constructor(options) {
        this.tag = options.tag || '#dateRange';
        this.from = options.from || moment(new Date()).format("DD-MM-YYYY")
        this.to = options.to || moment(new Date()).add(1, "day").format("DD-MM-YYYY")
    }

    init() {
        $(this.tag).daterangepicker({
            locale: {
                format: 'DD-MM-YYYY',
                applyLabel: 'Aplicar',
                cancelLabel: 'Limpiar',
                fromLabel: 'Desde',
                toLabel: 'Hasta',
                customRangeLabel: 'Seleccionar rango',
                daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre',
                    'Diciembre'
                ],
                firstDay: 1
            },
            "startDate": this.from,
            "endDate": this.to
        }, function (start, end, label) {
            console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' +
                end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ') desde la clase');
        });
    }

    getFrom() {
        return $(this.tag).val().substring(0, 10);
    }
    getTo() {
        return $(this.tag).val().substring(13);
    }
}
