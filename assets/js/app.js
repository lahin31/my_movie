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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(1);
module.exports = __webpack_require__(2);


/***/ }),
/* 1 */
/***/ (function(module, exports) {

var lhMovieApp = {
	addLoader: function addLoader() {
		var mov = {
			loader: jQuery('<div />', {
				class: 'lh_loader'
			})
		};
		jQuery('body').append(mov.loader);
	},
	removeLoader: function removeLoader() {
		jQuery('body').find(".lh_loader").remove();
	},
	fetchMovie: function fetchMovie(movieId) {
		var _this = this;

		this.addLoader();
		jQuery.get(lh_menu_vars.get_movie_url, {
			movie_id: movieId
		}).then(function (response) {
			var movieModalHolder = jQuery('<div />', {
				class: 'movie-modal-holder',
				html: response
			});

			jQuery('body').hide().append(movieModalHolder).fadeIn(100);
		}).fail(function (error) {
			alert("Something is wrong when loading the content please try again!");
		}).always(function () {
			_this.removeLoader();
		});
	},
	removeModal: function removeModal() {
		var _this2 = this;

		jQuery('.movie-modal-holder').fadeOut('200', function () {
			jQuery(_this2).remove();
			jQuery('html, body').removeClass('lh_has_modal');
			jQuery(document).off('keyup.lh_esc_key');
		});
	},
	initModalClick: function initModalClick() {
		var _this3 = this;

		jQuery('.movie_item_modal').on('click', function (e) {
			e.preventDefault();
			jQuery('html, body').addClass('lh_has_modal');
			var movieId = jQuery(_this3).attr('data-movie_menu_id');
			if (movieId) {
				_this3.fetchMovie(movieId);
				jQuery(document).on('keyup.lh_esc_key', function (e) {
					if (e.keyCode == 27) {
						// escape key maps to keycode 27
						_this3.removeModal();
					}
				});
			}
			_this3.addLoader();
		});
		jQuery(document).on('click', '.lr_close', function () {
			_this3.removeModal();
		});
	},
	documentReady: function documentReady() {
		var _this4 = this;

		jQuery(document).ready(function () {
			_this4.initModalClick();
		});
	}
};

lhMovieApp.documentReady();

/***/ }),
/* 2 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);