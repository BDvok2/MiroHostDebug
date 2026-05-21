(function ($) {
	"use strict";

	qodefCore.shortcodes.techlink_core_icon_with_text = {};

	$(document).ready(function () {
		qodefIconWithText.init();
	});

	var qodefIconWithText = {
		init: function () {
			this.holder = $('.qodef-icon-with-text.qodef--custom-icon');

			if ( this.holder.length ) {
				this.holder.each( function () {
					var $thisHolder = $(this);

					qodefIconWithText.linkHover( $thisHolder );
				});
			}
		},
		linkHover: function ( $thisHolder ) {
			var $titleLink = $thisHolder.find('.qodef-m-title');

			$titleLink.on('mouseenter', function() {
				$thisHolder.addClass('qodef--active');
			});

			$titleLink.on('mouseleave', function() {
				$thisHolder.removeClass('qodef--active');
			});
		}
	}
	
	qodefCore.shortcodes.techlink_core_icon_with_text.qodefAppear = qodef.qodefAppear ;
	
})(jQuery);