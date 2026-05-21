(function ($) {
    "use strict";
    
	qodefCore.shortcodes.techlink_core_image_gallery = {};

	$(document).ready(function () {
		qodefImageGallery.init();
	});

	var qodefImageGallery = {
		init: function () {
			var $gallery = $('.qodef-image-gallery.qodef--has-hover');

			if ( $gallery.length ) {
				$gallery.each( function () {
					var $this = $(this);
				});
			}
		}
	};

	qodefCore.shortcodes.techlink_core_image_gallery.qodefImageGallery = qodefImageGallery;
	qodefCore.shortcodes.techlink_core_image_gallery.qodefSwiper = qodef.qodefSwiper;
	qodefCore.shortcodes.techlink_core_image_gallery.qodefMasonryLayout = qodef.qodefMasonryLayout;

})(jQuery);
