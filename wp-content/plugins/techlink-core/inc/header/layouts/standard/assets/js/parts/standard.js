(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefHeaderWidgetsInBox.init();
	});
	
	var qodefHeaderWidgetsInBox = {
		init: function () {
			this.header = $('.qodef-header-box-styled-widgets--enabled #qodef-page-header-inner, .qodef-header-box-styled-widgets--enabled .qodef-header-sticky-inner'),
			this.widgets = this.header.find('.qodef-widget-holder > .widget');

			if (this.widgets.length) {
				var headerHeight = this.header.outerHeight();

				this.widgets.each(function () {
					var $thisWidget = $(this);
					qodefHeaderWidgetsInBox.createBox($thisWidget, headerHeight);
				});
			}
		},
		createBox: function ($holder, boxHeight) {
			$holder.css('width', boxHeight);
		}
	};
	
})(jQuery);
