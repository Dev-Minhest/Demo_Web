<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:00 AM
 */
// Start at 16/6/2016
if(!function_exists('s7upf_vc_menu_meta'))
{
    function s7upf_vc_menu_meta($attr)
    {
        $html = '';
        extract(shortcode_atts(array(
            'style'        => '',
            'logo_img'        => '',
            'check_list'        => '',
            'menu'              => '',
            'position'          => '',
            'placeholder'       => esc_html__("Search...","supershop"),
        ),$attr));
        $check_array = explode(',', $check_list);
        switch ($style) {
            case 'home3':
                $html .=    '<ul class="list-inline-block nav-logo03">';
                if(!empty($logo_img)){
                    $html .=    '<li>
                                    <div class="logo logo3">
                                        <h1 class="hidden">'.get_bloginfo('name', 'display').'</h1>
                                        <a href="'.esc_url(get_home_url('/')).'">'.wp_get_attachment_image($logo_img,'full').'</a>
                                    </div>
                                </li>';
                }
                if(in_array('menu', $check_array)){
                    $html .=    '<li>
                                    <div class="home-nav03">
                                        <a href="#" class="toggle-menu-button"><span></span></a>
                                        <div class="toggle-nav3">
                                            <nav class="main-nav menu-toggle03">';
                        ob_start();
                        wp_nav_menu( array(
                            'menu'          => $menu,
                            'container'     => false,
                            'menu_class'    => '',
                            'walker'        => new SV_Walker_Nav_Menu(),
                        ));
                    $html .= @ob_get_clean();
                    $html .=                '</nav>';
                    if(in_array('search', $check_array)){
                        $search_val = get_search_query();
                        if(!empty($search_val)) $search_val = $placeholder;
                        ob_start();?>
                            <form class="search-form03" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
                                <input name="s" type="text" value="<?php echo esc_attr($search_val);?>" placeholder="<?php echo esc_attr($placeholder)?>">
                                <input type="submit" value="">
                                <input type="hidden" name="post_type" value="product" />
                            </form>
                        <?php
                        $html .=        ob_get_clean();
                    }
                    $html .=            '</div>
                                    </div>
                                </li>';
                }
                $html .=    '</ul>';
                break;
            
            default:
                $html .=    '<ul class="list-inline-block search-cart2 '.esc_attr($position).'">';
                if(in_array('menu', $check_array)){
                    $html .=    '<li>
                                    <div class="home-nav2 dropdown-box">
                                        <a href="#" class="dropdown-link title18 white"><i class="fa fa-navicon"></i></a>';
                        ob_start();
                        wp_nav_menu( array(
                            'menu'          => $menu,
                            'container'     => false,
                            'menu_class'    => 'list-none dropdown-list',
                            'walker'        => new SV_Walker_Nav_Menu(),
                        ));
                    $html .= @ob_get_clean();
                    $html .=        '</div>
                                </li>';
                }
                if(in_array('search', $check_array)){
                    $search_val = get_search_query();
                    if(!empty($search_val)) $search_val = $placeholder;
                    ob_start();?>
                        <form class="search-hover2" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
                            <input name="s" type="text" value="<?php echo esc_attr($search_val);?>" placeholder="<?php echo esc_attr($placeholder)?>">
                            <input type="submit" value="">
                            <input type="hidden" name="post_type" value="product" />
                        </form>
                    <?php
                    $html .=        '<li>
                                        '.ob_get_clean().'
                                    </li>';
                }
                if(in_array('cart', $check_array)){
                    $html .=    '<li><div class="mini-cart mini-cart02">
                                    <a href="'.esc_url(WC()->cart->get_cart_url()).'" class="header-mini-cart3">
                                        <span class="total-mini-cart-icon"></span>
                                        <span class="total-mini-cart-item cart-item-count">0</span>
                                    </a>';
                    $html .=        '<div class="content-mini-cart">
                                        <h2>(<span class="cart-item-count">0</span>) '.esc_html__("ITEMS IN MY CART","supershop").'</h2>
                                        <div class="mini-cart-content">'.sv_mini_cart().'</div>                    
                                        <input id="num-decimal" type="hidden" value="'.get_option("woocommerce_price_num_decimals").'">
                                        <input id="currency" type="hidden" value=".'.get_option("woocommerce_currency").'">
                                    </div>';
                    $html .=    '</div></li>';
                }
                $html .=        '</ul>';
                break;
        }        
        return $html;
    }
}

stp_reg_shortcode('sv_menu_meta','s7upf_vc_menu_meta');

vc_map( array(
    "name"      => esc_html__("SV menu meta", 'supershop'),
    "base"      => "sv_menu_meta",
    "icon"      => "icon-st",
    "category"  => '7Up-theme',
    "params"    => array(
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Style', 'supershop' ),
            'param_name' => 'style',
            'value' =>  array(
                esc_html__("Default",'supershop')   => '',
                esc_html__("Home 3",'supershop')    => 'home3',
                )
        ),
        array(
            "type" => "attach_image",
            "heading" => esc_html__("Logo image",'supershop'),
            "param_name" => "logo_img",
            "dependency"    => array(
                "element"     => 'style',
                "value"     => 'home3',
                )
        ),
        array(
            "type" => "checkbox",
            "holder" => "div",
            "heading" => esc_html__("Box Display",'supershop'),
            "param_name" => "check_list",
            "value"     => array(
                esc_html__("Menu",'supershop')   => 'menu',
                esc_html__("Search",'supershop')    => 'search',
                esc_html__("Mini Cart",'supershop') => 'cart',
                )
        ),
        array(
            'type' => 'dropdown',
            'holder' => 'div',
            'heading' => esc_html__( 'Menu name', 'supershop' ),
            'param_name' => 'menu',
            'value' => sv_list_menu_name(),
            'description' => esc_html__( 'Select Menu name to display', 'supershop' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Position', 'supershop' ),
            'param_name' => 'position',
            'value' =>  array(
                esc_html__("None",'supershop')   => '',
                esc_html__("Left",'supershop')    => 'pull-left',
                esc_html__("Right",'supershop') => 'pull-right',
                )
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => esc_html__("Place holder input search form",'supershop'),
            "param_name" => "placeholder",
        ),
    )
));