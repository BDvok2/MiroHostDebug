<?php
$post_id       = get_the_ID();
$is_enabled    = techlink_core_get_post_value_through_levels( 'qodef_blog_single_enable_related_posts' );
$related_posts = techlink_core_get_custom_post_type_related_posts( $post_id, techlink_core_get_blog_single_post_taxonomies( $post_id ) );

if ( $is_enabled === 'yes' && ! empty( $related_posts ) && class_exists( 'TechLinkCoreBlogListShortcode' ) ) { ?>
	<div id="qodef-related-posts">
		<div class="qodef-related-posts-content">
			<span class="qodef-related-posts-subtitle"><?php echo esc_html__( 'D - UNCOVER WHAT drive us', 'techlink' ); ?></span>
			<div class="qodef-related-posts-title"><?php echo esc_html__( 'Related Posts', 'techlink' ); ?></div>
		</div>
		<?php
		$params = apply_filters( 'techlink_core_filter_blog_single_related_posts_params', array(
			'custom_class'        => 'qodef--no-bottom-space',
			'layout'              => 'standard',
			'images_proportion'   => 'custom',
			'custom_image_width'  => '400',
			'custom_image_height' => '292',
			'enable_share'        => 'no',
			'enable_date'         => 'no',
			'enable_category'     => 'yes',
			'enable_author'       => 'no',
			'enable_content'      => 'no',
			'enable_excerpt'      => 'no',
			'enable_button'       => 'no',
			'content_padding'     => '19px',
			'columns'             => '3',
			'posts_per_page'      => 3,
			'additional_params'   => 'tax',
			'post_ids'            => $related_posts['items'],
			'title_tag'           => 'h4',
			'excerpt_length'      => '100'
		) );
		
		echo TechLinkCoreBlogListShortcode::call_shortcode( $params ); ?>
	</div>
<?php } ?>
