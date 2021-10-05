<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:00 AM
 */

if(!function_exists('s7upf_vc_tool_panel'))
{
    function s7upf_vc_tool_panel($attr)
    {
        $html = '';
        extract(shortcode_atts(array(
            'title'         => '',
            'sp_link'       => '',
            'doc_link'      => '',
            'buy_link'      => '',
            'image'         => '',
            'demos'         => '',
        ),$attr));
        $data = (array) vc_param_group_parse_atts( $demos );        
        $html .=    '<div class="widget-indexdm" id="widget_indexdm">
                        <a href="" class="dm-open dm-button" data-title="Close" data-title-close="Demos"><i class="fa fa-long-arrow-left"></i><i class="fa fa-long-arrow-right"></i></a>
                        <a href="'.esc_url($sp_link).'" target="_blank" class="dm-button dm-support" data-title="Support" data-title-close="Support"><i class="fa fa-support"></i></a>
                        <a href="'.esc_url($doc_link).'" target="_blank" class="dm-button dm-guide" data-title="Guide" data-title-close="Guide"><i class="fa fa-lightbulb-o"></i></a>
                        <div class="widget-indexdm-inner">
                            <div class="dm-header">
                                <div class="header-event">
                                    <a target="_blank" href="'.esc_url($buy_link).'">'.wp_get_attachment_image($image,array(590,300)).'</a>
                                </div>                                
                                <div class="header-description">
                                    <h2>'.$title.'</h2>
                                    <h4><span class="color2">Choose Your Demo</span></h4>
                                </div>                                
                                <div class="header-button">
                                    <a target="_blank" class="shop-button1" href="'.esc_url($buy_link).'" title="Buy Now">Buy Now</a>                  
                                </div>
                            </div>
                            <div class="dm-content clearfix">';
        if(is_array($data)){
            foreach ($data as $key => $value){
                if(isset($value['image_pre_link'])) $link_pre = $value['image_pre_link'];
                else $link_pre = '#';
                $html .=    '<div class="item-content pull-left">
                                <a class="indexdm-href" href="'.esc_url($value['link']).'" title="'.esc_attr($value['title']).'">
                                    '.wp_get_attachment_image($value['image_item'],array(170,130),0,array("data-src"=> $link_pre)).'
                                </a>
                                <h5>'.$value['title'].'</h5>
                            </div>';
            }
        }
        $html .=            '</div>
                        </div>          
                    </div>
                    <div id="indexdm_img"><div class="img-demo"></div></div>';
        return $html;
    }
}

stp_reg_shortcode('s7upf_tool_panel','s7upf_vc_tool_panel');

vc_map( array(
    "name"      => esc_html__("SV Tool Panel", 'supershop'),
    "base"      => "s7upf_tool_panel",
    "icon"      => "icon-st",
    "category"  => '7Up-theme',
    "params"    => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => esc_html__("Title",'supershop'),
            "param_name" => "title",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Support link",'supershop'),
            "param_name" => "sp_link",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Documentation",'supershop'),
            "param_name" => "doc_link",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Buy Link",'supershop'),
            "param_name" => "buy_link",
        ),
        array(
            "type" => "attach_image",
            "heading" => esc_html__("Image",'supershop'),
            "param_name" => "image",
        ),
        array(
            "type" => "param_group",
            "heading" => esc_html__("Demo List",'supershop'),
            "param_name" => "demos",
            "params"    => array(
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Title",'supershop'),
                    "param_name"    => "title",
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Link",'supershop'),
                    "param_name"    => "link",
                ),
                array(
                    "type" => "attach_image",
                    "heading" => esc_html__("Image item",'supershop'),
                    "param_name" => "image_item",
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Image preview Link",'supershop'),
                    "param_name"    => "image_pre_link",
                ),
            )
        ),
    )
));