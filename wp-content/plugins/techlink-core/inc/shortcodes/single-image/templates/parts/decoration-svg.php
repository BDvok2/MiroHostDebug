<?php if ( $decoration == 'svg' && ! empty ( $background_svg ) ) { ?>
	<?php echo qode_framework_wp_kses_html( 'svg custom', $background_svg ); ?>
<?php }