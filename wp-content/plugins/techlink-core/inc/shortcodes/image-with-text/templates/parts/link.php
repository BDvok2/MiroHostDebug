<?php if ( $image_action === 'open-popup' ) { ?>
    <a class="qodef-m-overlay-link qodef-magnific-popup qodef-popup-item" itemprop="image" href="<?php echo esc_url( $image_params['url'] ); ?>" data-type="image" title="<?php echo esc_attr( $image_params['alt'] ); ?>">
<?php } elseif ( $image_action === 'custom-link' && ! empty( $link ) ) { ?>
    <a class="qodef-m-overlay-link" itemprop="url" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
<?php } ?>
<?php if ( $image_action === 'open-popup' || $image_action === 'custom-link' ) { ?>
    </a>
<?php } ?>