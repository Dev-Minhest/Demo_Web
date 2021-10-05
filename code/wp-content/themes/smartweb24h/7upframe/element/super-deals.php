<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:00 AM
 */
if(class_exists("woocommerce")){
if(!function_exists('sv_vc_super_deals'))
{
    function sv_vc_super_deals($attr)
    {
        $html = $view_html = '';
        extract(shortcode_atts(array(
            'style'      => 'home-1',
            'title'      => '',
            'des'        => '',
            'adv_link'   => '',
            'time'       => '',
            'time2'       => '',
            'cats'       => '',
            'number'     => '',
            'item'          => '',
            'item_res'      => '',
            'speed'         => '',
            'size'          => '',
        ),$attr));
        if(!empty($cats)) $cats = str_replace(' ', '', $cats);
        if(!empty($size)) $size = explode('x', $size);
        wp_enqueue_script('timeCircles');        
        $args = array(
            'post_type'=>'product',
            'posts_per_page'    =>$number,
            'meta_query'        => array(
                'relation'      => 'OR',
                array( // Simple products type
                    'key'           => '_sale_price',
                    'value'         => 0,
                    'compare'       => '>',
                    'type'          => 'numeric'
                ),
                array( // Variable products type
                    'key'           => '_min_variation_sale_price',
                    'value'         => 0,
                    'compare'       => '>',
                    'type'          => 'numeric'
                )
            )
        );
        if(!empty($cats)) {
            $custom_list = explode(",",$cats);
            $args['tax_query'][]=array(
                'taxonomy'=>'product_cat',
                'field'=>'slug',
                'terms'=> $custom_list
            );
        }
        $query = new WP_Query($args);
        $count_query = $query->post_count;
        $count = 1;
        $date_to = $time;
        switch ($style) {
            case 'home5':
                if(empty($item) && empty($item_res)) $item_res = '0:1,568:2,768:1';
                if(empty($item)) $item = 1;
                if(empty($size)) $size = array(300,360);
                $curren_time = getdate();
                $time2 = explode(':', $time2);
                $hours = $min = 0;
                if(isset($time2[0])) $hours = (int)$time2[0];
                if(isset($time2[1])) $min = (int)$time2[1];
                $data_h = $hours - $curren_time['hours'];
                $data_m = $min - $curren_time['minutes'];
                $data_time = $data_h*3600+$data_m*60+60-$curren_time['seconds'];
                $html .=    '<div class="hot-deal05">';
                if(!empty($title)){
                    $html .=        '<div class="block-title05">
                                        <h2 class="title14 font-bold text-uppercase bg-color white inline-block">'.$title.'</h2>
                                    </div>';
                }
                $html .=        '<div class="hot-deal-slider05 arrow-style05">
                                    <div class="wrap-item smart-slider" data-item="'.esc_attr($item).'" data-speed="'.esc_attr($speed).'" data-itemres="'.esc_attr($item_res).'" data-prev="" data-next="" data-pagination="" data-navigation="true">';
                if($query->have_posts()) {
                    while($query->have_posts()) {
                        $query->the_post();
                        $html .=    '<div class="item-hotdeal">';
                        if(!empty($time2)){
                            $html .=    '<div class="hotdeal5">
                                            <span>'.esc_html__("Ends in:","supershop").'</span>
                                            <div class="countdown-master flip-clock-wrapper" data-time="'.esc_attr($data_time).'"></div>
                                        </div>';
                        }
                        $html .=        sv_product_thumb_hover($size).'
                                        <div class="product-info5">
                                            <h3 class="title-product"><a href="'.esc_url(get_the_permalink()).'">'.get_the_title().'</a></h3>
                                            <ul>
                                                <li>
                                                    '.sv_get_product_price().'
                                                </li>
                                                <li>
                                                    '.sv_get_saleoff_html('home5').'
                                                </li>
                                                <li>
                                                    <span class="count-order">'.get_post_meta(get_the_iD(),'total_sales',true).' '.esc_html__("Order","supershop").'</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>';
                    }
                }
                $html .=            '</div>
                                </div>
                            </div>';
                break;

            case 'home4':
                if(empty($item) && empty($item_res)) $item_res = '0:1';
                if(empty($item)) $item = 1;
                if(empty($size)) $size = array(300,360);
                $html .=    '<div class="hot-deals">';
                if(!empty($title)) $html .=    '<h2 class="bg-color"><i class="fa fa-clock-o"></i> '.esc_html($title).'</h2>';
                $html .=        '<div class="hotdeals-slider slider-home4 simple-owl-slider">
                                    <div class="wrap-item smart-slider" data-item="'.esc_attr($item).'" data-speed="'.esc_attr($speed).'" data-itemres="'.esc_attr($item_res).'" data-prev="" data-next="" data-pagination="" data-navigation="true">';
                if($query->have_posts()) {
                    while($query->have_posts()) {
                        $query->the_post();
                        global $product;
                        $button_html =  apply_filters( 'woocommerce_loop_add_to_cart_link',
                                sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="%s product_type_%s"><i class="fa fa-shopping-basket"></i></a>',
                                    esc_url( $product->add_to_cart_url() ),
                                    esc_attr( $product->get_id() ),
                                    esc_attr( $product->get_sku() ),
                                    esc_attr( isset( $quantity ) ? $quantity : 1 ),
                                    $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button addcart-link addcart-single' : 'addcart-link addcart-single',
                                    esc_attr( $product->get_type() )
                                ),
                            $product );
                        if($count % 3 == 1) $html .=    '<div class="item"><ul class="list-product-hotdeal">';
                        $html .=    '<li>
                                        <div class="zoom-image-thumb product-thumb">
                                            <a href="'.esc_url(get_the_permalink()).'">'.get_the_post_thumbnail(get_the_ID(),$size).'</a>
                                            '.$button_html.'
                                        </div>
                                        <div class="product-info">
                                            <h3 class="title-product"><a href="'.esc_url(get_the_permalink()).'">'.get_the_title().'</a></h3>
                                            '.sv_get_product_price().'
                                            <div class="time-countdown hidden-canvas hotdeal-countdown bg-color2 white" data-text="[&quot;&quot;,&quot;&quot;,&quot;&quot;,&quot;&quot;]" data-date="'.esc_attr($time).'"></div>
                                            <p class="desc-hidden">'.sv_substr(get_the_excerpt(),0,120).'</p>
                                        </div>
                                    </li>';
                        if($count % 3 == 0 || $count == $count_query) $html .=    '</ul></div>';
                        $count++;
                    }
                }
                $html .=            '</div>
                                </div>
                            </div>';
                break;

            case 'home3':
                if(empty($item) && empty($item_res)) $item_res = '0:1,640:2,990:3';
                if(empty($item)) $item = 3;
                if(empty($size)) $size = array(300,360);
                $main_color = sv_get_value_by_id('main_color');
                if(empty($main_color)) $main_color = '#fe9c00';
                $html .=    '<div class="hot-deal5 hot-deal01  hot-deal03">
                                <h2 class="title24 text-uppercase text-center font-bold">'.$title.'</h2>
                                <div class="hot-deal-slider5 simple-owl-slider slider-home5 line-white">
                                    <div class="wrap-item smart-slider" data-item="'.esc_attr($item).'" data-speed="'.esc_attr($speed).'" data-itemres="'.esc_attr($item_res).'" data-prev="" data-next="" data-pagination="" data-navigation="true">';
                if($query->have_posts()) {
                    while($query->have_posts()) {
                        $query->the_post();
                        global $product;
                        $html .=    '<div class="item-hotdeal">
                                        <div class="deal-countdown8 time-countdown" data-date="'.$date_to.'"  data-text="[&quot;'.esc_attr__("Days","supershop").'&quot;,&quot;'.esc_attr__("Hour","supershop").'&quot;,&quot;'.esc_attr__("Mins","supershop").'&quot;,&quot;'.esc_attr__("Secs","supershop").'&quot;]" data-color="'.esc_attr($main_color).'" data-day="false" data-width="0.01"></div>
                                        '.sv_product_thumb_hover($size).'
                                        <div class="product-info5">
                                            <h3 class="title-product"><a href="'.esc_url(get_the_permalink()).'">'.get_the_title().'</a></h3>
                                            <ul>
                                                <li>
                                                    '.sv_get_product_price().'
                                                </li>
                                                <li>
                                                    '.sv_get_saleoff_html('home5').'
                                                </li>
                                                <li>
                                                    <span class="count-order">'.get_post_meta(get_the_iD(),'total_sales',true).' '.esc_html__("Order","supershop").'</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>';
                    }
                }
                $html .=            '</div>
                                </div>
                            </div>';
                break;

            case 'home2':
                if(empty($item) && empty($item_res)) $item_res = '0:1,480:2,868:3,990:4';
                if(empty($item)) $item = 4;
                if(empty($size)) $size = array(300,360);
                $html .=    '<div class="block-hot-deal2">';
                if(!empty($title) || !empty($time)){
                    $html .=        '<div class="title-hot-deal2">
                                        <div class="special-slider-header">';
                    if(!empty($title)) $html .=     '<h2 class="title-special">'.$title.'</h2>';
                    if(!empty($time)){
                        $html .=            '<ul class="list-inline-block deal-count02 pull-right">
                                                <li><span class="text-uppercase">'.esc_html__("ENDS IN","supershop").'</span></li>
                                                <li><strong class="title24 color"><i class="fa fa-clock-o" aria-hidden="true"></i></strong></li>
                                                <li><div class="deal-countdown02 time-countdown hidden-canvas" data-text="[&quot;&quot;,&quot;&quot;,&quot;&quot;,&quot;&quot;]" data-date="'.esc_attr($time).'"></div></li>
                                            </ul>';
                    }
                    $html .=            '</div>
                                    </div>';
                }
                $html .=        '<div class="product-slider deal-slider02">
                                    <div class="wrap-item smart-slider" data-item="'.esc_attr($item).'" data-speed="'.esc_attr($speed).'" data-itemres="'.esc_attr($item_res).'" data-prev="" data-next="" data-pagination="" data-navigation="true">';
                if($query->have_posts()) {
                    while($query->have_posts()) {
                        $query->the_post();                        
                        $html .=    '<div class="item-product">
                                        '.sv_product_thumb_hover($size).'
                                        <div class="product-info">
                                            <h3 class="title-product"><a href="'.esc_url(get_the_permalink()).'" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a></h3>
                                            '.sv_get_product_price().'
                                            '.sv_get_rating_html().'
                                        </div>
                                        '.sv_get_saleoff_html().'
                                    </div>';
                    }
                }
                $html .=            '</div>
                                </div>
                            </div>';
                break;

            case 'mega-item':
                $html .=    '<div class="mega-hot-deal">
                                <h2 class="mega-menu-title">'.$title.'</h2>
                                <div class="mega-hot-deal-slider">
                                    <div class="wrap-item">';
                if($query->have_posts()) {
                    while($query->have_posts()) {
                        $query->the_post();
                        global $product;
                        $button_html =  apply_filters( 'woocommerce_loop_add_to_cart_link',
                                sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="%s product_type_%s">%s</a>',
                                    esc_url( $product->add_to_cart_url() ),
                                    esc_attr( $product->get_id() ),
                                    esc_attr( $product->get_sku() ),
                                    esc_attr( isset( $quantity ) ? $quantity : 1 ),
                                    $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button deal-shop-link' : 'deal-shop-link',
                                    esc_attr( $product->get_type() ),
                                    esc_html( $product->add_to_cart_text() )
                                ),
                            $product );
                        $html .=    '<div class="item-deal-product">
                                        '.sv_product_thumb_hover(array(300,360)).'
                                        <div class="product-info">
                                            <h3 class="title-product"><a href="'.esc_url(get_the_permalink()).'">'.get_the_title().'</a></h3>
                                            <p class="desc">'.sv_substr(get_the_excerpt(),0,40).'</p>
                                            '.sv_get_product_price('sale').'
                                            <div class="deal-shop-social">
                                                '.$button_html.'
                                                <div class="social-deal social-network">
                                                    <ul>
                                                        <li><a href="'.esc_url('http://www.facebook.com/sharer.php?u='.get_the_permalink()).'"><img width="40" height="40" alt="" src="'.esc_url(get_template_directory_uri() . '/assets/css/images/home1/s1.png').'"></a></li>
                                                        <li><a href="'.esc_url('http://www.twitter.com/share?url='.get_the_permalink()).'"><img width="40" height="40" alt="" src="'.esc_url(get_template_directory_uri() . '/assets/css/images/home1/s2.png').'"></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                    }
                }            
                $html .=            '</div>
                                </div>
                            </div>';
                break;
            
            default:
                if(empty($item) && empty($item_res)) $item_res = '0:1,640:2,990:3';
                if(empty($item)) $item = 3;
                if(empty($size)) $size = array(300,360);
                $main_color = sv_get_value_by_id('main_color');
                if(empty($main_color)) $main_color = '#fe9c00';
                $html .=    '<div class="hot-deal5 hot-deal01">
                                <div class="special-slider-header">
                                    <h2 class="title18 text-uppercase font-bold">'.$title.'</h2>
                                </div>
                                <div class="hot-deal-slider5 simple-owl-slider slider-home5 line-white">
                                    <div class="wrap-item smart-slider" data-item="'.esc_attr($item).'" data-speed="'.esc_attr($speed).'" data-itemres="'.esc_attr($item_res).'" data-prev="" data-next="" data-pagination="" data-navigation="true">';
                if($query->have_posts()) {
                    while($query->have_posts()) {
                        $query->the_post();
                        $html .=    '<div class="item-hotdeal">
                                        <div class="deal-countdown8 time-countdown" data-date="'.$date_to.'"  data-text="[&quot;'.esc_attr__("Days","supershop").'&quot;,&quot;'.esc_attr__("Hour","supershop").'&quot;,&quot;'.esc_attr__("Mins","supershop").'&quot;,&quot;'.esc_attr__("Secs","supershop").'&quot;]" data-color="'.esc_attr($main_color).'" data-day="false" data-width="0.01"></div>
                                        '.sv_product_thumb_hover($size).'
                                        <div class="product-info5">
                                            <h3 class="title-product"><a href="'.esc_url(get_the_permalink()).'">'.get_the_title().'</a></h3>
                                            <ul>
                                                <li>
                                                    '.sv_get_product_price().'
                                                </li>
                                                <li>
                                                    '.sv_get_saleoff_html('home5').'
                                                </li>
                                                <li>
                                                    <span class="count-order">'.get_post_meta(get_the_iD(),'total_sales',true).' '.esc_html__("Order","supershop").'</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>';
                    }
                }
                $html .=            '</div>
                                </div>
                            </div>';
                break;
        }        
        wp_reset_postdata();
        return $html;
    }
}

stp_reg_shortcode('sv_super_deals','sv_vc_super_deals');
$check_add = '';
if(isset($_GET['return'])) $check_add = $_GET['return'];
if(empty($check_add)) add_action( 'vc_before_init_base','sv_super_deals_admin',10,100 );
if ( ! function_exists( 'sv_super_deals_admin' ) ) {
    function sv_super_deals_admin(){
        vc_map( array(
            "name"      => esc_html__("SV Super Deals", 'supershop'),
            "base"      => "sv_super_deals",
            "icon"      => "icon-st",
            "category"  => '7Up-theme',
            "params"    => array(
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Style",'supershop'),
                    "param_name" => "style",
                    "value" => array(
                        esc_html__("Home 1",'supershop') => 'home1',
                        esc_html__("Home 2",'supershop') => 'home2',
                        esc_html__("Home 3",'supershop') => 'home3',
                        esc_html__("Home 4",'supershop') => 'home4',
                        esc_html__("Home 5",'supershop') => 'home5',
                        esc_html__("Mega item",'supershop') => 'mega-item',
                        )
                ),
                array(
                    "type" => "textfield",
                    "holder" => "h3",
                    "heading" => esc_html__("Title",'supershop'),
                    "param_name" => "title",
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Time CountDown",'supershop'),
                    "param_name" => "time",
                    'description'   => esc_html__( 'EntertTime for countdown. Format is mm/dd/yyyy. Example: 12/15/2016.', 'supershop' ),
                    "dependency"    => array(
                        "element"       => "style",
                        "value"         => array('home1','home2','home3','home4','mega-item'),
                        )
                ),
                array(
                    "type"          => "textfield",
                    "holder"        => "p",
                    "heading"       => esc_html__("Time Countdown",'supershop'),
                    'description'   => esc_html__( 'Enter time(hours:minutes) to countdown. Format is hh:mm. Example 18:30.', 'supershop' ),
                    "param_name"    => "time2",
                    "dependency"    => array(
                        "element"       => "style",
                        "value"         => array('home5'),
                        )
                ),
                array(
                    'holder'     => 'div',
                    'heading'     => esc_html__( 'Product Categories', 'supershop' ),
                    'type'        => 'autocomplete',
                    'param_name'  => 'cats',
                    'settings' => array(
                        'multiple' => true,
                        'sortable' => true,
                        'values' => s7upf_get_product_taxonomy(),
                    ),
                    'save_always' => true,
                    'description' => esc_html__( 'List of product categories', 'supershop' ),
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Number",'supershop'),
                    "param_name" => "number",
                ),

                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Size Thumbnail",'supershop'),
                    "param_name"    => "size",
                    "group"         => esc_html__("Advanced",'supershop'),
                    'description' => esc_html__( 'Enter site thumbnail to crop. [width]x[height]. Example is 300x300', 'supershop' ),
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Item",'supershop'),
                    "param_name"    => "item",
                    "group"         => esc_html__("Advanced",'supershop'),
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Item Responsive",'supershop'),
                    "param_name"    => "item_res",
                    "group"         => esc_html__("Advanced",'supershop'),
                    'description' => esc_html__( 'Enter item for screen width(px) format is width:value and separate values by ",". Example is 0:2,600:3,1000:4. Default is auto.', 'supershop' ),
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Speed",'supershop'),
                    "param_name"    => "speed",
                    "group"         => esc_html__("Advanced",'supershop'),                    
                ),
            )
        ));
    }
}
}