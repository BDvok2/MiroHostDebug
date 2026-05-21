<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<?php techlink_core_template_part( 'shortcodes/banner', 'templates/parts/image', '', $params ) ?>
	<div class="qodef-m-content">
		<div class="qodef-m-content-inner">
			<div class="qodef-m-content-inner-2">
				<?php techlink_core_template_part( 'shortcodes/banner', 'templates/parts/background-text', '', $params ) ?>
				<?php techlink_core_template_part( 'shortcodes/banner', 'templates/parts/subtitle', '', $params ) ?>
				<?php techlink_core_template_part( 'shortcodes/banner', 'templates/parts/title', '', $params ) ?>
				<?php techlink_core_template_part( 'shortcodes/banner', 'templates/parts/text', '', $params ) ?>
			</div>
			<?php techlink_core_template_part( 'shortcodes/banner', 'templates/parts/button', '', $params ) ?>
		</div>
	</div>
</div>