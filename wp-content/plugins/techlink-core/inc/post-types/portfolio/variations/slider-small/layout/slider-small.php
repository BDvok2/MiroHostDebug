<?php
// Hook to include additional content before portfolio single item
do_action( 'techlink_core_action_before_portfolio_single_item' );
?>
<article <?php post_class( 'qodef-portfolio-single-item qodef-e' ); ?>>
    <div class="qodef-e-inner">
        <div class="qodef-e-content qodef-grid qodef-layout--template <?php echo techlink_core_get_grid_gutter_classes(); ?>">
            <div class="qodef-grid-inner clear">
                <div class="qodef-grid-item qodef-col--9">
	                <div class="qodef-media qodef-swiper-container qodef--slider">
		                <div class="swiper-wrapper">
			                <?php techlink_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/media', 'slider'); ?>
		                </div>
		                <?php techlink_core_template_part( 'content', 'templates/swiper-nav', '', array( 'slider_navigation' => 'yes' ) ); ?>
	                </div>
                </div>
                <div class="qodef-grid-item qodef-col--3">
					<?php techlink_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/content' ); ?>
                    <div class="qodef-portfolio-info">
						<?php techlink_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/holder' ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>
<?php
// Hook to include additional content after portfolio single item
do_action( 'techlink_core_action_after_portfolio_single_item' );
?>