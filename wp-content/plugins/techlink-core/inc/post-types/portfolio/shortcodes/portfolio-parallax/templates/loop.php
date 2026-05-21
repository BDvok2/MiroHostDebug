<div class="qodef-m-parallax-main clearfix">
	<?php if ( $query_result->have_posts() ) {
		while ( $query_result->have_posts() ) : $query_result->the_post();
			techlink_core_template_part( 'post-types/portfolio/shortcodes/portfolio-parallax', 'templates/main', '', $params );
		endwhile; // End of the loop.
	} else {
		// Include global posts not found
		techlink_core_theme_template_part( 'content', 'templates/parts/posts-not-found' );
	}

	wp_reset_postdata(); ?>
</div>
<div class="qodef-m-parallax-texts clearfix">
	<?php if ( $query_result->have_posts() ) {
		while ( $query_result->have_posts() ) : $query_result->the_post();
			techlink_core_template_part( 'post-types/portfolio/shortcodes/portfolio-parallax', 'templates/texts', '', $params );
		endwhile; // End of the loop.
	} else {
		// Include global posts not found
		techlink_core_theme_template_part( 'content', 'templates/parts/posts-not-found' );
	}

	wp_reset_postdata(); ?>
</div>
