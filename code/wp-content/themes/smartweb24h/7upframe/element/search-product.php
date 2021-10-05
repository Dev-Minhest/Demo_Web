<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:00 AM
 */

if(!function_exists('sv_vc_search_form'))
{
    function sv_vc_search_form($attr)
    {
        $html = $label_sm = '';
        extract(shortcode_atts(array(
            'style' => 'search-form3 search-form5',
            'placeholder' => '',
            'show_cat' => 'yes',
            'cats'      => ''
        ),$attr));
        ob_start();
        $search_val = get_search_query();
        if(empty($search_val)){
            $search_val = $placeholder;
        }
        $text_all = esc_html__("All Categories",'supershop');
        switch ($style) {
            case 'search-form8':
               
                break;
            
            default:
                if($style == 'search-form2' || $style == 'search-form4') $label_sm = esc_html__("Search","supershop");
                if($style == 'search-form3' || $style == 'search-form3 search-form5' || $style == 'search-form4') $text_all = esc_html__("All",'supershop');
                ?>
                <div class="smart-search <?php echo esc_attr($style)?> show-cat-<?php echo esc_attr($show_cat)?>">
                    <?php if($show_cat == 'yes'):?>
                        <div class="select-category">
                            <a href="#" class="category-toggle-link"><?php echo balanceTags($text_all)?></a>
                            <ul class="list-category-toggle sub-menu-top">
                                <li class="active"><a href="#" data-filter=""><?php echo esc_html($text_all)?></a></li>
                                <?php 
                                    if(!empty($cats)){
                                        $custom_list = explode(",",$cats);
                                        foreach ($custom_list as $key => $cat) {
                                            $term = get_term_by( 'slug',$cat, 'product_cat' );
                                            if(!empty($term) && is_object($term)){
                                                if(!empty($term) && is_object($term)){
                                                    echo '<li><a href="#" data-filter=".'.$term->slug.'">'.$term->name.'</a></li>';
                                                }
                                            }
                                        }
                                    }
                                    else{
                                        $product_cat_list = get_terms('product_cat');
                                        if(is_array($product_cat_list) && !empty($product_cat_list)){
                                            foreach ($product_cat_list as $cat) {
                                                echo '<li><a href="#" data-filter=".'.$cat->slug.'">'.$cat->name.'</a></li>';
                                            }
                                        }
                                    }
                                ?>
                            </ul>
                        </div>
                    <?php endif;?>
                    <form class="smart-search-form" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
                        <input type="text" name="s" value="<?php echo esc_attr($search_val);?>" onfocus="if (this.value==this.defaultValue) this.value = ''" onblur="if (this.value=='') this.value = this.defaultValue">
                        <input type="hidden" name="post_type" value="product" />
                        <?php if($show_cat == 'yes'):?>
                            <input class="cat-value" type="hidden" name="product_cat" value="" />
                        <?php endif;?>
                        <input type="submit" value="<?php echo esc_attr($label_sm)?>" />
                    </form>
                </div>
                <?php
                break;
        }        
        $html .=    ob_get_clean();
        return $html;
    }
}

stp_reg_shortcode('sv_search_form','sv_vc_search_form');

$check_add = '';
if(isset($_GET['return'])) $check_add = $_GET['return'];
if(empty($check_add)) add_action( 'vc_before_init_base','sv_add_admin_search',10,100 );
if ( ! function_exists( 'sv_add_admin_search' ) ) {
    function sv_add_admin_search(){
        vc_map( array(
            "name"      => esc_html__("SV Search Form", 'supershop'),
            "base"      => "sv_search_form",
            "icon"      => "icon-st",
            "category"  => '7Up-theme',
            "params"    => array(
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Style",'supershop'),
                    "param_name" => "style",
                    "value"     => array(
                        esc_html__("Home 1",'supershop')   => 'search-form3 search-form5',
                        esc_html__("Home 4",'supershop')   => 'search-form4',
                        esc_html__("Home 5",'supershop')   => 'search-form05',
                        )
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "heading" => esc_html__("Place holder input",'supershop'),
                    "param_name" => "placeholder",
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Show Category Dropdown",'supershop'),
                    "param_name" => "show_cat",
                    "value"     => array(
                        esc_html__("Yes",'supershop') => 'yes',
                        esc_html__("No",'supershop') => 'no',
                        )
                ),        
                array(
                    'holder'     => 'div',
                    'heading'     => esc_html__( 'Product Categories', 'supershop' ),
                    'type'        => 'checkbox',
                    'param_name'  => 'cats',
                    'value'       => sv_list_taxonomy('product_cat',false)
                ),
            )
        ));
    }
}