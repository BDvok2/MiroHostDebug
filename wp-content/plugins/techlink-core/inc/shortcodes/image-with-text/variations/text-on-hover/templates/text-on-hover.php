<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<?php techlink_core_template_part( 'shortcodes/image-with-text', 'templates/parts/image', '', $params ) ?>
	<div class="qodef-m-content">
		<div class="qodef-m-content-inner">
			<?php techlink_core_template_part( 'shortcodes/image-with-text', 'templates/parts/title', '', $params ) ?>
			<?php techlink_core_template_part( 'shortcodes/image-with-text', 'templates/parts/text', '', $params ) ?>
		</div>
		<div class="qodef-m-content-inner-2">
			<?php techlink_core_render_svg_icon( 'slider-arrow-right-alt' ); ?>
		</div>
        <?php techlink_core_template_part( 'shortcodes/image-with-text', 'templates/parts/link', '', $params ) ?>
	</div>
</div>
