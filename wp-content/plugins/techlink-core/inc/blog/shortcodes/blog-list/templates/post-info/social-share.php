<?php if ( class_exists( 'TechLinkCoreSocialShareShortcode' ) ) { ?>
	<div class="qodef-e-info-item qodef-e-info-social-share">
		<?php
		$params = array(
			'title'     => '',
			'layout'    => 'list',
			'icon_font' => 'simple-line-icons'
		);
		
		echo TechLinkCoreSocialShareShortcode::call_shortcode( $params ); ?>
	</div>
<?php } ?>