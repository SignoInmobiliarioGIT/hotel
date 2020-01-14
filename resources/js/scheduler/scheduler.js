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
