class LightBox {

    static init() {
        LightBox.configuration();
        LightBox.controlTitular();
    }

    static configuration() {
        scheduler.config.lightbox.sections = [
            // {
            //         map_to: "customer",
            //         name: "Seleccionar titular",
            //         type: "select",
            //         options: scheduler.serverList("customers")
            //     },
            {
                map_to: 'customer_id',
                name: "Titular",
                type: "controlTitular"
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
                return "<div class='dhx_cal_ltext' style='height:50px;'><input type='text' name='name' class='form-control form-control-sm'  placeholder='Nombre y apellido' style='width:33%; float:left'><input type='text' name='document' class='form-control form-control-sm' placeholder='Documento' style='width:33%;float:left'> <input type='text' name='phone' class='form-control form-control-sm' placeholder='Teléfono' style='width:33%; float:left><hr></div>";
            },
            set_value: function (node, value, ev, config) {
                node.querySelector("[name='name']").value = value || "";
                node.querySelector("[name='document']").value = ev.document || "";
                node.querySelector("[name='phone']").value = ev.phone || "";
            },
            get_value: function (node, ev, config) {
                ev.document = node.querySelector("[name='document']").value;
                ev.phone = node.querySelector("[name='phone']").value;
                return node.querySelector("[name='name']").value;
            }
        };
    }

    static controlTitular() {
        scheduler.form_blocks["controlTitular"] = {
            render: function (config) { // config- section configuration object
                var html = '';
                html += "<div class='dhx_cal_ltext' style='height:35px;'>";
                html += '<input type="hidden" name="customer_id" value="55">';
                html += "<div class='row'> <div class='col'><input type='text' class='form-control form-control-sm' disabled></div>";
                html += "<div class='col'><button type='button' class='btn btn-primary btn-sm'  data-toggle='modal' data-target='#exampleModal'>Seleccionar titular</button></div>";

                html += "</div>"
                return html;
            },
            set_value: function (node, value, ev, config) {
                // node.querySelector("[name='customer_id']").value = value || "";
            },
            get_value: function (node, ev, config) {
                return node.querySelector("[name='customer_id']").value;
            }
        };
    }
}
