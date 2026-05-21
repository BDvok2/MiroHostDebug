(function($) {
	"use strict";

	qodefCore.shortcodes.techlink_core_floating_images = {};

	$(document).ready(function() {
		qodefFloatingImages.init();
	});

	var qodefFloatingImages = {
		init: function () {
			this.holder = $('.qodef-floating-images');

			if ( this.holder.length ) {
				this.holder.each( function () {
					var $thisHolder = $(this),
						$inner = $thisHolder.find('.qodef-m-inner'),
						$mainImg = $thisHolder.find('.qodef-m-main-image'),
						$auxImg = $thisHolder.find('.qodef-m-aux-image');

					$thisHolder.waitForImages( function () {
						qodefFloatingImages.getProps( $mainImg );
						qodefFloatingImages.getProps( $auxImg );
						qodefFloatingImages.setSizes( $mainImg, $thisHolder );
						qodefFloatingImages.setSizes( $auxImg, $thisHolder );
						qodefFloatingImages.holderCalcs( $thisHolder, $inner, $mainImg, $auxImg );
						qodefFloatingImages.setParallaxData( $thisHolder );
					});

					$(window).on('resize', function () {
						qodefFloatingImages.setSizes( $mainImg, $thisHolder );
						qodefFloatingImages.setSizes( $auxImg, $thisHolder );
						qodefFloatingImages.holderCalcs( $thisHolder, $inner, $mainImg, $auxImg );
					});
				});
			}
		},

		getProps: function ( $image ) {
			$image
				.data('c', $image.prop('naturalWidth') / $image.prop('naturalHeight'))
				.data('w', $image.attr('data-width') ? parseInt($image.attr('data-width')) : 100)
				.data('x', $image.attr('data-x') ? $image.attr('data-x') : 0)
				.data('y', $image.attr('data-y') ? $image.attr('data-y') : 0);
		},

		setSizes: function ( $image, $holder ) {
			$image.css({
				'width': $image.data('w') / 100 * $holder.width(),
				'height': $image.data('w') / 100 * $holder.width() / $image.data('c')
			});
		},

		holderCalcs: function ( $holder, $inner, $mainImg, $auxImg ) {
			var mainW = $mainImg.data('w') / 100 * $holder.width(),
				mainH = mainW / $mainImg.data('c'),
				auxY = parseInt($auxImg.data('y')),
				auxX = parseInt($auxImg.data('x')),
				auxWCorr = $auxImg.width() + Math.abs(auxX) * $mainImg.width() / 100,
				auxHCorr = $auxImg.height() + Math.abs(auxY) * $mainImg.height() / 100;

			var widthVal = mainW > auxWCorr ? mainW : auxWCorr,
				heightVal = mainH > auxHCorr ? mainH : auxHCorr;

			$inner.css({
				'height': heightVal,
				'width': widthVal
			});

			if ( auxY > 0 ) {
				$mainImg.css({'top': 0});
				$auxImg.css({'top': auxY / 100 * mainH});
			} else {
				$mainImg.css({'bottom': 0});
				$auxImg.css({'bottom': Math.abs(auxY) / 100 * mainH});
			}
			if ( auxX > 0 ) {
				$mainImg.css({'left': 0});
				$auxImg.css({'left': auxX / 100 * mainW});
			} else {
				$mainImg.css({'right': 0});
				$auxImg.css({'right': Math.abs(auxX) / 100 * mainW});
			}
		},

		setParallaxData: function ( $holder ) {
			var $mainImage = $holder.find('.qodef-main-image-holder > .qodef-m-image-wrapper'),
				$auxImage  = $holder.find('.qodef-aux-image-holder > .qodef-m-image-wrapper');

			if ( $mainImage.length ) {
				if ( qodef.windowWidth >= 1280 && qodef.windowWidth < 1441 ) {
					$mainImage.attr('data-parallax', '{"y": -32, "smoothness": 50}');
				} else {
					$mainImage.attr('data-parallax', '{"y": -88, "smoothness": 20}');
				}
			}

			if ( $auxImage.length ) {
				if ( qodef.windowWidth >= 1280 && qodef.windowWidth < 1441 ) {
					$auxImage.attr('data-parallax', '{"y": -16, "smoothness": 50}');
				} else {
					$auxImage.attr('data-parallax', '{"y": -32, "smoothness": 20}');
				}
			}

			setTimeout( function () {
				qodefFloatingImages.initParallax();
			}, 100);
		},

		initParallax: function () {
			var $parallaxIntances = $("[data-parallax]");

			if ( $parallaxIntances.length && !qodef.html.hasClass('touch') ) {
				ParallaxScroll.init();
			}
		}
	};

	qodefCore.shortcodes.techlink_core_floating_images.qodefFloatingImages = qodefFloatingImages;

})(jQuery);