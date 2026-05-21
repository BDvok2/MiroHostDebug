(function ($) {
	"use strict";
	
	var shortcode = 'techlink_core_portfolio_list';
	
	qodefCore.shortcodes[shortcode] = {};
	
	if (typeof qodefCore.listShortcodesScripts === 'object') {
		$.each(qodefCore.listShortcodesScripts, function (key, value) {
			qodefCore.shortcodes[shortcode][key] = value;
		});
	}

	$(document).ready(function () {
		qodefPortfolioList.init();
	});

	var qodefPortfolioList = {
		init: function () {
			this.holder = $('.qodef-portfolio-list');

			if ( this.holder.length ) {
				this.holder.each( function () {
					var $thisHolder = $(this);

					qodefPortfolioList.linkHover( $thisHolder );
				});
			}
		},
		linkHover: function ( $thisHolder ) {
			var $item = $thisHolder.find('article');

			$item.each( function () {
				var $thisItem = $(this),
					$titleLink = $thisItem.find('.qodef-e-title-link');

				$titleLink.on('mouseenter', function() {
					$titleLink.closest('article').addClass('qodef--active');
				});

				$titleLink.on('mouseleave', function() {
					$titleLink.closest('article').removeClass('qodef--active');
				});
			});
		}
	};

	qodefCore.shortcodes[shortcode].qodefPortfolioList = qodefPortfolioList;
	
})(jQuery);
