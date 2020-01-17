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
            {
                map_to: 'adults',
                name: "Adultos",
                type: "select",
                options: scheduler.serverList("adults")
            },
            {
                map_to: "children",
                name: "Niños",
                type: "select",
                options: scheduler.serverList("children")
            },
            {
                map_to: "room_id",
                name: "Habitación",
                type: "select",
                options: scheduler.serverList("visibleRooms")
            },
            {
                map_to: "currency_id",
                name: "Moneda",
                type: "select",
                options: scheduler.serverList("currencies")
            },
            {
                map_to: "warranty_id",
                name: "Garantía",
                type: "select",
                options: scheduler.serverList("warranties")
            },
            {
                map_to: "payment_id",
                name: "Pago",
                type: "select",
                options: scheduler.serverList("payments")
            },
            {
                name: "Precio por noche",
                height: 30,
                type: "textarea",
                map_to: "nightPrice",
                default_value: LightBox.getNightPrice()
            },
            {
                name: "Total",
                height: 30,
                type: "textarea",
                map_to: "totalToBill",
                default_value: LightBox.getTotaltoBill()
            },
            {
                map_to: "status_id",
                name: "Estado",
                type: "radio",
                options: scheduler.serverList("reservationStatuses")
            },
            {
                map_to: "time",
                name: "Fechas",
                type: "calendar_time"
            }
        ];

        scheduler.attachEvent("onLightbox", function () {
            var section = scheduler.formSection('Total');
            section.control.disabled = true;
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
        return 444;
    }


}
