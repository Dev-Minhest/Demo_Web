<?php
/**
 * Created by Sublime Text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:20 AM
 */

add_action('admin_init', 'sv_custom_meta_boxes');
if(!function_exists('sv_custom_meta_boxes')){
    function sv_custom_meta_boxes(){
        //Format content
        $format_metabox = array(
            'id' => 'block_format_content',
            'title' => esc_html__('Format Settings', 'supershop'),
            'desc' => '',
            'pages' => array('post'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(                
                array(
                    'id' => 'format_image',
                    'label' => esc_html__('Upload Image', 'supershop'),
                    'type' => 'upload',
                ),
                array(
                    'id' => 'format_gallery',
                    'label' => esc_html__('Add Gallery', 'supershop'),
                    'type' => 'Gallery',
                ),
                array(
                    'id' => 'format_media',
                    'label' => esc_html__('Link Media', 'supershop'),
                    'type' => 'text',
                )
            ),
        );
        // SideBar
    	$sidebar_metabox_default = array(
            'id'        => 'sv_sidebar_option',
            'title'     => 'Advanced Settings',
            'desc'      => '',
            'pages'     => array( 'page','post','product'),
            'context'   => 'side',
            'priority'  => 'low',
            'fields'    => array(
                array(
                    'id'          => 'sv_sidebar_position',
                    'label'       => esc_html__('Sidebar position ','supershop'),
                    'type'        => 'select',
                    'std' => '',
                    'choices'     => array(
                        array(
                            'label'=>esc_html__('--Select--','supershop'),
                            'value'=>'',
                        ),
                        array(
                            'label'=>esc_html__('No Sidebar','supershop'),
                            'value'=>'no'
                        ),
                        array(
                            'label'=>esc_html__('Left sidebar','supershop'),
                            'value'=>'left'
                        ),
                        array(
                            'label'=>esc_html__('Right sidebar','supershop'),
                            'value'=>'right'
                        ),
                    ),

                ),
                array(
                    'id'        =>'sv_select_sidebar',
                    'label'     =>esc_html__('Selects sidebar','supershop'),
                    'type'      =>'sidebar-select',
                    'condition' => 'sv_sidebar_position:not(no),sv_sidebar_position:not()',
                ),
                array(
                    'id'          => 'sv_show_breadrumb',
                    'label'       => esc_html__('Show Breadcrumb','supershop'),
                    'type'        => 'select',
                    'choices'     => array(
                        array(
                            'label'=>esc_html__('--Select--','supershop'),
                            'value'=>'',
                        ),
                        array(
                            'label'=>esc_html__('Yes','supershop'),
                            'value'=>'yes'
                        ),
                        array(
                            'label'=>esc_html__('No','supershop'),
                            'value'=>'no'
                        ),
                    ),

                ),
                array(
                    'id'          => 'sv_menu_fixed',
                    'label'       => esc_html__('Menu Fixed','supershop'),
                    'desc'        => 'Menu change to fixed when scroll',
                    'type'        => 'select',
                    'choices'     => array(
                        array(
                            'label' =>  esc_html__('--Select--','supershop'),
                            'value' =>  '',
                        ),
                        array(
                            'label' =>  esc_html__('Yes','supershop'),
                            'value' =>  'on'
                        ),
                        array(
                            'label' =>  esc_html__('No','supershop'),
                            'value' =>  'off'
                        ),
                    ),
                ),
                array(
                    'id'          => 'sv_header_page',
                    'label'       => esc_html__('Choose page header','supershop'),
                    'type'        => 'select',
                    'choices'     => sv_list_header_page()
                ),
                array(
                    'id'          => 'sv_footer_page',
                    'label'       => esc_html__('Choose page footer','supershop'),
                    'type'        => 'page-select'
                ),
                array(
                    'id'          => 's7upf_page_style',
                    'label'       => esc_html__('Page Style','supershop'),
                    'type'        => 'select',
                    'std'         => '',
                    'choices'     => array(
                        array(
                            'label' =>  esc_html__('Default','supershop'),
                            'value' =>  '',
                        ),
                        array(
                            'label' =>  esc_html__('Page boxed','supershop'),
                            'value' =>  'content-boxed'
                        ),
                    ),
                ),
            )
        );
        $product_trendding = array(
            'id' => 'product_trendding',
            'title' => esc_html__('Product Type', 'supershop'),
            'desc' => '',
            'pages' => array('product'),
            'context' => 'side',
            'priority' => 'high',
            'fields' => array(                
                array(
                    'id'    => 'trending_product',
                    'label' => esc_html__('Product Trendding', 'supershop'),
                    'type'        => 'on-off',
                    'std'         => 'off'
                ),
            ),
        );
        $product_metabox = array(
            'id' => 'block_product_thumb_hover',
            'title' => esc_html__('Product hover image', 'supershop'),
            'desc' => '',
            'pages' => array('product'),
            'context' => 'side',
            'priority' => 'low',
            'fields' => array(                
                array(
                    'id'    => 'product_thumb_hover',
                    'label' => esc_html__('Product hover image', 'supershop'),
                    'type'  => 'upload',
                ),
                array(
                    'id'    => 'deals_time',
                    'label' => esc_html__('Deals time', 'supershop'),
                    'type'  => 'text',
                    'desc' => esc_html__('Enter deals time format housr:min. 00:00 ~ 23:59.', 'supershop'),
                ),
                array(
                    'id'          => 'product_style',
                    'label'       => esc_html__('Product Style','supershop'),
                    'type'        => 'select',
                    'choices'     => array(
                        array(
                            'value'=> '',
                            'label'=> esc_html__("-- Select --", 'supershop'),
                        ),
                        array(
                            'value'=> 'style1',
                            'label'=> esc_html__("Style 1", 'supershop'),
                        ),
                        array(
                            'value'=> 'style2',
                            'label'=> esc_html__("Style 2", 'supershop'),
                        ),
                    )
                ),
                array(
                    'id'          => 'attribute_style',
                    'label'       => esc_html__('Attributes Style','supershop'),
                    'type'        => 'select',
                    'choices'     => array(  
                        array(
                            'value'=> '',
                            'label'=> esc_html__("-- Select --", 'supershop'),
                        ),                                                  
                        array(
                            'value'=> 'default',
                            'label'=> esc_html__("Default", 'supershop'),
                        ),
                        array(
                            'value'=> 'special',
                            'label'=> esc_html__("Special", 'supershop'),
                        ),
                    )
                ),
            ),
        );
        //Show page title
        $show_page_title = array(
            'id' => 'page_title_setting',
            'title' => esc_html__('Title page setting', 'supershop'),
            'pages' => array('page'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'id' => 'show_title_page',
                    'label' => esc_html__('Show title', 'supershop'),
                    'type' => 'on-off',
                    'std'   => 'on',
                ),
                array(
                    'id' => 'show_scroll_top',
                    'label' => esc_html__('Show Scroll top', 'supershop'),
                    'type' => 'on-off',
                    'std' => 'off',
                ),
                array(
                    'id'          => 'body_background',
                    'label'       => esc_html__('Body Background color','supershop'),
                    'type'        => 'colorpicker',
                    'section'     => 'option_general',
                ),
                array(
                    'id'          => 'main_color',
                    'label'       => esc_html__('Main color','supershop'),
                    'type'        => 'colorpicker',
                    'section'     => 'option_general',
                ),
                array(
                    'id'          => 'main_color2',
                    'label'       => esc_html__('Main color 2','supershop'),
                    'type'        => 'colorpicker',
                    'section'     => 'option_general',
                ),
                array(
                    'id' => 'shop_ajax',
                    'label' => esc_html__('Shop Ajax', 'supershop'),
                    'type' => 'select',
                    'std'   => '',
                    'choices'     => array(
                        array(
                            'label'=>esc_html__('--Select--','supershop'),
                            'value'=>'',
                        ),
                        array(
                            'label'=>esc_html__('On','supershop'),
                            'value'=>'on'
                        ),
                        array(
                            'label'=>esc_html__('Off','supershop'),
                            'value'=>'off'
                        ),
                    ),
                )
            ),
        );
        if (function_exists('ot_register_meta_box')){
            ot_register_meta_box($format_metabox);
            ot_register_meta_box($sidebar_metabox_default);
            ot_register_meta_box($product_trendding);
            ot_register_meta_box($product_metabox);
            ot_register_meta_box($show_page_title);
        }
    }
}
?>