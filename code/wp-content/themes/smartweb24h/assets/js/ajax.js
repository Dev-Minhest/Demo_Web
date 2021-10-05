(function($){
    "use strict";

    //Shop Filter
    function get_shop_filter(seff){
        var filter = {};
        filter['price'] = {};
        filter['cats'] = [];
        filter['attributes'] = {};
        var terms = [];
        var min_price = $('#min_price').attr('data-min');
        var max_price = $('#max_price').attr('data-max');
        if($('#slider-range')){
            min_price = $('#slider-range').attr('data-min');
            max_price = $('#slider-range').attr('data-max');
        }
        filter['min_price'] = min_price;
        filter['max_price'] = max_price;
        seff.toggleClass('active');
        if(seff.hasClass('page-numbers')){
            seff.parents('.page-numbers').find('.page-numbers').not(seff).removeClass('current');
            seff.parents('.page-numbers').find('.page-numbers').not(seff).removeClass('active');
            seff.addClass('current');
            seff.addClass('active');
        }
        else{
            $('.page-numbers').removeClass('current');
            $('.page-numbers').removeClass('active');
            $('.page-numbers li').first().find('.page-numbers').addClass('current active');
        }
        if(seff.attr('data-type')){
            seff.parents('.shop-tab-select').find('a.load-shop-ajax').not(seff).removeClass('active');
            seff.parents('.shop-tab-select').find('li').not(seff.parent()).removeClass('active');
            seff.parent().addClass('active');
            seff.addClass('active');
        }      
        if($('.price_label .from')) filter['price']['min'] = $('#min_price').val();
        if($('.price_label .to')) filter['price']['max'] = $('#max_price').val();
        if($('#slider-range')){
            filter['price']['min'] = $('.price-min-filter').val();
            filter['price']['max'] = $('.price-max-filter').val();
        }
        if($('.woocommerce-ordering')) filter['orderby'] = $('select[name="orderby"]').val();
        if($('.page-numbers.current')) filter['page'] = $('.page-numbers.current').html();
        if($('.page-numbers.active')) filter['page'] = $('.page-numbers.active').html();
        if($('.product-content-list').attr('data-number')) filter['number'] = $('.product-content-list').attr('data-number');
        if($('.product-content-list').attr('data-column')) filter['column'] = $('.product-content-list').attr('data-column');
        var i = 1;
        $('.load-shop-ajax.active').each(function(){
            var seff2 = $(this);
            if(seff2.attr('data-type')){
                if(i == 1) filter['type'] = seff2.attr('data-type');
                i++;
            }
            if(seff2.attr('data-attribute') && seff2.attr('data-term')){
                if(!filter['attributes'][seff2.attr('data-attribute')]) filter['attributes'][seff2.attr('data-attribute')] = [];
                if($.inArray(seff2.attr('data-term'),filter['attributes'][seff2.attr('data-attribute')])) filter['attributes'][seff2.attr('data-attribute')].push(seff2.attr('data-term'));
            }
            if(seff2.attr('data-cat') && $.inArray(seff2.attr('data-cat'),filter['cats'])) filter['cats'].push(seff2.attr('data-cat'));
            if(seff2.attr('data-number')) filter['number'] = seff2.attr('data-number');
        })
        if($('.content-shop').attr('data-cats')) filter['cats'].push($('.content-shop').attr('data-cats'));
        // console.log(filter['attributes']);
        return filter;
    }
    function load_ajax_shop(e){
        e.preventDefault();
        var filter = get_shop_filter($(this));
        var content = $('.main-shop-load');
        content.addClass('loadding');
        content.append('<div class="ajax-loading"><i class="fa fa-spinner fa-spin"></i></div>');
        $.ajax({
            type : "post",
            url : ajax_process.ajaxurl,
            crossDomain: true,
            data: {
                action: "load_shop",
                filter_data: filter,
            },
            success: function(data){
                if(data[data.length-1] == '0' ){
                    data = data.split('');
                    data[data.length-1] = '';
                    data = data.join('');
                }
                content.find(".ajax-loading").remove();
                content.removeClass('loadding');
                content.html(data);
            },
            error: function(MLHttpRequest, textStatus, errorThrown){                    
                console.log(errorThrown);  
            }
        });
        console.log(filter);
        return false;
    }

    $(document).ready(function() {
        // Shop ajax
        $('.shop-ajax-enable').on('click','.load-shop-ajax,.page-numbers,.price_slider_amount .button,.range-filter .btn-filter',load_ajax_shop);
        $('.shop-ajax-enable').on('change','select[name="orderby"]',load_ajax_shop);
        $( '.shop-ajax-enable .woocommerce-ordering' ).on( 'submit', function(e) {
            e.preventDefault();
        });

        $('.add_to_wishlist').live('click',function(){
            $(this).addClass('added');
            $(this).find('i').removeClass('fa-heart-o');
            $(this).find('i').addClass('fa-heart');
        })
        /// Woocommerce Ajax
        $("body").on("click",".add_to_cart_button:not(.product_type_variable)",function(e){
            e.preventDefault();
            var product_id = $(this).attr("data-product_id");
            var seff = $(this);
            seff.append('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type : "post",
                url : ajax_process.ajaxurl,
                crossDomain: true,
                data: {
                    action: "add_to_cart",
                    product_id: product_id
                },
                success: function(data){
                    seff.find('.fa-spinner').remove();
                    var cart_content = data.fragments['div.widget_shopping_cart_content'];
                    $('.mini-cart-content').html(cart_content);
                    var count_item = cart_content.split("<li").length;
                    $('.cart-item-count').html(count_item-1);
                    var price = $('.content-mini-cart').find('.mini-cart-total').find('.total-price').html();
                    $('.total-mini-cart-price').html(price);
                    if($('.list-mini-cart-item').length > 0){
                        if($('.list-mini-cart-item').height() >= 260) $('.list-mini-cart-item').mCustomScrollbar();
                    }
                },
                error: function(MLHttpRequest, textStatus, errorThrown){                    
                    console.log(errorThrown);  
                }
            });
        });

        $('body').on('click', '.btn-remove', function(e){
            e.preventDefault();
            var cart_item_key = $(this).parents('.item-info-cart').attr("data-key");
            console.log(cart_item_key);
            var element = $(this).parents('.item-info-cart');
            var currency = ["د.إ","лв.","kr.","Kr.","Rs.","руб."];
            var decimal = $("#num-decimal").val();
            function get_currency(pricehtml){
                var check,index,price,i;
                for(i = 0;i<6;i++){
                    if(pricehtml.search(currency[i]) != -1)  {
                        check = true;
                        index = i;
                    }
                }
                if(check) price =  pricehtml.replace(currency[index],"");
                else price = pricehtml.replace(/[^0-9\.]+/g,"");
                return price;
            }
            $.ajax({
                type: 'POST',
                url: ajax_process.ajaxurl,                
                crossDomain: true,
                data: { 
                    action: 'product_remove',
                    cart_item_key: cart_item_key
                },
                success: function(data){
                    console.log(data);
                    var price_html = element.find('span.amount').html();
                    var price = get_currency(price_html);
                    var qty = element.find('.qty-product').find('span').html();
                    var price_remove = price*qty;
                    var current_total_html = $(".total-price").find(".amount").html();
                    console.log(price);
                    var current_total = get_currency(current_total_html);
                    var new_total = current_total-price_remove;
                    new_total = parseFloat(new_total).toFixed(decimal);
                    current_total_html = current_total_html.replace(',','');
                    var new_total_html = current_total_html.replace(current_total,new_total);
                    element.slideUp().remove();
                    $(".total-price").find(".amount").html(new_total_html);
                    $(".total-mini-cart-price").html(new_total_html);
                    var current_html = $('.cart-item-count').html();
                    $('.cart-item-count').html(current_html-1);
                },
                error: function(MLHttpRequest, textStatus, errorThrown){  
                    console.log(errorThrown);  
                }
            });
            return false;
        });

        $('body').on('click','.product-quick-view', function(e){            
            $.fancybox.showLoading();
            var product_id = $(this).attr('data-product-id');
            $.ajax({
                type: 'POST',
                url: ajax_process.ajaxurl,                
                crossDomain: true,
                data: { 
                    action: 'product_popup_content',
                    product_id: product_id
                },
                success: function(res){
                    // console.log(res);
                    if(res[res.length-1] == '0' ){
                        res = res.split('');
                        res[res.length-1] = '';
                        res = res.join('');
                    }
                    $.fancybox.hideLoading();
                    $.fancybox(res, {
                        onStart: function(opener) {                            
                            if ($(opener).attr('id') == 'login') {
                                $.get('/hicommon/authenticated', function(res) { 
                                    if ('yes' == res) {
                                      console.log('this user must have already authenticated in another browser tab, SO I want to avoid opening the fancybox.');
                                      return false;
                                    } else {
                                      console.log('the user is not authenticated');
                                      return true;
                                    }
                                }); 
                            }
                        },
                    });
                    /*!
 * Variations Plugin
 */
!function(a,b,c,d){a.fn.wc_variation_form=function(){var c=this,f=c.closest(".product"),g=parseInt(c.data("product_id"),10),h=c.data("product_variations"),i=h===!1,j=!1,k=c.find(".reset_variations");return c.unbind("check_variations update_variation_values found_variation"),c.find(".reset_variations").unbind("click"),c.find(".variations select").unbind("change focusin"),c.on("click",".reset_variations",function(){return c.find(".variations select").val("").change(),c.trigger("reset_data"),!1}).on("reload_product_variations",function(){h=c.data("product_variations"),i=h===!1}).on("reset_data",function(){var b={".sku":"o_sku",".product_weight":"o_weight",".product_dimensions":"o_dimensions"};a.each(b,function(a,b){var c=f.find(a);c.attr("data-"+b)&&c.text(c.attr("data-"+b))}),c.wc_variations_description_update(""),c.trigger("reset_image"),c.find(".single_variation_wrap").slideUp(200).trigger("hide_variation")}).on("reset_image",function(){var a=f.find("div.images img:eq(0)"),b=f.find("div.images a.zoom:eq(0)"),c=a.attr("data-o_src"),e=a.attr("data-o_title"),g=a.attr("data-o_title"),h=b.attr("data-o_href");c!==d&&a.attr("src",c),h!==d&&b.attr("href",h),e!==d&&(a.attr("title",e),b.attr("title",e)),g!==d&&a.attr("alt",g)}).on("change",".variations select",function(){if(c.find('input[name="variation_id"], input.variation_id').val("").change(),c.find(".wc-no-matching-variations").remove(),i){j&&j.abort();var b=!0,d=!1,e={};c.find(".variations select").each(function(){var c=a(this).data("attribute_name")||a(this).attr("name");0===a(this).val().length?b=!1:d=!0,e[c]=a(this).val()}),b?(e.product_id=g,j=a.ajax({url:wc_cart_fragments_params.wc_ajax_url.toString().replace("%%endpoint%%","get_variation"),type:"POST",data:e,success:function(a){a?(c.find('input[name="variation_id"], input.variation_id').val(a.variation_id).change(),c.trigger("found_variation",[a])):(c.trigger("reset_data"),c.find(".single_variation_wrap").after('<p class="wc-no-matching-variations woocommerce-info">'+wc_add_to_cart_variation_params.i18n_no_matching_variations_text+"</p>"),c.find(".wc-no-matching-variations").slideDown(200))}})):c.trigger("reset_data"),d?"hidden"===k.css("visibility")&&k.css("visibility","visible").hide().fadeIn():k.css("visibility","hidden")}else c.trigger("woocommerce_variation_select_change"),c.trigger("check_variations",["",!1]),a(this).blur();c.trigger("woocommerce_variation_has_changed")}).on("focusin touchstart",".variations select",function(){i||(c.trigger("woocommerce_variation_select_focusin"),c.trigger("check_variations",[a(this).data("attribute_name")||a(this).attr("name"),!0]))}).on("found_variation",function(a,b){var e=f.find("div.images img:eq(0)"),g=f.find("div.images a.zoom:eq(0)"),h=e.attr("data-o_src"),i=e.attr("data-o_title"),j=e.attr("data-o_alt"),k=g.attr("data-o_href"),l=b.image_src,m=b.image_link,n=b.image_caption,o=b.image_title;c.find(".single_variation").html(b.price_html+b.availability_html),h===d&&(h=e.attr("src")?e.attr("src"):"",e.attr("data-o_src",h)),k===d&&(k=g.attr("href")?g.attr("href"):"",g.attr("data-o_href",k)),i===d&&(i=e.attr("title")?e.attr("title"):"",e.attr("data-o_title",i)),j===d&&(j=e.attr("alt")?e.attr("alt"):"",e.attr("data-o_alt",j)),l&&l.length>1?(e.attr("src",l).attr("alt",o).attr("title",o),g.attr("href",m).attr("title",n)):(e.attr("src",h).attr("alt",j).attr("title",i),g.attr("href",k).attr("title",i));var p=c.find(".single_variation_wrap"),q=f.find(".product_meta").find(".sku"),r=f.find(".product_weight"),s=f.find(".product_dimensions");q.attr("data-o_sku")||q.attr("data-o_sku",q.text()),r.attr("data-o_weight")||r.attr("data-o_weight",r.text()),s.attr("data-o_dimensions")||s.attr("data-o_dimensions",s.text()),b.sku?q.text(b.sku):q.text(q.attr("data-o_sku")),b.weight?r.text(b.weight):r.text(r.attr("data-o_weight")),b.dimensions?s.text(b.dimensions):s.text(s.attr("data-o_dimensions"));var t=!1,u=!1;b.is_purchasable&&b.is_in_stock&&b.variation_is_visible||(u=!0),b.variation_is_visible||c.find(".single_variation").html("<p>"+wc_add_to_cart_variation_params.i18n_unavailable_text+"</p>"),""!==b.min_qty?p.find(".quantity input.qty").attr("min",b.min_qty).val(b.min_qty):p.find(".quantity input.qty").removeAttr("min"),""!==b.max_qty?p.find(".quantity input.qty").attr("max",b.max_qty):p.find(".quantity input.qty").removeAttr("max"),"yes"===b.is_sold_individually&&(p.find(".quantity input.qty").val("1"),t=!0),t?p.find(".quantity").hide():u||p.find(".quantity").show(),u?p.is(":visible")?c.find(".variations_button").slideUp(200):c.find(".variations_button").hide():p.is(":visible")?c.find(".variations_button").slideDown(200):c.find(".variations_button").show(),c.wc_variations_description_update(b.variation_description),p.slideDown(200).trigger("show_variation",[b])}).on("check_variations",function(c,d,f){if(!i){var g=!0,j=!1,k={},l=a(this),m=l.find(".reset_variations");l.find(".variations select").each(function(){var b=a(this).data("attribute_name")||a(this).attr("name");0===a(this).val().length?g=!1:j=!0,d&&b===d?(g=!1,k[b]=""):k[b]=a(this).val()});var n=e.find_matching_variations(h,k);if(g){var o=n.shift();o?(l.find('input[name="variation_id"], input.variation_id').val(o.variation_id).change(),l.trigger("found_variation",[o])):(l.find(".variations select").val(""),f||l.trigger("reset_data"),b.alert(wc_add_to_cart_variation_params.i18n_no_matching_variations_text))}else l.trigger("update_variation_values",[n]),f||l.trigger("reset_data"),d||l.find(".single_variation_wrap").slideUp(200).trigger("hide_variation");j?"hidden"===m.css("visibility")&&m.css("visibility","visible").hide().fadeIn():m.css("visibility","hidden")}}).on("update_variation_values",function(b,d){i||(c.find(".variations select").each(function(b,c){var e,f=a(c);f.data("attribute_options")||f.data("attribute_options",f.find("option:gt(0)").get()),f.find("option:gt(0)").remove(),f.append(f.data("attribute_options")),f.find("option:gt(0)").removeClass("attached"),f.find("option:gt(0)").removeClass("enabled"),f.find("option:gt(0)").removeAttr("disabled"),e="undefined"!=typeof f.data("attribute_name")?f.data("attribute_name"):f.attr("name");for(var g in d)if("undefined"!=typeof d[g]){var h=d[g].attributes;for(var i in h)if(h.hasOwnProperty(i)){var j=h[i];if(i===e){var k="";d[g].variation_is_active&&(k="enabled"),j?(j=a("<div/>").html(j).text(),j=j.replace(/'/g,"\\'"),j=j.replace(/"/g,'\\"'),f.find('option[value="'+j+'"]').addClass("attached "+k)):f.find("option:gt(0)").addClass("attached "+k)}}}f.find("option:gt(0):not(.attached)").remove(),f.find("option:gt(0):not(.enabled)").attr("disabled","disabled")}),c.trigger("woocommerce_update_variation_values"))}),c.trigger("wc_variation_form"),c};var e={find_matching_variations:function(a,b){for(var c=[],d=0;d<a.length;d++){var f=a[d];e.variations_match(f.attributes,b)&&c.push(f)}return c},variations_match:function(a,b){var c=!0;for(var e in a)if(a.hasOwnProperty(e)){var f=a[e],g=b[e];f!==d&&g!==d&&0!==f.length&&0!==g.length&&f!==g&&(c=!1)}return c}};a.fn.wc_variations_description_update=function(b){var c=this,d=c.find(".woocommerce-variation-description");if(0===d.length)b&&(c.find(".single_variation_wrap").prepend(a('<div class="woocommerce-variation-description" style="border:1px solid transparent;">'+b+"</div>").hide()),c.find(".woocommerce-variation-description").slideDown(200));else{var e=d.outerHeight(!0),f=0,g=!1;d.css("height",e),d.html(b),d.css("height","auto"),f=d.outerHeight(!0),Math.abs(f-e)>1&&(g=!0,d.css("height",e)),g&&d.animate({height:f},{duration:200,queue:!1,always:function(){d.css({height:"auto"})}})}},a(function(){"undefined"!=typeof wc_add_to_cart_variation_params&&a(".variations_form").each(function(){a(this).wc_variation_form().find(".variations select:eq(0)").change()})})}(jQuery,window,document);
                    
                    //Detail Gallery
                    if($('.detail-gallery').length>0){
                        $(".detail-gallery .carousel").jCarouselLite({
                            btnNext: ".gallery-control .next",
                            btnPrev: ".gallery-control .prev",
                            speed: 800,
                            visible:4,
                        });
                        $(".detail-gallery .carousel a").on('click',function(event) {
                            event.preventDefault();
                            $(".detail-gallery .carousel a").removeClass('active');
                            $(this).addClass('active');
                            $(".detail-gallery .mid img").attr("src", $(this).find('img').attr("src"));
                            $(".detail-gallery .mid img").attr("srcset", $(this).find('img').attr("srcset"));
                        });
                    }
                    // variable product
                    if($('.wrap-attr-product.special').length > 0){
                        $('.attr-product ul li a').live('click',function(event){
                            event.preventDefault();
                            $(this).parents('ul').find('li').removeClass('active');
                            $(this).parent().addClass('active');
                            var attribute = $(this).parent().attr('data-attribute');
                            var id = $(this).parents('ul').attr('data-attribute-id');
                            $('#'+id).val(attribute);
                            $('#'+id).trigger( 'change' );
                            $('#'+id).trigger( 'focusin' );
                            return false;
                        })
                        $('.attr-product').hover(function(){
                            var seff = $(this);
                            var old_html = $(this).find('ul').html();
                            var current_val = $(this).find('ul li.active').attr('data-attribute');
                            $(this).next().find('select').trigger( 'focusin' );
                            var content = '';
                            $(this).next().find('select').find('option').each(function(){
                                var val = $(this).attr('value');
                                var title = $(this).html();
                                var el_class = '';
                                if(current_val == val) el_class = ' class="active"';
                                if(val != ''){
                                    if(seff.hasClass('attr-color')) content += '<li'+el_class+' data-attribute="'+val+'"><a href="#" class="color-'+val+'"></a></li>';
                                    else content += '<li'+el_class+' data-attribute="'+val+'"><a href="#">'+title+'</a></li>';
                                }
                            })
                            if(old_html != content) $(this).find('ul').html(content);
                        })
                        $('body .reset_variations').live('click',function(){
                            $('.attr-product').each(function(){
                                var seff = $(this);
                                var old_html = $(this).find('ul').html();
                                var current_val = $(this).find('ul li.active').attr('data-attribute');
                                $(this).next().find('select').trigger( 'focusin' );
                                var content = '';
                                $(this).next().find('select').find('option').each(function(){
                                    var val = $(this).attr('value');
                                    var title = $(this).html();
                                    var el_class = '';
                                    if(current_val == val) el_class = ' class="active"';
                                    if(val != ''){
                                        if(seff.hasClass('attr-color')) content += '<li'+el_class+' data-attribute="'+val+'"><a href="#" class="color-'+val+'"></a></li>';
                                        else content += '<li'+el_class+' data-attribute="'+val+'"><a href="#">'+title+'</a></li>';
                                    }
                                })
                                if(old_html != content) $(this).find('ul').html(content);
                                $(this).find('ul li').removeClass('active');
                            })
                        })
                    }
                    //end
                    //Detail Gallery Full Width
                    if($('.detail-gallery-fullwidth').length>0){
                        $(".detail-gallery-fullwidth .carousel").jCarouselLite({
                            btnNext: ".vertical-next",
                            btnPrev: ".vertical-prev",
                            speed: 800,
                            visible:4,
                            vertical: true
                        });
                        //Elevate Zoom
                        $('.detail-gallery-fullwidth .mid img').elevateZoom({
                            zoomType: "inner",
                            cursor: "crosshair",
                            zoomWindowFadeIn: 500,
                            zoomWindowFadeOut: 750
                        });
                        $(".detail-gallery-fullwidth .carousel a").on('click',function(event) {
                            event.preventDefault();
                            $(".detail-gallery-fullwidth .carousel a").removeClass('active');
                            $(this).addClass('active');
                            $(".detail-gallery-fullwidth .mid img").attr("src", $(this).find('img').attr("src"));
                            $(".detail-gallery-fullwidth .mid img").attr("srcset", $(this).find('img').attr("srcset"));
                            $(".detail-gallery-fullwidth .mid img").attr("title", $(this).find('img').attr("title"));
                            var z_url = $('.detail-gallery-fullwidth .mid img').attr('src');
                            $('.zoomWindow').css('background-image','url("'+z_url+'")');
                        });
                    }
                    //Fix product variable thumb
                    $('body .variations_form select').live('change',function(){         
                        var id = $('input[name="variation_id"]').val();
                        if(id){
                            $('.detail-gallery').find('ul').find('a[data-variation_id="'+id+'"]').trigger( 'click' );
                            $('.detail-gallery-fullwidth').find('ul').find('a[data-variation_id="'+id+'"]').trigger( 'click' );
                        }
                    })
                    //QUANTITY CLICK
                    $("body").on("click",".quantity .qty-up",function(){
                        var min = $(this).prev().attr("data-min");
                        var max = $(this).prev().attr("data-max");
                        var step = $(this).prev().attr("data-step");
                        if(step === undefined) step = 1;
                        if(max !==undefined && Number($(this).prev().val())< Number(max) || max === undefined){ 
                            if(step!='') $(this).prev().val(Number($(this).prev().val())+Number(step));
                        }
                        $( 'div.woocommerce > form input[name="update_cart"]' ).prop( 'disabled', false );
                        return false;
                    })
                    $("body").on("click",".quantity .qty-down",function(){
                        var min = $(this).next().attr("data-min");
                        var max = $(this).next().attr("data-max");
                        var step = $(this).next().attr("data-step");
                        if(step === undefined) step = 1;
                        if(Number($(this).next().val()) > 1){
                            if(min !==undefined && $(this).next().val()>min || min === undefined){
                                if(step!='') $(this).next().val(Number($(this).next().val())-Number(step));
                            }
                        }
                        $( 'div.woocommerce > form input[name="update_cart"]' ).prop( 'disabled', false );
                        return false;
                    })
                    $("body").on("keyup change","input.qty-val",function(){
                        var max = $(this).attr('data-max');
                        if( Number($(this).val()) > Number(max) ) $(this).val(max);
                        $( 'div.woocommerce > form input[name="update_cart"]' ).prop( 'disabled', false );
                    })
                    //Product Share
                    $('.share-link').on('click',function(){
                        $(this).next().slideToggle();
                        return false;
                    })
                    //END
                },
                error: function(MLHttpRequest, textStatus, errorThrown){  
                    console.log(errorThrown);  
                }
            });        
            return false;
        })

        //Product fillter Shop
        $('body').on('click', '.fillter-ajax', function(e){
            e.preventDefault();
            $(this).addClass('active');
            var href = $(this).attr('href');
            $.ajax({
                type: 'POST',
                url: href,                
                crossDomain: true,
                async: false,
                success: function(response){
                    // $(".product-content-list").html($(response).find(".product-content-list"));
                    $(".shop-tab-product").html($(response).find(".shop-tab-product"));
                },
                error: function(MLHttpRequest, textStatus, errorThrown){  
                    console.log(errorThrown);  
                }
            });
            return false;
        });
        //end

        //Set section
        $('body').on("click","#check-popup",function(){
            var checked = $(this).is(':checked');
            console.log(checked);
            $.ajax({
                type : "post",
                url : ajax_process.ajaxurl,
                crossDomain: true,
                data: {
                    action: "set_dont_show",
                    checked: checked
                },
                success: function(data){
                    console.log(data);
                },
                error: function(MLHttpRequest, textStatus, errorThrown){                    
                    console.log(errorThrown);  
                }
            });
        })
        //end
        //Load product home 6
        $('body').on('click', '.load-data-filter', function(e){
            e.preventDefault();
            var current = $(this).parents('.new-product-filter');
            var data_product = current.find('.loadmore-product-filter');
            var content = current.find('.category-filter-content .row');            
            content.parent().addClass('loadding');
            content.parent().append('<div class="ajax-loading"><i class="fa fa-spinner fa-spin"></i></div>');
            
            var this_tag = $(this).attr('data-tag');
            var this_attribute = $(this).attr('data-attribute');
            var this_term = $(this).attr('data-term');
            var this_price = $(this).attr('data-price');
            var this_cat = $(this).attr('data-cat');
            var this_product_type = $(this).attr('data-product_type');
            $(this).parents('ul').find('.load-data-filter').removeClass('active');
            var has_active = $(this).hasClass('active');
            if(has_active && !this_cat) $(this).removeClass('active');
            else $(this).addClass('active');
            if(this_tag){
                if(has_active) data_product.attr('data-tag','');
                else data_product.attr('data-tag',this_tag);
            }
            if(this_tag){
                if(has_active) data_product.attr('data-tag','');
                else data_product.attr('data-tag',this_tag);
            }
            if(this_attribute){
                if(has_active) data_product.attr('data-attribute','');
                else data_product.attr('data-attribute',this_attribute);
            }
            if(this_term){
                if(has_active) data_product.attr('data-term','');
                else data_product.attr('data-term',this_term);
            }
            if(this_price){
                if(has_active) data_product.attr('data-price','');
                else data_product.attr('data-price',this_price);
            }
            if(this_cat){
                if(has_active) data_product.attr('data-cat','');
                else data_product.attr('data-cat',this_cat);
            }
            if(this_product_type){
                if(has_active) data_product.attr('data-product_type','date');
                else data_product.attr('data-product_type',this_product_type);
            }
            data_product.attr('data-paged','1');
            var number = data_product.attr('data-number');
            var orderby = data_product.attr('data-orderby');
            var order = data_product.attr('data-order');
            var cat = data_product.attr('data-cat');
            var tag = data_product.attr('data-tag');            
            var price = data_product.attr('data-price');            
            var attribute = data_product.attr('data-attribute');            
            var term = data_product.attr('data-term');          
            var product_type = data_product.attr('data-product_type');
            $.ajax({
                type: 'POST',
                url: ajax_process.ajaxurl,                
                crossDomain: true,
                data: { 
                    action: 'load_more_product_filter',
                    number: number,
                    orderby: orderby,
                    order: order,
                    cat: cat,
                    tag: tag,
                    price: price,
                    attribute: attribute,
                    term: term,
                    product_type: product_type,
                },
                success: function(data){
                    // console.log(data);
                    if(data == '0' || data == 0 || data == ''){
                        content.parent().find('.no-product').removeClass('hidden');
                    }
                    else{
                        if(!content.parent().find('.no-product').hasClass('hidden')) content.parent().find('.no-product').addClass('hidden');
                    }
                    if(data[data.length-1] == '0' ){
                        data = data.split('');
                        data[data.length-1] = '';
                        data = data.join('');
                    }
                    content.parent().find(".ajax-loading").remove();                    
                    content.html(data);
                    content.parent().removeClass('loadding');
                    var current_maxpage = $('body #current-maxpage').val();
                    console.log(current_maxpage);
                    if(current_maxpage){
                        data_product.attr('data-maxpage',current_maxpage);
                        if(Number(current_maxpage)<= 1){
                            data_product.addClass('first-hidden');
                        }
                        else{
                            data_product.removeClass('first-hidden');  
                        }
                    }
                    $('.info-price').each(function(){
                        var sale_price = $(this).find('del').html();
                        if(sale_price){
                            $(this).find('del').remove();
                            $(this).append('<del>'+sale_price+'</del>');
                        }
                    })
                },
                error: function(MLHttpRequest, textStatus, errorThrown){  
                    console.log(errorThrown);  
                }
            });
            return false;
        });
        //end
        //Load product button home 6
        $('body').on('click', '.loadmore-product-filter', function(e){
            e.preventDefault();
            var current = $(this).parents('.new-product-filter');
            var data_product = $(this);
            var content = current.find('.category-filter-content .row');            
            content.parent().addClass('loadding');
            content.parent().append('<div class="ajax-loading"><i class="fa fa-spinner fa-spin"></i></div>');
            var number = data_product.attr('data-number');
            var orderby = data_product.attr('data-orderby');
            var order = data_product.attr('data-order');
            var cat = data_product.attr('data-cat');
            var tag = data_product.attr('data-tag');            
            var price = data_product.attr('data-price');            
            var attribute = data_product.attr('data-attribute');            
            var term = data_product.attr('data-term');          
            var product_type = data_product.attr('data-product_type');
            var paged = data_product.attr('data-paged');
            var maxpage = data_product.attr('data-maxpage');
            $.ajax({
                type: 'POST',
                url: ajax_process.ajaxurl,                
                crossDomain: true,
                data: { 
                    action: 'load_more_product_filter_button',
                    number: number,
                    orderby: orderby,
                    order: order,
                    cat: cat,
                    tag: tag,
                    price: price,
                    attribute: attribute,
                    paged: paged,
                    term: term,
                    product_type: product_type,
                },
                success: function(data){
                    // console.log(data);
                    if(data[data.length-1] == '0' ){
                        data = data.split('');
                        data[data.length-1] = '';
                        data = data.join('');
                    }
                    content.parent().find(".ajax-loading").remove();                    
                    content.append(data);
                    content.parent().removeClass('loadding');
                    paged = Number(paged) + 1;
                    data_product.attr('data-paged',paged);
                    if(Number(paged)>=Number(maxpage)){
                        data_product.addClass('first-hidden');
                    }                    
                    else data_product.removeClass('first-hidden');
                    $('.info-price').each(function(){
                        var sale_price = $(this).find('del').html();
                        if(sale_price){
                            $(this).find('del').remove();
                            $(this).append('<del>'+sale_price+'</del>');
                        }
                    })
                },
                error: function(MLHttpRequest, textStatus, errorThrown){  
                    console.log(errorThrown);  
                }
            });
            return false;
        });
        //end

        //Load cat product home 2
        $('body').on('click', '.cat-load-ajax', function(e){
            e.preventDefault();
            $(this).parents('ul').find('li').removeClass('active');
            $(this).parent().addClass('active');
            var current = $(this).parents('.block-product2');
            var data_load = $(this);
            var cats = data_load.attr('data-cat');
            var content = current.find('.product-slider2 .wrap-item');
            var load_data = current.attr('data-load_data');            
            content.parent().addClass('loadding');
            content.parent().append('<div class="ajax-loading"><i class="fa fa-spinner fa-spin"></i></div>');
            $.ajax({
                type: 'POST',
                url: ajax_process.ajaxurl,                
                crossDomain: true,
                data: { 
                    action: 'load_cat_products',
                    load_data: load_data,
                    cats: cats,
                },
                success: function(data){
                    if(data[data.length-1] == '0' ){
                        data = data.split('');
                        data[data.length-1] = '';
                        data = data.join('');
                    }
                    content.data('owlCarousel').destroy();
                    content.html(data);
                    content.parent().find(".ajax-loading").remove();
                    content.parent().removeClass('loadding');
                    var seff = content;
                    var item = seff.attr('data-item');
                    var speed = seff.attr('data-speed');
                    var itemres = seff.attr('data-itemres');
                    var text_prev = seff.attr('data-prev');
                    var text_next = seff.attr('data-next');
                    var pagination = seff.attr('data-pagination');
                    var navigation = seff.attr('data-navigation');
                    var paginumber = seff.attr('data-paginumber');
                    var autoplay;
                    if(speed === undefined) speed = '';
                    if(speed != '') autoplay = speed;
                    else autoplay = false;
                    if(item == '' || item === undefined) item = 1;
                    if(itemres === undefined) itemres = '';
                    if(text_prev == 'false') text_prev = '';
                    else{
                        if(text_prev == '' || text_prev === undefined) text_prev = '<i class="fa fa-angle-left" aria-hidden="true"></i>';
                        else text_prev = '<i class="fa '+text_prev+'" aria-hidden="true"></i>';
                    }
                    if(text_next == 'false') text_next = '';
                    else{
                        if(text_next == '' || text_next === undefined) text_next = '<i class="fa fa-angle-right" aria-hidden="true"></i>';
                        else text_next = '<i class="fa '+text_next+' aria-hidden="true"></i>';
                    }
                    if(pagination == 'true') pagination = true;
                    else pagination = false;
                    if(navigation == 'true') navigation = true;
                    else navigation = false;
                    if(paginumber == 'true') paginumber = true;
                    else paginumber = false;
                    // Item responsive
                    if(itemres == '' || itemres === undefined){
                        if(item == '1') itemres = '0:1,480:1,768:1,1024:1';
                        if(item == '2') itemres = '0:1,480:1,768:2,1024:2';
                        if(item == '3') itemres = '0:1,480:2,768:2,1024:3';
                        if(item == '4') itemres = '0:1,480:2,768:2,1024:4';
                        if(item >= '5') itemres = '0:1,480:2,568:3,1024:'+item;
                    }               
                    itemres = itemres.split(',');
                    var i;
                    for (i = 0; i < itemres.length; i++) { 
                        itemres[i] = itemres[i].split(':');
                    }
                    seff.owlCarousel({
                        items: item,
                        itemsCustom: itemres,
                        autoPlay:autoplay,
                        pagination: pagination,
                        navigation: navigation,
                        navigationText:[text_prev,text_next],
                        paginationNumbers:paginumber,
                        // afterAction:afterAction2,
                        // addClassActive : true,
                        // afterAction: afterAction,
                    });
                },
                error: function(MLHttpRequest, textStatus, errorThrown){  
                    console.log(errorThrown);  
                }
            });
            return false;
        });
        //end

        //Load tab product home 7
        $('body').on('click', '.tab-load-ajax', function(e){
            e.preventDefault();
            $(this).parents('ul').find('li').removeClass('active');
            $(this).parent().addClass('active');
            var current = $(this).parents('.block-product2');
            var data_load = $(this);
            var tab = data_load.attr('data-tab');
            var content = current.find('.product-slider2 .wrap-item');
            var load_data = current.attr('data-load_data');            
            content.parent().addClass('loadding');
            content.parent().append('<div class="ajax-loading"><i class="fa fa-spinner fa-spin"></i></div>');
            $.ajax({
                type: 'POST',
                url: ajax_process.ajaxurl,                
                crossDomain: true,
                data: { 
                    action: 'load_tab_products',
                    load_data: load_data,
                    tab: tab,
                },
                success: function(data){
                    if(data[data.length-1] == '0' ){
                        data = data.split('');
                        data[data.length-1] = '';
                        data = data.join('');
                    }
                    content.data('owlCarousel').destroy();
                    content.html(data);
                    content.parent().find(".ajax-loading").remove();
                    content.parent().removeClass('loadding');
                    var seff = content;
                    var item = seff.attr('data-item');
                    var speed = seff.attr('data-speed');
                    var itemres = seff.attr('data-itemres');
                    var text_prev = seff.attr('data-prev');
                    var text_next = seff.attr('data-next');
                    var pagination = seff.attr('data-pagination');
                    var navigation = seff.attr('data-navigation');
                    var paginumber = seff.attr('data-paginumber');
                    var autoplay;
                    if(speed === undefined) speed = '';
                    if(speed != '') autoplay = speed;
                    else autoplay = false;
                    if(item == '' || item === undefined) item = 1;
                    if(itemres === undefined) itemres = '';
                    if(text_prev == 'false') text_prev = '';
                    else{
                        if(text_prev == '' || text_prev === undefined) text_prev = '<i class="fa fa-angle-left" aria-hidden="true"></i>';
                        else text_prev = '<i class="fa '+text_prev+'" aria-hidden="true"></i>';
                    }
                    if(text_next == 'false') text_next = '';
                    else{
                        if(text_next == '' || text_next === undefined) text_next = '<i class="fa fa-angle-right" aria-hidden="true"></i>';
                        else text_next = '<i class="fa '+text_next+' aria-hidden="true"></i>';
                    }
                    if(pagination == 'true') pagination = true;
                    else pagination = false;
                    if(navigation == 'true') navigation = true;
                    else navigation = false;
                    if(paginumber == 'true') paginumber = true;
                    else paginumber = false;
                    // Item responsive
                    if(itemres == '' || itemres === undefined){
                        if(item == '1') itemres = '0:1,480:1,768:1,1024:1';
                        if(item == '2') itemres = '0:1,480:1,768:2,1024:2';
                        if(item == '3') itemres = '0:1,480:2,768:2,1024:3';
                        if(item == '4') itemres = '0:1,480:2,768:2,1024:4';
                        if(item >= '5') itemres = '0:1,480:2,568:3,1024:'+item;
                    }               
                    itemres = itemres.split(',');
                    var i;
                    for (i = 0; i < itemres.length; i++) { 
                        itemres[i] = itemres[i].split(':');
                    }
                    seff.owlCarousel({
                        items: item,
                        itemsCustom: itemres,
                        autoPlay:autoplay,
                        pagination: pagination,
                        navigation: navigation,
                        navigationText:[text_prev,text_next],
                        paginationNumbers:paginumber,
                        // afterAction:afterAction2,
                        // addClassActive : true,
                        // afterAction: afterAction,
                    });
                },
                error: function(MLHttpRequest, textStatus, errorThrown){  
                    console.log(errorThrown);  
                }
            });
            return false;
        });
        //end

    });

})(jQuery);