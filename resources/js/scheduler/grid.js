import Helper from './helper';

export default class Grid {
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
}
