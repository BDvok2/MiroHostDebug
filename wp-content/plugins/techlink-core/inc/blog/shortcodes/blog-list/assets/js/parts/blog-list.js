(function ($) {
	"use strict";
	
	var shortcode = 'techlink_core_blog_list';
	
	qodefCore.shortcodes[shortcode] = {};
	
	if (typeof qodefCore.listShortcodesScripts === 'object') {
		$.each(qodefCore.listShortcodesScripts, function (key, value) {
			qodefCore.shortcodes[shortcode][key] = value;
		});
	}

	$(document).ready(function () {
		qodefBlogList.init();
	});

	var qodefBlogList = {
		init: function () {
			this.holder = $('.qodef-blog.qodef--list');

			if ( this.holder.length ) {
				this.holder.each( function () {
					var $thisHolder = $(this);

					qodefBlogList.linkHover( $thisHolder );
				});
			}
		},
		linkHover: function ( $thisHolder ) {
			var $item = $thisHolder.find('.qodef-blog-item');

			$item.each( function () {
				var $thisItem = $(this),
					$titleLink = $thisItem.find('.qodef-e-title-link');

				$titleLink.on('mouseenter', function() {
					$titleLink.closest('.qodef-blog-item').addClass('qodef--active');
				});

				$titleLink.on('mouseleave', function() {
					$titleLink.closest('.qodef-blog-item').removeClass('qodef--active');
				});
			});
		}
	};

	qodefCore.shortcodes[shortcode].qodefResizeIframes = qodef.qodefResizeIframes;

})(jQuery);
