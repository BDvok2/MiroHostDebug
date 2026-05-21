(function ($) {
    "use strict";

    var shortcode = 'techlink_core_portfolio_showcase';

    qodefCore.shortcodes[shortcode] = {};

    if (typeof qodefCore.listShortcodesScripts === 'object') {
        $.each(qodefCore.listShortcodesScripts, function (key, value) {
            qodefCore.shortcodes[shortcode][key] = value;
        });
    }

    $(document).ready(function () {
        qodefPortfolioShowcase.init();
    });

    var qodefPortfolioShowcase = {
        init: function () {
            this.holder = $('.qodef-portfolio-showcase');

            if ( this.holder.length ) {
                this.holder.each( function () {
                    var $thisHolder = $(this);

                    if ( $thisHolder.hasClass('qodef--has-appear') ) {
                        qodefPortfolioShowcase.appear( $thisHolder );
                    }

                    if ( $thisHolder.hasClass('qodef--has-float') ) {
                        qodefPortfolioShowcase.setFloatData( $thisHolder );
                    }

                    if ( $thisHolder.hasClass('qodef--has-hover') ) {
                        qodefPortfolioShowcase.setHover( $thisHolder );
                    }
                });
            }
        },
        appear: function ( $thisHolder ) {
            var $items = $thisHolder.find('.qodef-e ');

            $items.each( function () {
                var $thisItem = $(this);

                $thisItem.appear( function () {
                    setTimeout( function () {
                        $thisItem.addClass('qodef--appear');
                    }, 50);
                }, { accX: 0, accY: -100 });
            });
        },
        setFloatData: function ( $thisHolder ) {
            var $items = $thisHolder.find('.qodef-e ');

            $items.each( function () {
                var $thisItem = $(this);

                $thisItem.attr('data-parallax', '{"y": -86, "smoothness": 20}');
            });

            setTimeout( function () {
                qodefPortfolioShowcase.initFloat();
            }, 100);
        },
        initFloat: function () {
            var $parallaxIntances = $("[data-parallax]");

            if ( $parallaxIntances.length && !qodef.html.hasClass('touch') ) {
                ParallaxScroll.init();
            }
        },
        setHover: function ( $thisHolder ) {
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
    }

})(jQuery);
