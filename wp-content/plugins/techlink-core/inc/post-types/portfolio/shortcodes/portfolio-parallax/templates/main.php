<?php
$portfolio_list_image = get_post_meta( get_the_ID(), 'qodef_portfolio_list_image', true );
$has_image            = ! empty ( $portfolio_list_image ) || has_post_thumbnail();
$style                = '';

if ( $has_image ) {
	$image_url = techlink_core_get_list_shortcode_item_image_url( 'full', $portfolio_list_image );
	$style     = ! empty( $image_url ) ? 'background-image: url( ' . esc_url( $image_url ) . ')' : '';
}
?>
<article <?php post_class(); ?> <?php qode_framework_inline_style( $style ); ?>>
	<a itemprop="url" href="<?php the_permalink(); ?>"></a>
</article>
