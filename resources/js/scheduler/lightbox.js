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
                options: scheduler.serverList("warranty")
            },
            {
                map_to: "status",
                name: "Estado",
                type: "radio",
                options: scheduler.serverList("bookingStatuses")
            },
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
