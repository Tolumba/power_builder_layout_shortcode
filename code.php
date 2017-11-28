<?php  
    /**
    * Shortcode for outputing "Power Builder" layouts where plugin is not availible
    */
    function render_builder_layout_shortcode( $atts=array() ){

        $content = '';
        $atts = shortcode_atts(
         array(
            'id' => '',
            ), $atts, 'builder_layout' 
         );

        if( '' != $atts['id'] ){
            $layout = get_post($atts['id']);

            if( $layout ){
                $content .= apply_filters( 'the_content', $layout->post_content );
            }
        }

        $outer_classes = implode( ' ', apply_filters( 'tm_builder_outer_content_class', array(
            'tm_builder_outer_content'
        ) ) );

        $inner_classes = implode( ' ', apply_filters( 'tm_builder_inner_content_class', array(
            'tm_builder_inner_content'
        ) ) );

        return sprintf(
            '<div class="%1$s" id="%2$s">
                <div class="%3$s">
                    %4$s
                </div>
            </div>',
            esc_attr( $outer_classes ),
            esc_attr( apply_filters( 'tm_builder_outer_content_id', 'tm_builder_outer_content' ) ),
            esc_attr( $inner_classes ),
            $content
        );
    }
    add_shortcode( 'builder_layout', 'render_builder_layout_shortcode' );

    add_filter( 'widget_text', 'do_shortcode' );
