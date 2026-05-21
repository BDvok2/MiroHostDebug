(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefTechlinkSpinner.init();
    });

    $(window).on('elementor/frontend/init', function() {
        var isEditMode = Boolean( elementorFrontend.isEditMode() );

        if ( isEditMode ) {
            qodefTechlinkSpinner.init( isEditMode );
        }
    });

    var qodefTechlinkSpinner = {
        init: function ( isEditMode ) {
            var $holder = $('#qodef-page-spinner.qodef-layout--techlink'),
                $revHolder = $('#qodef-landing-rev-holder');

            if ( $holder.length ) {
                if ( isEditMode ) {
                    qodefTechlinkSpinner.fadeOutLoader( $holder );
                } else {
                    qodefTechlinkSpinner.animateSpinner( $holder, $revHolder );
                    qodefTechlinkSpinner.splitText( $holder );
                }
            }
        },
        animateSpinner: function ( $holder, $revHolder ) {
            qodefTechlinkSpinner.windowLoaded = false;

            $( window ).on(
                'load',
                function () {
                    qodefTechlinkSpinner.windowLoaded = true;
                });

            var $svg = $holder.find('svg');

            if ( $svg.length ) {
                var $firstPath = $svg.find('.qodef-path.qodef--1'),
                    $secondPath = $svg.find('.qodef-path.qodef--2'),
                    $thirdPath = $svg.find('.qodef-path.qodef--3');

                $thirdPath.css('stroke-dashoffset', 0);

                setTimeout( function () {
                    $svg.css('transform', 'rotate(120deg)');
                    $firstPath.css('stroke-dashoffset', 0);
                }, 1000);

                setTimeout( function () {
                    $svg.css('transform', 'rotate(240deg)');
                    $secondPath.css('stroke-dashoffset', 0);
                }, 2000);

                setTimeout( function () {
                    var $word = $holder.find('.qodef-m-text .qodef-m-word');

                    setTimeout( function () {
                        $holder.addClass('qodef--show');
                    }, 300);

                    qodefTechlinkSpinner.animateText( $word, 'qodef-animate', 400 );
                }, 3000);

                setTimeout( function () {
                    if ( qodefTechlinkSpinner.windowLoaded ) {
                        $holder.addClass('qodef--end');

                        if ( $revHolder.length ) {
                            $revHolder.find('rs-module').revstart();
                        }
                    } else {
                        var $interval = setInterval( function() {
                            if ( qodefTechlinkSpinner.windowLoaded ) {
                                clearInterval($interval);
                                $holder.addClass('qodef--end');

                                if ( $revHolder.length ) {
                                    $revHolder.find('rs-module').revstart();
                                }
                            }
                        }, 100);
                    }
                }, 6000)
            }
        },
        splitText: function ( $holder ) {
            var $preloaderText = $holder.find('.qodef-m-text');

            if ( $preloaderText.length ) {
                var $txt = $preloaderText.text(),
                    $newTxt = $.trim($txt),
                    $extraClass = '';

                $preloaderText.empty();

                $newTxt.split(/(?=[A-Z])/).forEach( function($c) {
                    $extraClass = ($c === " " ? 'qodef-m-empty-char' : ' ');
                    $preloaderText.append('<span class="qodef-m-word ' + $extraClass + '">' + $c + '</span>')
                });
            }
        },
        animateText: function ( $selector, $class, $delay ) {
            $selector.each( function( $i ) {
                var $thisSpan = $(this);

                setTimeout(function () {
                    $thisSpan.addClass($class);
                }, $delay * 1 + $i * $delay);
            });
        },
        fadeOutLoader: function ($holder, speed, delay, easing) {
            speed = speed ? speed : 500;
            delay = delay ? delay : 0;
            easing = easing ? easing : 'swing';

            if ($holder.length) {
                $holder.delay(delay).fadeOut(speed, easing);
                $(window).on('bind', 'pageshow', function (event) {
                    if (event.originalEvent.persisted) {
                        $holder.fadeOut(speed, easing);
                    }
                });
            }
        }
    };

})(jQuery);