<a itemprop="url" class="qodef-m-opener" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
	<span class="qodef-m-opener-inner">
		<span class="qodef-m-opener-icon"><?php techlink_render_svg_icon( 'dropdown-cart' ); ?></span>
		<span class="qodef-m-opener-count"><?php echo WC()->cart->cart_contents_count; ?></span>
	</span>
</a>
