<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:00 AM
 */
if(!function_exists('sv_vc_payment'))
{
    function sv_vc_payment($attr, $content = false)
    {
        $html = $icon_html = '';
        extract(shortcode_atts(array(
            'title'          => '',
            'list'          => '',
            'style'         => 'payment-method',
        ),$attr));
		parse_str( urldecode( $list ), $data);
        if(is_array($data)){
            foreach ($data as $key => $value) {
                $icon_html .= '<a href="'.esc_url($value['link']).'">'.wp_get_attachment_image($value['image'],'full').'</a>';
            }
        }
        $html .=    '<div class="'.$style.' clearfix">';
        if(!empty($title)) $html .=    '<label>'.$title.'</label>';
        $html .=        $icon_html;
        $html .=    '</div>';   
		return  $html;
    }
}

stp_reg_shortcode('sv_payment','sv_vc_payment');


vc_map( array(
    "name"      => esc_html__("SV Image link", 'supershop'),
    "base"      => "sv_payment",
    "icon"      => "icon-st",
    "category"  => '7Up-theme',
    "params"    => array(
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Style",'supershop'),
            "param_name" => "style",
            "value"     => array(
                esc_html__("Payment footer",'supershop')    => 'payment-method',
                esc_html__("Partner list",'supershop')    => 'list-partner',
                )
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__( 'Title', 'supershop' ),
            'param_name'  => 'title',            
        ),
		array(
            "type" => "add_brand",
            "heading" => esc_html__("Add Image List",'supershop'),
            "param_name" => "list",
        )
    )
));