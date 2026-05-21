<?php if ( $slider_navigation !== 'no' ) {
    $nav_next_classes = '';
    $nav_prev_classes = '';

    if ( isset( $unique ) && ! empty( $unique ) ) {
        $nav_next_classes = 'swiper-button-outside swiper-button-next-' . esc_attr( $unique );
        $nav_prev_classes = 'swiper-button-outside swiper-button-prev-' . esc_attr( $unique );
    }
    ?>
    <div class="swiper-button-prev <?php echo esc_attr( $nav_prev_classes ); ?>"><?php techlink_core_render_svg_icon( 'slider-arrow-left-alt' ); ?></div>
    <div class="swiper-button-next <?php echo esc_attr( $nav_next_classes ); ?>"><?php techlink_core_render_svg_icon( 'slider-arrow-right-alt' ); ?></div>
<?php } ?>
