<?php if ( is_object( WC()->cart ) ) { ?>
<?php techlink_core_template_part( 'plugins/woocommerce/widgets/dropdown-cart', 'templates/parts/opener' ); ?>
<div class="qodef-m-dropdown">
	<div class="qodef-m-dropdown-inner">
		<?php
		// Hook to include additional content before cart items
		do_action( 'techlink_core_action_woocommerce_before_side_area_cart_content' );
		
		if ( ! WC()->cart->is_empty() ) {
			techlink_core_template_part( 'plugins/woocommerce/widgets/dropdown-cart', 'templates/parts/loop' );
			
		} else {
		    // Include posts not found
			techlink_core_template_part( 'plugins/woocommerce/widgets/dropdown-cart', 'templates/parts/posts-not-found' );
		} ?>
	</div>
	
	<?php if ( ! WC()->cart->is_empty() ) { ?>
	
		<div class="qodef-m-dropdown-second-inner">
			<?php
				techlink_core_template_part( 'plugins/woocommerce/widgets/dropdown-cart', 'templates/parts/order-details' );
				
				techlink_core_template_part( 'plugins/woocommerce/widgets/dropdown-cart', 'templates/parts/button' );
			 ?>
		</div>
	<?php } ?>
</div>
<?php } ?>