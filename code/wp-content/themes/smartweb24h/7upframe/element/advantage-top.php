<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:00 AM
 */

if(!function_exists('sv_vc_advantage_top'))
{
    function sv_vc_advantage_top($attr,$content = false)
    {
        $html = '';
        extract(shortcode_atts(array(
            'style'      => 'home-1',
            'image'      => '',
            'image2'      => '',
            'title'      => '',
            'price_regular'      => '',
            'price_sale'      => '',
            'link'       => '',
            'time'       => '',
            'animation'  => '',
        ),$attr));
        switch ($style) {
            case 'home6-bottom':
                $html .=    '<div class="item-ads06 banner-adv '.esc_attr($animation).'">
                                <a href="'.esc_url($link).'" class="adv-thumb-link">
                                    '.wp_get_attachment_image($image,'full').'
                                    '.wp_get_attachment_image($image2,'full').'
                                </a>
                                <div class="banner-info text-uppercase style2">
                                    '.wpb_js_remove_wpautop($content, true).'
                                </div>
                            </div>';
                break;

            case 'home6-top':
                $html .=    '<div class="item-ads06 banner-adv '.esc_attr($animation).'">
                                <a href="'.esc_url($link).'" class="adv-thumb-link">
                                    '.wp_get_attachment_image($image,'full').'
                                    '.wp_get_attachment_image($image2,'full').'
                                </a>
                                <div class="banner-info text-uppercase">
                                    '.wpb_js_remove_wpautop($content, true).'
                                </div>
                            </div>';
                break;

            case 'home6':
                $html .=    '<div class="item-adv06 banner-adv '.esc_attr($animation).'">
                                <a href="'.esc_url($link).'" class="adv-thumb-link">
                                    '.wp_get_attachment_image($image,'full').'
                                    '.wp_get_attachment_image($image2,'full').'
                                </a>
                                <div class="banner-info text-center text-uppercase">
                                    '.wpb_js_remove_wpautop($content, true).'
                                </div>
                            </div>';
                break;

            case 'adv-top-countdown':
                wp_enqueue_script('timeCircles');
                if(!empty($image)) $image = SV_Assets::build_css('background-image:url('.wp_get_attachment_image_url($image,'full').');');
                $html .=    '<div class="top-toggle '.esc_attr($image).'">
                                <div class="container">
                                    <div class="inner-top-toggle">
                                        <ul class="list-inline-block">
                                            <li>
                                                <div class="top-toggle-info white text-center">
                                                    '.wpb_js_remove_wpautop($content, true).'
                                                </div>
                                            </li>
                                            <li><a href="'.esc_url($link).'" class="shop-button bg-white text-uppercase">'.esc_html__("shop now","supershop").'</a></li>
                                        </ul>';
                if(!empty($time)) $html .=    '<div class="top-toggle-coutdown time-countdown" data-date="'.esc_attr($time).'" data-text="[&quot;days&quot;,&quot;hours&quot;,&quot;minutes&quot;,&quot;seconds&quot;]" data-bg="transparent" data-color="#fff" data-width="0.04"></div>';
                $html .=                '<a href="#" class="close-top-toggle"><i class="fa fa-times"></i></a>
                                    </div>
                                </div>
                            </div>';
                break;

             case 'home5-2':
                $html .=    '<div class="banner-ads05 banner-adv '.esc_attr($animation).'">
                                <a href="'.esc_url($link).'" class="adv-thumb-link">
                                    '.wp_get_attachment_image($image,'full').'
                                    '.wp_get_attachment_image($image2,'full').'
                                </a>
                                <div class="banner-info text-center text-uppercase">
                                    '.wpb_js_remove_wpautop($content, true).'
                                </div>
                            </div>';
                break;

            case 'home5':
                $html .=    '<div class="banner-product05 banner-adv '.esc_attr($animation).'">
                                <a href="'.esc_url($link).'" class="adv-thumb-link">
                                    '.wp_get_attachment_image($image,'full').'
                                    '.wp_get_attachment_image($image2,'full').'
                                </a>
                                <div class="banner-info white text-right text-uppercase">
                                    '.wpb_js_remove_wpautop($content, true).'
                                </div>
                            </div>';
                break;

            case 'home4':
                $html .=    '<div class="mac-banner banner-adv '.esc_attr($animation).'">
                                <a href="'.esc_url($link).'" class="adv-thumb-link">
                                    '.wp_get_attachment_image($image,'full').'
                                    '.wp_get_attachment_image($image2,'full').'
                                </a>
                                <div class="banner-info text-center">
                                    '.wpb_js_remove_wpautop($content, true).'
                                </div>
                            </div>';
                break;

            case 'home3':
                $html .=    '<div class="banner-adv banner-adv3 '.esc_attr($animation).'">
                                <a href="'.esc_url($link).'" class="adv-thumb-link">
                                    '.wp_get_attachment_image($image,'full').'
                                    '.wp_get_attachment_image($image2,'full').'
                                </a>
                                <div class="banner-info white text-uppercase">
                                    '.wpb_js_remove_wpautop($content, true).'
                                </div>
                            </div>';
                break;

            case 'no-content':
                $html .=    '<div class="banner-adv '.esc_attr($animation).'">
                                <a href="'.esc_url($link).'" class="adv-thumb-link">
                                    '.wp_get_attachment_image($image,'full').'
                                    '.wp_get_attachment_image($image2,'full').'
                                </a>
                            </div>';
                break;

            case 'home2-2':
                $html .=    '<div class="support-center2 banner-adv '.esc_attr($animation).'">
                                <a href="'.esc_url($link).'" class="adv-thumb-link">
                                    '.wp_get_attachment_image($image,'full').'
                                    '.wp_get_attachment_image($image2,'full').'
                                </a>
                                <div class="banner-info white">
                                    '.wpb_js_remove_wpautop($content, true).'
                                </div>
                            </div>';
                break;

            case 'home2':
                $html .=    '<div class="item-ads2 banner-adv '.esc_attr($animation).'">
                                <a href="'.esc_url($link).'" class="adv-thumb-link">
                                    '.wp_get_attachment_image($image,'full').'
                                    '.wp_get_attachment_image($image2,'full').'
                                    <div class="banner-info text-right gray">
                                        '.wpb_js_remove_wpautop($content, true).'
                                    </div>
                                </a>
                            </div>';
                break;

            case 'mega-adv':
                $html .=    '<div class="mega-adv">
                                <div class="mega-adv-thumb zoom-image-thumb">
                                    <a href="'.esc_url($link).'">'.wp_get_attachment_image($image,'full').'</a>
                                </div>
                                <div class="mega-adv-info">
                                    '.wpb_js_remove_wpautop($content, true).'
                                </div>
                            </div>';
                break;
            
            default:
                $html .=    '<div class="banner-adv01 border">
                                <div class="banner-adv '.esc_attr($animation).'">
                                    <a href="'.esc_url($link).'" class="adv-thumb-link">
                                        '.wp_get_attachment_image($image,'full').'
                                        '.wp_get_attachment_image($image2,'full').'
                                    </a>
                                </div>
                                <div class="adv-info01 text-uppercase font-bold">
                                    <h2 class="title24"><a href="'.esc_url($link).'" class="black">'.$title.'</a></h2>
                                    <strong class="title18 color">'.$price_regular.'</strong>
                                </div>
                            </div>';
                break;
        }        
        return $html;
    }
}

stp_reg_shortcode('sv_advantage_top','sv_vc_advantage_top');

vc_map( array(
    "name"      => esc_html__("SV Advantage", 'supershop'),
    "base"      => "sv_advantage_top",
    "icon"      => "icon-st",
    "category"  => '7Up-theme',
    "params"    => array(
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Style",'supershop'),
            "param_name" => "style",
            "value" => array(
                esc_html__("Home 1",'supershop') => 'home-1',
                esc_html__("Home 2",'supershop') => 'home2',
                esc_html__("Home 2(2)",'supershop') => 'home2-2',
                esc_html__("Home 3",'supershop') => 'home3',
                esc_html__("Home 4",'supershop') => 'home4',
                esc_html__("Home 5",'supershop') => 'home5',
                esc_html__("Home 5(2)",'supershop') => 'home5-2',
                esc_html__("Home 6",'supershop') => 'home6',
                esc_html__("Home 6 - info top",'supershop') => 'home6-top',
                esc_html__("Home 6 - info bottom",'supershop') => 'home6-bottom',
                esc_html__("Adv no content",'supershop') => 'no-content',
                esc_html__("Adv top countdown",'supershop') => 'adv-top-countdown',
                esc_html__("Mega Advantage",'supershop') => 'mega-adv',
                )
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Time CountDown",'supershop'),
            "param_name" => "time",
            'description'   => esc_html__( 'EntertTime for countdown. Format is mm/dd/yyyy. Example: 12/15/2016.', 'supershop' ),
            "dependency"    => array(
                "element"       => "style",
                "value"         => array('adv-top-countdown'),
                )
        ),
        array(
            "type" => "attach_image",
            "heading" => esc_html__("Image",'supershop'),
            "param_name" => "image",
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Animation",'supershop'),
            "param_name" => "animation",
            "value"     => array(
                esc_html__("Default",'supershop')                    => '',
                esc_html__("Zoom",'supershop')                       => 'zoom-image',
                esc_html__("Zoom out",'supershop')                   => 'zoom-out',
                esc_html__("Fade out-in",'supershop')                => 'fade-out-in',
                esc_html__("Zoom Fade out-in",'supershop')           => 'zoom-image fade-out-in',
                esc_html__("Fade in-out",'supershop')                => 'fade-in-out',
                esc_html__("Zoom rotate",'supershop')                => 'zoom-rotate',
                esc_html__("Zoom rotate Fade out-in",'supershop')    => 'zoom-rotate fade-out-in',
                esc_html__("Overlay",'supershop')                    => 'overlay-image',
                esc_html__("Overlay Zoom",'supershop')               => 'overlay-image zoom-image',
                esc_html__("Zoom in Info",'supershop')               => 'ef-movies',
                esc_html__("Zoom image line",'supershop')            => 'zoom-image line-scale',
                esc_html__("Gray image line",'supershop')            => 'gray-image line-scale',
                esc_html__("Pull curtain",'supershop')               => 'pull-curtain',
                esc_html__("Pull curtain gray image",'supershop')    => 'pull-curtain gray-image',
                esc_html__("Pull curtain zoom image",'supershop')    => 'pull-curtain zoom-image',
                ),
        ),
        array(
            "type" => "attach_image",
            "heading" => esc_html__("Image fade",'supershop'),
            "param_name" => "image2",
            "dependency"    => array(
                "element"   => "animation",
                "value"   => array("zoom-out"),
                )
        ),
        array(
            "type" => "textfield",
            "holder"    => 'h4',
            "heading" => esc_html__("Title",'supershop'),
            "param_name" => "title",
            'dependency'  => array(
                'element'   => 'style',
                'value'   => array('home-1'),
                )
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Price",'supershop'),
            "param_name" => "price_regular",
            'dependency'  => array(
                'element'   => 'style',
                'value'   => array('home-1'),
                )
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Link",'supershop'),
            "param_name" => "link",
        ),
        array(
            "type" => "textarea_html",
            "holder"    => 'div',
            "heading" => esc_html__("Content",'supershop'),
            "param_name" => "content",
        )
    )
));