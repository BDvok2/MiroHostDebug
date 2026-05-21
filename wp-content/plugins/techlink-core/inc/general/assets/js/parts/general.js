(function ($) {
	"use strict";
	
	$(document).ready(function () {
		qodefContentVerticalLines.init();
	});
	
	var qodefContentVerticalLines = {
		init: function () {
			this.header = $('#qodef-page-header-inner'),
			this.specialLine = $('.qodef-content-special-line');

			if (this.specialLine.length) {
				var headerHeight = this.header.outerHeight();
				this.specialLine.css('right', headerHeight);
			}
		}
	};
	
})(jQuery);
