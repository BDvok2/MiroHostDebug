<?php if ( class_exists( 'TechLinkCoreSocialShareShortcode' ) ) { ?>
	<div class="qodef-woo-product-social-share">
		<?php
		$params = array();
		$params['title'] = esc_html__( 'Share:', 'techlink-core' );
		
		echo TechLinkCoreSocialShareShortcode::call_shortcode( $params ); ?>
	</div>
<?php } ?>