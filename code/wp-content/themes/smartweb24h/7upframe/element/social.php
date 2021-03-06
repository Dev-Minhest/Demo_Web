<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:00 AM
 */
if(!function_exists('sv_vc_social'))
{
    function sv_vc_social($attr, $content = false)
    {
        $html = $icon_html = '';
        extract(shortcode_atts(array(
            'style'         => '',
            'title'         => '',
            'list'          => '',
            'align'         => 'text-left',
        ),$attr));
		parse_str( urldecode( $list ), $data);
        if(is_array($data)){
            foreach ($data as $key => $value) {
                $icon_html .= '<li><a href="'.esc_url($value['link']).'">'.wp_get_attachment_image($value['image'],'full').'</a></li>';
            }
        }
        switch ($style) {
            case 'home-2':
                $html .=    '<div class="social-home2 social-network '.$align.'">';
                if(!empty($title)) $html .= '<h2>'.$title.'</h2>';
                $html .=        '<ul>';
                $html .=            $icon_html;
                $html .=        '</ul>';
                $html .=    '</div>'; 
                break;
            
            default:
                $html .=    '<div class="social-footer social-network '.$align.'">';
                if(!empty($title)) $html .= '<label>'.$title.'</label>';
                $html .=        '<ul>';
                $html .=            $icon_html;
                $html .=        '</ul>';
                $html .=    '</div>'; 
                break;
        }          
		return  $html;
    }
}

stp_reg_shortcode('sv_social','sv_vc_social');


vc_map( array(
    "name"      => esc_html__("SV Social", 'supershop'),
    "base"      => "sv_social",
    "icon"      => "icon-st",
    "category"  => '7Up-theme',
    "params"    => array(
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Style",'supershop'),
            "param_name" => "style",
            "value"     => array(
                esc_html__("Normal",'supershop')    => '',
                esc_html__("Home 2",'supershop')    => 'home-2',
                )
        ),
        array(
            'type'        => 'textfield',
            'holder'      => 'div',
            'heading'     => esc_html__( 'Title', 'supershop' ),
            'param_name'  => 'title',
        ),
        array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Align', 'supershop' ),
			'value' => array(
				esc_html__( 'Align Left', 'supershop' ) => 'text-left',
				esc_html__( 'Align Center', 'supershop' ) => 'text-center',
				esc_html__( 'Align Right', 'supershop' ) => 'text-right',
			),
			'param_name' => 'align',
			'description' => esc_html__( 'Select social layout', 'supershop' ),
		),
		array(
            "type" => "add_brand",
            "heading" => esc_html__("Add Social List",'supershop'),
            "param_name" => "list",
        )
    )
));