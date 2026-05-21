<?php
$post_id       = get_the_ID();
$is_enabled    = techlink_core_get_post_value_through_levels( 'qodef_portfolio_single_enable_related_posts' );
$related_posts = techlink_core_get_custom_post_type_related_posts( $post_id, techlink_core_get_portfolio_single_post_taxonomies( $post_id ) );

if ( $is_enabled === 'yes' && ! empty( $related_posts ) && class_exists( 'TechLinkCorePortfolioListShortcode' ) ) { ?>
	<div id="qodef-portfolio-single-related-items">
		<div class="qodef-m-tagline"><?php echo esc_html__( 'D - uncover what drive us', 'techlink-core' ) ?></div>
		<h3 class="qodef-m-title"><?php echo esc_html__( 'Related Projects', 'techlink-core' ) ?></h3>
		<?php
		$params = apply_filters( 'techlink_core_filter_portfolio_single_related_posts_params', array(
			'custom_class'         => 'qodef--no-bottom-space',
			'columns'              => '3',
			'posts_per_page'       => 3,
			'additional_params'    => 'id',
			'post_ids'             => $related_posts['items'],
			'layout'               => 'info-below',
			'featured_images_only' => 'yes',
			'images_proportion'    => 'custom',
			'custom_image_width'   => '800',
			'custom_image_height'  => '582',
			'title_tag'            => 'h4',
			'excerpt_length'       => '100'
		) );
		
		echo TechLinkCorePortfolioListShortcode::call_shortcode( $params ); ?>
	</div>
<?php } ?>
