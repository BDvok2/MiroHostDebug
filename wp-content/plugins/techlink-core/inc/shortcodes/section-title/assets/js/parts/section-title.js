(function ($) {
    'use strict';

    qodefCore.shortcodes.techlink_core_section_title = {};

    $(document).ready(function () {
        qodefSectionTitle.init();
    });

    /**
     * Init progress bar shortcode functionality
     */
    var qodefSectionTitle = {
        init: function () {
            this.holder = $('.qodef-section-title');

            if ( this.holder.length ) {
                this.holder.each( function () {
                    var $thisHolder = $(this);

                    if ( $thisHolder.hasClass('qodef--has-appear') ) {
                        qodefSectionTitle.backgroundText( $thisHolder );
                    }
                });
            }
        },
        backgroundText: function ( $thisHolder ) {
            var $backgroundText = $thisHolder.find('.qodef-m-background-text');

            if ( $backgroundText.length ) {
                var $text = $backgroundText.text(),
                    $words = $text.split("");

                $backgroundText.empty();

                for ( var i = 0; i < $words.length; i++ ) {
                    $words[i] = '<span class="qodef-m-background-character">' + $words[i] + '</span>';

                    $text = $words.join("");
                }

                $backgroundText.append($text);

                setTimeout( function () {
                    var $backgroundChar = $thisHolder.find('.qodef-m-background-character');

                    if ( $backgroundChar.length ) {
                        $backgroundChar.each ( function () {
                            $backgroundChar.appear( function () {
                                $backgroundChar.addClass('qodef--appear');
                            }, { accX: 0, accY: -100 });
                        })
                    }
                }, 300);
            }
        }
    };

    qodefCore.shortcodes.techlink_core_section_title.qodefSectionTitle = qodefSectionTitle;

})(jQuery);
