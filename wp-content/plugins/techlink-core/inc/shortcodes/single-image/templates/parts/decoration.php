<?php if ( $decoration == 'image' && ! empty ( $background_image ) ) { ?>
	<?php echo wp_get_attachment_image( $background_image, 'full' ); ?>
<?php }