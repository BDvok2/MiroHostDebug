<?php if ( $query_result->have_posts() ) {
	while ( $query_result->have_posts() ) : $query_result->the_post();
		techlink_core_template_part( 'blog/shortcodes/blog-showcase', 'templates/main', '', $params );
	endwhile; // End of the loop.
} else {
	// Include global posts not found
	techlink_core_theme_template_part( 'content', 'templates/parts/posts-not-found' );
}

wp_reset_postdata();