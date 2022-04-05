/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************!*\
  !*** ./resources/js/timer.js ***!
  \*******************************/
function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

var FULL_DASH_ARRAY = 283;
var TIME_LIMIT;
var WARNING_THRESHOLD;
var ALERT_THRESHOLD;
var COLOR_CODES = {
  info: {
    color: "green",
    threshold: TIME_LIMIT
  },
  warning: {
    color: "orange",
    threshold: WARNING_THRESHOLD
  },
  alert: {
    color: "red",
    threshold: ALERT_THRESHOLD
  }
};
var timePassed;
var timeLeft;
var timerInterval = null;
var remainingPathColor = COLOR_CODES.info.color;
var timers = document.getElementsByClassName("timer");

var _iterator = _createForOfIteratorHelper(timers),
    _step;

try {
  for (_iterator.s(); !(_step = _iterator.n()).done;) {
    var timer = _step.value;
    timer.innerHTML = "\n<div class=\"base-timer\">\n  <svg class=\"base-timer__svg\" viewBox=\"0 0 100 100\" xmlns=\"http://www.w3.org/2000/svg\">\n    <g class=\"base-timer__circle\">\n      <circle class=\"base-timer__path-elapsed\" cx=\"50\" cy=\"50\" r=\"45\"></circle>\n      <path\n        id=\"base-timer-path-remaining".concat(timer.id.slice(5), "\"\n        stroke-dasharray=\"283\"\n        class=\"base-timer__path-remaining ").concat(remainingPathColor, "\"\n        d=\"\n          M 50, 50\n          m -45, 0\n          a 45,45 0 1,0 90,0\n          a 45,45 0 1,0 -90,0\n        \"\n      ></path>\n    </g>\n  </svg>\n  <span id=\"base-timer-label").concat(timer.id.slice(5), "\" class=\"base-timer__label\">").concat(formatTime(timer.parentElement.id), "</span>\n</div>\n");
  }
} catch (err) {
  _iterator.e(err);
} finally {
  _iterator.f();
}

function onTimesUp() {
  clearInterval(timerInterval);
}

var _iterator2 = _createForOfIteratorHelper(timers),
    _step2;

try {
  for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
    var _timer = _step2.value;

    var btnID = "timer_btn" + _timer.id.slice(5);

    var btn = document.getElementById(btnID);
    btn.addEventListener("click", function () {
      startTimer();
    });
  }
} catch (err) {
  _iterator2.e(err);
} finally {
  _iterator2.f();
}

function startTimer() {
  var fullID = document.activeElement.id.slice(9);
  onTimesUp();
  timePassed = 0;
  TIME_LIMIT = document.activeElement.parentElement.id;
  WARNING_THRESHOLD = TIME_LIMIT / 2;
  ALERT_THRESHOLD = TIME_LIMIT / 4;
  COLOR_CODES = {
    info: {
      color: "green",
      threshold: TIME_LIMIT
    },
    warning: {
      color: "orange",
      threshold: WARNING_THRESHOLD
    },
    alert: {
      color: "red",
      threshold: ALERT_THRESHOLD
    }
  };
  timeLeft = TIME_LIMIT;
  timerInterval = null;
  timerInterval = setInterval(function () {
    timePassed += 1;
    timeLeft = TIME_LIMIT - timePassed;
    document.getElementById("base-timer-label" + fullID).innerHTML = formatTime(timeLeft);
    setCircleDasharray(fullID);
    setRemainingPathColor(timeLeft, fullID);

    if (timeLeft === 0) {
      onTimesUp();
    }
  }, 1000);
}

function formatTime(time) {
  var minutes = Math.floor(time / 60);
  var seconds = time % 60;

  if (seconds < 10) {
    seconds = "0".concat(seconds);
  }

  return "".concat(minutes, ":").concat(seconds);
}

function setRemainingPathColor(timeLeft, id) {
  var _COLOR_CODES = COLOR_CODES,
      alert = _COLOR_CODES.alert,
      warning = _COLOR_CODES.warning,
      info = _COLOR_CODES.info;

  if (timeLeft <= alert.threshold) {
    document.getElementById("base-timer-path-remaining" + id).classList.remove(warning.color);
    document.getElementById("base-timer-path-remaining" + id).classList.add(alert.color);
  } else if (timeLeft <= warning.threshold) {
    document.getElementById("base-timer-path-remaining" + id).classList.remove(info.color);
    document.getElementById("base-timer-path-remaining" + id).classList.add(warning.color);
  } else if (timeLeft <= info.threshold) {
    document.getElementById("base-timer-path-remaining" + id).classList.remove(alert.color);
    document.getElementById("base-timer-path-remaining" + id).classList.remove(warning.color);
    document.getElementById("base-timer-path-remaining" + id).classList.add(info.color);
  }
}

function calculateTimeFraction() {
  var rawTimeFraction = timeLeft / TIME_LIMIT;
  return rawTimeFraction - 1 / TIME_LIMIT * (1 - rawTimeFraction);
}

function setCircleDasharray(id) {
  var circleDasharray = "".concat((calculateTimeFraction() * FULL_DASH_ARRAY).toFixed(0), " 283");
  document.getElementById("base-timer-path-remaining" + id).setAttribute("stroke-dasharray", circleDasharray);
}
/******/ })()
;