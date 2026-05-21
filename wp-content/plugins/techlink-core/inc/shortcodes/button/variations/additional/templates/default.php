<a <?php qode_framework_class_attribute( $holder_classes ); ?> href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>" <?php qode_framework_inline_attrs( $data_attrs ); ?> <?php qode_framework_inline_style( $styles ); ?>>
    <span class="qodef-m-text-line-holder qodef--before">
		<span class="qodef-m-text-line-top"></span>
		<span class="qodef-m-text-line"></span>
		<span class="qodef-m-text-line-bottom"></span>
	</span>
    <span class="qodef-m-text"><?php echo esc_html( $text ); ?></span>
	<span class="qodef-m-text-line-holder qodef--after">
		<span class="qodef-m-text-line-top"></span>
		<span class="qodef-m-text-line"></span>
		<span class="qodef-m-text-line-bottom"></span>
	</span>
</a>