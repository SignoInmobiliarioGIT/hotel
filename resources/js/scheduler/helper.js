export default class Helper {
    static getRoomType(key) {
        return Helper.findInArray(scheduler.serverList("roomTypes"), key).label;
    }

    static getRoomStatus(key) {
        return Helper.findInArray(scheduler.serverList("roomStatuses"), key);
    }

    static getRoom(key) {
        return Helper.findInArray(scheduler.serverList("rooms"), key);
    }

    static getBookingStatus(key) {
        var bookingStatus = Helper.findInArray(scheduler.serverList("bookingStatuses"), key);
        return !bookingStatus ? '' : bookingStatus.label;
    }

    static getPaidStatus(isPaid) {
        return isPaid ? "paid" : "not paid";
    }

    static findInArray(array, key) {
        for (var i = 0; i < array.length; i++) {
            if (key == array[i].key)
                return array[i];
        }
        return null;
    }
}
