class Event {
    static init() {
        Event.innerHtmlReservation();
        Event.toolTip();
    }
    static innerHtmlReservation() {
        var eventDateFormat = scheduler.date.date_to_str("%d %m %Y");

        scheduler.templates.event_bar_text = function (start, end, event) {
            var paidStatus = Helper.getPaidStatus(event.is_paid);
            var startDate = eventDateFormat(event.start_date);
            var endDate = eventDateFormat(event.end_date);
            return [event.text + "<br />",
                startDate + " - " + endDate,
                "<div class='booking_status booking-option'>" + Helper.getBookingStatus(event.status) + "</div>",
                "<div class='booking_paid booking-option'>" + paidStatus + "</div>"
            ].join("");
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
