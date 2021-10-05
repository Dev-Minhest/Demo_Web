<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package 7up-framework
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
<style>
div#header {
    z-index: 999!important;
}
.vc_custom_1561735135536 {
    padding-top: 35px !important;
}
@media (max-width: 767px){
.vc_custom_1561735135536 {
    padding-top: 105px !important;
}
}
</style>
</head>
<body <?php body_class(); ?>>
<div class="wrap">
    <?php
    $page_id = sv_get_value_by_id('sv_header_page');
    $page_style = sv_get_value_by_id('s7upf_page_style');
    echo '<div class="'.esc_attr($page_style).'">';
    if(!empty($page_id)){
       sv_get_header_visual($page_id);
    }
    else{
        sv_get_header_default();
    }

    ?>


