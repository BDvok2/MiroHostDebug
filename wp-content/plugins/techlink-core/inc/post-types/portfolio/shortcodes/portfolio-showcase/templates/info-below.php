<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<div class="qodef-e-image">
			<?php techlink_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-showcase', 'post-info/image', '', $params ); ?>
		</div>
		<div class="qodef-e-content">
			<?php techlink_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-showcase', 'post-info/category', '', $params ); ?>
			<?php techlink_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-showcase', 'post-info/title', '', $params ); ?>
		</div>
	</div>
</article>
