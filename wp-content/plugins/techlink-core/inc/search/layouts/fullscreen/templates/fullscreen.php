<div class="qodef-fullscreen-search-holder qodef-m">
	<div class="qodef-fullscreen-inner">
		<?php techlink_core_get_opener_icon_html( array(
			'option_name'  => 'search',
			'custom_class' => 'qodef-m-close',
			'custom_icon'  => 'search'
		), false, true ); ?>
		<div class="qodef-m-inner">
			<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="qodef-m-form" method="get">
				<span class="qodef-additional-search-text"><?php echo esc_html__( 'type your search', 'techlink-core' ) ?></span>
				<input type="text" placeholder="<?php esc_attr_e( 'right business solution', 'techlink-core' ); ?>"
				       name="s" class="qodef-m-form-field" autocomplete="off" required/>
				<?php techlink_core_get_opener_icon_html( array(
					'html_tag'     => 'button',
					'option_name'  => 'search',
					'custom_icon'  => 'search',
					'custom_class' => 'qodef-m-form-submit'
				) ); ?>
				<div class="qodef-m-form-line">
                    <span class="qodef-m-form-animated-line"></span>
                    <span class="qodef-m-hidden"></span>
                </div>
			</form>
		</div>
	</div>
</div>