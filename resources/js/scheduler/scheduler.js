const moment = require("moment");

import LightBox from './lightbox';
import Grid from './grid';
import Event from './event';
import Helper from './helper';

window.onload = function () {
    Grid.init();

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

    scheduler.templates.event_class = function (start, end, event) {
        return "event_" + (event.status || "");
    };

    var dp = new dataProcessor("/scheduler");
    dp.init(scheduler);
    dp.setTransactionMode("REST", false);

    LightBox.init();
    Event.init();
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

//needs to be attached to the 'save' button
function save_form() {
    var ev = scheduler.getEvent(scheduler.getState().lightbox_id);
    scheduler.endLightbox(true, custom_form);
}
//needs to be attached to the 'cancel' button
function close_form(argument) {
    scheduler.endLightbox(false, custom_form);
}
