<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:00 AM
 */
if(class_exists("woocommerce")){
if(!function_exists('sv_vc_product_tab'))
{
    function sv_vc_product_tab($attr)
    {
        $html = '';
        extract(shortcode_atts(array(
            'style'          => '',
            'title'          => '',
            'tabs'           => '',
            'adv_img'          => '',
            'cats'          => '',
            'number'        => '6',
            'order'         => 'DESC',
            'order_by'      => 'date',
            'item'          => '',
            'item_res'      => '',
            'speed'         => '',
            'size'          => '',
            'link'          => '',
            'box_color'     => '',
        ),$attr));
        if(!empty($cats)) $cats = str_replace(' ', '', $cats);
        if(!empty($size)) $size = explode('x', $size);
        if(!empty($tabs)){
            $args=array(
                'post_type'         => 'product',
                'posts_per_page'    => $number,
                'orderby'           => $order_by,
                'order'             => $order,
            );
            if(!empty($cats)) {
                $custom_list = explode(",",$cats);
                $args['tax_query'][]=array(
                    'taxonomy'=>'product_cat',
                    'field'=>'slug',
                    'terms'=> $custom_list
                );
            }
            $tabs = explode(',', $tabs);
            $tab_html = $content_html = $title_tab = '';
            foreach ($tabs as $key => $tab) {
                if($key == 0) $f_class = 'active';
                else $f_class = '';
                if($tab == 'best-sellers'){
                    $title_tab = esc_html__("Best Sellers","supershop");
                    $args['meta_key'] = 'total_sales';
                    $args['orderby'] = 'meta_value_num';
                }
                if($tab == 'new-arrivals'){
                    unset($args['meta_key']);
                    $title_tab = esc_html__("New Arrivals","supershop");
                    $args['order'] = 'DESC';
                    $args['orderby'] = 'ID';
                }
                if($tab == 'on-sale'){
                    $args['order'] = $order;
                    $args['orderby'] = $order_by;
                    $title_tab = esc_html__("On sale","supershop");
                    $args['meta_query']['relation'] = "OR";
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
                if($tab == 'special'){
                    $args['order'] = $order;
                    $args['orderby'] = $order_by;
                    unset($args['meta_query']);
                    $title_tab = esc_html__("Featured","supershop");
                    $args['tax_query'][] =  array(
                                                'taxonomy' => 'product_visibility',
                                                'field'    => 'name',
                                                'terms'    => 'featured',
                                                'operator' => 'IN',
                                            );
                }
                if($tab == 'popular'){
                    $args['order'] = $order;
                    unset($args['meta_query']);
                    $title_tab = esc_html__("Most Popular","supershop");
                    $args['orderby'] = 'meta_value_num';
                    $args['meta_key'] = 'post_views';
                }
                $query = new WP_Query($args);
                $count = 1;
                $count_query = $query->post_count;
                $pre = rand(1,100);
                switch ($style) {
                    case 'home7-ajax':
                        if(empty($item) && empty($item_res)) $item_res = '0:1,480:2,640:3,768:1,1024:2,1200:3';
                        if(empty($item)) $item = 3;
                        if(empty($size)) $size = array(300,360);
                        $tab_html .=    '<li class="'.$f_class.'"><a class="tab-load-ajax" href="'.esc_url('#'.$pre.$tab).'" data-tab="'.esc_attr($tab).'">'.$title_tab.'</a></li>';
                        if($key == 0){
                            $content_html .=    '<div class="product-slider2 line-white">
                                                    <div class="wrap-item smart-slider" data-item="'.esc_attr($item).'" data-speed="'.esc_attr($speed).'" data-itemres="'.esc_attr($item_res).'" data-prev="" data-next="" data-pagination="" data-navigation="true">';
                            if($query->have_posts()) {
                                while($query->have_posts()) {
                                    $query->the_post();
                                    global $product;
                                    $content_html .=    '<div class="item">
                                                            <div class="item-product5">
                                                                '.sv_product_thumb_hover2($size,'product-thumb5').'                                                                
                                                                <div class="product-info5">
                                                                    <h3 class="title-product"><a href="'.esc_url(get_the_permalink()).'" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a></h3>
                                                                    '.sv_get_product_price().'
                                                                    '.sv_get_rating_html().'
                                                                </div>
                                                            </div>
                                                        </div>';
                                    $count++;
                                }
                            }
                            $content_html .=        '</div>
                                                </div>';
                        }
                        break;

                    case 'home6':
                        if(empty($item) && empty($item_res)) $item_res = '0:1,480:2,1024:3,1200:4';
                        if(empty($item)) $item = 4;
                        if(empty($size)) $size = array(300,360);
                        $tab_html .=    '<li class="'.$f_class.'"><a href="'.esc_url('#'.$pre.$tab).'" data-toggle="tab">'.$title_tab.'</a></li>';
                        $content_html .=    '<div role="tabpanel" class="tab-pane fade in '.$f_class.'" id="'.$pre.$tab.'">
                                                <div class="list-product06">
                                                    <div class="row">';
                        if($query->have_posts()) {
                            while($query->have_posts()) {
                                $query->the_post();
                                global $product;
                                $content_html .=        '<div class="col-md-3 col-sm-4 col-xs-6">
                                                            <div class="item-product06">
                                                                '.sv_product_thumb_hover2($size).'
                                                                <div class="product-info5">
                                                                    <h3 class="title-product"><a href="'.esc_url(get_the_permalink()).'">'.get_the_title().'</a></h3>
                                                                    '.sv_get_product_price().'
                                                                </div>
                                                            </div>
                                                        </div>';
                                $count++;
                            }
                        }
                        $content_html .=            '</div>
                                                </div>
                                            </div>';
                        break;

                    case 'home5':
                        if(empty($item) && empty($item_res)) $item_res = '0:1,480:2,1024:3,1200:4';
                        if(empty($item)) $item = 4;
                        if(empty($size)) $size = array(300,360);
                        $tab_html .=    '<li class="'.$f_class.'"><a href="'.esc_url('#'.$pre.$tab).'" data-toggle="tab">'.$title_tab.'</a></li>';
                        $content_html .=    '<div role="tabpanel" class="tab-pane fade in '.$f_class.'" id="'.$pre.$tab.'">
                                                <div class="product-slider05 arrow-style05 line-white">
                                                    <div class="wrap-item smart-slider" data-item="'.esc_attr($item).'" data-speed="'.esc_attr($speed).'" data-itemres="'.esc_attr($item_res).'" data-prev="" data-next="" data-pagination="" data-navigation="true">';
                        if($query->have_posts()) {
                            while($query->have_posts()) {
                                $query->the_post();
                                global $product;
                                $content_html .=        '<div class="item-product05">
                                                            '.sv_product_thumb_hover2($size).'
                                                            <div class="product-info5">
                                                                <h3 class="title-product"><a href="'.esc_url(get_the_permalink()).'">'.get_the_title().'</a></h3>
                                                                '.sv_get_product_price().'
                                                                '.sv_get_rating_html().'
                                                            </div>
                                                        </div>';
                                $count++;
                            }
                        }
                        $content_html .=            '</div>
                                                </div>
                                            </div>';
                        break;
                    
                    default:                        
                        if(empty($item) && empty($item_res)) $item_res = '0:1,480:2,768:3,990:4,1200:5';
                        if(empty($item)) $item = 5;
                        if(empty($size)) $size = array(268,322);
                        $tab_html .=    '<li class="'.$f_class.'"><a href="'.esc_url('#'.$pre.$tab).'" data-toggle="tab">'.$title_tab.'</a></li>';
                        $content_html .=    '<div role="tabpanel" class="tab-pane fade in '.$f_class.'" id="'.$pre.$tab.'">
                                                <div class="popular-cat-slider slider-home5">
                                                    <div class="wrap-item smart-slider" data-item="'.esc_attr($item).'" data-speed="'.esc_attr($speed).'" data-itemres="'.esc_attr($item_res).'" data-prev="" data-next="" data-pagination="" data-navigation="true">';
                        if($query->have_posts()) {
                            while($query->have_posts()) {
                                $query->the_post();
                                global $product;                      
                                if($count % 2 == 1) $content_html .=    '<div class="item">';
                                $content_html .=        '<div class="item-product5">
                                                            '.sv_product_thumb_hover2($size).'
                                                            <div class="product-info5">
                                                                <h3 class="title-product"><a href="'.esc_url(get_the_permalink()).'">'.get_the_title().'</a></h3>
                                                                '.sv_get_product_price().'
                                                                '.sv_get_rating_html().'
                                                            </div>
                                                        </div>';
                                if($count % 2 == 0 || $count == $count_query) $content_html .=    '</div>';
                                $count++;
                            }
                        }
                        $content_html .=            '</div>
                                                </div>
                                            </div>'; 
                        break;
                }
                
            }
            switch ($style) {
                case 'home7-ajax':
                    $data_load = array(
                        "number"        => $number,
                        "order"         => $order,
                        "order_by"      => $order_by,
                        "cats"          => $cats,
                        "size"          => $size,
                        );
                    $data_loadjs = json_encode($data_load);
                    $cats_html = $adv_html = '';
                    if(!empty($adv_img)){
                        $adv_html .=   '<div class="banner-adv07 banner-adv line-scale zoom-image">
                                            <a href="'.esc_url($link).'" class="adv-thumb-link">'.wp_get_attachment_image($adv_img,'full').'</a>
                                        </div>';
                    }
                    if(!empty($cats)) {
                        $custom_list = explode(",",$cats);
                        $cats_html .=   '<div class="list-cat07">
                                            <ul class="list-none">';
                        foreach ($custom_list as $cat) {
                            $term = get_term_by( 'slug',$cat, 'product_cat' );
                            if(!empty($term) && is_object($term)){
                                $term_link = get_term_link( $term->term_id, 'product_cat' );
                                $cats_html .=    '<li><a href="'.esc_url($term_link).'">'.$term->name.'</a></li>';
                            }
                        }
                        $cats_html .=       '</ul>
                                        </div>';
                    }
                    $html .=    '<div class="block-product2 '.esc_attr($box_color).'" data-load_data="'.esc_attr($data_loadjs).'">
                                    <div class="block-title2 special-slider-header style2">
                                        <h2 class="title-special inline-block">'.$title.'</h2>                                        
                                        <ul class="list-inline-block inline-block list-cat-title2">
                                            '.$tab_html.'
                                        </ul>
                                    </div>
                                    <div class="block-product07 clearfix">
                                        '.$cats_html.'
                                        '.$adv_html.'
                                        '.$content_html.'
                                    </div>
                                </div>';
                    break;

                case 'home6':
                    $html .=    '<div class="block-product06">
                                    <div class="title-block06 font-bold text-uppercase">
                                        <h2 class="title18 color">'.$title.'</h2>
                                        <a href="'.esc_url($link).'" class="viewall title12">'.esc_html__("view all","supershop").' <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                    <div class="title-tab06 font-bold text-uppercase">
                                        <ul class="list-inline-block list-tab06 title12">
                                            '.$tab_html.'
                                        </ul>
                                    </div>
                                    <div class="tab-content">
                                        '.$content_html.'
                                    </div>
                                </div>';
                    break;

                case 'home5':
                    $html .=    '<div class="product-tab05">
                                    <div class="block-title05">
                                        <ul class="list-inline-block title-tab05">
                                            '.$tab_html.'
                                        </ul>
                                    </div>
                                    <div class="tab-content">
                                        '.$content_html.'
                                    </div>
                                </div>';
                    break;
                
                default: 
                    $html .=    '<div class="content-popular5 content-popular01">
                                    <div class="popular-cat-title">
                                        <ul>
                                            '.$tab_html.'
                                        </ul>
                                    </div>
                                    <div class="tab-content">
                                        '.$content_html.'
                                    </div>
                                </div>';
                    break;
            }
        }        
        wp_reset_postdata();
        return $html;
    }
}

stp_reg_shortcode('sv_product_tab','sv_vc_product_tab');
if(isset($_GET['return'])) $check_add = $_GET['return'];
if(empty($check_add)) add_action( 'vc_before_init_base','sv_admin_product_tab',10,100 );
if ( ! function_exists( 'sv_admin_product_tab' ) ) {
    function sv_admin_product_tab(){
        vc_map( array(
            "name"      => esc_html__("SV Product Tab", 'supershop'),
            "base"      => "sv_product_tab",
            "icon"      => "icon-st",
            "category"  => '7Up-theme',
            "params"    => array(
                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__("Style",'supershop'),
                    "param_name"    => "style",
                    "value"         => array(
                        esc_html__("Default",'supershop')     => '',
                        esc_html__("Home 5",'supershop')     => 'home5',
                        esc_html__("Home 6",'supershop')     => 'home6',
                        esc_html__("Home 7(Ajax)",'supershop')     => 'home7-ajax',
                        )
                ),
                array(
                    "type"          => "textfield",
                    "holder"        => 'div',
                    "heading"       => esc_html__("Title",'supershop'),
                    "param_name"    => "title",
                ),
                array(
                    "type"          => "attach_image",
                    "heading"       => esc_html__("Image Adv",'supershop'),
                    "param_name"    => "adv_img",
                    "dependency"    => array(
                        "element"   => "style",
                        "value"   => array("home7-ajax"),
                        )
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Link view",'supershop'),
                    "param_name"    => "link",
                    "dependency"    => array(
                        "element"   => "style",
                        "value"   => array("home6","home7-ajax"),
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
                        "value"   => 'home7-ajax',
                        )
                ),
                array(
                    "type"          => "checkbox",
                    "heading"       => esc_html__("Tabs",'supershop'),
                    "param_name"    => "tabs",
                    "value"         => array(
                        esc_html__("Best Sellers",'supershop')     => 'best-sellers',
                        esc_html__("New Arrivals",'supershop')     => 'new-arrivals',
                        esc_html__("On Sale",'supershop')          => 'on-sale',
                        esc_html__("Featured",'supershop')         => 'special',
                        esc_html__("Popular",'supershop')          => 'popular',
                        )
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Number product",'supershop'),
                    "param_name"    => "number",
                    'description'   => esc_html__( 'Number of product display in this element. Default is 6.', 'supershop' ),
                ),
                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__("Order",'supershop'),
                    "param_name"    => "order",
                    "value"         => array(
                        esc_html__('Desc','supershop') => 'DESC',
                        esc_html__('Asc','supershop')  => 'ASC',
                        ),
                    'edit_field_class'=>'vc_col-sm-6 vc_column'
                ),
                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__("Order By",'supershop'),
                    "param_name"    => "order_by",
                    "value"         => sv_get_order_list(),
                    'edit_field_class'=>'vc_col-sm-6 vc_column'
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
    // Home 7 ajax
    add_action( 'wp_ajax_load_tab_products', 's7upf_load_tab_products' );
    add_action( 'wp_ajax_nopriv_load_tab_products', 's7upf_load_tab_products' );
    if(!function_exists('s7upf_load_tab_products')){
        function s7upf_load_tab_products() {
            $tab = $_POST['tab'];
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
                );
            if($tab == 'best-sellers'){
                $args['meta_key'] = 'total_sales';
                $args['orderby'] = 'meta_value_num';
            }
            if($tab == 'new-arrivals'){
                $args['order'] = 'DESC';
                $args['orderby'] = 'ID';
            }
            if($tab == 'on-sale'){
                $args['meta_query']['relation'] = "OR";
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
            if($tab == 'special'){
                $args['tax_query'][] =  array(
                                            'taxonomy' => 'product_visibility',
                                            'field'    => 'name',
                                            'terms'    => 'featured',
                                            'operator' => 'IN',
                                        );
            }
            if($tab == 'popular'){
                $args['orderby'] = 'meta_value_num';
                $args['meta_key'] = 'post_views';
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
                                            <h3 class="title-product"><a href="'.esc_url(get_the_permalink()).'" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a></h3>
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