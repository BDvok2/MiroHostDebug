<?php if ( $icon_type == 'custom-icon' && ! empty ( $custom_icon ) ) { ?>
	<span class="qodef-e-custom-icon-holder" <?php qode_framework_inline_style( $custom_icon_styles ); ?>>
		<?php echo wp_get_attachment_image( $custom_icon, 'full' ); ?>
	</span>
<?php }
