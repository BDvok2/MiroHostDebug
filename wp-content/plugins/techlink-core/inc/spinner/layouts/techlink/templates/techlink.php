<?php
    $text = techlink_core_get_post_value_through_levels( 'qodef_page_spinner_text' );
?>

<div class="qodef-m-techlink">
    <div class="qodef-m-svg-image">
        <?php techlink_render_svg_icon( 'preloader' ); ?>
    </div>
    <div class="qodef-m-text"><?php echo esc_html( $text ); ?></div>
</div>