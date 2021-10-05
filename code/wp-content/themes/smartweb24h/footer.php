<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package 7up-framework
 */

?>
    <?php
    $page_id = sv_get_value_by_id('sv_footer_page');
    if(!empty($page_id)) {
        sv_get_footer_visual($page_id);
    }
    else{
        sv_get_footer_default();
    }
    sv_scroll_top();
    // $tp_content = '[s7upf_tool_panel image="2451" demos="%5B%7B%22title%22%3A%22Home%201%22%2C%22link%22%3A%22http%3A%2F%2F7uptheme.com%2Fwordpress%2Fsupershop%22%2C%22image_item%22%3A%222445%22%2C%22image_pre_link%22%3A%22http%3A%2F%2Fdemo.7uptheme.com%2Fhtml%2Fsupershop%2Fintro%2Fimages%2Fhome%2F02_home_v1.jpg%22%7D%2C%7B%22title%22%3A%22Home%202%22%2C%22link%22%3A%22http%3A%2F%2F7uptheme.com%2Fwordpress%2Fsupershop%2Fhome-2%2F%22%2C%22image_item%22%3A%222446%22%2C%22image_pre_link%22%3A%22http%3A%2F%2Fdemo.7uptheme.com%2Fhtml%2Fsupershop%2Fintro%2Fimages%2Fhome%2F02_home_v2.jpg%22%7D%2C%7B%22title%22%3A%22Home%203%22%2C%22link%22%3A%22http%3A%2F%2F7uptheme.com%2Fwordpress%2Fsupershop%2Fhome-3%2F%22%2C%22image_item%22%3A%222447%22%2C%22image_pre_link%22%3A%22http%3A%2F%2Fdemo.7uptheme.com%2Fhtml%2Fsupershop%2Fintro%2Fimages%2Fhome%2F02_home_v3.jpg%22%7D%2C%7B%22title%22%3A%22Home%204%22%2C%22link%22%3A%22http%3A%2F%2F7uptheme.com%2Fwordpress%2Fsupershop%2Fhome-4%2F%22%2C%22image_item%22%3A%222448%22%2C%22image_pre_link%22%3A%22http%3A%2F%2Fdemo.7uptheme.com%2Fhtml%2Fsupershop%2Fintro%2Fimages%2Fhome%2F02_home_v4.jpg%22%7D%2C%7B%22title%22%3A%22Home%205%22%2C%22link%22%3A%22http%3A%2F%2F7uptheme.com%2Fwordpress%2Fsupershop%2Fhome-5%2F%22%2C%22image_item%22%3A%222449%22%2C%22image_pre_link%22%3A%22http%3A%2F%2Fdemo.7uptheme.com%2Fhtml%2Fsupershop%2Fintro%2Fimages%2Fhome%2F02_home_v5.jpg%22%7D%2C%7B%22title%22%3A%22Home%206%22%2C%22link%22%3A%22http%3A%2F%2F7uptheme.com%2Fwordpress%2Fsupershop%2Fhome-6%2F%22%2C%22image_item%22%3A%222450%22%2C%22image_pre_link%22%3A%22http%3A%2F%2Fdemo.7uptheme.com%2Fhtml%2Fsupershop%2Fintro%2Fimages%2Fhome%2F02_home_v6.jpg%22%7D%2C%7B%22title%22%3A%22Home%207%20(New)%22%2C%22link%22%3A%22http%3A%2F%2F7uptheme.com%2Fwordpress%2Fsupershop%2Fhome-7%2F%22%2C%22image_item%22%3A%222446%22%2C%22image_pre_link%22%3A%22http%3A%2F%2Fdemo.7uptheme.com%2Fhtml%2Fsupershop%2Fintro%2Fimages%2Fhome%2F02_home_v7.jpg%22%7D%5D" title="PRE-BUILT WEBSITES" sp_link="http://7uptheme.com/wordpress/forum/forums/forum/wordpress/supershop/" doc_link="http://demo.7uptheme.com/guide/supershop/" buy_link="https://themeforest.net/item/super-shop-market-store-responsive-woocommerce-wordpress-theme/20102142"]';
    // s7upf_tool_panel($tp_content);    
    ?>
</div>
</div>
<div id="boxes"></div>
<?php wp_footer(); ?>
</body>
</html>
