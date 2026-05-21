<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
    <div class="qodef-m-holder">
        <div class="qodef-m-stripe"></div>
        <div class="qodef-m-frame-holder">
            <div class="qodef-m-frame-mobile-holder">
                <img src="<?php echo TECHLINK_CORE_ASSETS_URL_PATH . '/img/mobile-frame.png'; ?>" alt="<?php esc_attr_e( 'Mobile frame image', 'techlink-core' ); ?>">
                <div class="qodef-m-inner-frame"></div>
            </div>
        </div>
        <div class="qodef-m-frame-info qodef-m-frame-animate-out">
            <div class="qodef-m-frame-info-top">
	            <div class="qodef-m-frame-decoration"></div>
	            <div class="qodef-m-frame-content">
		            <h4 class="qodef-m-frame-title"></h4>
		            <div class="qodef-m-frame-text"></div>
	            </div>
            </div>
            <div class="qodef-m-frame-info-bottom">
	            <div class="qodef-m-frame-slide-number">01</div>
	            <div class="qodef-m-frame-slide-info">
		            <div class="qodef-m-frame-slide-tagline"></div>
		            <div class="qodef-m-frame-slide-decoration"></div>
	            </div>
            </div>
            <div class="qodef-m-frame-info-other">
				<?php if ( $enable_app_store_link == "yes" ) { ?>
                    <a itemprop="url" class="qodef-m-item-app-store-link" href="<?php echo esc_url( $app_store_link ); ?>" target="_blank">
                        <img src="<?php echo TECHLINK_CORE_ASSETS_URL_PATH . '/img/logo-app-store.png'; ?>" alt="<?php esc_attr_e( 'Apple store logo', 'techlink-core' ); ?>">
                    </a>
				<?php } ?>
				<?php if ( $enable_play_store_link == "yes" ) { ?>
                    <a itemprop="url" class="qodef-m-item-play-store-link" href="<?php echo esc_url( $play_store_link ); ?>" target="_blank">
                        <img src="<?php echo TECHLINK_CORE_ASSETS_URL_PATH . '/img/logo-play-store.png'; ?>" alt="<?php esc_attr_e( 'Play store logo', 'techlink-core' ); ?>">
                    </a>
				<?php } ?>
            </div>
        </div>
        <div class="swiper-container">
            <div class="swiper-wrapper">
				<?php if ( ! empty( $items ) ) { ?>
					<?php foreach ( $items as $item ): ?>
						<div class="swiper-slide" <?php qode_framework_inline_attr( $this_shortcode->get_slide_data( $item ), 'data-options' ); ?>>
                            <div class="qodef-m-item">
								<?php if ( isset( $item['item_image'] ) ) { ?>
									<?php echo wp_get_attachment_image( $item['item_image'], 'full' ); ?>
								<?php } ?>
                                <div class="qodef-m-item-info">
									<?php if ( isset( $item['item_title'] ) ) { ?>
                                        <span class="qodef-m-item-title"><?php echo esc_html( $item['item_title'] ); ?></span>
									<?php } ?>
	                                <?php if ( isset( $item['item_text'] ) ) { ?>
                                        <span class="qodef-m-item-text"><?php echo esc_html( $item['item_text'] ); ?></span>
									<?php } ?>
	                                <?php if ( isset( $item['item_decoration'] ) ) { ?>
		                                <span class="qodef-m-item-decoration"><?php echo wp_get_attachment_image( $item['item_decoration'], 'full' ); ?></span>
									<?php } ?>
									<?php if ( isset( $item['item_tagline'] ) ) { ?>
                                        <span class="qodef-m-item-tagline"><?php echo esc_html( $item['item_tagline'] ); ?></span>
									<?php } ?>
                                </div>
                            </div>
                        </div>
					<?php endforeach; ?>
                    <div class="swiper-slide" <?php qode_framework_inline_attr( $last_slide_data, 'data-options' ); ?>>
	                    <div class="qodef-m-contact-form-holder">
	                        <div class="qodef-m-contact-form">
	                            <div class="qodef-m-contact-form-info">
		                            <?php if ( ! empty( $contact_form_title ) || ! empty( $contact_form_subtitle ) || ! empty( $contact_form_text ) ) {
		                                $section_title_params = array(
				                            'title'             => $contact_form_title,
				                            'subtitle'          => $contact_form_subtitle,
				                            'text'              => $contact_form_text,
				                            'content_alignment' => 'center'
										);

										echo TechLinkCoreSectionTitleShortcode::call_shortcode( $section_title_params );
		                            } ?>
	                            </div>
								<?php if ( ! empty( $contact_form_id ) ) {
									echo do_shortcode( '[contact-form-7 id="' . esc_attr( $contact_form_id ) . '"]' );
								} ?>
	                        </div>
	                    </div>
                    </div>
				<?php } ?>
            </div>
	        <div class="swiper-pagination qodef-custom-pagination"></div>
        </div>
    </div>
</div>
