<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<?php if ( ! empty( $items ) ) { ?>
		<div class="qodef-m-bg-items">
			<?php $i = 1;
			foreach ( $items as $item ) { ?>
				<div class="qodef-m-bg-item qodef-m-bg-image"
				     data-index=<?php echo esc_attr( $i ); ?>
					<?php qode_framework_inline_style( $this_shortcode->get_image_styles( $item ) ); ?>>
				</div>
				<?php $i ++;
			} ?>
		</div>
		<div class="qodef-m-grid">
            <?php for ($i = 1; $i <= 5; $i++) : ?>
                <span class="qodef-m-grid-line"></span>
            <?php endfor; ?>
        </div>
		<div class="qodef-m-content">
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<?php $i = 1;
					foreach ( $items as $item ) { ?>
						<div class="qodef-m-item swiper-slide" data-index=<?php echo esc_attr( $i ); ?>>
							<div class="qodef-m-item-inner">
								<div class="qodef-m-item-subtitle-wrapper">
									<div class="qodef-m-item-subtitle">
										<?php echo esc_html( $item['item_subtitle'] ); ?>
									</div>
								</div>
								<div class="qodef-m-item-title-wrapper">
									<h1 class="qodef-m-item-title">
										<?php echo esc_html( $item['item_title'] ); ?>
									</h1>
								</div>
								<div class="qodef-m-item-text-wrapper">
									<div class="qodef-m-item-text">
										<?php echo esc_html( $item['item_text'] ); ?>
									</div>
								</div>
								<div class="qodef-m-item-button-wrapper">
									<?php
									$button_params = array(
										'button_layout' => 'outlined',
										'text'          => esc_html( $item['item_button_text'] ),
										'link'          => esc_url( $item['item_link'] ),
										'target'        => esc_url( $item['item_target'] )
									);

									echo TechLinkCoreButtonShortcode::call_shortcode( $button_params ); ?>
								</div>
							</div>
							<div class="qodef-m-item-number-wrapper">
                                <span class="qodef-m-item-number">
                                    <?php echo esc_attr( $i ); ?>
                                </span>
							</div>
						</div>
						<?php $i ++;
					} ?>
				</div>
			</div>
		</div>
		<div class="swiper-pagination"></div>
	<?php } ?>
</div>
