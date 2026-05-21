(function ($) {
    "use strict";

    var shortcode = 'techlink_core_team_showcase';

    qodefCore.shortcodes[shortcode] = {};

    if (typeof qodefCore.listShortcodesScripts === 'object') {
        $.each(qodefCore.listShortcodesScripts, function (key, value) {
            qodefCore.shortcodes[shortcode][key] = value;
        });
    }

    $(document).ready(function () {
        qodefTeamShowcase.init();
    });

    var qodefTeamShowcase = {
        init: function () {
            this.holder = $('.qodef-team-showcase');

            if ( this.holder.length ) {
                this.holder.each( function () {
                    var $thisHolder = $(this);

                    if ( $thisHolder.hasClass('qodef--has-appear') ) {
                        qodefTeamShowcase.appear($thisHolder);
                    }

                    if ( $thisHolder.hasClass('qodef--has-float') ) {
                        qodefTeamShowcase.setFloatData($thisHolder);
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
                qodefTeamShowcase.initFloat();
            }, 100);
        },
        initFloat: function () {
            var $parallaxIntances = $("[data-parallax]");

            if ( $parallaxIntances.length && !qodef.html.hasClass('touch') ) {
                ParallaxScroll.init();
            }
        }
    }

})(jQuery);