<?php if ( $query_result->have_posts() ) {
	$counter = 1;
	while ( $query_result->have_posts() ) : $query_result->the_post();

		if ( $counter % 2 != 0 ) { ?><div class="qodef-m-section"><?php }

		$params['item_classes']    = $this_shortcode->get_item_classes( $params );
		
		techlink_core_template_part( 'post-types/portfolio/shortcodes/portfolio-showcase', 'templates/info-below', '', $params );

		if ( $counter % 2 != 1 ) { ?></div><?php }

		$counter++;
	endwhile; // End of the loop.
} else {
	// Include global posts not found
	techlink_core_theme_template_part( 'content', 'templates/parts/posts-not-found' );
}

wp_reset_postdata();