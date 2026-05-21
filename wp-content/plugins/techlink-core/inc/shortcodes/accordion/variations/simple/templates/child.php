<<?php echo esc_attr( $title_tag ); ?> class="qodef-accordion-title">
	<span class="qodef-tab-title">
		<?php echo esc_html( $title ); ?>
	</span>
	<span class="qodef-accordion-mark">
		<span class="qodef-icon--plus"><?php echo techlink_get_svg_icon( 'plus' ); ?></span>
		<span class="qodef-icon--minus"><?php echo techlink_get_svg_icon( 'minus' ); ?></span>
	</span>
</<?php echo esc_attr( $title_tag ); ?>>
<div class="qodef-accordion-content">
	<div class="qodef-accordion-content-inner">
		<?php echo do_shortcode( $content ); ?>
	</div>
</div>