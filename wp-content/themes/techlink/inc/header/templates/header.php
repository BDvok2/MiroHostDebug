<?php
// Hook to include additional content before page header
do_action( 'techlink_action_before_page_header' );
?>
<header id="qodef-page-header" <?php techlink_class_attribute( apply_filters( 'techlink_filter_header_class', array() ) ); ?>>
	<?php
	// Hook to include additional content before page header inner
	do_action( 'techlink_action_before_page_header_inner' );
	?>
	<div id="qodef-page-header-inner" <?php techlink_class_attribute( apply_filters( 'techlink_filter_header_inner_class', array(), 'default' ) ); ?>>
		<?php
		// Include module content template
		echo apply_filters( 'techlink_filter_header_content_template', techlink_get_template_part( 'header', 'templates/header-content' ) );
		?>
	</div>
	<?php
	// Hook to include additional content after page header inner
	do_action( 'techlink_action_after_page_header_inner' );
	?>
</header>
