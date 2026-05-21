<?php if ( $query_result->have_posts() ) { ?>
	<div class="qodef-m-column qodef--left">
		<?php $counter = 1;
		while ( $query_result->have_posts() ) : $query_result->the_post();

			if ( $counter % 2 != 0 ) {
				$params['item_classes'] = $this_shortcode->get_item_classes( $params );
				techlink_core_template_part( 'post-types/team/shortcodes/team-showcase', 'templates/info-below', '', $params );
			}
			$counter++;

		endwhile;
		wp_reset_postdata(); ?>
	</div>
	<div class="qodef-m-column qodef--right">
		<?php $counter = 1;
		while ( $query_result->have_posts() ) : $query_result->the_post();

			if ( $counter % 2 == 0 ) {
				$params['item_classes'] = $this_shortcode->get_item_classes( $params );
				techlink_core_template_part( 'post-types/team/shortcodes/team-showcase', 'templates/info-below', '', $params );
			}
			$counter++;

		endwhile;
		wp_reset_postdata(); ?>
	</div>
<?php } else {
	// Include global posts not found
	techlink_core_theme_template_part( 'content', 'templates/parts/posts-not-found' );
}

wp_reset_postdata();