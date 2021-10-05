<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 15/12/15
 * Time: 10:00 AM
 */

if(!function_exists('sv_vc_lastest_post5'))
{
    function sv_vc_lastest_post5($attr)
    {
        $html = '';
        extract(shortcode_atts(array(
            'style'     => '',
            'title'     => '',
            'number'    => '5',
            'order'     => 'DESC',
            'sub'       => '',
        ),$attr));
        $args = array(
            'post_type'         => 'post',
            'posts_per_page'    => $number,
            'orderby'           => 'post_date',
            'order'             => $order,
        );
        $query = new WP_Query($args);
        $count_query = $query->post_count;        
        switch ($style) {
            case 'home-5':
                $size = array(375,250);
                $item = 4;
                $item_res = '0:1,560:2,768:3,1024:4';
                $html .=    '<div class="block-product05 latest-news05">';
                if(!empty($title)) $html .=    '<div class="block-title05">
                                                    <h2 class="title14 font-bold text-uppercase bg-color white inline-block">'.$title.'</h2>
                                                </div>';
                $html .=        '<div class="news-slider05 arrow-style05">
                                    <div class="wrap-item smart-slider" data-item="'.esc_attr($item).'" data-speed="" data-itemres="'.esc_attr($item_res).'" data-prev="" data-next="" data-pagination="" data-navigation="true">';
                if($query->have_posts()){
                    while($query->have_posts()){
                        $query->the_post();
                        $html .=    '<div class="item-blog05">
                                        <div class="banner-adv overlay-image zoom-image">
                                            <a href="'.esc_url(get_the_permalink()).'" class="adv-thumb-link">'.get_the_post_thumbnail(get_the_ID(),$size).'</a>
                                        </div>
                                        <div class="blog-info05">
                                            <h3 class="title14 font-bold"><a href="'.esc_url(get_the_permalink()).'" class="black">'.get_the_title().'</a></h3>
                                            <div class="date-comment05 table title12 silver">
                                                <div class="text-left">
                                                    <span><i class="fa fa-calendar-o"></i> '.get_the_date('d F Y').'</span>
                                                </div>
                                                <div class="text-right">
                                                    <a href="'.esc_url(get_the_permalink()).'" class="silver"><i class="fa fa-comment-o"></i> '.get_comments_number().'</a>
                                                </div>
                                            </div>
                                            <a href="'.esc_url(get_the_permalink()).'" class="readmore black">'.esc_html__("Read more","supershop").' <i class="fa fa-long-arrow-right"></i></a>
                                        </div>
                                    </div>';
                    }
                }
                $html .=            '</div>
                                </div>
                            </div>';
                break;

            case 'home-4':
                $size = array(300,300);
                $item = 2;
                $item_res = '0:1,667:2';
                $html .=    '<div class="from-blog6 from-blog03 arrow-style04">';
                if(!empty($title)) $html .=    '<h2><span>'.$title.'</span></h2>';
                $html .=        '<div class="fromblog-slider slider-home6">
                                    <div class="wrap-item smart-slider" data-item="'.esc_attr($item).'" data-speed="" data-itemres="'.esc_attr($item_res).'" data-prev="" data-next="" data-pagination="" data-navigation="true">';
                if($query->have_posts()){
                    while($query->have_posts()){
                        $query->the_post();
                        if(empty($sub)) $sub = 120;
                        $excerpt_text = sv_substr(get_the_excerpt(),0,$sub);
                        $html .=    '<div class="item-from-blog clearfix">
                                        <div class="zoom-image-thumb">
                                            <a href="'.esc_url(get_the_permalink()).'">'.get_the_post_thumbnail(get_the_ID(),$size).'</a>
                                        </div>
                                        <div class="from-blog-info">
                                            <h3 class="post-title"><a href="'.esc_url(get_the_permalink()).'">'.get_the_title().'</a></h3>
                                            <ul class="post-date-author">
                                                <li>'.esc_html__("By","supershop").': <a href="'.get_author_posts_url(get_the_author_meta('ID')).'">'.get_the_author().'</a></li>
                                                <li><a href="'.esc_url( get_comments_link() ).'">'.get_comments_number().' '.esc_html__("Comment","supershop").'</a></li>
                                            </ul>
                                            <p class="post-desc">'.$excerpt_text.'</p>
                                            <a href="'.esc_url(get_the_permalink()).'" class="shop-button text-uppercase white bg-color">'.esc_html__("Shop now","supershop").'</a>
                                        </div>
                                    </div>';
                    }
                }
                $html .=            '</div>
                                </div>
                            </div>';
                break;

            case 'home-2':
                $size = array(350,265);
                $item = 3;
                $item_res = '0:1,560:2,990:3';
                $html .=    '<div class="block-news2">';
                if(!empty($title)){
                    $html .=    '<div class="special-slider-header">
                                    <h2 class="title18 text-uppercase gray font-bold">'.esc_html($title).'</h2>
                                </div>';
                }
                $html .=        '<div class="news-slider2">
                                    <div class="wrap-item smart-slider" data-item="'.esc_attr($item).'" data-speed="" data-itemres="'.esc_attr($item_res).'" data-prev="" data-next="" data-pagination="" data-navigation="true">';
                if($query->have_posts()){
                    while($query->have_posts()){
                        $query->the_post();
                        $html .=    '<div class="item-news2">
                                        <div class="banner-adv overlay-image zoom-image">
                                            <a href="'.esc_url(get_the_permalink()).'" class="adv-thumb-link">'.get_the_post_thumbnail(get_the_ID(),$size).'</a>
                                            <a href="'.get_the_post_thumbnail_url(get_the_ID(),'full').'" class="fancybox news-gal" data-fancybox-group="gallery"><i class="fa fa-link" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="news-info2">
                                            <h3 class="title14"><a href="'.esc_url(get_the_permalink()).'">'.get_the_title().'</a></h3>
                                            <ul class="list-inline-block comment-date2 title12">
                                                <li><span class="silver"><i class="fa fa-calendar-o" aria-hidden="true"></i> '.get_the_date('d. M. Y').'</span></li>
                                                <li><a href="'.esc_url( get_comments_link() ).'" class="silver"><i class="fa fa-comments-o" aria-hidden="true"></i> '.get_comments_number().' '.esc_html__("Comments","supershop").'</a></li>
                                            </ul>
                                        </div>
                                    </div>';
                    }
                }
                $html .=            '</div>
                                </div>
                            </div>';
                break;
            
            default:
                $html .=    '<div class="from-blog6">
                                <h2><span>'.$title.'</span></h2>
                                <div class="fromblog-slider slider-home6">
                                    <div class="wrap-item">';
                if($query->have_posts()){
                    while($query->have_posts()){
                        $query->the_post();
                        if(empty($sub)) $sub = 120;
                        $excerpt_text = sv_substr(get_the_excerpt(),0,$sub);
                        $html .=    '<div class="item-from-blog clearfix">
                                        <div class="zoom-image-thumb">
                                            <a href="'.esc_url(get_the_permalink()).'">'.get_the_post_thumbnail(get_the_ID(),array(300,300)).'</a>
                                        </div>
                                        <div class="from-blog-info">
                                            <h3 class="post-title"><a href="'.esc_url(get_the_permalink()).'">'.get_the_title().'</a></h3>
                                            <ul class="post-date-author">
                                                <li>'.esc_html__("By","supershop").': <a href="'.get_author_posts_url(get_the_author_meta('ID')).'">'.get_the_author().'</a></li>
                                                <li><a href="'.esc_url( get_comments_link() ).'">'.get_comments_number().' '.esc_html__("Comment","supershop").'</a></li>
                                            </ul>
                                            <p class="post-desc">'.$excerpt_text.'</p>
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

stp_reg_shortcode('sv_lastest_post5','sv_vc_lastest_post5');

vc_map( array(
    "name"      => esc_html__("SV Latest Post", 'supershop'),
    "base"      => "sv_lastest_post5",
    "icon"      => "icon-st",
    "category"  => '7Up-theme',
    "params"    => array(
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Style",'supershop'),
            "param_name" => "style",
            "value"     => array(
                esc_html__("Home 1",'supershop')   => 'home-1',
                esc_html__("Home 2",'supershop')   => 'home-2',
                esc_html__("Home 4",'supershop')   => 'home-4',
                esc_html__("Home 5",'supershop')   => 'home-5',
                )
        ), 
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__( 'Title', 'supershop' ),
            'param_name'  => 'title',            
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__( 'Number post', 'supershop' ),
            'param_name'  => 'number',            
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
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__( 'Get Excerpt character', 'supershop' ),
            'param_name'  => 'sub',            
        ),
    )
));