<h5 class="qodef-info-section-title"><?php echo esc_html__( 'Information', 'techlink-core' ) ?></h5>
<div class="qodef-info-section-holder">
    <?php techlink_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/custom-fields' ); ?>
	<?php techlink_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/categories' ); ?>
	<?php techlink_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/date' ); ?>
	<?php techlink_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/tags' ); ?>
</div>

<?php if ( techlink_core_get_post_value_through_levels( 'qodef_portfolio_single_enable_social_share' ) === 'yes' ) { ?>
    <h5 class="qodef-info-section-title"><?php echo esc_html__( 'Follow us on:', 'techlink-core' ) ?></h5>
	<div class="qodef-info-section-holder">
		<?php techlink_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/social-share' ); ?>
	</div>
<?php } ?>
