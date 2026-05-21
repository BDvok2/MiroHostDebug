<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_attr( $data_attr, 'data-options' ); ?>>
	<div class="qodef-grid-inner clear">
		<?php
		// Include items
		techlink_core_template_part( 'blog/shortcodes/blog-showcase', 'templates/loop', '', $params ); ?>
	</div>
	<?php
	// Include global pagination from theme
	techlink_core_theme_template_part( 'pagination', 'templates/pagination', $params['pagination_type'], $params ); ?>
</div>