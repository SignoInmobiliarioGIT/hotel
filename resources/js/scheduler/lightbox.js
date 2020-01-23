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
                axios.get('get-companions', {
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
