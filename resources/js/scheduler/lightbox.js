export default class LightBox {

    static init() {
        LightBox.configuration();
    }

    static configuration() {
        scheduler.config.lightbox.sections = [{
                map_to: "text",
                name: "text",
                type: "textarea",
                height: 24
            },
            {
                map_to: "room",
                name: "room",
                type: "select",
                options: scheduler.serverList("visibleRooms")
            },
            {
                map_to: "status",
                name: "status",
                type: "radio",
                options: scheduler.serverList("bookingStatuses")
            },
            {
                map_to: "is_paid",
                name: "is_paid",
                type: "checkbox",
                checked_value: true,
                unchecked_value: false
            },
            {
                map_to: "time",
                name: "time",
                type: "calendar_time"
            }
        ];

        scheduler.locale.labels.section_text = 'Titular';
        scheduler.locale.labels.section_room = 'Habitación';
        scheduler.locale.labels.section_status = 'Estado';
        scheduler.locale.labels.section_is_paid = 'Pagado';
        scheduler.locale.labels.section_time = 'Fecha';

        scheduler.templates.lightbox_header = function (start, end, ev) {
            // var formatFunc = scheduler.date.date_to_str('%d.%m.%Y');
            // return formatFunc(start) + " - " + formatFunc(end);
            return "Reserva"
        };
    }
}
