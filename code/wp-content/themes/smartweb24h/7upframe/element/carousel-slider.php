<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 31/08/15
 * Time: 10:00 AM
 */
/************************************Main Carousel*************************************/
if(!function_exists('sv_vc_slide_carousel'))
{
    function sv_vc_slide_carousel($attr, $content = false)
    {
        $html = $css_class = '';
        extract(shortcode_atts(array(
            'item'      => '1',
            'speed'     => '',
            'itemres'   => '',
            'nav_slider'=> 'nav-hidden',
            'animation' => '',
            'custom_css' => '',
            'banner_bg' => '',
            'el_class' => '',
        ),$attr));
        if(!empty($custom_css)) $css_class = vc_shortcode_custom_css_class( $custom_css );
            $html .=    '<div class="wrap-slider '.esc_attr($nav_slider.' '.$banner_bg .' '.$el_class).'">';
            $html .=        '<div class="wrap-item sv-slider '.$css_class.'" data-item="'.$item.'" data-speed="'.$speed.'" data-itemres="'.$itemres.'" data-animation="'.$animation.'" data-nav="'.$nav_slider.'">';
            $html .=            wpb_js_remove_wpautop($content, false);
            $html .=        '</div>';
            $html .=    '</div>';
        return $html;
    }
}
stp_reg_shortcode('slide_carousel','sv_vc_slide_carousel');
vc_map(
    array(
        'name'     => esc_html__( 'Carousel Slider', 'supershop' ),
        'base'     => 'slide_carousel',
        'category' => esc_html__( '7Up-theme', 'supershop' ),
        'icon'     => 'icon-st',
        'as_parent' => array( 'only' => 'vc_column_text,slide_banner_item,sv_manufacture_item,sv_icon_content_item,sv_category_product_item,slide_testimonial_item' ),
        'content_element' => true,
        'js_view' => 'VcColumnView',
        'params'   => array(                       
            array(
                'heading'     => esc_html__( 'Item slider display', 'supershop' ),
                'type'        => 'textfield',
                'description' => esc_html__( 'Enter number of item. Default is 1.', 'supershop' ),
                'param_name'  => 'item',
            ),
            array(
                'heading'     => esc_html__( 'Speed', 'supershop' ),
                'type'        => 'textfield',
                'description' => esc_html__( 'Enter time slider go to next item. Unit (ms). Example 5000. If empty this field autoPlay is false.', 'supershop' ),
                'param_name'  => 'speed',
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Navigation style', 'supershop' ),
                'param_name'  => 'nav_slider',
                'value'       => array(
                    esc_html__( 'Hidden', 'supershop' )   => 'nav-hidden',
                    esc_html__( 'Default', 'supershop' )   => 'default',
                    esc_html__( 'Default Navigation', 'supershop' )   => 'banner-slider',
                    esc_html__( 'Default Pagination', 'supershop' )   => 'gift-icon-slider',
                    esc_html__( 'Navigation home 1', 'supershop' )   => 'banner-slider banner-slider1',
                    )
            ),
            array(
                'heading'     => esc_html__( 'Custom Item', 'supershop' ),
                'type'        => 'textfield',
                'description' => esc_html__( 'Enter custom item for each window 360px,480px,768px,992px. Default is auto. Example: "2,3,4,5"', 'supershop' ),
                'param_name'  => 'itemres',
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Image style', 'supershop' ),
                'param_name'  => 'banner_bg',
                'value'       => array(
                    esc_html__( 'Default', 'supershop' )                  => '',
                    esc_html__( 'Banner Background', 'supershop' )      => 'bg-slider',
                    esc_html__( 'Banner Background Parallax', 'supershop' )      => 'bg-slider parallax-slider',
                ),
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Animation', 'supershop' ),
                'param_name'  => 'animation',
                'value'       => array(
                    esc_html__( 'None', 'supershop' )        => '',
                    esc_html__( 'Fade', 'supershop' )        => 'fade',
                    esc_html__( 'BackSlide', 'supershop' )   => 'backSlide',
                    esc_html__( 'GoDown', 'supershop' )      => 'goDown',
                    esc_html__( 'FadeUp', 'supershop' )      => 'fadeUp',
                    )
            ),
            array(
                "type"          => "css_editor",
                "heading"       => esc_html__("Custom Block",'supershop'),
                "param_name"    => "custom_css",
                'group'         => esc_html__('Advanced','supershop')
            ),            
            array(
                'heading'     => esc_html__( 'Add class', 'supershop' ),
                'type'        => 'textfield',
                'param_name'  => 'el_class',
            ),
        )
    )
);

/*******************************************END MAIN*****************************************/


/**************************************BEGIN ITEM************************************/
//Banner item Frontend
if(!function_exists('sv_vc_slide_banner_item'))
{
    function sv_vc_slide_banner_item($attr, $content = false)
    {
        $html = '';
        extract(shortcode_atts(array(
            'style'     => '',
            'image'     => '',
            'link'      => '',
            'color'     => 'bg-blue',
            'info_animation'    => '',
            'info_style'        => '',
            'info_align'    => '',
            'info_transform'    => '',
        ),$attr));
        $info_class = $info_style.' '.$info_align.' '.$info_transform;
        if(!empty($image)){
            if(!empty($info_animation)) $info_class .= ' animated';
            switch ($style) {
                case 'outlet':
                    $html .=    '<div class="item">
                                    <div class="outlet-slider-thumb">
                                        <a href="'.esc_url($link).'">'.wp_get_attachment_image($image,'full').'</a>
                                    </div>
                                    <div class="outlet-slider-info" '.esc_attr($info_class).'" data-animated="'.esc_attr($info_animation).'">
                                        '.wpb_js_remove_wpautop($content, true).'
                                    </div>
                                </div>';
                    break;

                default:
                    $html .=    '<div class="item-slider '.esc_attr($style).'">
                                    <div class="banner-thumb"><a href="'.esc_url($link).'">'.wp_get_attachment_image($image,'full').'</a></div>
                                    <div class="banner-info '.esc_attr($info_class).'" data-animated="'.esc_attr($info_animation).'">
                                        '.wpb_js_remove_wpautop($content, true).'
                                    </div>
                                </div>';
                    break;
            }            
        }
        return $html;
    }
}
stp_reg_shortcode('slide_banner_item','sv_vc_slide_banner_item');

// Banner item
vc_map(
    array(
        'name'     => esc_html__( 'Banner Item', 'supershop' ),
        'base'     => 'slide_banner_item',
        'icon'     => 'icon-st',
        'content_element' => true,
        'as_child' => array('only' => 'slide_carousel'),
        'params'   => array(
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Style', 'supershop' ),
                'param_name'  => 'style',
                'value'       => array(
                    esc_html__( 'Default', 'supershop' ) => '',
                    esc_html__( 'Home 1', 'supershop' ) => 'item-slider1',
                    esc_html__( 'Home 2', 'supershop' ) => 'item-slider2',
                    esc_html__( 'Home 3', 'supershop' ) => 'item-slider3',
                    esc_html__( 'Home 4', 'supershop' ) => 'item-slider4',
                    esc_html__( 'Home 5', 'supershop' ) => 'item-slider5',
                    esc_html__( 'Home 6', 'supershop' ) => 'item-slider06',
                    )
            ),
            array(
                'type'        => 'attach_image',
                'heading'     => esc_html__( 'Image', 'supershop' ),
                'param_name'  => 'image',
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Link Banner', 'supershop' ),
                'param_name'  => 'link',
            ),
            array(
                'type' => 'animation_style',
                'heading' => esc_html__( 'Info Animation', 'supershop' ),
                'param_name' => 'info_animation',
                'admin_label' => true,
                'value' => '',
                'settings' => array(
                    'type' => 'in',
                    'custom' => array(
                        array(
                            'label' => esc_html__( 'Default', 'supershop' ),
                            'values' => array(
                                esc_html__( 'Top to bottom', 'supershop' ) => 'top-to-bottom',
                                esc_html__( 'Bottom to top', 'supershop' ) => 'bottom-to-top',
                                esc_html__( 'Left to right', 'supershop' ) => 'left-to-right',
                                esc_html__( 'Right to left', 'supershop' ) => 'right-to-left',
                                esc_html__( 'Appear from center', 'supershop' ) => 'appear',
                            ),
                        ),
                    ),
                ),
                'description' => esc_html__( 'Select type of animation for element to be animated when it enters the browsers viewport (Note: works only in modern browsers).', 'supershop' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Info Style', 'supershop' ),
                'param_name' => 'info_style',
                'value' => array(
                    esc_html__( 'None', 'supershop' )     => '',
                    esc_html__( 'Black', 'supershop' )     => 'black',
                    esc_html__( 'White', 'supershop' )     => 'white',
                    esc_html__( 'Navi', 'supershop' )     => 'navi',
                    )
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Info Align', 'supershop' ),
                'param_name' => 'info_align',
                'value' => array(
                    esc_html__( 'Default', 'supershop' )     => '',
                    esc_html__( 'Left', 'supershop' )     => 'text-left',
                    esc_html__( 'Right', 'supershop' )     => 'text-right',
                    esc_html__( 'Center', 'supershop' )     => 'text-center',
                    )
                ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Info Transform', 'supershop' ),
                'param_name' => 'info_transform',
                'value' => array(
                    esc_html__( 'Default', 'supershop' )     => '',
                    esc_html__( 'Uppercase', 'supershop' )     => 'text-uppercase',
                    )
                ),
            array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => esc_html__("Content",'supershop'),
                "param_name" => "content",
            ),
        )
    )
);

/**************************************END ITEM************************************/

/**************************************BEGIN ITEM************************************/
//Banner item Frontend
if(!function_exists('sv_vc_manufacture_item'))
{
    function sv_vc_manufacture_item($attr, $content = false)
    {
        $html = '';
        extract(shortcode_atts(array(
            'image'     => '',
            'link'      => '',
        ),$attr));
        if(!empty($image)){                
            $html .=    '<div class="item-manufacture">
                            <div class="zoom-image-thumb"><a href="'.esc_url($link).'">'.wp_get_attachment_image($image,'full').'</a></div>
                        </div>';
        }
        return $html;
    }
}
stp_reg_shortcode('sv_manufacture_item','sv_vc_manufacture_item');

// Banner item
vc_map(
    array(
        'name'     => esc_html__( 'Manufacture Item', 'supershop' ),
        'base'     => 'sv_manufacture_item',
        'icon'     => 'icon-st',
        'content_element' => true,
        'as_child' => array('only' => 'slide_carousel'),
        'params'   => array(            
            array(
                'type'        => 'attach_image',
                'heading'     => esc_html__( 'Image', 'supershop' ),
                'param_name'  => 'image',
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Link', 'supershop' ),
                'param_name'  => 'link',
            ),
        )
    )
);

/**************************************END ITEM************************************/

/**************************************BEGIN ITEM************************************/
//Banner item Frontend
if(!function_exists('sv_vc_icon_content_item'))
{
    function sv_vc_icon_content_item($attr, $content = false)
    {
        $html = '';
        extract(shortcode_atts(array(
            'icon'     => '',
        ),$attr));               
        $html .=    '<div class="item-gift-icon">
                        <span><i class="fa '.$icon.'"></i></span>
                        '.wpb_js_remove_wpautop($content, true).'
                    </div>';
        return $html;
    }
}
stp_reg_shortcode('sv_icon_content_item','sv_vc_icon_content_item');

// Banner item
vc_map(
    array(
        'name'     => esc_html__( 'Icon Content Item', 'supershop' ),
        'base'     => 'sv_icon_content_item',
        'icon'     => 'icon-st',
        'content_element' => true,
        'as_child' => array('only' => 'slide_carousel'),
        'params'   => array(
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Icon', 'supershop' ),
                'param_name'  => 'icon',                
                'edit_field_class'=>'vc_col-sm-12 vc_column sv_iconpicker'
            ),
            array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => esc_html__("Content",'supershop'),
                "param_name" => "content",
            ),
        )
    )
);

/**************************************END ITEM************************************/

/**************************************BEGIN ITEM************************************/
//Banner item Frontend
if(!function_exists('sv_vc_category_product_item'))
{
    function sv_vc_category_product_item($attr, $content = false)
    {
        $html = '';
        extract(shortcode_atts(array(
            'cat'       => '',
            'image'     => ''
        ),$attr));
        $term = get_term_by( 'slug',$cat, 'product_cat' );
        if(!empty($term) && is_object($term)){
            $term_link = get_term_link( $term->term_id, 'product_cat' );  
            $html .=    '<div class="item-pop-cat">
                            <div class="zoom-image-thumb">
                                <a href="'.esc_url($term_link).'">'.wp_get_attachment_image($image,'full').'</a>
                            </div>
                            <h2 class="pop-cat-title">'.$term->name.'</h2>
                        </div>';
        }
        return $html;
    }
}
stp_reg_shortcode('sv_category_product_item','sv_vc_category_product_item');
// Banner item
$check_add = '';
if(isset($_GET['return'])) $check_add = $_GET['return'];
if(empty($check_add)) add_action( 'vc_before_init_base','sv_admin_category_product_item',10,100 );
if ( ! function_exists( 'sv_admin_category_product_item' ) ) {
    function sv_admin_category_product_item(){
        vc_map(
            array(
                'name'     => esc_html__( 'Product Category Item', 'supershop' ),
                'base'     => 'sv_category_product_item',
                'icon'     => 'icon-st',
                'content_element' => true,
                'as_child' => array('only' => 'slide_carousel'),
                'params'   => array(
                    array(
                        'type'        => 'dropdown',
                        'holder'      => 'div',
                        'heading'     => esc_html__( 'Product Category', 'supershop' ),
                        'param_name'  => 'cat',
                        'value'       => sv_list_taxonomy('product_cat',true),
                    ),            
                    array(
                        "type" => "attach_image",
                        "heading" => esc_html__("Product image",'supershop'),
                        "param_name" => "image",
                    ),
                )
            )
        );
    }
}

/**************************************END ITEM************************************/

/**************************************BEGIN ITEM************************************/
//Testimonial Frontend
if(!function_exists('sv_vc_slide_testimonial_item'))
{
    function sv_vc_slide_testimonial_item($attr, $content = false)
    {
        $html = '';
        extract(shortcode_atts(array(
            'style'     => 'style-1',
            'image'     => '',
            'name'      => '',
            'position'  => '',
            'link'      => '#',
        ),$attr));
        if(!empty($image)){
            if($style == 'style-2'){
                $html .=    '<div class="item">
                                <div class="item-customer-saying">
                                    <div class="thumb-customer-saying">
                                        <a href="'.esc_url($link).'">'.wp_get_attachment_image($image,array(70,70)).'</a>
                                    </div>
                                    <div class="info-customer-saying">
                                        '.wpb_js_remove_wpautop($content, true).'
                                        <h3><a href="'.esc_url($link).'">'.$name.'</a></h3>
                                        <span>'.$position.'</span>
                                    </div>
                                </div>
                            </div>';
            }
            else{
                $html .=    '<div class="item">
                                <div class="testimo-item">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="testimo-content-left">
                                                '.wp_get_attachment_image($image,array(570,390),0,array('class'=>'testimo-thumb')).'
                                                <div class="info-testimo-author">
                                                    <a href="'.esc_url($link).'" class="testimo-avatar">
                                                        '.wp_get_attachment_image($image,array(150,150)).'
                                                    </a>
                                                    <h3 class="testimo-name"><a href="'.esc_url($link).'">'.$name.'</a></h3>
                                                    <p class="testimo-job">'.$position.'</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="testimo-content-right">
                                                '.wpb_js_remove_wpautop($content, true).'
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
            }
        }
        return $html;
    }
}
stp_reg_shortcode('slide_testimonial_item','sv_vc_slide_testimonial_item');

// Testimonial item
vc_map(
    array(
        'name'     => esc_html__( 'Testimonial Item', 'supershop' ),
        'base'     => 'slide_testimonial_item',
        'icon'     => 'icon-st',
        'content_element' => true,
        'as_child' => array('only' => 'slide_carousel'),
        'params'   => array(
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Style', 'supershop' ),
                'param_name'  => 'style',
                'value'       => array(
                    esc_html__( 'Style 1', 'supershop' )   => 'style-1',
                    esc_html__( 'Style 2', 'supershop' )   => 'style-2',
                    )
            ),
            array(
                'type'        => 'attach_image',
                'heading'     => esc_html__( 'Avatar', 'supershop' ),
                'param_name'  => 'image',
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Name', 'supershop' ),
                'param_name'  => 'name',
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Position', 'supershop' ),
                'param_name'  => 'position',
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Link Detail', 'supershop' ),
                'param_name'  => 'link',
            ),
            array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => esc_html__("Content",'supershop'),
                "param_name" => "content",
            ),
        )
    )
);

/**************************************END ITEM************************************/

//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Slide_Carousel extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Slide_Banner_Item extends WPBakeryShortCode {}
    class WPBakeryShortCode_Sv_Manufacture_Item extends WPBakeryShortCode {}
    class WPBakeryShortCode_Sv_Icon_Content_Item extends WPBakeryShortCode {}
    class WPBakeryShortCode_Sv_Category_Product_Item extends WPBakeryShortCode {}
    class WPBakeryShortCode_Slide_Testimonial_Item extends WPBakeryShortCode {}
}