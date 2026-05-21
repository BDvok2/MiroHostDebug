<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-m-items">
		<?php foreach ( $items as $item ) { ?>
			<div class="qodef-m-item qodef-e">
				<?php if ( ! empty( $item['item_location'] ) || ! empty( $item['item_date'] ) ) { ?>
					<div class="qodef-e-info">
						<?php if ( ! empty( $item['item_location'] ) ) { ?>
							<span class="qodef-e-location"><?php echo esc_html( $item['item_location'] ); ?></span>
						<?php }
						if ( ! empty( $item['item_date'] ) ) { ?>
							<span class="qodef-e-date"><?php echo esc_html( $item['item_date'] ); ?></span>
						<?php } ?>
					</div>
				<?php }
				if ( ! empty( $item['item_title'] ) ) { ?><h4
						class="qodef-e-title"><?php echo esc_html( $item['item_title'] ); ?></h4>
				<?php }
				if ( ! empty( $item['item_description'] ) ) { ?>
					<div class="qodef-e-description"><?php echo esc_html( $item['item_description'] ); ?></div>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
</div>