<div class="qodef-e-media"  <?php qode_framework_inline_style( $this_shortcode->get_content_styles( $params ) ); ?>>

	<?php switch ( get_post_format() ) {

		case 'gallery':
			techlink_core_theme_template_part( 'blog', 'templates/parts/post-format/gallery','', $params );
			break;
		case 'video':
			techlink_core_theme_template_part( 'blog', 'templates/parts/post-format/video','', $params );
			break;
		case 'audio':
			techlink_core_theme_template_part( 'blog', 'templates/parts/post-format/audio','', $params );
			break;
		default:
			techlink_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/image','', $params );
			break;
	} ?>
</div>