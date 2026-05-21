<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<?php techlink_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/image', 'background', $params ); ?>
		<div class="qodef-e-content">
			<div class="qodef-e-info qodef-info--top">
				<?php
				// Include post date info
				techlink_core_theme_template_part( 'blog', 'templates/parts/post-info/date' );
				
				// Include post category info
				techlink_core_theme_template_part( 'blog', 'templates/parts/post-info/category' );
				?>
			</div>
			
			<?php
			// Include post title
			techlink_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/title', '', $params );
			
			// Include post excerpt
			techlink_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/excerpt', '', $params );
			
			// Include post read more
			techlink_core_theme_template_part( 'blog', 'templates/parts/post-info/read-more' );
			?>
		</div>
		<?php techlink_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/link' ); ?>
	</div>
</article>
