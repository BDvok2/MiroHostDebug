<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_attrs( $data_attrs ); ?>>
	<div class="qodef-m-digit-wrapper">
		<?php techlink_core_template_part( 'shortcodes/counter', 'variations/'.$layout.'/templates/parts/digit', '', $params ) ?>
	</div>
	<div class="qodef-m-content">
		<div class="qodef-m-content-inner" <?php qode_framework_inline_style( $content_styles ); ?>>
			<?php techlink_core_template_part( 'shortcodes/counter', 'variations/'.$layout.'/templates/parts/text', '', $params ) ?>
			<?php techlink_core_template_part( 'shortcodes/counter', 'variations/'.$layout.'/templates/parts/title', '', $params ) ?>
		</div>
	</div>
</div>
