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
                map_to: "nightPrice",
                default_value: LightBox.getNightPrice()
            },
            {
                name: "total_to_bill",
                height: 30,
                type: "textarea",
                map_to: "totalToBill",
                default_value: LightBox.getTotaltoBill()
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
            $('*[data-name="night_price"]').on("change keyup paste", function () {
                LightBox.setTotalToBillWhenChangesAreDetected();
            })
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


        });

        scheduler.templates.lightbox_header = function (start, end, ev) {
            return "Reserva"
        };
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
    static getTotaltoBill() {
        var a = moment([2007, 0, 29]);
        var b = moment([2007, 0, 28]);
        a.diff(b, 'days')
        return 444;
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
