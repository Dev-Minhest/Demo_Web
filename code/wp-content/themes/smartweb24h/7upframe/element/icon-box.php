<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:00 AM
 */
if(!function_exists('s7upf_vc_icon_box'))
{
    function s7upf_vc_icon_box($attr)
    {
        $html = '';
        extract(shortcode_atts(array(
            'style'      => '',
            'icon'      => '',
            'title'      => '',
            'des'        => '',
            'des2'        => '',
            'link'       => '',
        ),$attr));
        switch ($style) {
            case 'active item-active':
            case 'server-home6':
                $html .=    '<a href="'.esc_url($link).'" class="item-hover-active '.esc_attr($style).' item-service06 bg-color">
                                <ul class="list-inline-block white">
                                    <li><span class="title60"><i class="fa '.esc_attr($icon).'"></i></span></li>
                                    <li>
                                        <h3 class="title14 font-bold text-uppercase">'.esc_html($title).'</h3>
                                        <p class="desc white">'.esc_html($des).'</p>
                                    </li>
                                </ul>
                            </a>';
                break;

            case 'home2':
                $html .=    '<div class="text-center wrap-call-canter03">
                                <div class="call-center03 white inline-block text-left">
                                    <span class="title24"><i class="fa '.esc_attr($icon).'"></i></span>
                                    <h3 class="title14"><i>'.esc_html($title).'</i></h3>
                                    <h2 class="title18">'.esc_html($des).'</h2>
                                </div>
                            </div>';
                break;

            case 'server-home1':
                $html .=    '<a href="'.esc_url($link).'" class="item-privacy-shipping">
                                <ul>
                                    <li><i class="fa '.esc_attr($icon).'"></i></li>
                                    <li>
                                        <h2>'.esc_html($title).'</h2>
                                        <span>'.esc_html($des).'</span>
                                    </li>
                                </ul>
                            </a>';
                break;
            
            default:
                $html .=    '<div class="item-service02">
                                <div class="service-thumb"><a href="'.esc_url($link).'" class="color title30"><i class="fa '.esc_attr($icon).'"></i></a></div>
                                <div class="service-info">
                                    <h2 class="title18 text-uppercase">'.esc_html($title).'</h2>
                                    <p class="desc">'.esc_html($des).'</p>
                                    <i class="silver">'.esc_html($des2).'</i>
                                </div>
                            </div>';
                break;
        }
        
        return $html;
    }
}

stp_reg_shortcode('s7upf_icon_box','s7upf_vc_icon_box');

vc_map( array(
    "name"      => esc_html__("SV Icon Box", 'supershop'),
    "base"      => "s7upf_icon_box",
    "icon"      => "icon-st",
    "category"  => '7Up-theme',
    "params"    => array(
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Style",'supershop'),
            "param_name" => "style",
            "value"     => array(
                esc_html__("Default",'supershop')   => '',
                esc_html__("Service home 1",'supershop')   => 'server-home1',
                esc_html__("Home 2",'supershop')   => 'home2',
                esc_html__("Service home 6",'supershop')   => 'server-home6',
                esc_html__("Service home 6 - active",'supershop')   => 'active item-active',
                )
        ),
        array(
            'type'          => 'iconpicker',
            'heading'       => esc_html__( 'Icon', 'supershop' ),
            'param_name'    => 'icon',
            'value'         => '',
            'settings'      => array(
                'emptyIcon'     => true,
                'iconsPerPage'  => 4000,
            ),
            'description'   => esc_html__( 'Select icon from library.', 'supershop' ),
        ),
        array(
            "type" => "textfield",
            "holder" => "h4",
            "heading" => esc_html__("Title",'supershop'),
            "param_name" => "title",
        ),
        array(
            "holder" => "p",
            "type" => "textfield",
            "heading" => esc_html__("Description",'supershop'),
            "param_name" => "des",
        ),
        array(
            "holder" => "p",
            "type" => "textfield",
            "heading" => esc_html__("Description 2",'supershop'),
            "param_name" => "des2",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Link",'supershop'),
            "param_name" => "link",
        ),
    )
));