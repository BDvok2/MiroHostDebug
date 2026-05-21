<?php
$blog_list_image = get_post_meta( get_the_ID(), 'qodef_blog_list_image', true );
$has_image       = ! empty ( $blog_list_image ) || has_post_thumbnail();

if ( $has_image ) {
	$image_url = techlink_core_get_list_shortcode_item_image_url( 'full', $blog_list_image );
	$style     = ! empty( $image_url ) ? 'background-image: url( ' . esc_url( $image_url ) . ')' : '';
	?>
	<div class="qodef-parallax-img-holder">
		<div class="qodef-parallax-img-wrapper">
			<div class="qodef-e-media-image qodef--background qodef-parallax-img-holder" <?php qode_framework_inline_style( $style ); ?>>
				<?php echo techlink_core_get_list_shortcode_item_image( 'full', $blog_list_image ); ?>
				<a itemprop="url" href="<?php the_permalink(); ?>">
					<?php echo techlink_core_get_list_shortcode_item_image( 'full', $blog_list_image ); ?>
				</a>
			</div>
		</div>
	</div>
<?php } ?>