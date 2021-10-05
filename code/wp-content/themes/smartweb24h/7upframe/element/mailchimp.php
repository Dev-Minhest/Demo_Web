<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 26/12/15
 * Time: 10:00 AM
 */

if(!function_exists('sv_vc_mailchimp'))
{
    function sv_vc_mailchimp($attr)
    {
        $html = '';
        extract(shortcode_atts(array(
            'title'    => '',
            'des'      => '',
            'submit'    => '',
            'form_id'    => '',
            'style'      => 'newsletter-form',
        ),$attr));
        $placeholder = esc_html__("Enter Your Email...","supershop");
        $form_html = apply_filters('sv_remove_autofill',do_shortcode('[mc4wp_form id="'.$form_id.'"]'));
        switch ($style) {
            case 'newsletter2':
                $html .=    '';
                break;
            
            default:
                $html .=    '<div class="sv-mailchimp-form '.$style.'" data-placeholder="'.$placeholder.'" data-submit="'.$submit.'">
                                <label>'.$title.'</label>
                                '.$form_html.'
                            </div>';
                break;
        }        
        return $html;
    }
}

stp_reg_shortcode('sv_mailchimp','sv_vc_mailchimp');

vc_map( array(
    "name"      => esc_html__("SV MailChimp", 'supershop'),
    "base"      => "sv_mailchimp",
    "icon"      => "icon-st",
    "category"  => '7Up-theme',
    "params"    => array(
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Style",'supershop'),
            "param_name" => "style",
            "value"     => array(
                esc_html__("Normal",'supershop')    => 'newsletter-form',
                esc_html__("Home 6",'supershop')    => 'newsletter-footer newsletter-footer3',
                )
        ),
        array(
            "type" => "textfield",
            'holder'      => 'div',
            "heading" => esc_html__("Title",'supershop'),
            "param_name" => "title",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Submit Label",'supershop'),
            "param_name" => "submit",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Form ID",'supershop'),
            "param_name" => "form_id",
        )
    )
));