<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:00 AM
 */

if(!function_exists('sv_vc_process_bar'))
{
    function sv_vc_process_bar($attr)
    {
        $html = '';
        extract(shortcode_atts(array(
            'style'         => 'circle-process',
            'title'         => '100',
            'value'         => '100',
            'color1'        => '#e5e5e5',
            'color2'        => '#ffd21e',
            'value_color'   => '',
            'value_size'    => '30',
            'bg_color'      => '',
            'radius'        => '150',
            'width'         => '3',
            'height'        => '5',
            'border_radius' => '0',
            'align'         => '',
        ),$attr));
        wp_enqueue_script('pieChart');
        wp_enqueue_script('circles');
        $el_class = $css_string = $bg_class = $c_class1 = $c_class2 = $css_string2 = $line_class = $line_class2 = '';
        if(!empty($value_color)) $css_string .= 'color:'.$value_color.';';
        if(!empty($bg_color)) $bg_class = SV_Assets::build_css('background:'.$bg_color.';');
        if(!empty($value_size)) $css_string .= 'font-size:'.$value_size.'px !important;';
        if(!empty($css_string)) $el_class = SV_Assets::build_css($css_string);
        if(!empty($color1)) $c_class1 = SV_Assets::build_css('background-color: '.$color1.';fill: '.$color1.';');
        if(!empty($color2)) $c_class2 = SV_Assets::build_css('background-color: '.$color2.';fill: '.$color2.';');
        if(!empty($height)) $css_string2 .= 'height:'.$height.'px;';
        $css_string2 .= 'border-radius:'.$border_radius.'px;';
        if(!empty($color1)) $css_string2 .= 'background:'.$color1.' !important;';
        if(!empty($css_string2)) $line_class = SV_Assets::build_css($css_string2);
        if(!empty($color2)) $line_class2 = SV_Assets::build_css('background:'.$color2.' !important;');
        $num = uniqid();
        switch ($style) {
            case 'line-title':
                $html .=    '<div class="item-progressbar processbar-title '.$align.'">
                                <div class="process-intro clearfix"><label class="pull-left">'.$title.'</label> <span class="pull-right">'.$value.'%</span></div>
                                <div class="hidden"></div>
                                <div class="line-progressbar '.$line_class.'" id="'.$num.'" data-value="'.$value.'" data-class="'.$line_class2.'"></div>
                            </div>';
                break;

            case 'line-process':
            $html .=    '<div class="item-progressbar '.$align.'">
                            <label class="'.$el_class.'">100%</label>
                            <div class="line-progressbar '.$line_class.'" id="'.$num.'" data-value="'.$value.'" data-class="'.$line_class2.'"></div>
                        </div>';
            break;

            case 'pie-chart':
            $value2 = 100 - (int)$value;
                $html .=    '<div class="sv-pie-chart" id="'.$num.'" data-color1="'.$c_class1.'" data-color2="'.$c_class2.'">
                                <input type="hidden" class="pieChart" value="'.$value.'">
                                <input type="hidden" class="pieChart" value="'.$value2.'">
                            </div>
                            <div id="target_'.$num.'" class="pie-chart"></div>';
                break;
            
            default:
                
        $html .= '<div class="'.$style.' '.$bg_class.'" id="chart-'.$num.'" data-color1="'.$color1.'" data-color2="'.$color2.'" data-value="'.$value.'" data-radius="'.$radius.'" data-width="'.$width.'" data-class="'.$el_class.'"></div>';
                break;
        }
        return $html;
    }
}

stp_reg_shortcode('sv_process_bar','sv_vc_process_bar');

vc_map( array(
    "name"      => esc_html__("SV Process Bar", 'supershop'),
    "base"      => "sv_process_bar",
    "icon"      => "icon-st",
    "category"  => '7Up-theme',
    "params"    => array(
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => esc_html__("Style",'supershop'),
            "param_name" => "style",
            "value"     => array(
                esc_html__("Circle",'supershop')  => 'circle-process',
                esc_html__("Pie Chart",'supershop')  => 'pie-chart',
                esc_html__("Line",'supershop')  => 'line-process',
                esc_html__("Line title",'supershop')  => 'line-title',
                )
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => esc_html__("Title",'supershop'),
            "param_name" => "title",
            "dependency"    => array(
                "element"   => 'style',
                "value"   => 'line-title',
                )
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => esc_html__("Value",'supershop'),
            "param_name" => "value",
            'description' => esc_html__( 'Enter number 1~100. Default is 100', 'supershop' ),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Radius",'supershop'),
            "param_name" => "radius",
            'description' => esc_html__( 'Enter number. Default is 150', 'supershop' ),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Width",'supershop'),
            "param_name" => "width",
            'description' => esc_html__( 'Enter number. Default is 3', 'supershop' ),
        ),
        array(
            "type" => "colorpicker",
            "heading" => esc_html__("Color 1",'supershop'),
            "param_name" => "color1",
            'description' => esc_html__( 'Default is #e5e5e5', 'supershop' ),
        ),
        array(
            "type" => "colorpicker",
            "heading" => esc_html__("Color 2",'supershop'),
            "param_name" => "color2",
            'description' => esc_html__( 'Default is #ffd21e', 'supershop' ),
        ),
        array(
            "type" => "colorpicker",
            "heading" => esc_html__("Value Color",'supershop'),
            "param_name" => "value_color",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Value Size",'supershop'),
            "param_name" => "value_size",
            'description' => esc_html__( 'Default is 30. Unit(px)', 'supershop' ),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Height",'supershop'),
            "param_name" => "height",
            'description' => esc_html__( 'Default is 5. Unit(px)', 'supershop' ),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Border Radius",'supershop'),
            "param_name" => "height",
            'description' => esc_html__( 'Default is 0. Unit(px)', 'supershop' ),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Align",'supershop'),
            "param_name" => "align",
            "value"     => array(
                esc_html__("Default",'supershop')    => '',
                esc_html__("Pull left",'supershop')    => 'pull-left',
                esc_html__("Pull right",'supershop')    => 'pull-right',
                )
        ),
        array(
            "type" => "colorpicker",
            "heading" => esc_html__("Background Color",'supershop'),
            "param_name" => "bg_color",
        ),
    )
));