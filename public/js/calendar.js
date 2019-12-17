/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/calendar/calendar.js":
/*!*******************************************!*\
  !*** ./resources/js/calendar/calendar.js ***!
  \*******************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _my_light_box__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./my-light-box */ "./resources/js/calendar/my-light-box.js");


window.onload = function () {
  scheduler.templates.event_bar_text = function (start, end, ev) {
    return 'Reserva N° ' + ev.id + '<br>' + ev.customer;
  };

  scheduler.attachEvent("onEventCollision", function (ev, evs) {
    //any custom logic here
    alert('No grabar');
    return true;
  }); // scheduler.attachEvent("onBeforeEventChanged", function (id, mode, e) {
  //     // var event_obj = dragged_event;
  //     alert('Grabar');
  // });

  scheduler.config.dblclick_create = true;
  scheduler.config.details_on_create = false;
  scheduler.config.details_on_dblclick = false;
  scheduler.config.drag_resize = true;
  scheduler.config.drag_move = true;
  scheduler.config.drag_create = true;

  window.showRooms = function showRooms(type) {
    var allRooms = scheduler.serverList("rooms");
    var visibleRooms;

    if (type == 'all') {
      visibleRooms = allRooms.slice();
    } else {
      visibleRooms = allRooms.filter(function (room) {
        return room.type == type;
      });
    }

    scheduler.updateCollection("visibleRooms", visibleRooms);
  }; //===============
  //Configuration
  //===============


  scheduler.serverList("roomTypes");
  scheduler.serverList("roomStatuses");
  scheduler.serverList("bookingStatuses");
  scheduler.serverList("rooms");
  scheduler.serverList("reservations");
  scheduler.createTimelineView({
    fit_events: true,
    name: "timeline",
    y_property: "room_id",
    render: 'bar',
    x_unit: "day",
    x_date: "%d",
    x_size: typeof size === 'undefined' ? '15' : size,
    dy: 52,
    dx: 52,
    event_dy: 48,
    section_autoheight: false,
    round_position: true,
    y_unit: scheduler.serverList("visibleRooms"),
    second_scale: {
      x_unit: "month",
      x_date: "%F %Y"
    }
  }); //===============
  //Data loading
  //===============

  scheduler.locale.labels.section_template = '';
  scheduler.config.lightbox.sections = [{
    name: "template",
    height: 200,
    type: "template",
    map_to: "my_template"
  }];
  scheduler.attachEvent("onParse", function () {
    showRooms("all");
    var roomSelect = document.querySelector("#room_filter");
    var types = scheduler.serverList("roomTypes");
    var typeElements = ["<option value='all'>All</option>"];
    types.forEach(function (type) {
      typeElements.push("<option value='" + type.key + "'>" + type.label + "</option>");
    });
    if (roomSelect != null) roomSelect.innerHTML = typeElements.join("");
  });
  scheduler.attachEvent("onEventCollision", function (ev, evs) {
    for (var i = 0; i < evs.length; i++) {
      if (ev.room != evs[i].room) continue;
      dhtmlx.message({
        type: "error",
        text: "This room is already booked for this date."
      });
    }

    return true;
  });
  scheduler.init('scheduler_here', typeof date_pick_scheduler === 'undefined' ? '' : date_pick_scheduler, "timeline");
  scheduler.parse(JSON.stringify({
    "data": reservations,
    "collections": {
      "rooms": rooms
    }
  }), "json");
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $('input[name="birthday"]').val(date_pick);
  $('input[name="birthday"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 1901,
    maxYear: parseInt(moment().format('YYYY'), 10),
    locale: {
      format: 'DD/MM/YYYY'
    }
  }, function (start, end, label) {
    window.location.replace('?size=' + size + "&dd=" + start.format('DD') + "&mm=" + start.format('MM') + "&yyyy=" + start.format('YYYY'));
  });
  scheduler.attachEvent("onBeforeLightbox", function (id, e) {
    var ev = scheduler.getEvent(id);
    scheduler.config.buttons_left = ["cancel"];
    scheduler.locale.labels["cancel"] = "Cancelar";
    scheduler.resetLightbox();
    scheduler.attachEvent("onLightboxButton", function (button_id, node, e) {
      if (button_id == "cancel") {
        scheduler.endLightbox(false);
      }

      if (button_id == "more_info") {
        window.location.replace("/reservations");
      }
    });

    if (typeof ev.customer === 'undefined') {
      _my_light_box__WEBPACK_IMPORTED_MODULE_0__["default"].templateNew(ev);
    } else {
      _my_light_box__WEBPACK_IMPORTED_MODULE_0__["default"].templateEdit(ev);
    }

    return true;
  });
};

/***/ }),

/***/ "./resources/js/calendar/my-light-box.js":
/*!***********************************************!*\
  !*** ./resources/js/calendar/my-light-box.js ***!
  \***********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var MyLightBox =
/*#__PURE__*/
function () {
  function MyLightBox() {
    _classCallCheck(this, MyLightBox);
  }

  _createClass(MyLightBox, [{
    key: "templateNew",
    value: function templateNew(ev, roomData) {
      scheduler.templates.lightbox_header = function (start, end, ev) {
        return 'Nueva Reserva';
      }; // let roomData;


      $.each(rooms, function (index, room) {
        if (room.value == ev.room_id) {
          roomData = {
            "name": room.label,
            "category": room.category
          };
        }
      });
      scheduler.config.buttons_right = ["save"];
      scheduler.locale.labels["save"] = "Grabar";
      ev.my_template = '<dl class="row">';
      ev.my_template += '<dt class="col-sm-3">Desde</dt>' + '<dd class="col-sm-3">' + moment(ev.start_date).format('DD/MM/YYYY') + '</dd>';
      ev.my_template += '<dt class="col-sm-3">Hasta</dt>' + '<dd class="col-sm-3">' + moment(ev.start_date).format('DD/MM/YYYY') + '</dd>';
      ev.my_template += '<dt class="col-sm-3">Categoría de la habitación</dt>' + '<dd class="col-sm-3">' + roomData.category + '</dd>';
      ev.my_template += '<dt class="col-sm-3">Habitación</dt>' + '<dd class="col-sm-3">' + roomData.name + '</dd>';
      ev.my_template += '</dl>';
    }
  }, {
    key: "templateEdit",
    value: function templateEdit(ev) {
      scheduler.config.buttons_right = ["more_info"];
      scheduler.locale.labels["more_info"] = "+ INFO";

      scheduler.templates.lightbox_header = function (start, end, ev) {
        return 'Reserva N° ' + ev.id;
      };

      ev.my_template = '<dl class="row">';
      ev.my_template += '<dt class="col-sm-3">Desde</dt>' + '<dd class="col-sm-3">' + moment(ev.start_date).format('DD/MM/YYYY') + '</dd>';
      ev.my_template += '<dt class="col-sm-3">Hasta</dt>' + '<dd class="col-sm-3">' + moment(ev.end_date).format('DD/MM/YYYY') + '</dd>';
      ev.my_template += '<dt class="col-sm-3">Categoría de la habitación</dt>' + '<dd class="col-sm-3">' + ev.room_category + '</dd>';
      ev.my_template += '<dt class="col-sm-3">Habitación</dt>' + '<dd class="col-sm-3">' + ev.room + '</dd>';
      ev.my_template += '</dl>';
      ev.my_template += '<hr>';
      ev.my_template += '<dl class="row">';
      ev.my_template += '<dt class="col-sm-3">Titular</dt>' + '<dd class="col-sm-3">' + ev.customer + '</dd>';
      ev.my_template += '<dt class="col-sm-3">Status</dt>' + '<dd class="col-sm-3">' + ev.status + '</dd>';
      ev.my_template += '<dt class="col-sm-3">Pago</dt>' + '<dd class="col-sm-3">' + ev.payment + '</dd>';
      ev.my_template += '<dt class="col-sm-3">Moneda</dt>' + '<dd class="col-sm-3">' + ev.currency + '</dd>';
      ev.my_template += '<dt class="col-sm-3">Garantía</dt>' + '<dd class="col-sm-3">' + ev.warranty + '</dd>';
      ev.my_template += '</dl>';
    }
  }]);

  return MyLightBox;
}();

;
/* harmony default export */ __webpack_exports__["default"] = (new MyLightBox());

/***/ }),

/***/ 1:
/*!*************************************************!*\
  !*** multi ./resources/js/calendar/calendar.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\laravel-projects\hotel6\resources\js\calendar\calendar.js */"./resources/js/calendar/calendar.js");


/***/ })

/******/ });