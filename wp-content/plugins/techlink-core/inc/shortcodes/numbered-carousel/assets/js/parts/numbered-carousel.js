(function ($) {
	"use strict";

	qodefCore.shortcodes.techlink_core_numbered_carousel = {};

	$(document).ready(function () {
		qodefNumberedCarousel.init();
	});
	
	var qodefNumberedCarousel = {
		ieFallback: qodef.body.hasClass('qodef-browser--ms-explorer'),
		init: function () {
			this.holder = $('.qodef-numbered-carousel');
			
			if (this.holder.length) {
				this.holder.each(function () {
					var $thisHolder = $(this);
					qodefNumberedCarousel.createSlider($thisHolder);
				});
			}
		},
		createSlider: function ($holder) {
			var $carousel = $holder.find('.swiper-container'),
				$swiper = new Swiper($carousel, {
                    loop: false,
                    slidesPerView: 'auto',
                    centeredSlides: true,
                    speed: 800,
					allowTouchMove: false,
                    init: false,
					pagination: {
                    	el: $holder.find( '.swiper-pagination' ),
						type: 'bullets',
						clickable: false
					},
                }),
                $bgItems = $holder.find('.qodef-m-bg-item'),
                $gridTrigger = $holder.find('.qodef-m-grid-line:last-child');

			$swiper.on('init', function () {
                $holder.data('items', $bgItems.length);

                qodefNumberedCarousel.iterate($holder, $carousel, $bgItems, $carousel.find('.swiper-wrapper'));
                qodefNumberedCarousel.changeActiveSlide($holder, $swiper);
                qodefNumberedCarousel.setBulletsIndexes($holder);

                //initial animation
                $carousel
                    .addClass('qodef-show')
                    .one(qodef.transitionEnd, function () {
                        $holder.addClass('qodef-initialized');
                        $gridTrigger.one(qodef.transitionEnd, function () {
                            $holder.data('idle', true);
                        });
                        qodefNumberedCarousel.ieFallback && $holder.data('idle', true);
                    });
            });

            $swiper.on('slideChangeTransitionEnd', function () {
                qodefNumberedCarousel.iterate($holder, $carousel, $bgItems, $carousel.find('.swiper-wrapper'));

                //wait for last item to unmask
                $holder.removeClass('qodef-mask');
                $gridTrigger.one(qodef.transitionEnd, function () {
                    $holder.data('idle', true);
                });
                qodefNumberedCarousel.ieFallback && $holder.data('idle', true);
            });

            //initialize swiper
            $holder.waitForImages(function () {
                $swiper.init();
            });
		},

        setBulletsIndexes: function ( $holder ) {
            var $bullets = $holder.find('.swiper-pagination-bullet');

            if ( $bullets.length ) {
                $bullets.each( function ( $i ) {
                    var $thisBullet = $(this);

                    $thisBullet.attr('data-index', $i);
                })
            }
        },

		//toggle on every slide iteration
		iterate: function ($holder, $carousel, $bgItems, $wrapper) {
			qodefNumberedCarousel.setActiveIndex($holder, $carousel);
            qodefNumberedCarousel.changeActiveItem($holder, $bgItems);
            !qodefNumberedCarousel.ieFallback && qodefNumberedCarousel.roundTransformVal($wrapper);
		},

		//fix swiper calcs for center layout type
		roundTransformVal: function ($wrapper) {
			var val = Math.round($wrapper.css('transform').split(',')[4]);

            $wrapper.css('transform', 'matrix(1, 0, 0, 1, ' + val + ', 0)');
		},

		//sets active index to holder element
		setActiveIndex: function ($holder, $carousel) {
			var activeIndex = $carousel.find('.swiper-slide-active').data('index');
            $holder.data('active-index', activeIndex);
		},

		//change css class
		changeClass: function ($holder, cssClass) {
			$holder
                .removeClass('qodef-next qodef-prev')
                .addClass(cssClass);
		},

		//declarative item change - bg item
		changeActiveItem: function ($holder, $items) {
			var $activeItem = $items.filter(function () {
                return $(this).data("index") == $holder.data('active-index');
            });

            $items.removeClass('qodef-active');
            $activeItem.addClass('qodef-active');
		},

		//declarative slide change
		changeActiveSlide: function ($holder, $swiper) {
			var delay = 500,
                speed = 800;

            var slideTo = function ($holder, $swiper, direction) {
                if (direction == 'next' && $swiper.activeIndex + 1 < $swiper.slides.length) {
                    qodefNumberedCarousel.changeClass($holder, 'qodef-' + direction);

                    $holder.data('idle', false);
                    $holder.addClass('qodef-mask');

                    setTimeout(function () {
                        $swiper.slideNext(speed);
                    }, delay);
                } else if (direction == 'prev' && $swiper.activeIndex != 0) {
                    qodefNumberedCarousel.changeClass($holder, 'qodef-' + direction);

                    $holder.data('idle', false);
                    $holder.addClass('qodef-mask');

                    //fade before transition
                    $holder.addClass('qodef-fade-prev-content');
                    setTimeout(function () {
                        $holder.removeClass('qodef-fade-prev-content');
                        $swiper.slidePrev(speed);
                    }, delay * 1.5);
                }
            };

            var jumpTo = function ($holder, $swiper, $item) {
                if ( $item.attr('data-index') > $swiper.activeIndex) {
                    qodefNumberedCarousel.changeClass($holder, 'qodef-next');

                    $holder.data('idle', false);
                    $holder.addClass('qodef-mask');

                    setTimeout(function () {
                        $swiper.slideTo($item.attr('data-index'), speed);
                    }, delay);
                } else if ( $item.attr('data-index') < $swiper.activeIndex) {
                    qodefNumberedCarousel.changeClass($holder, 'qodef-prev');

                    $holder.data('idle', false);
                    $holder.addClass('qodef-mask');

                    //fade before transition
                    $holder.addClass('qodef-fade-prev-content');
                    setTimeout(function () {
                        $holder.removeClass('qodef-fade-prev-content');
                        $swiper.slideTo($item.attr('data-index'), speed);
                    }, delay * 1.5);
                }
            }

            var clickHandler = function (e) {
                var item = $(e.currentTarget);

                if (item.hasClass('swiper-slide-next')) {
                    $holder.data('idle') && slideTo($holder, $swiper, 'next');
                } else if (item.hasClass('swiper-slide-prev')) {
                    $holder.data('idle') && slideTo($holder, $swiper, 'prev');
                }
            };

            var paginationHandler = function ( $e ) {
                var $item = $($e.currentTarget);

                $holder.data('idle') && jumpTo($holder, $swiper, $item);
            };

            var wheelHandler = function (e) {
                if ($holder.data('idle')) {
                    var direction = e.deltaY > 0 ? 'next' : 'prev';

                    if (direction == 'next' || direction == 'prev') {
                        slideTo($holder, $swiper, direction);
                    }
                }
            }

            var touchStart = function (e) {
                $holder.data('touch-start', parseInt(e.changedTouches[0].clientX));
            };

            var touchMove = function (e) {
                $holder.data('touch-move', parseInt(e.changedTouches[0].clientX));

                var delta = $holder.data('touch-move') - $holder.data('touch-start');

                if ($holder.data('idle')) {
                    var direction = delta < 0 ? 'next' : 'prev';

                    if (direction == 'next' || direction == 'prev') {
                        slideTo($holder, $swiper, direction);
                    }
                }
            };

            $holder.on('click', '.swiper-slide', clickHandler);
            $holder.on('click', '.swiper-pagination-bullet', paginationHandler);
            if ($holder.hasClass('qodef-change-on-scroll')) {
                $holder[0].addEventListener('wheel', wheelHandler);

                if ( qodef.windowWidth < 481) {
                    $holder[0].addEventListener('touchstart', touchStart);
                    $holder[0].addEventListener('touchmove', touchMove);
                }
            }
		}
	};

	qodefCore.shortcodes.techlink_core_numbered_carousel.qodefNumberedCarousel = qodefNumberedCarousel;

})(jQuery);
