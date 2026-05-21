<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<?php
		// Include post media
		if ( $enable_media !== 'no' ) {
			techlink_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/media', '', $params );
		}
		?>
		<div class="qodef-e-content">
			<div class="qodef-e-info qodef-info--top">
				<?php
				// Include post date info
				if ( $enable_date !== 'no' ) {
					techlink_core_theme_template_part( 'blog', 'templates/parts/post-info/date' );
				}
				
				// Include post category info
				if ( $enable_category !== 'no' ) {
					techlink_core_theme_template_part( 'blog', 'templates/parts/post-info/category' );
				}
				?>
			</div>
			<div class="qodef-e-text">
				<?php
				// Include post title
				techlink_core_theme_template_part( 'blog', 'templates/parts/post-info/title', '', array( 'title_tag' => $title_tag ) );
				
				// Include post excerpt
				if ( $enable_excerpt !== 'no' ) {
					techlink_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/excerpt', '', $params );
				}
				
				// Hook to include additional content after blog single content
				if ( $enable_content !== 'no' ) {
					do_action( 'techlink_action_after_blog_single_content' );
				}
				?>
			</div>
			<div class="qodef-e-info qodef-info--bottom">
				<div class="qodef-e-info-left">
					<?php
					// Include post read more
					if ( $enable_button !== 'no' ) {
						techlink_core_theme_template_part( 'blog', 'templates/parts/post-info/read-more' );
					}
					?>
				</div>
			</div>
		</div>
	</div>
</article>
