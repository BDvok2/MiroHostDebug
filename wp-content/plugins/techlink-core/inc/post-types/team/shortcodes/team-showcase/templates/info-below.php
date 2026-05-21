<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<div class="qodef-e-image">
			<?php techlink_core_list_sc_template_part( 'post-types/team/shortcodes/team-showcase', 'post-info/image', '', $params ); ?>
		</div>
		<div class="qodef-e-content">
			<?php techlink_core_list_sc_template_part( 'post-types/team/shortcodes/team-showcase', 'post-info/role', '', $params ); ?>
			<?php techlink_core_list_sc_template_part( 'post-types/team/shortcodes/team-showcase', 'post-info/title', '', $params ); ?>
			<?php techlink_core_list_sc_template_part( 'post-types/team/shortcodes/team-showcase', 'post-info/social-icons', '', $params ); ?>
		</div>
	</div>
</article>