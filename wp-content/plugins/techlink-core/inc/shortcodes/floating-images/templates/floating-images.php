<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-m-inner">
		<div class="qodef-m-image-holder qodef-main-image-holder">
			<div class="qodef-m-image-wrapper">
				<img class="qodef-m-main-image"
					<?php echo qode_framework_get_inline_attrs( $main_image_position_data ); ?>
					<?php qode_framework_inline_style( $main_image_styles ); ?>
					 src="<?php echo wp_get_attachment_url( $main_image ); ?>"
					 alt="<?php echo get_the_title( $main_image ) ?>"/>
			</div>
		</div>
		<div class="qodef-m-image-holder qodef-aux-image-holder">
			<div class="qodef-m-image-wrapper">
				<img class="qodef-m-aux-image"
					<?php echo qode_framework_get_inline_attrs( $aux_image_position_data ); ?>
					<?php qode_framework_inline_style( $aux_image_styles ); ?>
					 src="<?php echo wp_get_attachment_url( $aux_image ); ?>"
					 alt="<?php echo get_the_title( $aux_image ) ?>"/>
			</div>
		</div>
	</div>
</div>
