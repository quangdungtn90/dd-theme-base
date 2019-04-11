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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./wp-content/themes/dd-base/assets/js/app.js":
/*!*****************************************************!*\
  !*** ./wp-content/themes/dd-base/assets/js/app.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ./custom */ "./wp-content/themes/dd-base/assets/js/custom.js");

/***/ }),

/***/ "./wp-content/themes/dd-base/assets/js/custom.js":
/*!********************************************************!*\
  !*** ./wp-content/themes/dd-base/assets/js/custom.js ***!
  \********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * Custom js
 *
 * Package: 1.0
 * Auth: quangdung.tn90@gmail.com
 *
 **/
(function ($) {
  'use strict'; // Header Mobile

  if ($('#primary-menu').length) {
    var primary_menu = $('#primary-menu').clone();
    $('.site-header-mobile__nav').html('<ul class="site-header-mobile__primary-menu">' + primary_menu.html() + '</ul>');
  }

  (function () {
    var menu = $('.menu-item-has-children');
    var winWidth = $(window).width();
    menu.children().each(function () {
      if ($(this).hasClass('sub-menu')) {
        var outerWidth = $(this).outerWidth();
        var rightEdge = $(this).offset().left + outerWidth;

        if (rightEdge > winWidth) {
          // CSS:
          // .submenu--right { left: auto; right: 0; }
          $(this).addClass('right');
        }
      }
    });
  })(); //Mobile menu


  $('.site-header-mobile__primary-menu li.menu-item-has-children').append('<span class="toggle-submenu"> </span>');
  $('.toggle-submenu').on('click', function () {
    $(this).toggleClass('open', 300);
    $(this).parent().find('> .sub-menu').slideToggle(500);
  });
  $('.site-header-mobile__close-content i').on('click', function () {
    $(this).parent().parent().removeClass('show-content');
    $('.site-content-contain').removeClass('content-overlay');
  });
  $('.site-header-mobile__button-left').on('click', function () {
    $('.site-header-mobile__content-left').addClass('show-content');
    $('.site-content-contain').addClass('content-overlay');
  });
  $('#search-modal').on('shown.bs.modal', function () {
    $(this).find('.search-form input').focus();
  });
  $('.site-header-mobile__button-right').on('click', function () {
    $('.site-header-mobile__content-right').addClass('show-content');
    $('.site-content-contain').addClass('content-overlay');
  });
  $('.site-content-contain').on('click', function () {
    if ($(this).hasClass('content-overlay')) {
      $('.site-content-contain').removeClass('content-overlay');
      $('.site-header-mobile__content-left').removeClass('show-content');
      $('.site-header-mobile__content-right').removeClass('show-content');
    }
  });
  $(document).ready(function () {
    var e = $('.post .entry-content iframe');
    e.addClass('embed-responsive-item');
    e.parent().addClass('embed-responsive embed-responsive-16by9');
  });
})(jQuery);

/***/ }),

/***/ "./wp-content/themes/dd-base/assets/vendor/bootstrap/bootstrap.scss":
/*!***************************************************************************!*\
  !*** ./wp-content/themes/dd-base/assets/vendor/bootstrap/bootstrap.scss ***!
  \***************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./wp-content/themes/dd-base/style.scss":
/*!***********************************************!*\
  !*** ./wp-content/themes/dd-base/style.scss ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!***********************************************************************************************************************************************************************!*\
  !*** multi ./wp-content/themes/dd-base/assets/js/app.js ./wp-content/themes/dd-base/assets/vendor/bootstrap/bootstrap.scss ./wp-content/themes/dd-base/style.scss ***!
  \***********************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! D:\WAMP\www\wp-base\wp-content\themes\dd-base\assets\js\app.js */"./wp-content/themes/dd-base/assets/js/app.js");
__webpack_require__(/*! D:\WAMP\www\wp-base\wp-content\themes\dd-base\assets\vendor\bootstrap\bootstrap.scss */"./wp-content/themes/dd-base/assets/vendor/bootstrap/bootstrap.scss");
module.exports = __webpack_require__(/*! D:\WAMP\www\wp-base\wp-content\themes\dd-base\style.scss */"./wp-content/themes/dd-base/style.scss");


/***/ })

/******/ });
//# sourceMappingURL=global.js.map
