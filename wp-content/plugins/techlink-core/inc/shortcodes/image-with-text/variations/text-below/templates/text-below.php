<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
    <?php techlink_core_template_part( 'shortcodes/image-with-text', 'templates/parts/background-image', '', $params ) ?>
	<?php if ( ! empty( $title ) || ! empty( $text ) ) { ?>
		<div class="qodef-m-content">
			<?php techlink_core_template_part( 'shortcodes/image-with-text', 'templates/parts/title', '', $params ) ?>
			<?php techlink_core_template_part( 'shortcodes/image-with-text', 'templates/parts/text', '', $params ) ?>
		</div>
	<?php } ?>
</div>
