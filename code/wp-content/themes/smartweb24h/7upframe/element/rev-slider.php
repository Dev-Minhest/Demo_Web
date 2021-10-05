<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 31/08/15
 * Time: 10:00 AM
 */
/************************************Main Carousel*************************************/
if(!function_exists('sv_vc_slide_revslider'))
{
    function sv_vc_slide_revslider($attr, $content = false)
    {
        $html = $css_class = '';
        extract(shortcode_atts(array(

        ),$attr));
        wp_enqueue_script('themepunch-revolution');
        wp_enqueue_script('themepunch-plugins');
        $html .=    '<div class="banner-slider">
                        <div class="rev-slider">
                            <ul>';
        $html .=                wpb_js_remove_wpautop($content, false);
        $html .=            '</ul>
                        </div>';
        $html .=    '</div>';
        return $html;
    }
}
stp_reg_shortcode('sv_slide_revslider','sv_vc_slide_revslider');
vc_map(
    array(
        'name'              => esc_html__( 'Rev Slider', 'supershop' ),
        'base'              => 'sv_slide_revslider',
        'category'          => esc_html__( '7Up-theme', 'supershop' ),
        'icon'              => 'icon-st',
        'as_parent'         => array( 'only' => 'vc_column_text,sv_rev_item' ),
        'content_element'   => false,
        'js_view'           => 'VcColumnView',
        'params'            => array(

        )
    )
);

/*******************************************END MAIN*****************************************/

/************************************ITEM CONTENT*************************************/

if(!function_exists('sv_vc_rev_item'))
{
    function sv_vc_rev_item($attr, $content = false)
    {
        $html = $css_class = '';
        extract(shortcode_atts(array(
            'image'         => '',
            'transition'    => '',
        ),$attr));
        if(!empty($image)){
            $html .=    '<li class="slide" data-transition="'.$transition.'">';
            $html .=        wp_get_attachment_image($image,'full');
            $html .=        wpb_js_remove_wpautop($content, false);
            $html .=    '</li>';
        }
        return $html;
    }
}
stp_reg_shortcode('sv_rev_item','sv_vc_rev_item');
vc_map(
    array(
        "name"              => esc_html__("Rev Item", "supershop"),
        "base"              => "sv_rev_item",
        "content_element"   => true,
        "as_parent"         => array('only' => 'sv_rev_item_content'),
        "as_child"          => array('only' => 'sv_slide_revslider'),
        "icon"              => "icon-st",
        "category"          => esc_html__( '7Up-theme', 'supershop' ),
        "params"            => array(
            array(
                "type"          => "attach_image",
                "heading"       => esc_html__("Image",'supershop'),
                "param_name"    => "image",
            ),
            array(
                "type"          => "dropdown",
                "heading"       => esc_html__("Transition",'supershop'),
                "param_name"    => "transition",
                "value"         => array(
                    esc_html__("None",'supershop')                           => '',
                    esc_html__("Slide To Top",'supershop')                   => 'slideup',
                    esc_html__("Slide To Bottom",'supershop')                => 'slidedown',
                    esc_html__("Slide To Right",'supershop')                 => 'slideright',
                    esc_html__("Slide To Left",'supershop')                  => 'slideleft',
                    esc_html__("Slide Horizonta",'supershop')                => 'slidehorizontal',
                    esc_html__("Slide Vertical",'supershop')                 => 'slidevertical',
                    esc_html__("Slide Boxes",'supershop')                    => 'boxslide',
                    esc_html__("Slide Slots Horizontal",'supershop')         => 'slotslide-horizontal',
                    esc_html__("Slide Slots Vertical",'supershop')           => 'slotslide-vertical',
                    esc_html__("Fade Boxes",'supershop')                     => 'boxfade',
                    esc_html__("Fade Slots Horizontal",'supershop')          => 'slotfade-horizontal',
                    esc_html__("Fade Slots Vertical",'supershop')            => 'slotfade-vertical',
                    esc_html__("Fade and Slide from Right",'supershop')      => 'fadefromright',
                    esc_html__("Fade and Slide from Left",'supershop')       => 'fadefromleft',
                    esc_html__("Fade and Slide from Top",'supershop')        => 'fadefromtop',
                    esc_html__("Fade and Slide from Bottom",'supershop')     => 'fadefrombottom',
                    esc_html__("Fade To Left and Fade From Right",'supershop')   => 'fadetoleftfadefromright',
                    esc_html__("Fade To Right and Fade From Left",'supershop')   => 'fadetorightfadefromleft',
                    esc_html__("Fade To Top and Fade From Bottom",'supershop')   => 'fadetotopfadefrombottom',
                    esc_html__("Fade To Bottom and Fade From Top",'supershop')   => 'fadetobottomfadefromtop',
                    esc_html__("Parallax to Right",'supershop')                  => 'parallaxtoright',
                    esc_html__("Parallax to Left",'supershop')               => 'parallaxtoleft',
                    esc_html__("Parallax to Top",'supershop')                => 'parallaxtotop',
                    esc_html__("Parallax to Bottom",'supershop')             => 'parallaxtobottom',
                    esc_html__("Zoom Out and Fade From Right",'supershop')   => 'scaledownfromright',
                    esc_html__("Zoom Out and Fade From Left",'supershop')    => 'scaledownfromleft',
                    esc_html__("Zoom Out and Fade From Top",'supershop')     => 'scaledownfromtop',
                    esc_html__("Zoom Out and Fade From Bottom",'supershop')  => 'scaledownfrombottom',
                    esc_html__("ZoomOut",'supershop')                        => 'zoomout',
                    esc_html__("ZoomIn",'supershop')                         => 'zoomin',
                    esc_html__("Zoom Slots Horizontal",'supershop')          => 'slotzoom-horizontal',
                    esc_html__("Zoom Slots Vertical",'supershop')            => 'slotzoom-vertical',
                    esc_html__("Fade",'supershop')                           => 'fade',
                    esc_html__("Random Flat",'supershop')                    => 'random-static',
                    esc_html__("Random Flat and Premium",'supershop')        => 'random',
                    )
            )
        ),
        "js_view" => 'VcColumnView'
    )
);
/**************************************END ITEM************************************/

/**************************************BEGIN ITEM************************************/
//Banner item Frontend
if(!function_exists('sv_vc_rev_item_content'))
{
    function sv_vc_rev_item_content($attr, $content = false)
    {
        $html = '';
        extract(shortcode_atts(array(
            'data_x'        => '',
            'data_y'        => '',
            'start'         => '',
            'speed'         => '',
            'end_speed'     => '',
        ),$attr));
        switch ($data_y) {
            case 'bottom':
                $el_after = 'b';
                break;

            case 'top':
                $el_after = 't';
                break;
            
            default:
                $el_after = 'l';
                break;
        }
        $html .=    '<div class="tp-caption lf'.$el_after.'" data-x="'.$data_x.'" data-y="'.$data_y.'" data-start="'.$start.'" data-speed="'.$speed.'" data-easing="easeInOutQuint" data-endspeed="'.$end_speed.'">'.wpb_js_remove_wpautop($content, false).'</div>';
        return $html;
    }
}
stp_reg_shortcode('sv_rev_item_content','sv_vc_rev_item_content');

// Banner item
vc_map(
    array(
        'name'     => esc_html__( 'Content Item', 'supershop' ),
        'base'     => 'sv_rev_item_content',
        'icon'     => 'icon-st',
        'content_element' => true,
        'as_child' => array('only' => 'sv_rev_item'),
        'params'   => array(            
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Data X', 'supershop' ),
                'param_name'  => 'data_x',
                'description' => esc_html__( 'Set X position: left, right or number.', 'supershop' ),
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Data Y', 'supershop' ),
                'param_name'  => 'data_y',
                'description' => esc_html__( 'Set Y position: top, bottom or number.', 'supershop' ),
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Time start', 'supershop' ),
                'param_name'  => 'start',
                'description' => esc_html__( 'Enter number. Unit(ms)', 'supershop' ),
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Speed', 'supershop' ),
                'param_name'  => 'speed',
                'description' => esc_html__( 'Enter number. Unit(ms)', 'supershop' ),
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Speed end', 'supershop' ),
                'param_name'  => 'end_speed',
                'description' => esc_html__( 'Enter number. Unit(ms)', 'supershop' ),
            ),
            array(
                'type'        => 'textarea_html',
                // 'holder'      => 'div',
                'heading'     => esc_html__( 'Content', 'supershop' ),
                'param_name'  => 'content',
            )
        )
    )
);

/**************************************END ITEM************************************/



//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Sv_Slide_Revslider extends WPBakeryShortCodesContainer {}
    class WPBakeryShortCode_Sv_Rev_Item extends WPBakeryShortCodesContainer {}
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Sv_Rev_Item_Content extends WPBakeryShortCode {}
}