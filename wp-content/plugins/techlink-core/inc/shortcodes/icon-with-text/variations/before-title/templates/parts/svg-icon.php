<?php if ( $icon_type == 'svg-icon' && ! empty ( $svg_icon ) ) { ?>
	<?php echo qode_framework_wp_kses_html( 'svg custom', $svg_icon ); ?>
<?php }