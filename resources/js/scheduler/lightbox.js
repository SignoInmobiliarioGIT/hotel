export default class LightBox {

    static init() {
        LightBox.configuration();
        LightBox.customNewTitular();
    }


    static configuration() {
        scheduler.config.lightbox.sections = [{
                map_to: "text",
                name: "Seleccionar titular",
                type: "textarea",
                height: 24
            },
            {
                name: "Titular nuevo",
                height: 35,
                type: "newTitular"
            },
            {
                map_to: "room",
                name: "Habitación",
                type: "select",
                options: scheduler.serverList("visibleRooms")
            },
            {
                map_to: "status",
                name: "Estado",
                type: "radio",
                options: scheduler.serverList("bookingStatuses")
            },
            {
                map_to: "is_paid",
                name: "Pagado",
                type: "checkbox",
                checked_value: true,
                unchecked_value: false
            },
            {
                map_to: "time",
                name: "Fechas",
                type: "calendar_time"
            }
        ];

        scheduler.templates.lightbox_header = function (start, end, ev) {
            // var formatFunc = scheduler.date.date_to_str('%d.%m.%Y');
            // return formatFunc(start) + " - " + formatFunc(end);
            return "Reserva"
        };
    }
    static customNewTitular() {
        scheduler.form_blocks["newTitular"] = {
            render: function (config) { // config- section configuration object
                var height = (config.height || 50) + "px";
                return "<div class='dhx_cal_ltext' style='height:" + height + ";'>" +
                    "<textarea></textarea></div>";
            },
            set_value: function (node, value, ev, config) {
                // node - HTML object related to HTML defined above
                // value - value defined by map_to property
                // ev - event object
                // config - section configuration object
                node.querySelector("textarea").value = value || "";
            },
            get_value: function (node, ev, config) {
                // node - HTML object related to HTML defined above
                // event object
                // config - section configuration object
                return node.querySelector("textarea").value;
            },
            focus: function (node) {
                // node - HTML object related to HTML defined above
                node.querySelector("textarea").focus();
            }
        };
    }
}
