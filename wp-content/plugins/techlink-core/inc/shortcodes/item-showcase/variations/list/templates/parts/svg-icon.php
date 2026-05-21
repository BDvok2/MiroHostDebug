<?php if ( $item_icon_type == 'svg-icon' && ! empty ( $item_svg_icon ) ) { ?>
	<?php echo qode_framework_wp_kses_html( 'svg custom', $item_svg_icon ); ?>
<?php }