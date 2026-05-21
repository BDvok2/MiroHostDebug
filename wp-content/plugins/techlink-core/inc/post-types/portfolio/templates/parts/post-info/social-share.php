<div class="qodef-e qodef-info--social-share">
	<?php if ( class_exists( 'TechLinkCoreSocialShareShortcode' ) ) {
		$params = array(
			'title'     => '',
			'layout'    => 'list',
			'icon_font' => 'simple-line-icons'
		);

		echo TechLinkCoreSocialShareShortcode::call_shortcode( $params );
	} ?>
</div>