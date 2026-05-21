<article <?php post_class( array( 'qodef-blog-item qodef-parallax',  ) ); ?>>
	<div class="qodef-e-inner">
		<?php
		// Include post media
		techlink_core_template_part( 'blog/shortcodes/blog-parallax', 'templates/post-info/image','background', $params );
		?>
		<div class="qodef-e-content">
			<div class="qodef-e-info qodef-info--top">
				<?php
				// Include post date info
				techlink_core_template_part( 'blog/shortcodes/blog-parallax', 'templates/post-info/date','', $params );
				
				// Include post category info
				techlink_core_template_part( 'blog/shortcodes/blog-parallax', 'templates/post-info/category','', $params );
				?>
			</div>
			<div class="qodef-e-text">
				<?php
				// Include post title
				techlink_core_template_part( 'blog/shortcodes/blog-parallax', 'templates/post-info/title','', $params );
				
				// Include post excerpt
				techlink_core_template_part( 'blog/shortcodes/blog-parallax', 'templates/post-info/excerpt','', $params );
				?>
			</div>
		</div>
	</div>
</article>