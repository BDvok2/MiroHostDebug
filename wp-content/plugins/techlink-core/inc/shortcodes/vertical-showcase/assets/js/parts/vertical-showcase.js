(function ($) {
	"use strict";

	qodefCore.shortcodes.techlink_core_vertical_showcase = {};

	$(document).ready(function () {
		qodefVerticalShowcase.init();
	});

	var qodefVerticalShowcase = {
		init: function () {
			this.holder = $('.qodef-vertical-showcase'),
			this.header = $('#qodef-page-header-inner');

			if (this.holder.length) {
				this.holder.each(function () {
					var $thisHolder = $(this);
					qodefVerticalShowcase.createSlider($thisHolder);
					qodefVerticalShowcase.forceInputFocus( $thisHolder );
				});
			}
		},
		createSlider: function ($holder) {
			var $pasepartuWrapper = $('.qodef--passepartout'),
                $stripe = $holder.find('.qodef-m-stripe'),
                $frameImage = $holder.find('.qodef-m-inner-frame'),
                $frameInfo = $holder.find('.qodef-m-frame-info'),
                $frameSlideTagline = $frameInfo.find('.qodef-m-frame-slide-tagline'),
                $frameSlideNumber = $frameInfo.find('.qodef-m-frame-slide-number'),
                $frameDecoration = $frameInfo.find('.qodef-m-frame-decoration'),
                $frameTitle = $frameInfo.find('.qodef-m-frame-title'),
                $frameText = $frameInfo.find('.qodef-m-frame-text'),
                $swiperInstance = $holder.find('.swiper-container'),
                $swiperSlide = $swiperInstance.find('.swiper-slide'),
                lastSlide = $swiperSlide.length,
                secondLastSlide = lastSlide - 1,
                indexCounter = 1,
                currentActiveIndex,
                currentActiveTagline,
                currentActiveTitle,
                currentActiveText,
				currentActiveDecoration,
                onLastSlide = false,
                currentActiveImageSrc,
                scrollStart = false,

				$swiper = new Swiper($swiperInstance, {
                    loop: false,
                    direction: 'vertical',
                    slidesPerView: 1,
                    touchStartForcePreventDefault: true,
                    speed: 1000,
                    init: false,
					pagination: {
                    	el: $holder.find( '.swiper-pagination' ),
						type: 'bullets',
						clickable: true
					},
                });

			// Recalculate slider height if paspartu enabled
            if (qodef.body.hasClass('qodef--passepartout')) {
                var paspartuPadding = parseInt($pasepartuWrapper.css('padding'));
                $holder.css("height", "calc(100vh - " + paspartuPadding*2 + "px)");
                $swiperInstance.css("height", "calc(100vh - " + paspartuPadding*2 + "px)");
            }

            if (qodef.windowWidth < 1025) {
                var headerHeight = $('.qodef-mobile-header-inner').css('height');
                $holder.css("height", "calc(100vh - " + headerHeight + ")");
                $swiperInstance.css("height", "calc(100vh - " + headerHeight + ")");
                $pasepartuWrapper.css('padding', 0);
            }

            $swiperInstance.on(
                'mousewheel',
                function ( e ) {
                    e.preventDefault();

                    if ( ! scrollStart ) {
                        scrollStart = true;

                        if ( e.deltaY < 0 ) {
                            $swiperInstance[0].swiper.slideNext();
                        } else {
                            $swiperInstance[0].swiper.slidePrev();
                        }

                        setTimeout(
                            function () {
                                scrollStart = false;
                            },
                            1000
                        );
                    }
                }
            );

            //initialize swiper
            $holder.waitForImages(function () {
                $swiper.init();

                var rotateDegrees = 0,
                    swiperPagination = $holder.find('.swiper-pagination'),
                    swiperPaginationBullet = swiperPagination.find('.swiper-pagination-bullet');

                $swiperSlide.each(function() {
                    $(this).attr('slide-index', indexCounter);
                    $(this).data('slide-index', indexCounter);
                    var imgSrc = $(this).find('.qodef-m-item>img').attr('src'),
                        imgAlt = $(this).find('.qodef-m-item>img').attr('alt');
                    if (imgSrc !== undefined) {
                        $frameImage.append('<div><img src="'+ imgSrc +'" alt="'+ imgAlt +'"></div>')
                    }
                    indexCounter++;
                });

                $frameImage.find('div:first-child').addClass('active');

                function enableAdjacentPagination() {
                    var activeBullet = swiperPagination.find('.swiper-pagination-bullet-active');
                    swiperPaginationBullet.removeClass('bullet-clickable');
                    activeBullet.addClass('bullet-clickable');
                    activeBullet.next().addClass('bullet-clickable');
                    activeBullet.prev().addClass('bullet-clickable');
                }

                // function find active item
                function findActiveItem() {
                	var currentSlide = $swiperInstance.find('.swiper-slide-active'),
						currentslideOptions = {};

                    currentActiveIndex = currentSlide.data('slide-index');
                    currentActiveTagline = currentSlide.find('.qodef-m-item-tagline').text();
                    currentActiveTitle = currentSlide.find('.qodef-m-item-title').text();
                    currentActiveText = currentSlide.find('.qodef-m-item-text').text();
	                currentActiveDecoration = currentSlide.find('.qodef-m-item-decoration').html();
	                currentActiveImageSrc = currentSlide.find('>.qodef-m-item>img').attr('src');

	                currentslideOptions = typeof currentSlide.data( 'options' ) !== 'undefined' ? currentSlide.data( 'options' ) : {};
					if ( currentslideOptions.hasOwnProperty( 'headerSkin' ) ) {
	                	qodefVerticalShowcase.header
							.removeClass('qodef-skin--light qodef-skin--dark')
							.addClass('qodef-skin--' + currentslideOptions.headerSkin);

					}
                }

                function animateFrameImages() {
                    $frameImage.find('div').removeClass('prev-active')
                    $frameImage.find('div.active').removeClass('active').addClass('prev-active');
                    $frameImage.find('div:nth-child('+ currentActiveIndex +')').addClass('active');
                }

                function updateFrameInfo() {
                    $frameSlideTagline.text(currentActiveTagline);
                    $frameSlideNumber.text('0' + currentActiveIndex);
                    $frameDecoration.html(currentActiveDecoration);
                    $frameTitle.text(currentActiveTitle);
                    $frameText.text(currentActiveText);
                }

                function readyAnimation() {
                    setTimeout(function() {
                        $frameInfo.removeClass("qodef-m-frame-animate-out");
                    }, 700);
                    $holder.removeClass("qodef-vertical-showcase-ready-animation");
                }

                // Initialize frame info when slider is ready
                findActiveItem();
                enableAdjacentPagination();
                updateFrameInfo();

                setTimeout(function() {
                    readyAnimation();
                }, 500);

                $swiper.on('slideNextTransitionStart', function() {
                    if (!onLastSlide) {
                        rotateDegrees+=180;
                        $stripe.css('transform', 'rotate('+ rotateDegrees +'deg)');
                    }
                });

                $swiper.on('slidePrevTransitionStart', function() {
                    if (currentActiveIndex !== secondLastSlide) {
                        rotateDegrees-=180;
                        $stripe.css('transform', 'rotate('+ rotateDegrees +'deg)');
                    }
                });

                $swiper.on('slideChangeTransitionStart', function() {
                    findActiveItem();
                    animateFrameImages();
                    enableAdjacentPagination();

                    if (currentActiveIndex == lastSlide) {
                        onLastSlide = true;
                        $holder.addClass("qodef-vertical-showcase-last-slide");
                    } else {
                        onLastSlide = false;
                        $holder.removeClass("qodef-vertical-showcase-last-slide");
                    }

                    if (!onLastSlide) {
                        $frameInfo.addClass("qodef-m-frame-animate-out");

                        setTimeout(function() {
                            // if even slide move the frame info down
                            if (currentActiveIndex % 2 == 0) {
                                $frameInfo.addClass("qodef-m-frame-even");
                            } else {
                                $frameInfo.removeClass("qodef-m-frame-even");
                            }
                            updateFrameInfo();
                            $frameInfo.removeClass("qodef-m-frame-animate-out");
                        }, 800);
                    }
                });
            });
		},
        forceInputFocus: function ( $holder ) {
		    var $form = $holder.find('.qodef-m-contact-form');

		    if ( $form.length ) {
		        var $inputs = $form.find('input');

		        if ( $inputs.length ) {
		            $inputs.each( function () {
		                var $thisInput = $(this);

		                $thisInput.on('click', function () {
		                    $thisInput.focus();
                        });
                    });
                }
            }
        }
	};

	qodefCore.shortcodes.techlink_core_vertical_showcase.qodefVerticalShowcase = qodefVerticalShowcase;

})(jQuery);
