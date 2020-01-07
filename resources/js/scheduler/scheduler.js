const moment = require("moment");

import LightBox from './lightbox';
import Grid from './grid';
import Event from './event';
import Helper from './helper';

window.onload = function () {
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
        y_property: "room",
        render: "bar",
        round_position: true,
        dy: 60,
        event_dy: "full",
        second_scale: {
            x_unit: "month",
            x_date: "%F, %Y"
        }
    });

    scheduler.attachEvent("onParse", function () {
        showRooms("all");

        var roomSelect = document.querySelector("#room_filter");
        var types = scheduler.serverList("roomTypes");
        var typeElements = ["<option value='all'>All</option>"];
        types.forEach(function (type) {
            typeElements.push("<option value='" + type.key + "'>" + type.label + "</option>");
        });
        roomSelect.innerHTML = typeElements.join("")

    });
    scheduler.locale.labels.timeline_scale_header = Grid.headerHTML();
    Grid.addMultipleColumnLeftTimeline();
    Grid.highLightWeekend();

    scheduler.templates.event_class = function (start, end, event) {
        return "event_" + (event.status || "");
    };
    Event.innerHtmlReservation();
    Event.toolTip();

    scheduler.config.date_format = "%d-%m-%Y";
    scheduler.setLoadMode("day");

    scheduler.init('scheduler_here', moment(), "timeline");

    scheduler.load("/scheduler", "json");
    var dp = new dataProcessor("/scheduler");
    dp.init(scheduler);
    dp.setTransactionMode("REST", false);

    LightBox.configuration();
}

window.showRooms = function showRooms(type) {
    var allRooms = scheduler.serverList("rooms");
    var visibleRooms;
    if (type == 'all') {
        visibleRooms = allRooms.slice();
    } else {
        visibleRooms = allRooms
            .filter(function (room) {
                return room.type == type;
            });
    }

    scheduler.updateCollection("visibleRooms", visibleRooms);
}
