<article <?php post_class( 'qodef-blog-item qodef-e' ); ?>>
	<div class="qodef-e-inner">
		<?php
		// Include post media
		techlink_template_part( 'blog', 'templates/parts/post-info/media' );
		?>
		<div class="qodef-e-content">
			<div class="qodef-e-info qodef-info--top">
				<?php
				// Include post date info
				techlink_template_part( 'blog', 'templates/parts/post-info/date' );
				
				// Include post category info
				techlink_template_part( 'blog', 'templates/parts/post-info/category' );
				?>
			</div>
			<div class="qodef-e-text">
				<?php
				// Include post title
				techlink_template_part( 'blog', 'templates/parts/post-info/title', '', array( 'title_tag' => 'h1', 'title_classes' => 'qodef-h2' ) );

				// Include post content
				the_content();

				// Hook to include additional content after blog single content
				do_action( 'techlink_action_after_blog_single_content' );
				?>
			</div>
			<div class="qodef-e-info qodef-info--bottom">
				<div class="qodef-e-info-left">
					<?php
					// Include post tags info
					techlink_template_part( 'blog', 'templates/parts/post-info/tags' );
					?>
				</div>
			</div>
		</div>
	</div>
</article>
