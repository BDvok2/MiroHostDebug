<div class="qodef-e-media">
	<?php
	switch ( get_post_format() ) {
		case 'gallery':
			techlink_template_part( 'blog', 'templates/parts/post-format/gallery' );
			break;
		case 'video':
			techlink_template_part( 'blog', 'templates/parts/post-format/video' );
			break;
		case 'audio':
			techlink_template_part( 'blog', 'templates/parts/post-format/audio' );
			break;
		default:
			techlink_template_part( 'blog', 'templates/parts/post-info/image' );
			break;
	}
	?>
</div>
