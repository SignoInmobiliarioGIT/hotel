const moment = require("moment");

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
    scheduler.locale.labels.timeline_scale_header = headerHTML();
    addMultipleColumnLeftTimeline();

    scheduler.templates.event_class = function (start, end, event) {
        return "event_" + (event.status || "");
    };
    innerHtmlReservation();
    toolTip();
    highLightWeekend();

    scheduler.load("/scheduler", "json");
    scheduler.init('scheduler_here', moment(), "timeline");
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

function headerHTML() {
    return "<div class='timeline_item_separator'></div>" +
        "<div class='timeline_item_cell'>Hab.</div>" +
        "<div class='timeline_item_separator'></div>" +
        "<div class='timeline_item_cell'>Tipo</div>" +
        "<div class='timeline_item_separator'></div>" +
        "<div class='timeline_item_cell room_status'>Estado</div>";

}

function addMultipleColumnLeftTimeline() {
    scheduler.attachEvent("onTemplatesReady", function () {

        scheduler.templates.timeline_scale_label = function (key, label, section) {
            var roomStatus = getRoomStatus(section.status);
            return ["<div class='timeline_item_separator'></div>",
                "<div class='timeline_item_cell'>" + label + "</div>",
                "<div class='timeline_item_separator'></div>",
                "<div class='timeline_item_cell'>" + getRoomType(section.type) + "</div>",
                "<div class='timeline_item_separator'></div>",
                "<div class='timeline_item_cell room_status'>",
                "<span class='room_status_indicator room_status_indicator_" + section.status + "'></span>",
                "<span class='status-label'>" + roomStatus.label + "</span>",
                "</div>"
            ].join("");
        };

    });
}

var eventDateFormat = scheduler.date.date_to_str("%d %M %Y");

function innerHtmlReservation() {
    scheduler.templates.event_bar_text = function (start, end, event) {
        var paidStatus = getPaidStatus(event.is_paid);
        var startDate = eventDateFormat(event.start_date);
        var endDate = eventDateFormat(event.end_date);
        return [event.text + "<br />",
            startDate + " - " + endDate,
            "<div class='booking_status booking-option'>" + getBookingStatus(event.status) + "</div>",
            "<div class='booking_paid booking-option'>" + paidStatus + "</div>"
        ].join("");
    };
}

function findInArray(array, key) {
    for (var i = 0; i < array.length; i++) {
        if (key == array[i].key)
            return array[i];
    }
    return null;
}

function getRoomType(key) {
    return findInArray(scheduler.serverList("roomTypes"), key).label;
}

function getRoomStatus(key) {
    return findInArray(scheduler.serverList("roomStatuses"), key);
}

function getRoom(key) {
    return findInArray(scheduler.serverList("rooms"), key);
}

function getBookingStatus(key) {
    var bookingStatus = findInArray(scheduler.serverList("bookingStatuses"), key);
    return !bookingStatus ? '' : bookingStatus.label;
}

function getPaidStatus(isPaid) {
    return isPaid ? "paid" : "not paid";
}

function toolTip() {
    scheduler.templates.tooltip_text = function (start, end, event) {
        var room = getRoom(event.room) || {
            label: ""
        };

        var html = [];
        html.push("Booking: <b>" + event.text + "</b>");
        html.push("Room: <b>" + room.label + "</b>");
        html.push("Check-in: <b>" + eventDateFormat(start) + "</b>");
        html.push("Check-out: <b>" + eventDateFormat(end) + "</b>");
        html.push(getBookingStatus(event.status) + ", " + getPaidStatus(event.is_paid));
        return html.join("<br>")
    };
}

function highLightWeekend() {
    scheduler.addMarkedTimespan({
        days: [0, 6],
        zones: "fullday",
        css: "timeline_weekend"
    });
}
