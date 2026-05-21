(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefImageWithTextBelow.init();
    });

    var qodefImageWithTextBelow = {
        init: function () {
            this.holder = $('.qodef-image-with-text.qodef-layout--text-below');

            if ( this.holder.length ) {
                this.holder.each( function () {
                    var $thisHolder = $(this);

                    qodefImageWithTextBelow.linkHover( $thisHolder );
                });
            }
        },
        linkHover: function ( $thisHolder ) {
            var $title = $thisHolder.find('.qodef-m-title a');

            if ( $title.length ) {
                $title.on('mouseenter', function() {
                    $thisHolder.addClass('qodef--active');
                });

                $title.on('mouseleave', function() {
                    $thisHolder.removeClass('qodef--active');
                });
            }
        },
    };

})(jQuery);