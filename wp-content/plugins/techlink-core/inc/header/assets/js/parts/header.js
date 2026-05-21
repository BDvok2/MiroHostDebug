(function ($) {
	"use strict";

	$(document).ready(function () {
		qodefHeaderScrollAppearance.init();
	});

	$(window).on('load', function () {
		qodefShowHideDropdownMenu();
	});

	var qodefHeaderScrollAppearance = {
		appearanceType: function () {
			return qodefCore.body.attr('class').indexOf('qodef-header-appearance--') !== -1 ? qodefCore.body.attr('class').match(/qodef-header-appearance--([\w]+)/)[1] : '';
		},
		init: function () {
			var appearanceType = this.appearanceType();

			if (appearanceType !== '' && appearanceType !== 'none') {
				qodefCore[appearanceType + "HeaderAppearance"]();
			}
		}
	};

	/**
	 * Show/hide second/dropdown menu
	 */
	function qodefShowHideDropdownMenu() {
		var wrapper = $('#qodef-page-wrapper'),
			mainMenuButtonOpen = $('.qodef-header-navigation>ul>li>a, .qodef-drop-down-second, .qodef-woo-dropdown-cart'),
			cssClass = 'qodef-dropdown-menu-opened'

		$(mainMenuButtonOpen).on('touchstart mouseenter', function (e) {

			if (!mainMenuButtonOpen.hasClass('opened')) {
				mainMenuButtonOpen.addClass('opened');
				qodef.body.addClass(cssClass);
			}
		}).on('mouseleave', function (e) {
			qodef.body.removeClass(cssClass);
			mainMenuButtonOpen.removeClass('opened');
		});
	}

})(jQuery);
