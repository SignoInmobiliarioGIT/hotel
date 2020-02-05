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
