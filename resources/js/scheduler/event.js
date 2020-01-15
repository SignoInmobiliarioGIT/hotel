class Event {
    static init() {
        Event.innerHtmlReservation();
        Event.toolTip();
    }
    static innerHtmlReservation() {

        scheduler.templates.event_bar_text = function (start, end, event) {
            return "<div class='event_reservation_id'>" +
                event.reservation_id + "</div>" +
                "<div class='event_customer_name'>" +
                event.customer_name + "</div>";
        };
    }
    static toolTip() {
        var eventDateFormat = scheduler.date.date_to_str("%d %m %Y");

        scheduler.templates.tooltip_text = function (start, end, event) {
            var room = Helper.getRoom(event.room) || {
                label: ""
            };

            var html = [];
            html.push("Booking: <b>" + event.text + "</b>");
            html.push("Room: <b>" + room.label + "</b>");
            html.push("Check-in: <b>" + eventDateFormat(start) + "</b>");
            html.push("Check-out: <b>" + eventDateFormat(end) + "</b>");
            html.push(Helper.getBookingStatus(event.status) + ", " + Helper.getPaidStatus(event.is_paid));
            return html.join("<br>")
        };
    }
}
