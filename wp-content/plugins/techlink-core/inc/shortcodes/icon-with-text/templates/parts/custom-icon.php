<?php if ( $icon_type == 'custom-icon' && ! empty ( $custom_icon ) ) { ?>
	<span class="qodef-m-custom-icon" <?php qode_framework_inline_style( $custom_icon_styles ); ?>>
		<?php if ( ! empty( $link ) ) : ?>
			<a itemprop="url" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
		<?php endif; ?>
			<?php echo wp_get_attachment_image( $custom_icon, 'full' ); ?>
            <?php if ( ! empty( $custom_icon_hover ) ) : ?>
                <span class="qodef-m-custom-icon-hover">
                    <?php echo wp_get_attachment_image($custom_icon_hover, 'full'); ?>
                </span>
            <?php endif; ?>
		<?php if ( ! empty( $link ) ) : ?>
			</a>
		<?php endif; ?>
	</span>
<?php }
