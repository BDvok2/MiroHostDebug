<?php if ( has_post_thumbnail() ) {
	$images_proportion     = isset( $images_proportion ) && ! empty( $images_proportion ) ? esc_attr( $images_proportion ) : 'full';
	$custom_image_width  = isset( $custom_image_width ) && $custom_image_width !== '' ? intval( $custom_image_width ) : 0;
	$custom_image_height = isset( $custom_image_height ) && $custom_image_height !== '' ? intval( $custom_image_height ) : 0;

    $hover_image = get_post_meta( get_the_ID(), 'qodef_team_member_hover_image', true );
	?>
	<div class="qodef-e-media-image">
		<?php if ( $has_single ) { ?>
			<a itemprop="url" href="<?php the_permalink(); ?>">
		<?php } ?>
			<?php echo techlink_core_get_list_shortcode_item_image( $images_proportion, 0, $custom_image_width, $custom_image_height ); ?>
            <?php if ( !empty( $hover_image ) && 'yes' === $hover_animation ) { ?>
                <div class="qodef-e-hover-image">
                    <?php echo techlink_core_get_list_shortcode_item_image( $images_proportion, $hover_image, $custom_image_width, $custom_image_height ); ?>
                </div>
            <?php } ?>
		<?php if ( $has_single ) { ?>
			</a>
		<?php } ?>
	</div>
<?php } ?>