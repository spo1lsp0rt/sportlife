/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!****************************************!*\
  !*** ./resources/js/number_handler.js ***!
  \****************************************/
var invalidChars = [".", "+", "e"];
var inputBox = document.querySelectorAll(".input_number");

for (var i = 0; i < inputBox.length; i++) {
  var input = inputBox[i];
  input.addEventListener("input", function () {
    validateInput(this);
  });
  input.addEventListener("keydown", function (e) {
    validateInput(this, e);
  });
  input.addEventListener("blur", function () {
    if (this.value.toString().length > 0) {
      if (this.value[0].toString() === ".") {
        this.value = "0" + this.value.toString();
      }
    }

    this.value = this.value.toString();
  });
}

function validateInput(elm, e) {
  // handle keydown event
  if (e) {
    if (invalidChars.includes(e.key)) {
      e.preventDefault();
    }

    if (e.key === "-") {
      if (elm.value[0].toString() !== "-") {
        elm.value = "-" + elm.value.toString();
      }

      e.preventDefault();
    }
  } // handle input event
  else {
    // do not allow leading zeros
    while (elm.value.length > 1 && elm.value[0] === "0" && elm.value[1] !== ".") {
      elm.value = elm.value.toString().slice(1);
    } // input should be between min and max


    if (elm.validity.rangeUnderflow) {
      elm.value = elm.min;
    } else if (elm.validity.rangeOverflow) {
      elm.value = elm.max;
    }
  }
}
/******/ })()
;