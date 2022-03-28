/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/combobox.js ***!
  \**********************************/
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

var Keys = {
  Backspace: 'Backspace',
  Clear: 'Clear',
  Down: 'ArrowDown',
  End: 'End',
  Enter: 'Enter',
  Escape: 'Escape',
  Home: 'Home',
  Left: 'ArrowLeft',
  PageDown: 'PageDown',
  PageUp: 'PageUp',
  Right: 'ArrowRight',
  Space: ' ',
  Tab: 'Tab',
  Up: 'ArrowUp'
};
var MenuActions = {
  Close: 0,
  CloseSelect: 1,
  First: 2,
  Last: 3,
  Next: 4,
  Open: 5,
  Previous: 6,
  Select: 7,
  Space: 8,
  Type: 9
}; // filter an array of options against an input string
// returns an array of options that begin with the filter string, case-independent

function filterOptions() {
  var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : [];
  var filter = arguments.length > 1 ? arguments[1] : undefined;
  var exclude = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : [];
  return options.filter(function (option) {
    var matches = option.toLowerCase().indexOf(filter.toLowerCase()) === 0;
    return matches && exclude.indexOf(option) < 0;
  });
} // return an array of exact option name matches from a comma-separated string


function findMatches(options, search) {
  var names = search.split(',');
  return names.map(function (name) {
    var match = options.filter(function (option) {
      return name.trim().toLowerCase() === option.toLowerCase();
    });
    return match.length > 0 ? match[0] : null;
  }).filter(function (option) {
    return option !== null;
  });
} // return combobox action from key press


function getActionFromKey(event, menuOpen) {
  var key = event.key,
      altKey = event.altKey,
      ctrlKey = event.ctrlKey,
      metaKey = event.metaKey; // handle opening when closed

  if (!menuOpen && (key === Keys.Down || key === Keys.Enter || key === Keys.Space)) {
    return MenuActions.Open;
  } // handle keys when open


  if (key === Keys.Down) {
    return MenuActions.Next;
  } else if (key === Keys.Up) {
    return MenuActions.Previous;
  } else if (key === Keys.Home) {
    return MenuActions.First;
  } else if (key === Keys.End) {
    return MenuActions.Last;
  } else if (key === Keys.Escape) {
    return MenuActions.Close;
  } else if (key === Keys.Enter) {
    return MenuActions.CloseSelect;
  } else if (key === Keys.Space) {
    return MenuActions.Space;
  } else if (key === Keys.Backspace || key === Keys.Clear || key.length === 1 && !altKey && !ctrlKey && !metaKey) {
    return MenuActions.Type;
  }
} // get index of option that matches a string


function getIndexByLetter(options, filter) {
  var firstMatch = filterOptions(options, filter)[0];
  return firstMatch ? options.indexOf(firstMatch) : -1;
} // get updated option index


function getUpdatedIndex(current, max, action) {
  switch (action) {
    case MenuActions.First:
      return 0;

    case MenuActions.Last:
      return max;

    case MenuActions.Previous:
      return Math.max(0, current - 1);

    case MenuActions.Next:
      return Math.min(max, current + 1);

    default:
      return current;
  }
} // check if an element is currently scrollable


function isScrollable(element) {
  return element && element.clientHeight < element.scrollHeight;
} // ensure given child element is within the parent's visible scroll area


function maintainScrollVisibility(activeElement, scrollParent) {
  var offsetHeight = activeElement.offsetHeight,
      offsetTop = activeElement.offsetTop;
  var parentOffsetHeight = scrollParent.offsetHeight,
      scrollTop = scrollParent.scrollTop;
  var isAbove = offsetTop < scrollTop;
  var isBelow = offsetTop + offsetHeight > scrollTop + parentOffsetHeight;

  if (isAbove) {
    scrollParent.scrollTo(0, offsetTop);
  } else if (isBelow) {
    scrollParent.scrollTo(0, offsetTop - parentOffsetHeight + offsetHeight);
  }
}
/*
   * Editable Combobox code
   */


var Combobox = function Combobox(el, options) {
  // element refs
  this.el = el;
  this.inputEl = el.querySelector('input');
  this.listboxEl = el.querySelector('[role=listbox]'); // data

  this.idBase = this.inputEl.id;
  this.options = options; // state

  this.activeIndex = 0;
  this.open = false;
};

Combobox.prototype.init = function () {
  var _this = this;

  this.inputEl.value = options[0];
  this.inputEl.addEventListener('input', this.onInput.bind(this));
  this.inputEl.addEventListener('blur', this.onInputBlur.bind(this));
  this.inputEl.addEventListener('click', function () {
    return _this.updateMenuState(true);
  });
  this.inputEl.addEventListener('keydown', this.onInputKeyDown.bind(this));
  this.options.map(function (option, index) {
    var optionEl = document.createElement('div');
    optionEl.setAttribute('role', 'option');
    optionEl.id = "".concat(_this.idBase, "-").concat(index);
    optionEl.className = index === 0 ? 'combo-option option-current' : 'combo-option';
    optionEl.setAttribute('aria-selected', "".concat(index === 0));
    optionEl.innerText = option;
    optionEl.addEventListener('click', function () {
      _this.onOptionClick(index);
    });
    optionEl.addEventListener('mousedown', _this.onOptionMouseDown.bind(_this));

    _this.listboxEl.appendChild(optionEl);
  });
};

Combobox.prototype.onInput = function () {
  var _this2 = this;

  var curValue = this.inputEl.value;
  var matches = filterOptions(this.options, curValue); // set activeIndex to first matching option
  // (or leave it alone, if the active option is already in the matching set)

  var filterCurrentOption = matches.filter(function (option) {
    return option === _this2.options[_this2.activeIndex];
  });

  if (matches.length > 0 && !filterCurrentOption.length) {
    this.onOptionChange(this.options.indexOf(matches[0]));
  }

  var menuState = this.options.length > 0;

  if (this.open !== menuState) {
    this.updateMenuState(menuState, false);
  }
};

Combobox.prototype.onInputKeyDown = function (event) {
  var max = this.options.length - 1;
  var action = getActionFromKey(event, this.open);

  switch (action) {
    case MenuActions.Next:
    case MenuActions.Last:
    case MenuActions.First:
    case MenuActions.Previous:
      event.preventDefault();
      return this.onOptionChange(getUpdatedIndex(this.activeIndex, max, action));

    case MenuActions.CloseSelect:
      event.preventDefault();
      this.selectOption(this.activeIndex);
      return this.updateMenuState(false);

    case MenuActions.Close:
      event.preventDefault();
      return this.updateMenuState(false);

    case MenuActions.Open:
      return this.updateMenuState(true);
  }
};

Combobox.prototype.onInputBlur = function () {
  if (this.ignoreBlur) {
    this.ignoreBlur = false;
    return;
  }

  if (this.open) {
    this.selectOption(this.activeIndex);
    this.updateMenuState(false, false);
  }
};

Combobox.prototype.onOptionChange = function (index) {
  this.activeIndex = index;
  this.inputEl.setAttribute('aria-activedescendant', "".concat(this.idBase, "-").concat(index)); // update active style

  var options = this.el.querySelectorAll('[role=option]');

  _toConsumableArray(options).forEach(function (optionEl) {
    optionEl.classList.remove('option-current');
  });

  options[index].classList.add('option-current');

  if (this.open && isScrollable(this.listboxEl)) {
    maintainScrollVisibility(options[index], this.listboxEl);
  }
};

Combobox.prototype.onOptionClick = function (index) {
  this.onOptionChange(index);
  this.selectOption(index);
  this.updateMenuState(false);
};

Combobox.prototype.onOptionMouseDown = function () {
  this.ignoreBlur = true;
};

Combobox.prototype.selectOption = function (index) {
  var selected = this.options[index];
  this.inputEl.value = selected;
  this.activeIndex = index; // update aria-selected

  var options = this.el.querySelectorAll('[role=option]');

  _toConsumableArray(options).forEach(function (optionEl) {
    optionEl.setAttribute('aria-selected', 'false');
  });

  options[index].setAttribute('aria-selected', 'true');
};

Combobox.prototype.updateMenuState = function (open) {
  var callFocus = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
  this.open = open;
  this.inputEl.setAttribute('aria-expanded', "".concat(open));
  open ? this.el.classList.add('open') : this.el.classList.remove('open');
  callFocus && this.inputEl.focus();
}; // init combo


var comboEl = document.querySelector('.js-combobox');
var options = arr_groups;
var comboComponent = new Combobox(comboEl, options);
comboComponent.init();
/******/ })()
;