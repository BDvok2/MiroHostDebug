<?php
$excerpt = techlink_core_get_custom_post_type_excerpt( isset( $excerpt_length ) ? $excerpt_length : 0 );
	
if ( ! empty( $excerpt ) ) { ?>
	<div itemprop="description" class="qodef-e-excerpt"><?php echo esc_html( $excerpt ); ?></div>
<?php }
