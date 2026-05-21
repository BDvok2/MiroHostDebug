<?php if ( $item_icon_type == 'custom-icon' && ! empty ( $item_custom_icon ) ) { ?>
	<?php echo wp_get_attachment_image( $item_custom_icon, 'full' ); ?>
<?php }