<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-m-inner">
		<div class="qodef-m-inner-2" <?php qode_framework_inline_style( $inner_styles ); ?>>
			<?php techlink_core_template_part( 'shortcodes/pricing-table', 'templates/parts/price', '', $params ) ?>
			<?php techlink_core_template_part( 'shortcodes/pricing-table', 'templates/parts/subtitle', '', $params ) ?>
			<?php techlink_core_template_part( 'shortcodes/pricing-table', 'templates/parts/title', '', $params ) ?>
			<?php techlink_core_template_part( 'shortcodes/pricing-table', 'templates/parts/content', '', $params ) ?>
		</div>
		<?php techlink_core_template_part( 'shortcodes/pricing-table', 'templates/parts/button', '', $params ) ?>
	</div>
</div>