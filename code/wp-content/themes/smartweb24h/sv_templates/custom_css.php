<?php
/**
 * Created by Sublime Text 2.
 * User: thanhhiep992
 * Date: 13/08/15
 * Time: 10:20 AM
 */
$bg_color = sv_get_value_by_id('body_background');
$main_color = sv_get_value_by_id('main_color');
$main_color2 = sv_get_value_by_id('main_color2');
?>
<?php
$style = '';
if(!empty($bg_color)){
    $style .= 'body
    {background-color:'.$bg_color.'}'."\n";
}
/*****BEGIN MAIN COLOR*****/
if(!empty($main_color)){
	$style .= '.footer-menu-box li a:hover,.title-product a:hover,.product-extra-link a:hover,.info-price-deal span,.content-popup h4,.main-nav > ul > li .sub-menu > li:hover>a,a:hover,.footer-box-contact .fa,.menu-footer a:hover,
    .top-menu a:hover,.total-mini-cart-price,.total-mini-cart-icon,.banner-cat-hover-info > h2,.inner-category-hover .info-price span,.list-category-hover>li> a:hover,.hot-deal-tab-title li:hover a, .hot-deal-tab-title li.active a,
    .outlet-brand > h2,.list-outlet-brand a:hover,.item-box-footer2 h2,.copyright2 a,.menu-footer2 a:hover,.author-test-info span,.product-info2 .info-price span,.item-hot-deal-product .info-price span,.top-info-right > li a:hover,
    .featured-product2.yellow-box7 .info-price span,.category-adv.yellow-box .sidebar-cat-childrent a:hover,.top-info-right > li a:hover,
    .item-hot-deal-product .title-product a:hover, .item-hot-deal-product .product-extra-link a:hover,.sidebar-cat-childrent a:hover,.featured-product2.yellow-box7 .title-product a:hover,
    .featured-product2.yellow-box7 .tags-featured-product a:hover,.contact-footer2 a:hover,.category-adv.yellow-box .tags-featured-product a:hover,
    .list-category-dropdown a:hover,.wrap-category-hover4 .list-category-dropdown .has-cat-mega::after,
    .list-category-dropdown a:hover,.list-product-hotdeal .info-price span,.item-best-seller .info-price span,.pop-cat-title,
    .list-product-new .info-price span,.item-lower-price h3 a:hover, .item-lower-price .viewall:hover,
    .box-menu-footer4 a:hover,.item-order-policy > ul li i,.copyrigh4 > a,.item-tags-footer > a:hover,.item-lower-price:hover h2 a,
    .item-privacy-shipping:hover h2, .item-privacy-shipping:hover i,.list-product-hotdeal .title-product a:hover,.best-seller-header li:hover a,.best-seller-header li.active a,
    .hot-deals > h2 i,.product-info5 .info-price span,.item-online-shipping li i,.popcat-list-box h2 span,.product-info5 .title-product > a:hover,
    .listcategory-hot.list-shop-cat a:hover,.product-thumb5 .product-extra-link a:hover,.contact-top7 i,.top-info.top-info7 > li > a i,.main-nav.main-nav7 > ul > li:hover > a, .main-nav.main-nav7 > ul li.current-menu-ancestor > a, .main-nav.main-nav7 > ul li.current-menu-item > a,
    .header-mini-cart7 .total-mini-cart-item,.featured-product2.yellow-box7 .list-cat-childrent a:hover,.great-deal-countdown .time_circles > div,
    .product-info7 .info-price span,.product-thumb7 .product-extra-link a:hover,.product-info7 .title-product a:hover,.footer-box6.footer-box7 > h2,
    .footer-bottom7 .copyrigh4.policy6 a,.footer-contact6.footer-box7 .footer-box-contact .fa,.footer-contact6.footer-box7 .footer-box-contact a,
    .deal-cat-title li.active a, .deal-cat-title li:hover a,.deal-cat-title li.active a::before,.deal-cat-title li.active a::after,.inner-content-text > h2,
    .item-tags-category a:hover,.copyright a:hover,.popular-cat-title.popular-cat-label li.active a,ul.per-page-list li a:hover,
    .product-stock > span,.product-social-extra a:hover,.detail-gallery .carousel a.active::after,.title-post-tab li.active a,.post-tags-info a:hover,
    .item-post-masonry .post-format,.single-post-leading .post-date-author > li:last-child a,.vc_tta.vc_tta-accordion.accordion-style3 .vc_tta-panel-title:hover a span, .vc_tta.vc_tta-accordion.accordion-style2 .vc_tta-panel-title:hover a span, .vc_tta.vc_tta-accordion.accordion-style1 .vc_tta-panel-title:hover a span,
    .team-circle-info h3 a:hover,.team-circle-info h3 a:hover,.about-menu a:hover,.item-contact-info a:hover,.about-info h3 a:hover,.item-contact-info .contact-icon:hover .before,.breadcrumb a:hover,
    .wrap-category-hover4 .list-category-dropdown .has-cat-mega > a::after,.main-nav > ul .sub-menu > li.current-menu-item > a,.from-blog-info h3 a:hover,.author-test-info h3 a:hover,
    .footer-bottom7 .policy4.policy6 a:hover,.slider-home3.great-deal-cat-slider .wrap-item.owl-theme .owl-controls .owl-buttons div,
    .top-info> li:hover> a,.box-category10.yellow-box .info-price span,.list-product-new .product-extra-link a:hover, .list-product-new .title-product a:hover,
    .main-nav > ul li li.current-menu-ancestor > a,.color,.item-from-blog .post-date-author a:hover, .item-from-blog .post-title a:hover, .list-category-dropdown a:hover,
    .copyrigh4.policy6 a, .footer-contact6 .footer-box-contact .fa, .footer-contact6 .footer-box-contact a, .policy4.policy6 a:hover, .product-thumb6 .product-extra-link a:hover,
    .info-price span,.item-product.item-product03 .info-price span,.product-thumb3 .product-extra-link a:hover,
    .main-nav.menu-toggle03 > ul > li.has-mega-menu .sub-menu > li > a:hover,.header-nav05 .main-nav>ul li.current-menu-item>a,
    .privacy-shipping.style2 .item-privacy-shipping:hover *,.title-tab-block4 li.active a::after,
    .header06 .search-form05 .smart-search-form::after, .list-tab06 li.active a,.box-menu-footer3 li::before
    {color:'.$main_color.'}'."\n";
    
    $style .= '.main-nav,.header-mini-cart::before,.inner-list-service,.product-info-cart .addcart-link,.deal-shop-social .deal-shop-link,.super-deal-content .view-all-deal span,.newsletter-footer input[type="submit"],
    .window-popup .close-popup,.top-toggle-info .shop-now,.hotnews-ticker-slider > label,.cat-hover-percent > strong,.list-category-hover>li> a:hover::before,.hot-deal-tab-title li.active::before,.hot-deal-tab-countdown .time_circles,
    .outlet-brand span::after,.list-outlet-brand .list-outlet-right a:hover::before,.list-service2 > div,.box-newsletter input[type="submit"],.featured-product2.yellow-box7 .title-cat-parent,
    .box-from-blog .viewall,.box-testimo .viewall,.category-adv.yellow-box .title-cat-parent,.persale,.inner-left-category-hover .expand-list-link,.product-thumb .addcart-link.addcart-single,
    .paginav-featured-slider .owl-theme .owl-controls .owl-page:hover span::before, .paginav-featured-slider .owl-theme .owl-controls .owl-page.active span::before,.category-adv.yellow-box .sidebar-cat-childrent a:hover::before,
    .slider-home2 .wrap-item.owl-theme .owl-controls .owl-buttons div:hover,.item-hot-deal-product .product-info-cart .addcart-link,
    .list-category-dropdown > li:hover::before,.slider-home4 .wrap-item.owl-theme .owl-controls .owl-buttons div:hover,.sub-menu-top li:hover,
    .best-seller-header li.active::after,.right-category-dropdown .title-category-dropdown,.main-nav.main-nav5 > ul > li > a:hover,.right-category-dropdown .title-category-dropdown,.popular-cat-title li.active,
    .title-special,.slider-home5 .wrap-item.owl-theme .owl-controls .owl-buttons div:hover,.sidebar-cat-brand .sidebar-cat-childrent li.active a::before,.popular-cat-title li.active::before,
    .title-widget-adv,.listcategory-hot.list-shop-cat a:hover span,.product-thumb5 .product-info-cart .addcart-link,.banner-slider5 .wrap-item.owl-theme .owl-controls .owl-buttons div:hover,
    .slide-adds .wrap-item.owl-theme .owl-controls .owl-page.active span,.featured-product2.yellow-box7 .best-seller-right.slider-home2 h2,
    .featured-product2.yellow-box7 .item-product-right .addcart-link.addcart-single,.newsletter7 .newsletter-form input[type="submit"],
    .list-cat-great-deal a span::after,.product-thumb7 .product-info-cart .addcart-link,.smart-search.search-form8 .smart-search-form input[type="submit"],
    .category-dropdown8 .title-category-dropdown,.box-border.box-trending8 > h2,.banner-slider8 .wrap-item.owl-theme .owl-controls .owl-buttons div:hover,.inner-content-text .shopnow,
    .title-box10,.popular-cat-label label,.popular-cat-label label::before,.list-shop-cat a span,.btn-filter,.range-filter #slider-range .ui-slider-handle.ui-state-default.ui-corner-all,
    .range-filter #slider-range .ui-widget-header,.shop-tab-select li.active a.grid-tab,.product-pagi-nav .current,.product-pagi-nav a:hover,
    .woocommerce input.button:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover,
    .woocommerce table.shop_table td.actions input[type="submit"],.woocommerce-cart .wc-proceed-to-checkout a.checkout-button,#order_review_heading,.form-row.place-order input[type="submit"],
    .title-tab-detail li:hover a, .title-tab-detail li.active a,.post-date,.post-paginav span.current,.post-paginav > a:hover, .post-paginav > a.curent-page,
    .about-menu a::after,.about-full-protec span,.form-contact input[type="submit"],.mini-cart-checkout,.search-form4 .smart-search-form input[type="submit"]:hover,
    .list-category-dropdown > li:hover>a::before,.wrap-category-dropdown .expand-category-link,.search-form2 .smart-search-form input[type="submit"]:hover,
    .search-form3.search-form5 .smart-search-form input[type="submit"],.header-mini-cart3.header-mini-cart5 .total-mini-cart-item,.mini-cart-3.mini-cart-5 .mini-cart-view,
    .slider-home5 .product-thumb3 .product-info-cart .addcart-link,.featured-product2.yellow-box7 .list-cat-childrent a::before,.featured-product2.yellow-box7 .product-info-cart .addcart-link,
    .slider-home3.great-deal-cat-slider .wrap-item.owl-theme .owl-controls .owl-buttons div:hover,.bg-color,.banner-adv .news-gal:hover,
    .sub-menu-top li.active,.top-info3 .sub-menu-top li:hover,.newsletter-form input[type=submit],.count-order, .deal-countdown8 .time_circles>div, .search-form05 .select-category .category-toggle-link::after,
    .left-category-dropdown .title-category-dropdown,.count-order, .deal-countdown8 .time_circles>div, .search-form05 .select-category .category-toggle-link::after,
    .banner-slider .wrap-item.owl-theme .owl-controls .owl-buttons div:hover, .shop-button:hover, .slider-home6 .wrap-item.owl-theme .owl-controls .owl-buttons div:hover, .wrap-item.owl-theme .owl-controls .owl-buttons div:hover,
    .product-thumb3 .product-info-cart .addcart-link,.dm-button,#widget_indexdm .dm-header .header-button > a:hover,
    .home-nav2 .dropdown-list li a:hover,.main-nav.menu-toggle03>ul li:not(.has-mega-menu)>.sub-menu,.privacy-shipping.style2,
    .privacy-shipping.style2 .item-privacy-shipping,.product-slider04 .wrap-item.owl-theme .owl-controls .owl-buttons div, .title-tab-block4 li.active a,
    .item-product04 .product-info,.arrow-style04 .slider-home6 .wrap-item.owl-theme .owl-controls .owl-buttons div,
    .arrow-style05 .wrap-item.owl-theme .owl-controls .owl-buttons div:hover, .header-nav05 .main-nav>ul > li.current-menu-item>a,.header-nav05 .main-nav>ul > li.current-menu-parent>a, .header-nav05 .main-nav>ul>li:hover>a, .title-tab05 li.active a,
    .newsletter-footer.newsletter-footer3 input[type=submit],.wrap-category-dropdown .expand-category-link,
    .main-nav .toggle-mobile-menu span, .main-nav .toggle-mobile-menu::after, .main-nav .toggle-mobile-menu::before
    {background-color:'.$main_color.'}'."\n";

    $style .= '.total-mini-cart-icon,.list-outlet-brand .mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,.paginav-featured-slider .owl-theme .owl-controls .owl-page span,
    .title-cat-mega-menu,.item-lower-price:hover,.item-privacy-shipping:hover,.great-deal-countdown .time_circles > div,
    .smart-search.search-form8 .smart-search-form,.deal-cat-title li.active a, .deal-cat-title li:hover a,
    .shop-tab-select li.active a,.product-pagi-nav a:hover,.detail-gallery .carousel a.active,.title-tab-detail li:hover a, .title-tab-detail li.active a,
    .post-paginav > a:hover, .post-paginav > a.curent-page,.post-paginav span.current,.post-readmore:hover,.about-review-thumb a:hover,
    .privacy-shipping.style2
    {border-color:'.$main_color.'}'."\n";

    $style .= '.item-pop-cat:hover
    {border-top-color:'.$main_color.'}'."\n";

    $style .= '.search-form2 .smart-search-form input[type="submit"]:hover
    {box-shadow: 0 0 0 2px '.$main_color.'}'."\n";

    $style .= '.list-category-hover > li:hover > a > img,.list-category-dropdown > li:hover > img,
    .list-category-dropdown > li:hover> a > img
    {filter: drop-shadow(1px 1px 1px '.$main_color.');
    -moz-filter: drop-shadow(1px 1px 1px '.$main_color.');
    -webkit-filter: drop-shadow(1px 1px 1px '.$main_color.');}'."\n";

    $style .= 'a.mini-cart-view,a.mini-cart-checkout{color:#fff}'."\n";

    list($r, $g, $b) = sscanf($main_color, "#%02x%02x%02x");

    $style .= '.banner-adv3 .banner-info,.item-normal04 .item-product04 .product-info
    {background-color: rgba('.$r.', '.$g.', '.$b.', 0.9)}'."\n";
}
if(!empty($main_color2)){
    $style .= '.main-color2,.color2,.footer-bottom3.bg-color .policy3 a:hover
    {color:'.$main_color2.'}'."\n";
    
    $style .= '.title-tab-product li.active a, .title-tab-product li:hover a,.super-deal-header,.title-category-dropdown,.smart-search-form input[type="submit"],
    .adv-product-info .shopnow,.header-cat-parent label,.wrap-newsletter-footer8::before,.woocommerce table.shop_table td.actions input[type="submit"]:hover,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover,.woocommerce .woocommerce-checkout table.shop_table thead,.form-row.place-order input[type="submit"]:hover,
    .form-contact input[type="submit"]:hover,.mini-cart-view,.deal-shop-social .deal-shop-link:hover,.super-deal-content .view-all-deal::after,
    .cat-menu2 li a:hover, .mini-cart02 .header-mini-cart3 .total-mini-cart-item,.bg-color2,
    .mini-cart .mini-cart-view,.title-hot-deal2 .title-special,.service-thumb a::before,.service-thumb a:hover::after,
    .arrow-style04 .slider-home6 .wrap-item.owl-theme .owl-controls .owl-buttons div:hover, .percent-sale,
    .gift-icon-slider .owl-theme .owl-controls .owl-page.active span,.bg-color .newsletter-form input[type=submit],
    .header-mini-cart2 .total-mini-cart-item,.newsletter6.bg-color .newsletter-form input[type=submit],
    .product-slider04 .wrap-item.owl-theme .owl-controls .owl-buttons div:hover,.shop-button.bg-color:hover,
    .wrap-cart-info05 .header-mini-cart3 .total-mini-cart-item,.search-form05 .smart-search-form input[type=submit]
    {background-color:'.$main_color2.'}'."\n";

    $style .= '.title-tab-product li.active a, .title-tab-product li:hover a,
    .service-thumb a::after,.service-thumb a:hover::before
    {border-color: '.$main_color2.'}'."\n";

    $style .= 'a.mini-cart-view,a.mini-cart-checkout{color:#fff}'."\n";
}
/*****END MAIN COLOR*****/

/*****BEGIN CUSTOM CSS*****/
$custom_css = sv_get_option('custom_css');
if(!empty($custom_css)){
    $style .= $custom_css."\n";
}

/*****END CUSTOM CSS*****/

/*****BEGIN MENU COLOR*****/
$menu_color = sv_get_option('sv_menu_color');
$menu_hover = sv_get_option('sv_menu_color_hover');
$menu_active = sv_get_option('sv_menu_color_active');
$menu_color2 = sv_get_option('sv_menu_color2');
$menu_hover2 = sv_get_option('sv_menu_color_hover2');
$menu_active2 = sv_get_option('sv_menu_color_active2');
if(is_array($menu_color) && !empty($menu_color)){
    $style .= '.main-nav > ul > li > a
    {';
    if(!empty($menu_color['font-color'])) $style .= 'color:'.$menu_color['font-color'].';';
    if(!empty($menu_color['font-family'])) $style .= 'font-family:'.$menu_color['font-family'].';';
    if(!empty($menu_color['font-size'])) $style .= 'font-size:'.$menu_color['font-size'].';';
    if(!empty($menu_color['font-style'])) $style .= 'font-style:'.$menu_color['font-style'].';';
    if(!empty($menu_color['font-variant'])) $style .= 'font-variant:'.$menu_color['font-variant'].';';
    if(!empty($menu_color['font-weight'])) $style .= 'font-weight:'.$menu_color['font-weight'].';';
    if(!empty($menu_color['letter-spacing'])) $style .= 'letter-spacing:'.$menu_color['letter-spacing'].';';
    if(!empty($menu_color['line-height'])) $style .= 'line-height:'.$menu_color['line-height'].';';
    if(!empty($menu_color['text-decoration'])) $style .= 'text-decoration:'.$menu_color['text-decoration'].';';
    if(!empty($menu_color['text-transform'])) $style .= 'text-transform:'.$menu_color['text-transform'].';';
    $style .= '}'."\n";
}
if(!empty($menu_hover)){
    $style .= '.main-nav > ul > li:hover > a:focus,.main-nav > ul > li:hover > a,
    .main-nav > ul li.current-menu-ancestor > a,
    .main-nav > ul li.current-menu-item > a,
    .main-nav.main-nav5 > ul > li > a:hover,
    .main-nav.main-nav6 > ul > li.current-menu-item > a, .main-nav.main-nav6 > ul > li:hover > a,
    .main-nav.main-nav7 > ul > li:hover > a, .main-nav.main-nav7 > ul > li.current-menu-ancestor > a, .main-nav.main-nav7 > ul > li.current-menu-item > a
    {color:'.$menu_hover.'}'."\n";
}
if(!empty($menu_active)){
    $style .= '.main-nav > ul > li:hover, .main-nav > ul >li.current-menu-ancestor,
    .main-nav > ul > li.current-menu-item,
    .main-nav.main-nav6 > ul > li.current-menu-item > a, .main-nav.main-nav6 > ul > li:hover > a
    {background-color:'.$menu_active.'}'."\n";
}

// Sub menu
if(is_array($menu_color2) && !empty($menu_color2)){
    $style .= '.main-nav > ul > li.menu-item-has-children li > a{';
    if(!empty($menu_color2['font-color'])) $style .= 'color:'.$menu_color2['font-color'].';';
    if(!empty($menu_color2['font-family'])) $style .= 'font-family:'.$menu_color2['font-family'].';';
    if(!empty($menu_color2['font-size'])) $style .= 'font-size:'.$menu_color2['font-size'].';';
    if(!empty($menu_color2['font-style'])) $style .= 'font-style:'.$menu_color2['font-style'].';';
    if(!empty($menu_color2['font-variant'])) $style .= 'font-variant:'.$menu_color2['font-variant'].';';
    if(!empty($menu_color2['font-weight'])) $style .= 'font-weight:'.$menu_color2['font-weight'].';';
    if(!empty($menu_color2['letter-spacing'])) $style .= 'letter-spacing:'.$menu_color2['letter-spacing'].';';
    if(!empty($menu_color2['line-height'])) $style .= 'line-height:'.$menu_color2['line-height'].';';
    if(!empty($menu_color2['text-decoration'])) $style .= 'text-decoration:'.$menu_color2['text-decoration'].';';
    if(!empty($menu_color2['text-transform'])) $style .= 'text-transform:'.$menu_color2['text-transform'].';';
    $style .= '}'."\n";
}
if(!empty($menu_hover2)){
    $style .= '.main-nav > ul > li.menu-item-has-children li.menu-item-has-children > a:focus,
    .main-nav > ul > li.menu-item-has-children li.menu-item-has-children:hover > a,
    .main-nav > ul .sub-menu > li.current-menu-item > a,
    .main-nav > ul > li .sub-menu > li:hover>a,
    .main-nav > ul > li.menu-item-has-children li.current-menu-item> a,    
    .main-nav.main-nav6 > ul li li.current-menu-ancestor > a,
    .main-nav.main-nav6 > ul .sub-menu > li.current-menu-item > a,
    .main-nav > ul > li.menu-item-has-children li.current-menu-ancestor > a,
    .main-nav > ul > li.menu-item-has-children li.current-menu-item > a,
    .main-nav.main-nav7  ul ul > li:hover > a, .main-nav.main-nav7 ul ul li.current-menu-ancestor > a, .main-nav.main-nav7 ul ul li.current-menu-item > a
    {color:'.$menu_hover2.'}'."\n";
}
if(!empty($menu_active2)){
    $style .= '.main-nav > ul > li.menu-item-has-children li.menu-item-has-children:hover,
    .main-nav > ul > li.menu-item-has-children li.current-menu-ancestor,
    .main-nav > ul > li.menu-item-has-children li.current-menu-item,
    .main-nav>ul>li:not(.has-mega-menu) .sub-menu> li:hover,
    .main-nav > ul > li.menu-item-has-children li.current-menu-ancestor
    {background-color:'.$menu_active2.'}.main-nav.main-nav5 > ul > li > a:hover{background-color:rgba(0,0,0,0)}'."\n";
}

/*****END MENU COLOR*****/

/*****BEGIN TYPOGRAPHY*****/
$typo_data = sv_get_option('sv_custom_typography');
if(is_array($typo_data) && !empty($typo_data)){
    foreach ($typo_data as $value) {
        switch ($value['typo_area']) {
            case 'header':
                $style_class = '#header';
                break;

            case 'footer':
                $style_class = '#footer';
                break;

            case 'widget':
                $style_class = '.sidebar-post .widget';
                break;
            
            default:
                $style_class = '#main-content';
                break;
        }
        $class_array = explode(',', $style_class);
        $new_class = '';
        if(is_array($class_array)){
            foreach ($class_array as $prefix) {
                $new_class .= $prefix.' '.$value['typo_heading'].',';
            }
        }
        if(!empty($new_class)) $style .= $new_class.' .nocss{';
        if(!empty($value['typography_style']['font-color'])) $style .= 'color:'.$value['typography_style']['font-color'].';';
        if(!empty($value['typography_style']['font-family'])) $style .= 'font-family:'.$value['typography_style']['font-family'].';';
        if(!empty($value['typography_style']['font-size'])) $style .= 'font-size:'.$value['typography_style']['font-size'].';';
        if(!empty($value['typography_style']['font-style'])) $style .= 'font-style:'.$value['typography_style']['font-style'].';';
        if(!empty($value['typography_style']['font-variant'])) $style .= 'font-variant:'.$value['typography_style']['font-variant'].';';
        if(!empty($value['typography_style']['font-weight'])) $style .= 'font-weight:'.$value['typography_style']['font-weight'].';';
        if(!empty($value['typography_style']['letter-spacing'])) $style .= 'letter-spacing:'.$value['typography_style']['letter-spacing'].';';
        if(!empty($value['typography_style']['line-height'])) $style .= 'line-height:'.$value['typography_style']['line-height'].';';
        if(!empty($value['typography_style']['text-decoration'])) $style .= 'text-decoration:'.$value['typography_style']['text-decoration'].';';
        if(!empty($value['typography_style']['text-transform'])) $style .= 'text-transform:'.$value['typography_style']['text-transform'].';';
        $style .= '}';
        $style .= "\n";
    }
}
/*****END TYPOGRAPHY*****/
if(!empty($style)) print $style;
?>