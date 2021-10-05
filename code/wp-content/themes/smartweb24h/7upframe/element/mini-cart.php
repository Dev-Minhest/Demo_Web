<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:00 AM
 */
if(class_exists("woocommerce")){
    if(!function_exists('sv_vc_mini_cart'))
    {
        function sv_vc_mini_cart($attr)
        {
            $html = $header_cart_html = '';
            extract(shortcode_atts(array(
                'style'     => 'mini-cart-3 mini-cart-5',
            ),$attr));
            switch ($style) {
                case 'mini-cart-2':
                    $header_cart_html = '<a href="'.esc_url(WC()->cart->get_cart_url()).'" class="header-mini-cart2">
                                            <span class="total-mini-cart-icon bg-color"><i class="white fa fa-shopping-basket"></i></span>
                                            <span class="total-mini-cart-item cart-item-count">0</span>
                                        </a>';
                    break;

                case 'min-cart6':
                    $header_cart_html = '<a href="'.esc_url(WC()->cart->get_cart_url()).'" class="header-mini-cart">
                                            <span class="total-mini-cart-item"><span class="cart-item-count">0</span> '.esc_html__("Item(s)","supershop").' - </span>
                                            <span class="total-mini-cart-price">'.WC()->cart->get_cart_total().'</span>
                                        </a>';
                    break;

                case 'mini-cart-05':
                    $header_cart_html = '<a href="'.esc_url(WC()->cart->get_cart_url()).'"  class="header-mini-cart3">
                                            <span class="total-mini-cart-icon"><i class="fa fa-shopping-basket"></i></span>
                                            <span class="total-mini-cart-item cart-item-count">0</span>
                                        </a>';
                    break;
                
                default:
                    $header_cart_html = '<a href="'.esc_url(WC()->cart->get_cart_url()).'" class="header-mini-cart3 header-mini-cart5">
                                            <span class="total-mini-cart-icon"></span>
                                            <span class="total-mini-cart-item cart-item-count">0</span>
                                        </a>';
                    break;
            }
            $html .=    '<div class="mini-cart '.$style.'">
                            '.$header_cart_html.'
                            <div class="content-mini-cart">
                                <h2>(<span class="cart-item-count">0</span>) '.esc_html__("ITEMS IN MY CART","supershop").'</h2>
                                <div class="mini-cart-content">'.sv_mini_cart().'</div>                    
                                <input id="num-decimal" type="hidden" value="'.get_option("woocommerce_price_num_decimals").'">
                                <input id="currency" type="hidden" value=".'.get_option("woocommerce_currency").'">
                            </div>
                        </div>';
            $show_mode = sv_check_catelog_mode();
            if($show_mode == 'on') $html = '';
            return $html;
        }
    }

    stp_reg_shortcode('sv_mini_cart','sv_vc_mini_cart');

    vc_map( array(
        "name"      => esc_html__("SV Mini Cart", 'supershop'),
        "base"      => "sv_mini_cart",
        "icon"      => "icon-st",
        "category"  => '7Up-theme',
        "params"    => array(
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Style",'supershop'),
                "param_name" => "style",
                "value"     => array(
                    esc_html__("Home 1",'supershop')   => 'mini-cart-3 mini-cart-5',
                    esc_html__("Home 4",'supershop')   => 'mini-cart-2',
                    esc_html__("Home 5",'supershop')   => 'mini-cart-05',
                    esc_html__("Home 6",'supershop')   => 'min-cart6',
                    )
            )
        )
    ));
}