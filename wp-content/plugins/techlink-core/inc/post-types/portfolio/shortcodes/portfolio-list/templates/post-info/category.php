<?php
$categories = wp_get_post_terms(get_the_ID(), 'portfolio-category');

if( !empty( $categories ) ) {
	$custom_category_color_class = ! empty( $this_shortcode->get_list_item_category_style( $params ) ) ? 'qodef-custom-color' : '';
?>
<div class="qodef-e-info-category <?php echo esc_attr( $custom_category_color_class ); ?>" <?php qode_framework_inline_style( $this_shortcode->get_list_item_category_style( $params ) ) ?>>
	<?php foreach ($categories as $cat) { ?>
		<a itemprop="url" class="qodef-e-category" href="<?php echo esc_url(get_term_link($cat->term_id)); ?>">
			<?php echo esc_html($cat->name); ?>
		</a>
	<?php } ?>
</div>
<?php } ?>
