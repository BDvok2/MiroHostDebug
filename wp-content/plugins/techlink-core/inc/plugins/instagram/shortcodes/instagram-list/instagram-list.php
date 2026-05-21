<?php

if ( ! function_exists ( 'techlink_core_add_instagram_list_shortcode' ) ) {
    /**
     * Function that is adding shortcode into shortcodes list for registration
     *
     * @param array $shortcodes - Array of registered shortcodes
     *
     * @return array
     */
    function techlink_core_add_instagram_list_shortcode ( $shortcodes ) {
        if ( qode_framework_is_installed ( 'instagram' ) ) {
            $shortcodes[] = 'TechLinkCoreInstagramListShortcode';
        }

        return $shortcodes;
    }

    add_filter ( 'techlink_core_filter_register_shortcodes', 'techlink_core_add_instagram_list_shortcode' );
}

if ( class_exists ( 'TechLinkCoreShortcode' ) ) {
    class TechLinkCoreInstagramListShortcode extends TechLinkCoreShortcode
    {
        public function map_shortcode () {
            $this -> set_shortcode_path ( TECHLINK_CORE_PLUGINS_URL_PATH . '/instagram/shortcodes/instagram-list' );
            $this -> set_base ( 'techlink_core_instagram_list' );
            $this -> set_name ( esc_html__ ( 'Instagram List', 'techlink-core' ) );
            $this -> set_description ( esc_html__ ( 'Shortcode that displays instagram list', 'techlink-core' ) );
            $this -> set_category ( esc_html__ ( 'TechLink Core', 'techlink-core' ) );
            $this -> set_option ( array (
                'field_type' => 'text',
                'name'       => 'custom_class',
                'title'      => esc_html__ ( 'Custom Class', 'techlink-core' ),
            ) );
            $this -> set_option ( array (
                'field_type' => 'text',
                'name'       => 'photos_number',
                'title'      => esc_html__ ( 'Number of Photos', 'techlink-core' ),
            ) );
            $this -> set_option ( array (
                'field_type'    => 'select',
                'name'          => 'columns_number',
                'title'         => esc_html__ ( 'Number of Columns', 'techlink-core' ),
                'options'       => array (
                    '1'  => esc_html__ ( 'One', 'techlink-core' ),
                    '2'  => esc_html__ ( 'Two', 'techlink-core' ),
                    '3'  => esc_html__ ( 'Three', 'techlink-core' ),
                    '4'  => esc_html__ ( 'Four', 'techlink-core' ),
                    '5'  => esc_html__ ( 'Five', 'techlink-core' ),
                    '6'  => esc_html__ ( 'Six', 'techlink-core' ),
                    '7'  => esc_html__ ( 'Seven', 'techlink-core' ),
                    '8'  => esc_html__ ( 'Eight', 'techlink-core' ),
                    '9'  => esc_html__ ( 'Nine', 'techlink-core' ),
                    '10' => esc_html__ ( 'Ten', 'techlink-core' ),
                ),
                'default_value' => '3',
            ) );
            $this -> set_option ( array (
                'field_type'    => 'select',
                'name'          => 'space',
                'title'         => esc_html__ ( 'Padding Around Images', 'techlink-core' ),
                'options'       => techlink_core_get_select_type_options_pool ( 'items_space' ),
                'default_value' => 'small',
            ) );
            $this -> set_option ( array (
                'field_type'    => 'select',
                'name'          => 'image_resolution',
                'title'         => esc_html__ ( 'Image Resolution', 'techlink-core' ),
                'options'       => array (
                    'auto'   => esc_html__ ( 'Auto-detect (recommended)', 'techlink-core' ),
                    'thumb'  => esc_html__ ( 'Thumbnail (150x150)', 'techlink-core' ),
                    'medium' => esc_html__ ( 'Medium (306x306)', 'techlink-core' ),
                    'full'   => esc_html__ ( 'Full (640x640)', 'techlink-core' ),
                ),
                'default_value' => 'auto',
            ) );
            if ( ! class_exists ( 'SB_Instagram_Feed_Pro' ) ) {
                $this -> set_option ( array (
                    'field_type'    => 'select',
                    'name'          => 'behavior',
                    'title'         => esc_html__ ( 'List Appearance', 'techlink-core' ),
                    'options'       => techlink_core_get_select_type_options_pool ( 'list_behavior', false, array ( 'masonry', 'justified-gallery' ) ),
                    'default_value' => 'columns',
                ) );
            }
        }

        public function render ( $options, $content = null ) {
            parent ::render ( $options );

            $atts = $this -> get_atts ();

            $atts[ 'behavior' ]         = isset( $atts[ 'behavior' ] ) ? $atts[ 'behavior' ] : '';
            $atts[ 'holder_classes' ]   = $this -> get_holder_classes ( $atts );
            $atts[ 'instagram_params' ] = $this -> get_instagram_params ( $atts );
            $atts[ 'slider_attr' ]      = $this -> get_slider_data ( $atts );

            return techlink_core_get_template_part ( 'plugins/instagram/shortcodes/instagram-list', 'templates/instagram-list', $atts[ 'behavior' ], $atts );
        }

        private function get_holder_classes ( $atts ) {
            $holder_classes = $this -> init_holder_classes ();

            $holder_classes[] = 'qodef-instagram-list';
            $holder_classes[] = ( 'columns' === $atts[ 'behavior' ] ) ? 'qodef-layout--columns qodef--no-bottom-space' : '';
            $holder_classes[] = ( 'slider' === $atts[ 'behavior' ] ) ? 'qodef-layout--slider' : '';
            $holder_classes[] = ! empty( $atts[ 'space' ] ) ? 'qodef-gutter--' . $atts[ 'space' ] : '';
            $holder_classes[] = ! empty( $atts[ 'columns_number' ] ) ? 'qodef-col-num--' . $atts[ 'columns_number' ] : '';

            $holder_classes = array_merge ( $holder_classes );

            return implode ( ' ', $holder_classes );
        }

        private function get_instagram_params ( $atts ) {
            $params = array ();

            $params[ 'num' ]              = isset( $atts[ 'photos_number' ] ) && ! empty( $atts[ 'photos_number' ] ) ? $atts[ 'photos_number' ] : 6;
            $params[ 'cols' ]             = isset( $atts[ 'columns_number' ] ) && ! empty( $atts[ 'columns_number' ] ) ? $atts[ 'columns_number' ] : 3;
            $params[ 'imagepadding' ]     = 0;
            $params[ 'imagepaddingunit' ] = 'px';
            $params[ 'showheader' ]       = false;
            $params[ 'showfollow' ]       = false;
            $params[ 'showbutton' ]       = false;
            $params[ 'imageres' ]         = isset( $atts[ 'image_resolution' ] ) && ! empty( $atts[ 'image_resolution' ] ) ? $atts[ 'image_resolution' ] : 'auto';

            if ( is_array ( $params ) && count ( $params ) ) {
                foreach ( $params as $key => $value ) {
                    if ( $value !== '' ) {
                        $params[] = $key . "='" . esc_attr ( str_replace ( ' ', '', $value ) ) . "'";
                    }
                }
            }

            return implode ( ' ', $params );
        }

        private function get_slider_data ( $atts ) {
            $data = array ();

            $data[ 'slidesPerView' ] = isset( $atts[ 'columns_number' ] ) ? $atts[ 'columns_number' ] : 4;
            $data[ 'spaceBetween' ]  = isset( $atts[ 'space' ] ) ? ( techlink_core_get_space_value ( $atts[ 'space' ] ) * 2 ) : 0; // double half space for slider

            return json_encode ( $data );
        }
    }
}