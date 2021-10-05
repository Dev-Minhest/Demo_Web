<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 05/09/15
 * Time: 10:00 AM
 */
if(class_exists("woocommerce")){
if(!function_exists('sv_vc_product_list'))
{
    function sv_vc_product_list($attr, $content = false)
    {
        $html = $view_html = '';
        extract(shortcode_atts(array(
            'style'         => 'side-home01',
            'title'         => '',
            'number'        => '8',
            'cats'          => '',
            'order_by'      => 'date',
            'order'         => 'DESC',
            'product_type'  => '',
            'prices'        => '',
            'attributes'        => '',
            'item'          => '',
            'item_res'      => '',
            'speed'         => '',
            'size'          => '',
            'box_color'          => '',
        ),$attr));
        if(!empty($cats)) $cats = str_replace(' ', '', $cats);
        if(!empty($size)) $size = explode('x', $size);
        $custom_list = array();
        $args = array(
            'post_type'         => 'product',
            'posts_per_page'    => $number,
            'orderby'           => $order_by,
            'order'             => $order,
            'paged'             => 1,
            );
        if($product_type == 'trendding'){
            $args['meta_query'][] = array(
                    'key'     => 'trending_product',
                    'value'   => 'on',
                    'compare' => '=',
                );
        }
        if($product_type == 'toprate'){
            $args['meta_key'] = '_wc_average_rating';
            $args['orderby'] = 'meta_value_num';
            $args['meta_query'] = WC()->query->get_meta_query();
            $args['tax_query'][] = WC()->query->get_tax_query();
        }
        if($product_type == 'mostview'){
            $args['meta_key'] = 'post_views';
            $args['orderby'] = 'meta_value_num';
        }
        if($product_type == 'bestsell'){
            $args['meta_key'] = 'total_sales';
            $args['orderby'] = 'meta_value_num';
        }
        if($product_type=='onsale'){
            $args['meta_query']['relation']= 'OR';
            $args['meta_query'][]=array(
                'key'   => '_sale_price',
                'value' => 0,
                'compare' => '>',                
                'type'          => 'numeric'
            );
            $args['meta_query'][]=array(
                'key'   => '_min_variation_sale_price',
                'value' => 0,
                'compare' => '>',                
                'type'          => 'numeric'
            );
        }
        if($product_type == 'featured'){
            $args['tax_query'][] =  array(
                                        'taxonomy' => 'product_visibility',
                                        'field'    => 'name',
                                        'terms'    => 'featured',
                                        'operator' => 'IN',
                                    );
        }
        if(!empty($cats)) {
            $custom_list = explode(",",$cats);
            $args['tax_query'][]=array(
                'taxonomy'=>'product_cat',
                'field'=>'slug',
                'terms'=> $custom_list
            );
        }
        $product_query = new WP_Query($args);
        $count = 1;
        $count_query = $product_query->post_count;
        switch ($style) {
            case 'slider5':
                if(empty($item) && empty($item_res)) $item_res = '0:1,480:2,1024:3,1200:4';
                if(empty($item)) $item = 4;
                if(empty($size)) $size = array(300,360);
                $html .=    '<div class="product-tab05">';
                if(!empty($title)){
                    $html .=    '<div class="block-title05">
                                    <h2 class="title14 font-bold text-uppercase bg-color white inline-block">'.$title.'</h2>
                                </div>';
                }
                $html .=        '<div class="product-slider05 arrow-style05 line-white">
                                    <div class="wrap-item smart-slider" data-item="'.esc_attr($item).'" data-speed="'.esc_attr($speed).'" data-itemres="'.esc_attr($item_res).'" data-prev="" data-next="" data-pagination="" data-navigation="true">';
                if($product_query->have_posts()) {
                    while($product_query->have_posts()) {
                        $product_query->the_post();
                        $html .=    '<div class="item-product05">
                                        '.sv_product_thumb_hover2($size).'
                                        <div class="product-info5">
                                            <h3 class="title-product"><a href="'.esc_url(get_the_permalink()).'">'.get_the_title().'</a></h3>
                                            '.sv_get_product_price().'
                                            '.sv_get_rating_html().'
                                        </div>
                                    </div>';
                    }
                }
                $html .=            '</div>
                                </div>
                            </div>';
                break;

            case 'side-slider5':
                if(empty($item) && empty($item_res)) $item_res = '0:1,568:2,768:1';
                if(empty($item)) $item = 1;
                if(empty($size)) $size = array(70,84);
                $html .=    '<div class="hot-deal05">';
                if(!empty($title)){
                    $html .=    '<div class="block-title05">
                                    <h2 class="title14 font-bold text-uppercase bg-color white inline-block">'.$title.'</h2>
                                </div>';
                }
                $html .=        '<div class="special-slider05 arrow-style05">
                                    <div class="wrap-item smart-slider" data-item="'.esc_attr($item).'" data-speed="'.esc_attr($speed).'" data-itemres="'.esc_attr($item_res).'" data-prev="" data-next="" data-pagination="" data-navigation="true">';
                if($product_query->have_posts()) {
                    while($product_query->have_posts()) {
                        $product_query->the_post();
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
                        if($count % 4 == 1) $html .=   '<div class="item">';
                        $html .=    '<div class="product-table05 table">
                                        <div class="zoom-image-thumb product-thumb">
                                            <a href="'.esc_url(get_the_permalink()).'">'.get_the_post_thumbnail(get_the_ID(),$size).'</a>
                                            '.$button_html.'
                                        </div>
                                        <div class="product-info5">
                                            <h3 class="title-product"><a href="'.esc_url(get_the_permalink()).'">'.get_the_title().'</a></h3>
                                            '.sv_get_product_price().'
                                            '.sv_get_rating_html().'
                                        </div>
                                    </div>';
                        if($count % 4 == 0 || $count == $count_query) $html .=   '</div>';
                        $count++;
                    }
                }
                $html .=            '</div>
                                </div>
                            </div>';
                break;

            case 'tab-slider4-2':
                if(!empty($cats)){
                    if(empty($item) && empty($item_res)) $item_res = '0:1,600:2,990:3';
                    if(empty($item)) $item = 3;
                    if(empty($size)) $size = array(400,480);
                    $pre = rand(1,100);
                    $tabs = explode(",",$cats);
                    $tab_active = 0;
                    $tab_html = $tab_content = '';
                    foreach ($tabs as $key => $tab) {
                        $term = get_term_by( 'slug',$tab, 'product_cat' );
                        if(!empty($term) && is_object($term)){
                            if($key == $tab_active) $active = 'active';
                            else $active = '';
                            $key_adv = $key+1;
                            $tab_html .=    '<li class="'.esc_attr($active).'"><a class="shop-button bg-white" href="#'.esc_attr($pre.$term->slug).'" data-toggle="tab">'.$term->name.'</a></li>';
                            $tab_content .=    '<div id="'.$pre.$term->slug.'" class="tab-pane '.$active.'">
                                                    <div class="product-slider04">
                                                        <div class="wrap-item smart-slider" data-item="'.esc_attr($item).'" data-speed="'.esc_attr($speed).'" data-itemres="'.esc_attr($item_res).'" data-prev="" data-next="" data-pagination="" data-navigation="true">';
                            unset($args['tax_query']);
                            if($product_type == 'featured'){
                                $args['tax_query'][] = array(
                                    'taxonomy' => 'product_visibility',
                                    'field'    => 'name',
                                    'terms'    => 'featured',
                                    'operator' => 'IN',
                                );
                            }
                            $args['tax_query'][]=array(
                                'taxonomy'=>'product_cat',
                                'field'=>'slug',
                                'terms'=> $tab
                            );
                            $product_query = new WP_Query($args);
                            $max_page = $product_query->max_num_pages;
                            if($product_query->have_posts()) {
                                while($product_query->have_posts()) {
                                    $product_query->the_post();
                                    $size_thumb = $size;
                                    if($count % 2 == 1) $tab_content .= '<div class="item-leading04">';
                                    $tab_content .=    '<div class="item-product04">
                                                    <div class="product-thumb">
                                                        <a href="'.esc_url(get_the_permalink()).'">'.get_the_post_thumbnail(get_the_ID(),$size).'</a>
                                                    </div>
                                                    <div class="product-info text-uppercase text-center">
                                                        <h3 class="title14 font-bold"><a href="'.esc_url(get_the_permalink()).'">'.get_the_title().'</a></h3>
                                                        '.sv_get_product_price().'
                                                    </div>
                                                </div>';
                                    if($count % 2 == 0 || $count == $count_query) $tab_content .= '</div>';
                                    $count++;
                                }
                            }
                            $tab_content .=             '</div>
                                                    </div>
                                                </div>';
                        }
                    }
                    $html .=    '<div class="product-block4 style3">
                                    <div class="title-product-block4 text-uppercase">';
                    if(!empty($title)) $html .= '<h2 class="title18 font-bold inline-block">'.esc_html($title).'</h2>';
                    $html .=            '<ul class="list-inline-block inline-block title-tab-block4">
                                            '.$tab_html.'
                                        </ul>
                                    </div>';
                    $html .=        '<div class="tab-content">
                                        '.$tab_content.'
                                    </div>
                                </div>';
                }
                break;

            case 'tab-slider4':
                if(!empty($cats)){
                    if(empty($item) && empty($item_res)) $item_res = '0:1';
                    if(empty($item)) $item = 1;
                    if(empty($size)) $size = array(300,360);
                    $pre = rand(1,100);
                    $tabs = explode(",",$cats);
                    $tab_active = 0;
                    $tab_html = $tab_content = '';
                    foreach ($tabs as $key => $tab) {
                        $term = get_term_by( 'slug',$tab, 'product_cat' );
                        if(!empty($term) && is_object($term)){
                            if($key == $tab_active) $active = 'active';
                            else $active = '';
                            $key_adv = $key+1;
                            $tab_html .=    '<li class="'.esc_attr($active).'"><a class="shop-button bg-white" href="#'.esc_attr($pre.$term->slug).'" data-toggle="tab">'.$term->name.'</a></li>';
                            $tab_content .=    '<div id="'.$pre.$term->slug.'" class="tab-pane '.$active.'">
                                                    <div class="product-slider04">
                                                        <div class="wrap-item smart-slider" data-item="'.esc_attr($item).'" data-speed="'.esc_attr($speed).'" data-itemres="'.esc_attr($item_res).'" data-prev="" data-next="" data-pagination="" data-navigation="true">';
                            unset($args['tax_query']);
                            if($product_type == 'featured'){
                                $args['tax_query'][] = array(
                                    'taxonomy' => 'product_visibility',
                                    'field'    => 'name',
                                    'terms'    => 'featured',
                                    'operator' => 'IN',
                                );
                            }
                            $args['tax_query'][]=array(
                                'taxonomy'=>'product_cat',
                                'field'=>'slug',
                                'terms'=> $tab
                            );
                            $product_query = new WP_Query($args);
                            $count = 1;
                            $count_query = $product_query->post_count;
                            if($product_query->have_posts()) {
                                while($product_query->have_posts()) {
                                    $product_query->the_post();
                                    $size_thumb = $size;
                                    if($count % 7 == 1) {
                                        $tab_content .= '<div class="item clearfix">';
                                        $tab_content .= '<div class="item-leading04">';
                                        $size_thumb = array(400,480);
                                    }
                                    if($count % 7 == 2 || $count % 7 == 4 || $count % 7 == 6) $tab_content .= '<div class="item-normal04">';
                                    $tab_content .=    '<div class="item-product04">
                                                            <div class="product-thumb">
                                                                <a href="'.esc_url(get_the_permalink()).'">'.get_the_post_thumbnail(get_the_ID(),$size_thumb).'</a>
                                                            </div>
                                                            <div class="product-info text-uppercase text-center">
                                                                <h3 class="title14 font-bold"><a href="'.esc_url(get_the_permalink()).'">'.get_the_title().'</a></h3>
                                                                '.sv_get_product_price().'
                                                            </div>
                                                        </div>';
                                    if($count % 7 == 0 || $count % 7 == 1 || $count % 7 == 3 || $count % 7 == 5 || $count == $count_query) $tab_content .= '</div>';
                                    if($count % 7 == 0 || $count == $count_query) $tab_content .= '</div>';
                                    $count++;
                                }
                            }
                            $tab_content .=             '</div>
                                                    </div>
                                                </div>';
                        }
                    }
                    $html .=    '<div class="product-block4 style2">
                                    <div class="title-product-block4 text-uppercase">';
                    if(!empty($title)) $html .= '<h2 class="title18 font-bold inline-block">'.esc_html($title).'</h2>';
                    $html .=            '<ul class="list-inline-block inline-block title-tab-block4">
                                            '.$tab_html.'
                                        </ul>
                                    </div>';
                    $html .=        '<div class="tab-content">
                                        '.$tab_content.'
                                    </div>
                                </div>';
                }
                break;

            case 'grid-home3':
                if(empty($size)) $size = array(300,360);
                $html .=    '<div class="featured-product03">';
                if(!empty($title)) $html .=    '<h2 class="title24 font-bold text-uppercase text-center">'.esc_html($title).'</h2>';
                $html .=        '<div class="row">';
                if($product_query->have_posts()) {
                    while($product_query->have_posts()) {
                        $product_query->the_post();
                        global $product;
                        $html .=        '<div class="col-md-3 col-sm-4 col-xs-6">
                                            <div class="item-product item-product03 text-center">
                                                '.sv_product_thumb_hover2($size).'
                                                <div class="product-info">
                                                    <h3 class="title-product"><a href="'.esc_url(get_the_permalink()).'">'.get_the_title().'</a></h3>
                                                    '.sv_get_product_price().'
                                                    '.sv_get_rating_html().'
                                                </div>
                                            </div>
                                        </div>';
                    }
                }
                $html .=        '</div>
                            </div>';
                break;

            case 'tab-slider-ajax':
                $data_load = array(
                    "number"        => $number,
                    "order"         => $order,
                    "order_by"      => $order_by,
                    "product_type"  => $product_type,
                    "size"          => $size,
                    );
                $data_loadjs = json_encode($data_load);
                if(empty($item) && empty($item_res)) $item_res = '0:1,480:2,640:3,990:4,1200:5';
                if(empty($item)) $item = 5;
                if(empty($size)) $size = array(300,360);
                $pre =  rand(1,100);
                $cat = '';
                if(!empty($cats)) $cat = $custom_list[0];
                unset($args['tax_query']);
                if($product_type == 'featured'){
                    $args['tax_query'][] =  array(
                            'taxonomy' => 'product_visibility',
                            'field'    => 'name',
                            'terms'    => 'featured',
                            'operator' => 'IN',
                        );
                }
                if(!empty($cat)){
                    $args['tax_query'][]=array(
                        'taxonomy'=>'product_cat',
                        'field'=>'slug',
                        'terms'=> $cat
                    );
                }
                $product_query = new WP_Query($args);
                $max_page = $product_query->max_num_pages;
                $html .=    '<div class="block-product2 '.esc_attr($box_color).'" data-load_data="'.esc_attr($data_loadjs).'">
                                <div class="block-title2 special-slider-header">';
                if(!empty($title)) $html .=    '<h2 class="title-special inline-block">'.$title.'</h2>';
                $html .=            '<ul class="list-inline-block inline-block list-cat-title2">';
                $tabs = explode(",",$cats);
                if(is_array(($tabs))){
                    foreach ($tabs as $key => $tab) {
                        $term = get_term_by( 'slug',$tab, 'product_cat' );
                        if(!empty($term) && is_object($term)){
                            if($key == 0) $active = 'active';
                            else $active = '';
                            $html .=    '<li class="'.esc_attr($active).'"><a class="cat-load-ajax" href="#" data-cat="'.$term->slug.'">'.$term->name.'</a></li>';
                        }
                    }
                }
                $html .=            '</ul>
                                </div>';
                $html .=        '<div class="product-slider2 line-white">
                                    <div class="no-product hidden"><h3>'.esc_html__("No Product are display.","supershop").'</h3></div>
                                    <div class="wrap-item smart-slider" data-item="'.esc_attr($item).'" data-speed="'.esc_attr($speed).'" data-itemres="'.esc_attr($item_res).'" data-prev="" data-next="" data-pagination="" data-navigation="true">';
                if($product_query->have_posts()) {
                    while($product_query->have_posts()) {
                        $product_query->the_post();
                        global $product;
                        $html .=        '<div class="item">
                                            <div class="item-product5">
                                                '.sv_product_thumb_hover2($size,'product-thumb5').'
                                                <div class="product-info5">
                                                    <h3 class="title-product"><a href="'.esc_url(get_the_permalink()).'">'.get_the_title().'</a></h3>
                                                    '.sv_get_product_price().'
                                                    '.sv_get_rating_html().'
                                                </div>
                                            </div>
                                        </div>';
                    }
                }
                $html .=            '</div>
                                </div>
                            </div>';
                break;

            case 'mega-item':
                $html .=    '<div class="mega-new-arrival">
                                <h2 class="mega-menu-title">'.$title.'</h2>
                                <div class="mega-new-arrival-slider">
                                    <div class="wrap-item">';
                if($product_query->have_posts()) {
                    while($product_query->have_posts()) {
                        $product_query->the_post();
                        global $product;
                        $html .=    '<div class="item">
                                        <div class="item-product">
                                            '.sv_product_thumb_hover2(array(300,360)).'
                                            <div class="product-info">
                                                <h3 class="title-product"><a href="'.esc_url(get_the_permalink()).'">'.get_the_title().'</a></h3>
                                                '.sv_get_product_price().'
                                                '.sv_get_rating_html().'
                                            </div>
                                        </div>
                                    </div>';
                    }
                }
                $html .=            '</div>
                                </div>
                            </div>';
                break;            

            case 'product-filter':
                $pre =  rand(1,100);
                $cat = '';
                if(!empty($cats)) $cat = $custom_list[0];
                unset($args['tax_query']);
                if($product_type == 'featured'){
                    $args['tax_query'][] =  array(
                            'taxonomy' => 'product_visibility',
                            'field'    => 'name',
                            'terms'    => 'featured',
                            'operator' => 'IN',
                        );
                }
                if(!empty($cat)){
                    $args['tax_query'][]=array(
                        'taxonomy'=>'product_cat',
                        'field'=>'slug',
                        'terms'=> $cat
                    );
                }
                $product_query = new WP_Query($args);
                $max_page = $product_query->max_num_pages;
                $html .=    '<div class="new-product-filter">
                                <div class="header-product-filter">
                                    <h2>
                                        <span>'.$title.'</span>
                                        <a href="#" class="toggle-link-filter"><i class="fa fa-filter"></i> '.esc_html__("filter","supershop").'</a>
                                    </h2>
                                    '.sv_product_filter_box($prices,$attributes).'
                                </div>';
                $html .=    '<div class="category-tab-filter">
                                <div class="category-filter-title">
                                    <ul>';
                $tabs = explode(",",$cats);
                if(is_array(($tabs))){
                    foreach ($tabs as $key => $tab) {
                        $term = get_term_by( 'slug',$tab, 'product_cat' );
                        if(!empty($term) && is_object($term)){
                            if($key == 0) $active = 'active';
                            else $active = '';
                            $html .=    '<li><a class="load-data-filter '.$active.'" href="#" data-cat="'.$term->slug.'">'.$term->name.' </a></li>';
                        }
                    }
                }
                $html .=            '</ul>
                                </div>';
                $html .=        '<div class="category-filter-content">
                                    <div class="tab-content">
                                        <div class="no-product hidden"><h3>'.esc_html__("No Product are display.","supershop").'</h3></div>
                                        <div class="row">';
                if($product_query->have_posts()) {
                    while($product_query->have_posts()) {
                        $product_query->the_post();
                        global $product;
                        $html .=    '<div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="item-product-filter">
                                            '.sv_product_thumb_hover2(array(300,360),'product-thumb6').'                                            
                                            <div class="product-info6">
                                                <h3 class="title-product"><a href="'.esc_url(get_the_permalink()).'">'.get_the_title().'</a></h3>
                                                '.sv_get_product_price().'
                                            </div>
                                        </div>
                                    </div>';
                    }
                }
                $html .=                '</div>';
                if($max_page > 1) $f_class= '';
                else $f_class= 'first-hidden';
                $html .=    '<a data-tag="" data-attribute="" data-term=""  data-price="" data-cat="'.$cat.'" data-number="'.$number.'"  data-order="'.$order.'" data-orderby="'.$order_by.'" data-paged="1"  data-maxpage="'.$max_page.'" data-product_type="'.$product_type.'" href="#" class="loadmore-item loadmore-product-filter '.$f_class.'">'.esc_html__("Load more items","supershop").'</a>';
                $html .=            '</div>
                                </div>
                            </div></div>';
                break;            

            default:
                if(empty($item) && empty($item_res)) $item_res = '0:1,480:2,768:1';
                if(empty($item)) $item = 1;
                if(empty($size)) $size = array(300,360);
                $html .=    '<div class="hot-deal5 hot-deal01 side-home01">
                                <div class="special-slider-header">
                                    <h2 class="title18 text-uppercase font-bold">'.$title.'</h2>
                                </div>
                                <div class="hot-deal-slider5 simple-owl-slider slider-home5">
                                    <div class="wrap-item smart-slider" data-item="'.esc_attr($item).'" data-speed="'.esc_attr($speed).'" data-itemres="'.esc_attr($item_res).'" data-prev="" data-next="" data-pagination="" data-navigation="true">';
                if($product_query->have_posts()) {
                    while($product_query->have_posts()) {
                        $product_query->the_post();
                        $html .=    '<div class="item-hotdeal">
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

stp_reg_shortcode('sv_product_list','sv_vc_product_list');
$check_add = '';
if(isset($_GET['return'])) $check_add = $_GET['return'];
if(empty($check_add)) add_action( 'vc_before_init_base','sv_add_list_product',10,100 );
if ( ! function_exists( 'sv_add_list_product' ) ) {
    function sv_add_list_product(){
        vc_map( array(
            "name"      => esc_html__("SV Product list", 'supershop'),
            "base"      => "sv_product_list",
            "icon"      => "icon-st",
            "category"  => '7Up-theme',
            "params"    => array(
                array(
                    'heading'     => esc_html__( 'Style', 'supershop' ),
                    'holder'      => 'div',
                    'type'        => 'dropdown',
                    'description' => esc_html__( 'Choose style to display.', 'supershop' ),
                    'param_name'  => 'style',
                    'value'       => array(
                        esc_html__('Side home 01','supershop') => 'side-home01',
                        esc_html__('Tab category slider ajax(home 2)','supershop') => 'tab-slider-ajax',
                        esc_html__('Grid 4 home 3','supershop') => 'grid-home3',
                        esc_html__('Tab slider home 4','supershop') => 'tab-slider4',
                        esc_html__('Tab slider home 4(2)','supershop') => 'tab-slider4-2',
                        esc_html__('Side slider home 5','supershop') => 'side-slider5',
                        esc_html__('Slider home 5','supershop') => 'slider5',
                        esc_html__('Product Filter','supershop') => 'product-filter',
                        esc_html__('Mega item','supershop') => 'mega-item',
                        )
                ),
                array(
                    'heading'     => esc_html__( 'Box color', 'supershop' ),
                    'type'        => 'dropdown',
                    'param_name'  => 'box_color',
                    'value'       => array(
                        esc_html__('Default','supershop') => '',
                        esc_html__('Navi','supershop') => 'block-navi',
                        esc_html__('Magenta','supershop') => 'block-magenta',
                        esc_html__('Blue','supershop') => 'block-blue',
                        ),
                    "dependency"    => array(
                        "element"   => 'style',
                        "value"   => 'tab-slider-ajax',
                        )
                ),
                array(
                    'heading'     => esc_html__( 'Title', 'supershop' ),
                    'holder'      => 'h4',
                    'type'        => 'textfield',
                    'param_name'  => 'title',
                ),
                array(
                    'heading'     => esc_html__( 'Number', 'supershop' ),
                    'type'        => 'textfield',
                    'description' => esc_html__( 'Enter number of product. Default is 8.', 'supershop' ),
                    'param_name'  => 'number',
                ),
                array(
                    'heading'     => esc_html__( 'Product Type', 'supershop' ),
                    'type'        => 'dropdown',
                    'param_name'  => 'product_type',
                    'value' => array(
                        esc_html__('Default','supershop')            => '',
                        esc_html__('Trendding','supershop')          => 'trendding',
                        esc_html__('Featured Products','supershop')  => 'featured',
                        esc_html__('Best Sellers','supershop')       => 'bestsell',
                        esc_html__('On Sale','supershop')            => 'onsale',
                        esc_html__('Top rate','supershop')           => 'toprate',
                        esc_html__('Most view','supershop')          => 'mostview',
                    ),
                    'description' => esc_html__( 'Select Product View Type', 'supershop' ),
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
                    'type' => 'dropdown',
                    'heading' => esc_html__( 'Order By', 'supershop' ),
                    'value' => sv_get_order_list(),
                    'param_name' => 'orderby',
                    'description' => esc_html__( 'Select Orderby Type ', 'supershop' ),
                    'edit_field_class'=>'vc_col-sm-6 vc_column',
                ),
                array(
                    'heading'     => esc_html__( 'Order', 'supershop' ),
                    'type'        => 'dropdown',
                    'param_name'  => 'order',
                    'value' => array(                   
                        esc_html__('Desc','supershop')  => 'DESC',
                        esc_html__('Asc','supershop')  => 'ASC',
                    ),
                    'description' => esc_html__( 'Select Order Type ', 'supershop' ),
                    'edit_field_class'=>'vc_col-sm-6 vc_column',
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Prices",'supershop'),
                    "param_name" => "prices",
                    "group" => esc_html__("Filter",'supershop'),
                    "dependency"    => array(
                        "element"   => 'style',
                        "value"   => 'product-filter',
                        )
                ),
                array(
                    "type" => "checkbox",
                    "heading" => esc_html__("Attribute",'supershop'),
                    "param_name" => "attributes",
                    "group" => esc_html__("Filter",'supershop'),
                    "value" => sv_get_attr_product_list(),
                    "dependency"    => array(
                        "element"   => 'style',
                        "value"   => 'product-filter',
                        )
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
//Home 6
add_action( 'wp_ajax_load_more_product_filter', 'sv_load_more_product_filter' );
add_action( 'wp_ajax_nopriv_load_more_product_filter', 'sv_load_more_product_filter' );
if(!function_exists('sv_load_more_product_filter')){
    function sv_load_more_product_filter() {
        $number         = $_POST['number'];
        $order_by       = $_POST['orderby'];
        $order          = $_POST['order'];
        $product_type   = $_POST['product_type'];
        $cat            = $_POST['cat'];
        $tag            = $_POST['tag'];
        $attribute      = $_POST['attribute'];
        $paged          = $_POST['paged'];
        $price          = $_POST['price'];
        $term           = $_POST['term'];
        $args = array(
            'post_type'         => 'product',
            'posts_per_page'    => $number,
            'orderby'           => $order_by,
            'order'             => $order,
            'paged'             => 1,
        );
        if(!empty($product_type)){
            switch ($product_type) {
                case 'trendding':
                    $args['meta_query'][] = array(
                        'key'     => 'trending_product',
                        'value'   => 'on',
                        'compare' => '=',
                    );
                    break;

                case 'toprate':
                    $args['meta_key'] = '_wc_average_rating';
                    $args['orderby'] = 'meta_value_num';
                    $args['meta_query'] = WC()->query->get_meta_query();
                    $args['tax_query'][] = WC()->query->get_tax_query();
                    break;

                case 'mostview':
                    $args['meta_key'] = 'post_views';
                    $args['orderby'] = 'meta_value_num';
                    break;

                case 'bestsell':
                    $args['meta_key'] = 'total_sales';
                    $args['orderby'] = 'meta_value_num';
                    break;

                case 'onsale':
                    $args['meta_query']['relation']= 'OR';
                    $args['meta_query'][]=array(
                        'key'   => '_sale_price',
                        'value' => 0,
                        'compare' => '>',                
                        'type'          => 'numeric'
                    );
                    $args['meta_query'][]=array(
                        'key'   => '_min_variation_sale_price',
                        'value' => 0,
                        'compare' => '>',                
                        'type'          => 'numeric'
                    );
                    break;

                case 'featured':
                    $args['tax_query'][] =  array(
                                                'taxonomy' => 'product_visibility',
                                                'field'    => 'name',
                                                'terms'    => 'featured',
                                                'operator' => 'IN',
                                            );
                    break;

                case 'price-asc' :
                    $args['orderby']  = "meta_value_num ID";
                    $args['order']    = 'ASC';
                    $args['meta_key'] = '_price';
                break;

                case 'price-desc' :
                    $args['orderby']  = "meta_value_num ID";
                    $args['order']    = 'DESC';
                    $args['meta_key'] = '_price';
                break;

                case 'popularity' :
                    $args['meta_key'] = 'total_sales';
                    add_filter( 'posts_clauses', array( $this, 'order_by_popularity_post_clauses' ) );
                break;

                case 'rating' :
                    $args['meta_key'] = '_wc_average_rating';
                    $args['orderby'] = 'meta_value_num';
                    $args['meta_query'] = WC()->query->get_meta_query();
                    $args['tax_query'][] = WC()->query->get_tax_query();
                break;
                
                default:
                    # code...
                    break;
            }
        }
        if(!empty($attribute) && !empty($term)){
            $args['tax_query']['relation'] = 'AND';
            $args['tax_query'][] =  array(
                                        'taxonomy'      => $attribute,
                                        'terms'         => $term,
                                        'field'         => 'slug',
                                        'operator'      => 'IN'
                                    );
        }
        if(!empty($price)){
            $price_filter = explode(',', $price);
            $min = $price_filter[0];
            $max = $price_filter[1];
            $args['post__in'] = sv_filter_price($min,$max);
        }
        if(!empty($cat)) {
            $args['tax_query'][]=array(
                'taxonomy'  => 'product_cat',
                'field'     => 'slug',
                'terms'     => $cat
            );
        }
        if(!empty($tag)) {
            $args['tax_query'][]=array(
                'taxonomy'  => 'product_tag',
                'field'     => 'slug',
                'terms'     => $tag
            );
        }
        $product_query = new WP_Query($args);
        $max_page = $product_query->max_num_pages;
        $html = '';
        if($product_query->have_posts()) {
            while($product_query->have_posts()) {
                $product_query->the_post();
                global $product;
                $html .=    '<div class="col-md-3 col-sm-4 col-xs-12">
                                <div class="item-product-filter">
                                    '.sv_product_thumb_hover2(array(300,360),'product-thumb6').'                                            
                                    <div class="product-info6">
                                        <h3 class="title-product"><a href="'.esc_url(get_the_permalink()).'">'.get_the_title().'</a></h3>
                                        '.sv_get_product_price().'
                                    </div>
                                </div>
                            </div>';
            }            
            $html .=    '<input id="current-maxpage" type="hidden" value="'.$max_page.'">';
        }
        echo balanceTags($html);
        wp_reset_postdata();
    }
}
//Home 6
add_action( 'wp_ajax_load_more_product_filter_button', 'sv_load_more_product_filter_button' );
add_action( 'wp_ajax_nopriv_load_more_product_filter_button', 'sv_load_more_product_filter_button' );
if(!function_exists('sv_load_more_product_filter_button')){
    function sv_load_more_product_filter_button() {
        $number         = $_POST['number'];
        $order_by       = $_POST['orderby'];
        $order          = $_POST['order'];
        $product_type   = $_POST['product_type'];
        $cat            = $_POST['cat'];
        $tag            = $_POST['tag'];
        $attribute      = $_POST['attribute'];
        $paged          = $_POST['paged'];
        $price          = $_POST['price'];
        $term           = $_POST['term'];
        $args = array(
            'post_type'         => 'product',
            'posts_per_page'    => $number,
            'orderby'           => $order_by,
            'order'             => $order,
            'paged'             => (int)$paged+1,
        );
        if(!empty($product_type)){
            switch ($product_type) {
                case 'trendding':
                    $args['meta_query'][] = array(
                        'key'     => 'trending_product',
                        'value'   => 'on',
                        'compare' => '=',
                    );
                    break;

                case 'toprate':
                    $args['meta_key'] = '_wc_average_rating';
                    $args['orderby'] = 'meta_value_num';
                    $args['meta_query'] = WC()->query->get_meta_query();
                    $args['tax_query'][] = WC()->query->get_tax_query();
                    break;

                case 'mostview':
                    $args['meta_key'] = 'post_views';
                    $args['orderby'] = 'meta_value_num';
                    break;

                case 'bestsell':
                    $args['meta_key'] = 'total_sales';
                    $args['orderby'] = 'meta_value_num';
                    break;

                case 'onsale':
                    $args['meta_query']['relation']= 'OR';
                    $args['meta_query'][]=array(
                        'key'   => '_sale_price',
                        'value' => 0,
                        'compare' => '>',                
                        'type'          => 'numeric'
                    );
                    $args['meta_query'][]=array(
                        'key'   => '_min_variation_sale_price',
                        'value' => 0,
                        'compare' => '>',                
                        'type'          => 'numeric'
                    );
                    break;

                case 'featured':
                    $args['tax_query'][] =  array(
                                                'taxonomy' => 'product_visibility',
                                                'field'    => 'name',
                                                'terms'    => 'featured',
                                                'operator' => 'IN',
                                            );
                    break;

                case 'price-asc' :
                    $args['orderby']  = "meta_value_num ID";
                    $args['order']    = 'ASC';
                    $args['meta_key'] = '_price';
                break;

                case 'price-desc' :
                    $args['orderby']  = "meta_value_num ID";
                    $args['order']    = 'DESC';
                    $args['meta_key'] = '_price';
                break;

                case 'popularity' :
                    $args['meta_key'] = 'total_sales';
                    add_filter( 'posts_clauses', array( $this, 'order_by_popularity_post_clauses' ) );
                break;

                case 'rating' :
                    $args['meta_key'] = '_wc_average_rating';
                    $args['orderby'] = 'meta_value_num';
                    $args['meta_query'] = WC()->query->get_meta_query();
                    $args['tax_query'][] = WC()->query->get_tax_query();
                break;
                
                default:
                    # code...
                    break;
            }
        }
        if(!empty($attribute) && !empty($term)){
            $args['tax_query']['relation'] = 'AND';
            $args['tax_query'][] =  array(
                                        'taxonomy'      => $attribute,
                                        'terms'         => $term,
                                        'field'         => 'slug',
                                        'operator'      => 'IN'
                                    );
        }
        if(!empty($price)){
            $price_filter = explode(',', $price);
            $min = $price_filter[0];
            $max = $price_filter[1];
            $args['post__in'] = sv_filter_price($min,$max);
        }
        if(!empty($cat)) {
            $args['tax_query'][]=array(
                'taxonomy'  => 'product_cat',
                'field'     => 'slug',
                'terms'     => $cat
            );
        }
        if(!empty($tag)) {
            $args['tax_query'][]=array(
                'taxonomy'  => 'product_tag',
                'field'     => 'slug',
                'terms'     => $tag
            );
        }
        $product_query = new WP_Query($args);
        $max_page = $product_query->max_num_pages;
        $html = '';
        if($product_query->have_posts()) {
            while($product_query->have_posts()) {
                $product_query->the_post();
                global $product;
                $html .=    '<div class="col-md-3 col-sm-4 col-xs-6">
                                <div class="item-product-filter">
                                    '.sv_product_thumb_hover2(array(300,360),'product-thumb6').'                                            
                                    <div class="product-info6">
                                        <h3 class="title-product"><a href="'.esc_url(get_the_permalink()).'">'.get_the_title().'</a></h3>
                                        '.sv_get_product_price().'
                                    </div>
                                </div>
                            </div>';
            }
        }
        echo balanceTags($html);
        wp_reset_postdata();
    }
}
    //Home 2
    add_action( 'wp_ajax_load_cat_products', 's7upf_load_cat_products' );
    add_action( 'wp_ajax_nopriv_load_cat_products', 's7upf_load_cat_products' );
    if(!function_exists('s7upf_load_cat_products')){
        function s7upf_load_cat_products() {
            $cats = $_POST['cats'];
            $load_data = $_POST['load_data'];
            $load_data = str_replace('\"', '"', $load_data);
            $load_data = json_decode($load_data,true);
            extract($load_data);
            $html = '';
            $args = array(
                'post_type'         => 'product',
                'posts_per_page'    => $number,
                'orderby'           => $order_by,
                'order'             => $order,
                'paged'             => 1,
                );
            if($product_type == 'trendding'){
                $args['meta_query'][] = array(
                        'key'     => 'trending_product',
                        'value'   => 'on',
                        'compare' => '=',
                    );
            }
            if($product_type == 'toprate'){
                $args['meta_key'] = '_wc_average_rating';
                $args['orderby'] = 'meta_value_num';
                $args['meta_query'] = WC()->query->get_meta_query();
                $args['tax_query'][] = WC()->query->get_tax_query();
            }
            if($product_type == 'mostview'){
                $args['meta_key'] = 'post_views';
                $args['orderby'] = 'meta_value_num';
            }
            if($product_type == 'bestsell'){
                $args['meta_key'] = 'total_sales';
                $args['orderby'] = 'meta_value_num';
            }
            if($product_type=='onsale'){
                $args['meta_query']['relation']= 'OR';
                $args['meta_query'][]=array(
                    'key'   => '_sale_price',
                    'value' => 0,
                    'compare' => '>',                
                    'type'          => 'numeric'
                );
                $args['meta_query'][]=array(
                    'key'   => '_min_variation_sale_price',
                    'value' => 0,
                    'compare' => '>',                
                    'type'          => 'numeric'
                );
            }
            if($product_type == 'featured'){
                $args['tax_query'][] = array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'name',
                    'terms'    => 'featured',
                    'operator' => 'IN',
                );
            }
            if(!empty($cats)) {
                $custom_list = explode(",",$cats);
                $args['tax_query'][]=array(
                    'taxonomy'=>'product_cat',
                    'field'=>'slug',
                    'terms'=> $custom_list
                );
            }
            $product_query = new WP_Query($args);
            $count = 1;
            $count_query = $product_query->post_count;
            if(empty($size)) $size = array(300,360);
            else $size = explode('x', $size);          
            if($product_query->have_posts()) {
                while($product_query->have_posts()) {
                    $product_query->the_post();
                    $html .=    '<div class="item">
                                    <div class="item-product5">
                                        '.sv_product_thumb_hover2($size,'product-thumb5').'
                                        <div class="product-info5">
                                            <h3 class="title-product"><a href="'.esc_url(get_the_permalink()).'">'.get_the_title().'</a></h3>
                                            '.sv_get_product_price().'
                                            '.sv_get_rating_html().'
                                        </div>
                                    </div>
                                </div>';
                }
            }
            echo balanceTags($html);
            wp_reset_postdata();
        }
    }
}