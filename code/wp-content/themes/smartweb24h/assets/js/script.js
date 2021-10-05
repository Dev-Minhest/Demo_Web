(function($){
    "use strict"; // Start of use strict  
    /*==============================
        Is mobile
    ==============================*/
    var isMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    }
    function fix_menu_has_childrent_mobile(){
    	$('.main-nav .menu-item-has-children:not(.has-mega-menu)').each(function(){
    		$(this).append('<span class="expand-sub"><i class="fa fa-angle-down" aria-hidden="true"></i></span>')
    	})
    	$('.expand-sub').on('click',function(event){
				event.preventDefault();
				event.stopPropagation();
				$(this).toggleClass('active');
				$(this).parent().find('> .sub-menu').stop(true,true).slideToggle('slow');
		});
    }
    function tool_panel(){
    	$('.dm-open').on('click',function(){
    		$('#widget_indexdm').toggleClass('active');
    		$('#indexdm_img').toggleClass('active');
    		$('.dm-content .item-content').hover(
    			function(){
	    			var img_src = $(this).find('img').attr('data-src');
	    			$('.img-demo').css('display','block');
	    			$('.img-demo').css('background-image','url('+img_src+')');
	    		},
	    		function(){
	    			//$('#indexdm_img').removeClass('active');
	    			$('.img-demo').attr('style','');
	    		}
    		);
    		return false;
    	})
    }
    function s7upf_all_slider(){
    	//Carousel Slider
		if($('.smart-slider').length>0){
			$('.smart-slider').each(function(){
				var seff = $(this);
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
			});			
		}
    }
    function afterAction(){
		this.$elem.find('.owl-item').removeClass('active');
		this.$elem.find('.owl-item').eq(this.owl.currentItem).addClass('active');
		this.$elem.find('.owl-item').each(function(){
			// $(this).find('.wow').removeClass('animated');
			var check = $(this).hasClass('active');
			if(check==true){
				$(this).find('.animated').each(function(){
					var anime = $(this).attr('data-animated');
					$(this).addClass(anime);
				});
			}else{
				$(this).find('.animated').each(function(){
					var anime = $(this).attr('data-animated');
					$(this).removeClass(anime);
				});
			}
		})
	}

    //Slider Background
	function background(){
		$('.bg-slider .item-slider').each(function(){
			var src=$(this).find('.banner-thumb a img').attr('src');
			$(this).find('.banner-thumb a img').css('height',$(this).find('.banner-thumb a img').attr('height'));
			$(this).css('background-image','url("'+src+'")');
		});	
	}
    function menu_responsive(){
		$('.main-nav li.menu-item-has-children>a').on('click',function(event){				
			if($(window).width() >= 768 && isMobile.any()){
				event.preventDefault();
				event.stopPropagation();				
			}
		});
		$('body').on('click',function(event){				
			if($(window).width() < 768){
				$('.main-nav>ul').slideUp('slow');
			}
		});
		$('.toggle-mobile-menu').on('click',function(event){
			if($(window).width() < 768){
				event.preventDefault();
				event.stopPropagation();
				$('.main-nav>ul').slideToggle('slow');
			}
		});
		// $('.main-nav li.menu-item-has-children>a').on('click',function(event){
		// 	if($(window).width()<768 && !$(this).parent().hasClass('has-mega-menu')){
		// 		event.preventDefault();
		// 		event.stopPropagation();
		// 		$(this).next().stop(true,true).slideToggle('slow');
		// 	}
		// });
    }
    
    function fixed_header(){
    	if($( "body .menufixed" ).length > 0){
    		var menu_row = $(".main-nav").parents('.vc_row');
	    	var hd = $('#header').height();
	    	var ht = hd + 30;
			var st = $(window).scrollTop();
			if(st>hd){
				if(!menu_row.parent().hasClass('fixed-header')) menu_row.wrap( "<div class='container fixed-header'></div>" );
				if(st>ht) $( "body .fixed-header" ).addClass('active');
				else $( "body .fixed-header" ).removeClass('active');
				$('.set-load-active').next().slideUp();
			}else{
				if(menu_row.parent().hasClass('fixed-header')) menu_row.unwrap();
				$('.set-load-active').next().slideDown();
			}
		}
	}
	
	$(document).ready(function(){
		tool_panel();
		fix_menu_has_childrent_mobile();
		//Hover Acive
		if($('.box-hover-active').length>0){
			$('.item-hover-active').on('mouseover',function(){
				$(this).parents('.box-hover-active').find('.item-hover-active').removeClass('active');
				$(this).addClass('active');
			});
			$('.box-hover-active').on('mouseout',function(){
				$(this).find('.item-hover-active').removeClass('active');
				$(this).find('.item-active').addClass('active');
			});
		}
		//Close Top Toggle
		$('.close-top-toggle').on('click',function(event) {
			event.preventDefault();
			$('.top-toggle').slideUp('slow');
		});
		//Toggle Nav Home 3
		$('.toggle-menu-button').on('click',function(event){
			event.preventDefault();
			event.stopPropagation();
			$(this).parent().toggleClass('active');
		});
		if($('.home-nav03').length>0){
			$('.home-nav03').each(function(){
				var nav_os = $(this).offset().left;
				var par_os = $(this).parents('.container').offset().left;
				var nav_left = nav_os - par_os - 15;
				$(this).find('.toggle-nav3').css('margin-left','-' + nav_left + 'px');
			});
		}

		$('.image-lightbox').on('click',function(event){
			event.preventDefault();
			var gallerys = $(this).attr('data-gallery');
			var gallerys_array = gallerys.split(',');
			var data = [];
			if(gallerys != ''){
				for (var i = 0; i < gallerys_array.length; i++) {
					if(gallerys_array[i] != ''){
						data[i] = {};
						data[i].href = gallerys_array[i];
					}
				};
			}
			$.fancybox.open(data);
		})
		$('.fancybox').each(function(){
			$(this).fancybox();
		});
		//Thumb click
		if($('.thumb-click-all-device').length > 0){
			$('body').on('click','.product-thumb a',function(event){
				event.preventDefault();
				// $(this).parent().toggleClass('active');
				return false;
			})
		}
		if($('.thumb-click-on-mobile').length > 0 && isMobile.any()){
			$('body').on('click','.product-thumb a',function(event){
				event.preventDefault();
				// $(this).parent().toggleClass('active');
				return false;
			})
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
				zoomWindowFadeOut: 750,
			});
			$(".detail-gallery-fullwidth .carousel a").on('click',function(event) {
				event.preventDefault();
				$(".detail-gallery-fullwidth .carousel a").removeClass('active');
				$(this).addClass('active');
				$(".detail-gallery-fullwidth .mid img").attr("src", $(this).find('img').attr("src"));
				$(".detail-gallery-fullwidth .mid img").attr("srcset", $(this).find('img').attr("srcset"));
				$(".detail-gallery-fullwidth .mid img").attr("title", $(this).find('img').attr("title"));
				var z_url = $('.detail-gallery-fullwidth .mid img').attr('src');
				$.removeData($('.detail-gallery-fullwidth .mid img'), 'elevateZoom');//remove zoom instance from image
        		$('.zoomContainer').remove();
        		$('.detail-gallery-fullwidth .mid img').elevateZoom({
					zoomType: "inner",
					cursor: "crosshair",
					zoomWindowFadeIn: 500,
					zoomWindowFadeOut: 750
				});
			});
		}
		//Fixed Header
		if($(window).width()>1024){			
			fixed_header();
			$(window).scroll(function(){
				fixed_header();
			});
		}
		//Process Bar
		$('.circle-process').each(function(){
			var id = $(this).attr('id');
			var radius = $(this).attr('data-radius');
			var value = $(this).attr('data-value');
			var width = $(this).attr('data-width');
			var color1 = $(this).attr('data-color1');
			var color2 = $(this).attr('data-color2');
			var el_class = $(this).attr('data-class');
			Circles.create({
				id:                  id,
				radius:              Number(radius),
				value:               Number(value),
				maxValue:            100,
				width:               Number(width),
				colors:              [color1, color2],
				duration:            800,
				wrpClass:            'circles-wrp',
				textClass:           el_class,
				valueStrokeClass:    'circles-valueStroke',
				maxValueStrokeClass: 'circles-maxValueStroke',
				styleWrapper:        true,
				styleText:           true
			});
		})
		$('.sv-pie-chart').each(function(){
			var id = $(this).attr('id');
			var class1 = $(this).attr('data-color1');
			var class2 = $(this).attr('data-color2');
			var id = $(this).attr('id');
			$('#'+id).pieChart('#target_'+id);
			$('#target_'+id).children().find('.pieChart.pie0').attr('class','pieChart pie0 '+class1);
			$('#target_'+id).children().find('.pieChart.pie1').attr('class','pieChart pie1 '+class2);
		})
		$('.line-progressbar').each(function(){
			var id = $(this).attr('id');
			var pclass = $(this).attr('data-class');
			var value = $(this).attr('data-value');
			$( "#"+id ).progressbar({
							value: Number(value)
						});
			$(this).prev().html(value+'%');
			var val_class = $(this).find('.ui-progressbar-value').attr('class');
			$(this).find('.ui-progressbar-value').attr('class',val_class+' '+pclass);
		})
		//END
		//menu fix
		if($(window).width() >= 768){
			var c_width = $(window).width();
			$('.main-nav ul ul ul.sub-menu').each(function(){
				var left = $(this).offset().left;
				if(c_width - left < 180){
					$(this).css({"left": "-100%"})
				}
				if(left < 180){
					$(this).css({"left": "100%"})
				}
			})
		}
		//Scroll Top
		$(window).scroll(function(){
			if ($(this).scrollTop() > 300) {
				$('.back-to-top').fadeIn();
			} else {
				$('.back-to-top').fadeOut();
			}
		});
		$('.back-to-top').on('click',function(event){
			event.preventDefault();
			$('html, body').animate({scrollTop:0}, 'slow');
		});
		if($('.top-toggle-coutdown').length>0){
			$(".top-toggle-coutdown").TimeCircles({
				fg_width: 0.03,
				bg_width: 1.2,
				text_size: 0.07,
				circle_bg_color: "rgba(27,29,31,0.5)",
				time: {
					Days: {
						show: true,
						text: "day",
						color: "#fbb450"
					},
					Hours: {
						show: true,
						text: "hou",
						color: "#fbb450"
					},
					Minutes: {
						show: true,
						text: "min",
						color: "#fbb450"
					},
					Seconds: {
						show: true,
						text: "sec",
						color: "#fbb450"
					}
				}
			}); 
		}
		//Menu Responsive
		menu_responsive();
		//Outlet mCustom Scrollbar
		if($('.list-outlet-brand').length>0){
			$(".list-outlet-brand").mCustomScrollbar();
		}		
		if($('.list-mini-cart-item').length > 0){
            if($('.list-mini-cart-item').height() >= 260) $('.list-mini-cart-item').mCustomScrollbar();
        }
		
		//menu cat home 2
		$('.inner-right-category-hover ul.cat-title-list').each(function(){
			$('.inner-category-hover ul.list-category-hover').append($(this).html());
		})
		$('.content-right-category-hover').find('.inner-right-category-hover').first().addClass('active');
		$('.list-category-hover a').on('mouseover',function() {
			var id_hv = $(this).attr('data-id');
			$('.inner-right-category-hover').each(function(){
				if($(this).attr('id')==id_hv){
					$(this).addClass('active');
				}else{
					$(this).removeClass('active');
				}
			})
			
		});
		$('.list-category-hover').each(function(){
			var index = $(this).attr('data-expand');
			$('.list-category-hover>li:gt('+index+')').hide();
			$('.expand-list-link').on('click',function(event) {
				event.preventDefault();
				$(this).toggleClass('expanding');
				$('.list-category-hover>li:gt('+index+')').slideToggle('slow');
			});				
		})
		//Sticker Slider
		if($('.bxslider-ticker').length>0){
			$('.bxslider-ticker').bxSlider({
				maxSlides: 2,
				minSlides: 1,
				slideWidth: 400,
				slideMargin: 10,
				ticker: true,
				tickerHover:true,
				useCSS:false,
				speed: 50000,
			});
		}
		if($('.hot-deal-tab-countdown').length>0){
			$(".hot-deal-tab-countdown").TimeCircles({
				fg_width: 0,
				bg_width: 1,
				text_size: 0.07,
				time: {
					Days: {
						show: true,
						text: "D",
					},
					Hours: {
						show: true,
						text: "H",
					},
					Minutes: {
						show: true,
						text: "M",
					},
					Seconds: {
						show: true,
						text: "S",
					}
				}
			}); 
		}
		// if($('.deal-countdown8').length>0){
		// 	$(".deal-countdown8").TimeCircles({
		// 		fg_width: 0.01,
		// 		bg_width: 1.2,
		// 		text_size: 0.07,
		// 		circle_bg_color: "#fafafa",
		// 		time: {
		// 			Days: {
		// 				show: true,
		// 				text: "D",
		// 				color: "#e62e04"
		// 			},
		// 			Hours: {
		// 				show: true,
		// 				text: "H",
		// 				color: "#e62e04"
		// 			},
		// 			Minutes: {
		// 				show: true,
		// 				text: "M",
		// 				color: "#e62e04"
		// 			},
		// 			Seconds: {
		// 				show: true,
		// 				text: "S",
		// 				color: "#e62e04"
		// 			}
		// 		}
		// 	}); 
		// }
		//Time Countdown
		if($('.time-countdown').length>0){
			$(".time-countdown").each(function(){
				var data = $(this).data(); 
				$(this).TimeCircles({
					fg_width: data.width,
					bg_width: 0,
					text_size: 0,
					circle_bg_color: data.bg,
					time: {
						Days: {
							show: data.day,
							text: data.text[0],
							color: data.color,
						},
						Hours: {
							show: data.hou,
							text: data.text[1],
							color: data.color,
						},
						Minutes: {
							show: data.min,
							text: data.text[2],
							color: data.color,
						},
						Seconds: {
							show: data.sec,
							text: data.text[3],
							color: data.color,
						}
					}
				}); 
			});
		}
		if($('.great-deal-countdown').length>0){
			$(".great-deal-countdown").TimeCircles({
				fg_width: 0,
				bg_width: 1,
				text_size: 0.07,
				circle_bg_color: "#fff",
				time: {
					Days: {
						show: true,
						text: "d",
					},
					Hours: {
						show: true,
						text: "h",
					},
					Minutes: {
						show: true,
						text: "m",
					},
					Seconds: {
						show: true,
						text: "s",
					}
				}
			}); 
		}
		if($('.supperdeal-countdown').length>0){
			$(".supperdeal-countdown").TimeCircles({
				fg_width: 0.03,
				bg_width: 1.2,
				text_size: 0.07,
				circle_bg_color: "#5f6062",
				time: {
					Days: {
						show: true,
						text: "day",
						color: "#c6d43a"
					},
					Hours: {
						show: true,
						text: "hou",
						color: "#c6d43a"
					},
					Minutes: {
						show: true,
						text: "min",
						color: "#c6d43a"
					},
					Seconds: {
						show: true,
						text: "sec",
						color: "#c6d43a"
					}
				}
			}); 
		}
		//Toggle Filter
		$('body').on('click',function(){
			$('.box-product-filter').slideUp('slow');
		});
		$('.toggle-link-filter').on('click',function(event) {
			event.stopPropagation();
			event.preventDefault();
			$('.box-product-filter').slideToggle('slow');
		});
		$('.sv-mailchimp-form').each(function(){
			var placeholder = $(this).attr('data-placeholder');
			var submit = $(this).attr('data-submit');
			$(this).find('input[name="EMAIL"]').attr('placeholder',placeholder);
			$(this).find('input[type="submit"]').val(submit);
		})
		if($('.hotdeal-countdown5').length>0){
			$(".hotdeal-countdown5").TimeCircles({
				fg_width: 0,
				bg_width: 1,
				text_size: 0.07,
				circle_bg_color: "#f4f4f4",
				time: {
					Days: {
						show: false,
						text: "Days",
						color: "#e62e04"
					},
					Hours: {
						show: true,
						text: "Hour",
						color: "#e62e04"
					},
					Minutes: {
						show: true,
						text: "Mins",
						color: "#e62e04"
					},
					Seconds: {
						show: true,
						text: "Secs",
						color: "#e62e04"
					}
				}
			}); 
		}
		$('.info-price').each(function(){
			var sale_price = $(this).find('del').html();
			if(sale_price){
				$(this).find('del').remove();
				$(this).append('<del>'+sale_price+'</del>');
			}
		})
		if($('.hotdeal-countdown').length>0){
			$(".hotdeal-countdown").TimeCircles({
				fg_width: 0,
				bg_width: 1,
				text_size: 0.07,
				time: {
					Days: {
						show: true,
						text: "D",
					},
					Hours: {
						show: true,
						text: "H",
					},
					Minutes: {
						show: true,
						text: "M",
					},
					Seconds: {
						show: true,
						text: "S",
					}
				}
			}); 
		}
		//World Hover Dir
		$('.world-ad-box').each( function() {
			$(this).hoverdir(); 
		});
		//Close Top Toggle
		$('.close-top-toggle').on('click',function(event) {
			event.preventDefault();
			$('.top-toggle').slideUp('slow');
		});
		//Fix product variable thumb
		$('body .variations_form select').live('change',function(){			
			var id = $('input[name="variation_id"]').val();
			if(id){
				var product_variations = $('.variations_form').attr('data-product_variations');
				product_variations = JSON.parse(product_variations);
				for (var i = product_variations.length - 1; i >= 0; i--) {
					if(product_variations[i].variation_id == id) $('.product-code span').html('#'+product_variations[i].sku);
				};
				$('.detail-gallery').find('ul').find('a[data-variation_id="'+id+'"]').trigger( 'click' );
				$('.detail-gallery-fullwidth').find('a[data-variation_id="'+id+'"]').trigger( 'click' );
			}
		})
		//Widget vote
		$('.widget-vote a').on('click',function(event){
			event.preventDefault();
			$(this).toggleClass('active');
		});
		//Widget Adv
		if($('.widget-adv').length>0){
			$('.widget-adv').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items: 1,
					itemsCustom: [ 
					[0, 1], 
					[480, 1], 
					[768, 1], 
					[992, 1], 
					[1200, 1] 
					],
					pagination: true,
					navigation: false,
				});
			});
		}
		//Faqs Widget
		$('.list-post-faq li h3').on('click',function(event) {
			$('.list-post-faq li').removeClass('active');
			$(this).parent().addClass('active');
		});
		
		//My account
		$('.form-my-account .input-text').each(function(){
			$(this).prev().find('span').remove();
			var text_label = $(this).prev().html();
			$(this).attr('placeholder',text_label+'*');
		})
		//Label checkout
		$('.woocommerce-shipping-fields label.checkbox').on('click',function(){
			$(this).toggleClass('checked');
		})
		// $('.woocommerce-billing-fields .form-row').each(function(){
		// 	var label = $(this).find('label').html();
		// 	label = label.replace('<abbr class="required" title="required">','');
		// 	label = label.replace('</abbr>','');
		// 	$(this).find('input').attr('placeholder',label);
		// })
		$('.woocommerce .form-row label[for="rememberme"]').on('click',function(event){
			event.preventDefault();
			$(this).toggleClass('checked');
		})
		//Product Share
		$('.share-link').on('click',function(){
			$(this).next().slideToggle();
			return false;
		})
		//QUANTITY CLICK
		$("body").on("click",".quantity .qty-up",function(){
            var min = $(this).prev().attr("min");
            var max = $(this).prev().attr("max");
            var step = $(this).prev().attr("step");
            if(step === undefined) step = 1;
            console.log(max === '');
            if(max !==undefined && Number($(this).prev().val())< Number(max) || max === undefined || max === ''){ 
                if(step!='') $(this).prev().val(Number($(this).prev().val())+Number(step));
            }
            $( 'div.woocommerce > form input[name="update_cart"]' ).prop( 'disabled', false );
            return false;
        })
        $("body").on("click",".quantity .qty-down",function(){
            var min = $(this).next().attr("min");
            var max = $(this).next().attr("max");
            var step = $(this).next().attr("step");
            if(step === undefined) step = 1;
            if(Number($(this).next().val()) > 1){
	            if(min !==undefined && $(this).next().val()>min || min === undefined || min === ''){
	                if(step!='') $(this).next().val(Number($(this).next().val())-Number(step));
	            }
	        }
	        $( 'div.woocommerce > form input[name="update_cart"]' ).prop( 'disabled', false );
	        return false;
        })
        $("body").on("keyup change","input.qty-val",function(){
        	$( 'div.woocommerce > form input[name="update_cart"]' ).prop( 'disabled', false );
        })
		//END
		//Product Upsell
		if($('.upsell-detail').length>0){
			$('.col-md-9 .upsell-detail-slider').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items: 3,
					itemsCustom: [ 
					[0, 1], 
					[480, 1], 
					[568, 2], 
					[768, 2], 
					[992, 3], 
					[1200, 3] 
					],
					pagination: false,
					navigation: true,
					navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
				});
			});
			$('.col-md-12 .upsell-detail-slider').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items: 3,
					itemsCustom: [ 
					[0, 1], 
					[480, 1], 
					[568, 2], 
					[768, 3], 
					[992, 4], 
					[1200, 4] 
					],
					pagination: false,
					navigation: true,
					navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
				});
			});
		}	
		//Detail Gallery
		if($('.detail-gallery').length>0){
			$(".detail-gallery .carousel").jCarouselLite({
				btnNext: ".gallery-control .next",
				btnPrev: ".gallery-control .prev",
				speed: 800,
				visible:4,
			});
			//Elevate Zoom
			$('.detail-gallery .mid img').elevateZoom({
				zoomType: "inner",
				cursor: "crosshair",
				zoomWindowFadeIn: 500,
				zoomWindowFadeOut: 750
			});
			$(".detail-gallery .carousel a").on('click',function(event) {
				event.preventDefault();
				$(".detail-gallery .carousel a").removeClass('active');
				$(this).addClass('active');
				$(".detail-gallery .mid img").attr("src", $(this).find('img').attr("src"));
				$(".detail-gallery .mid img").attr("srcset", $(this).find('img').attr("srcset"));
				var z_url = $('.detail-gallery .mid img').attr('src');
				$('.zoomWindow').css('background-image','url("'+z_url+'")');
				$.removeData($('.detail-gallery .mid img'), 'elevateZoom');//remove zoom instance from image
        		$('.zoomContainer').remove();
        		$('.detail-gallery .mid img').elevateZoom({
					zoomType: "inner",
					cursor: "crosshair",
					zoomWindowFadeIn: 500,
					zoomWindowFadeOut: 750
				});
			});
		}
		//Filter title
		$('.widget-filter .widget-title').on('click',function(event){
			$(this).toggleClass('active');
			$(this).next().slideToggle('slow');
		});
		//show product number
		$('body .per-page-toggle').on('click',function(){
			$('body .per-page-list').slideToggle();
			return false;
		})
		//Fillter Price
		if($('.range-filter').length>0){
			var min = $("#slider-range").attr('data-min');
			var current_min = $("#slider-range").attr('data-current_min');
			var max = $("#slider-range").attr('data-max');
			var current_max = $("#slider-range").attr('data-current_max');
			$( ".range-filter #slider-range" ).slider({
				range: true,
				min: Number(min),
				max: Number(max),
				values: [ Number(current_min), Number(current_max) ],
				slide: function( event, ui ) {
				$( "#amount" ).html( "<span>" + ui.values[ 0 ] + "</span>" + " - " + "<span>" + ui.values[ 1 ] + "</span>" );
				$('.price-min-filter').val(ui.values[ 0 ]);
				$('.price-max-filter').val(ui.values[ 1 ]);
				}
			});
			$( ".range-filter #amount" ).html( "<span>" + $( "#slider-range" ).slider( "values", 0 )+ "</span>" + " - " + "<span>" + $( "#slider-range" ).slider( "values", 1 ) + "</span>" );
		}
		//Count item cart
		if($("#count-cart-item").length){
			var count_cart_item = $("#count-cart-item").val();
			$(".cart-item-count").html(count_cart_item);
		}
		if($(".get-count-cart-item")){
			var count_cart_item = $(".get-count-cart-item").val();
			$(".number-cart-total").html(count_cart_item);
		}
		//Blog Masonry 
		if($('.masonry-list-post').length>0){
			$('.masonry-list-post').masonry({
				// options
				itemSelector: '.item-post-masonry',
			});
		}
		//Menu Category
		$('.list-category-dropdown').each(function(){
			var index = $(this).attr('data-expand');
			$('.list-category-dropdown >li:gt('+index+')').hide();
			$('.expand-category-link').on('click',function(event) {
				event.preventDefault();
				$(this).toggleClass('expanding');
				$('.list-category-dropdown >li:gt('+index+')').slideToggle('slow');
			});				
		})
		if(isMobile.any()){
			$('.list-category-dropdown .has-cat-mega > a').on('click',function(event) {
				event.preventDefault();
			});
		}
		//Deal Count Down
		if($('.super-deal-countdown').length>0){
			$(".super-deal-countdown").TimeCircles({
				fg_width: 0.01,
				bg_width: 1.2,
				text_size: 0.07,
				circle_bg_color: "#ffffff",
				time: {
					Days: {
						show: true,
						text: "Days",
						color: "#f9bc02"
					},
					Hours: {
						show: true,
						text: "Hour",
						color: "#f9bc02"
					},
					Minutes: {
						show: true,
						text: "Mins",
						color: "#f9bc02"
					},
					Seconds: {
						show: true,
						text: "Secs",
						color: "#f9bc02"
					}
				}
			}); 
		}
		//Tab Control
		var current_id = $('.title-tab-product li.active a').attr('data-id');
		$('.content-tab-product .tab-pane').slideUp();
		$('#'+current_id).slideDown();
		$('.title-tab-product li a').on('click',function(event) {
			event.preventDefault();
			var current_id = $('.title-tab-product li.active a').attr('data-id');
			var clicked_id = $(this).attr('data-id');
			$('.title-tab-product li').removeClass('active');
			$(this).parent().addClass('active');
			if(current_id != clicked_id){
				$('#'+clicked_id).slideDown();
				$('#'+current_id).slideUp();
			}
		})
		//Close Service Box
		$('.close-service-box').on('click',function(event) {
			event.preventDefault();
			$('.list-service-box').slideUp('slow');
		});	
		//Category search
			$('body').on('click',function(){
				$('.list-category-toggle').slideUp();
			});
			// if($('.list-category-toggle:not(.mCustomScrollbar)').length>0){
			// 	$(".list-category-toggle:not(.mCustomScrollbar)").mCustomScrollbar();
			// }
			$('.category-toggle-link').on('click',function(event){
				event.stopPropagation();
				event.preventDefault();				
				$('.list-category-toggle').slideToggle();
			});
			$('.title-category-dropdown').on('click',function(){
				if(!$(this).hasClass('set-load-active') || $('.menufixed').find('.fixed-header').length > 0) $(this).next().slideToggle();
				// if($(this).hasClass('set-load-active') && $(window).width() < 1024) $(this).next().slideToggle();
			});
			$('.list-category-toggle li a').click(function(event){
				event.preventDefault();
				$(this).parents('.list-category-toggle').find('li').removeClass('active');
				$(this).parent().addClass('active');
				var x = $(this).attr('data-filter');
				if(x){
					x = x.replace('.','');
					$('.cat-value').val(x);
				}
				else $('.cat-value').val('');
				$('.category-toggle-link').text($(this).text());
			});
		//end
	});

	$(window).load(function(){
		if($('.countdown-master').length>0){
			$('.countdown-master').each(function(){
				var seconds = Number($(this).attr('data-time'));
				$(this).FlipClock(seconds,{
			        clockFace: 'HourlyCounter',
			        countdown: true,
			        autoStart: true,
			    });
			});
		}
		$('.fix-row-bg').each(function(){
			var row_class = $(this).attr('class');
			row_class = row_class.replace('vc_row wpb_row','');
			$(this).removeClass(row_class);
			$(this).removeClass('fix-row-bg');
			$(this).wrap('<div class="wrap-vc-row'+row_class+'"></div>');
		})
		if($('.list-category-toggle:not(.mCustomScrollbar)').length>0){
			$(".list-category-toggle:not(.mCustomScrollbar)").mCustomScrollbar();
		}
		s7upf_all_slider();
		//Carousel Slider
		if($('.sv-slider').length>0){
			$('.sv-slider').each(function(){
				var seff = $(this);
				var item = seff.attr('data-item');
				var speed = seff.attr('data-speed');
				var itemres = seff.attr('data-itemres');
				var animation = seff.attr('data-animation');
				var nav = seff.attr('data-nav');
				var pagination = false, navigation= true, singleItem = false;
				var autoplay;
				if(speed != '') autoplay = speed;
				else autoplay = false;
				// Navigation
				if(nav == 'nav-hidden'){
					pagination = false;
					navigation= false;
				}
				if(nav == 'gift-icon-slider' || nav == 'slide-adds' || nav == 'outlet-slider' || nav == 'nav-ontop'){
					pagination = true;
					navigation= false;
				}
				if(nav == 'banner-slider banner-slider21 slider-home3 bg-slider'){
					pagination = true;
					navigation= true;
				}
				if(animation != ''){
					singleItem = true;
					item = '1';
				}
				var prev_text = '<i class="fa fa-angle-left"></i>';
				var next_text = '<i class="fa fa-angle-right"></i>';				
				// Item responsive
				if(itemres == '' || itemres === undefined || itemres.split(',').length < 4){
					if(item == '1') itemres = '1,1,1,1';
					if(item == '2') itemres = '1,1,2,2';
					if(item == '3') itemres = '1,1,2,3';
					if(item == '4') itemres = '1,1,2,4';
					if(item >= '5') itemres = '1,2,3,5';
				}
				itemres = itemres.split(',');
				seff.owlCarousel({
					items: item,
					itemsCustom: [ 
					[0, itemres[0]], 
					[360, itemres[0]], 
					[480, itemres[1]], 
					[768, itemres[2]], 
					[992, itemres[3]], 
					[1200, item] 
					],
					autoPlay:autoplay,
					pagination: pagination,
					navigation: navigation,
					navigationText:[prev_text,next_text],
					singleItem : singleItem,
					addClassActive : true,
					beforeInit:background,
					afterAction: afterAction,
					transitionStyle : animation
				});
			});
		}
		//End
		//Parallax Slider
		if($('.parallax-slider').length>0){
			$(window).scroll(function() {
				var ot = $('.parallax-slider').offset().top;
				var sh = $('.parallax-slider').height();
				var st = $(window).scrollTop();
				var top = (($(window).scrollTop() - ot) * 0.5) + 'px';
				if(st>ot&&st<ot+sh){
					$('.parallax-slider .item-slider').css({
						'background-position': 'center ' + top
					});
				}else if(st<ot){
					$('.parallax-slider .item-slider').css({
						'background-position': 'center 0'
					});
				}else{
					return false;
				}
			});
		}
		//Featured Product Category
		if($('.featured-product-category').length>0){
			$('.featured-product-category').each(function(){
				if($(this).hasClass('product-tab22')){
					$(this).find('.wrap-item').owlCarousel({
						items: 5,
						itemsCustom: [ 
						[0, 1], 
						[480, 2], 
						[768, 3], 
						[980, 4], 
						[1200, 5] 
						],
						pagination: false,
						navigation: true,
						navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
					});
				}
				else{
					$(this).find('.wrap-item').owlCarousel({
						items: 3,
						itemsCustom: [ 
						[0, 1], 
						[480, 2], 
						[768, 1], 
						[992, 2], 
						[1200, 3] 
						],
						pagination: false,
						navigation: true,
						navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
					});
				}				
			});
		}
		//Product Tab
		if($('.product-tab-slider').length>0){
			$('.product-tab-slider').each(function(){
				if($(this).parents('.wpb_column.col-md-12').length>0){
					$(this).find('.wrap-item').owlCarousel({
						items: 4,
						itemsCustom: [ 
						[0, 1], 
						[480, 2], 
						[568, 2], 
						[800, 3],
						[992, 4],
						[1200, 4] 
						],
						pagination: false,
						navigation: true,
						navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
					});
				}
				else{
					$(this).find('.wrap-item').owlCarousel({
						items: 3,
						itemsCustom: [ 
						[0, 1], 
						[480, 2], 
						[568, 2], 
						[992, 3], 
						[1200, 3] 
						],
						pagination: false,
						navigation: true,
						navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
					});
				}
			});
		}
		//Category Filter
		if($('.category-filter-slider').length>0){
			$('.category-filter-slider').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items: 2,
					itemsCustom: [ 
					[0, 2], 
					[480, 2], 
					[768, 2], 
					[992, 2], 
					[1200, 2] 
					],
					autoPlay:true,
					autoplayHoverPause:true,
					pagination: false,
					navigation: false,
				});
			});
		}	
		//Category Brand
		if($('.category-brand-slider').length>0){
			$('.category-brand-slider').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items: 1,
					itemsCustom: [ 
					[0, 2], 
					[480, 2], 
					[768, 1], 
					[992, 1], 
					[1200, 1] 
					],
					pagination: false,
					navigation: true,
					autoPlay: true,
					autoplayHoverPause: true,
					navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
				});
			});
		}
		//Single Relared Post
		if($('.single-related-post-slider').length>0){
			$('.single-related-post-slider').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items: 1,
					itemsCustom: [ 
					[0, 1], 
					[480, 1], 
					[568, 2], 
					[768, 2], 
					[992, 3], 
					[1200, 3] 
					],
					pagination: false,
					navigation: true,
					navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
				});
			});
		}
		//Banner Shop Slider
		if($('.banner-shop-slider').length>0){
			$('.banner-shop-slider').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items: 1,
					itemsCustom: [ 
					[0, 1], 
					[480, 1], 
					[768, 1], 
					[992, 1], 
					[1200, 1] 
					],
					pagination: false,
					navigation: true,
					navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
				});
			});
		}
		//Rev Slider
		if($('.rev-slider').length>0){
			$('.rev-slider').revolution({
				startwidth:1170,
				startheight:410,
				keyboardNavigation:"off",
				navigationType:"none",		 
			});
		}
		//Deal Of The day
		if($('.dealoff-theday-slider').length>0){
			$('.dealoff-theday-slider').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items: 5,
					itemsCustom: [ 
					[0, 1], 
					[480, 2], 
					[768, 3], 
					[992, 4], 
					[1200, 5] 
					],
					pagination: false,
					navigation: true,
					navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
				});
			});
		}
		if($('.dealoff-countdown').length>0){
			$(".dealoff-countdown").TimeCircles({
				fg_width: 0,
				bg_width: 1,
				text_size: 0.07,
				circle_bg_color: "#fff",
				time: {
					Days: {
						show: false,
						text: "d",
					},
					Hours: {
						show: true,
						text: "h",
					},
					Minutes: {
						show: true,
						text: "m",
					},
					Seconds: {
						show: true,
						text: "s",
					}
				}
			}); 
		}
		//The New Slider
		if($('.best-seller3').length>0){
			$('.best-seller3').each(function(){
				if($(this).hasClass('product-box21')){
					$(this).find('.wrap-item').owlCarousel({
						items: 5,
						itemsCustom: [ 
						[0, 1], 
						[480, 2], 
						[768, 3], 
						[980, 4], 
						[1200, 5] 
						],
						pagination: false,
						navigation: true,
						navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
					});
				}
				else{
					$(this).find('.wrap-item').owlCarousel({
						items: 4,
						itemsCustom: [ 
						[0, 1], 
						[480, 2], 
						[768, 3], 
						[992, 3], 
						[1200, 4] 
						],
						pagination: false,
						navigation: true,
						navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
					});
				}
			});
		}
		//Popualar Category Slider
		if($('.content-popular5 .popular-cat-slider').length>0){
			$('.content-popular5 .popular-cat-slider').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items: 4,
					itemsCustom: [ 
					[0, 1], 
					[480, 2], 
					[768, 3], 
					[992, 3], 
					[1200, 4] 
					],
					pagination: false,
					navigation: true,
					navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
				});
			});
		}
		//Popualar Category Slider home 6
		if($('.supper-deal6 .popular-cat-slider').length>0){
			$('.supper-deal6 .popular-cat-slider').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items: 4,
					itemsCustom: [ 
					[0, 1], 
					[480, 2], 
					[768, 2], 
					[992, 3], 
					[1200, 4] 
					],
					pagination: false,
					navigation: true,
					navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
				});
			});
		}
		//Popualar Category Slider home 5
		if($('.hot-category-slider.popular-cat-slider').length>0){
			$('.hot-category-slider.popular-cat-slider').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items: 4,
					itemsCustom: [ 
					[0, 1], 
					[480, 2], 
					[768, 3], 
					[992, 3], 
					[1200, 4] 
					],
					pagination: false,
					navigation: true,
					navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
				});
			});
		}
		//Popualar Category Slider
		if($('.popular-cat-box .popular-cat-slider').length>0){
			$('.popular-cat-box .popular-cat-slider').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items: 4,
					itemsCustom: [ 
					[0, 1], 
					[480, 2], 
					[768, 3], 
					[992, 3], 
					[1200, 4] 
					],
					pagination: false,
					navigation: true,
					navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
				});
			});
		}
		//Testimo Home 3
		if($('.tab-testimo-slider').length>0){
			$('.tab-testimo-slider').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items: 1,
					itemsCustom: [ 
					[0, 1], 
					[480, 1], 
					[768, 1], 
					[992, 1], 
					[1200, 1] 
					],
					pagination: true,
					navigation: false,
				});
			});
		}
		//Best Seller Slider
		if($('.best-seller-slider').length>0){
			$('.best-seller-slider').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items: 3,
					itemsCustom: [ 
					[0, 1], 
					[480, 1], 
					[768, 2], 
					[992, 3], 
					[1200, 3] 
					],
					pagination: false,
					navigation: true,
					navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
				});
			});
		}	
		//Simple Owl Slider
		if($('.simple-owl-slider').length>0){
			$('.simple-owl-slider').each(function(){
				if($(this).hasClass('hot-deal-slider5')){
					$(this).find('.wrap-item').owlCarousel({
						items: 1,
						itemsCustom: [ 
						[0, 1], 
						[567, 2],
						[768, 1], 
						[992, 1], 
						[1200, 1] 
						],
						pagination: false,
						navigation: true,
						navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
					});
				}
				else{
					$(this).find('.wrap-item').owlCarousel({
						items: 1,
						itemsCustom: [ 
						[0, 1], 
						[567, 1],
						[768, 1], 
						[992, 1], 
						[1200, 1] 
						],
						pagination: false,
						navigation: true,
						navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
					});
				}
			});
		}
		//Brand Cat
		if($('.brand-cat-slider').length>0){
			$('.brand-cat-slider').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items: 3,
					itemsCustom: [ 
					[0, 1], 
					[480, 2], 
					[768, 1], 
					[992, 2], 
					[1200, 3] 
					],
					pagination: false,
					navigation: true,
					navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
				});
			});
		}
		//From Blog Slider
		if($('.from-blog-slider').length>0){
			$('.from-blog-slider').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items:1,
					itemsCustom: [ 
					[0, 1], 
					[480, 1], 
					[768, 1], 
					[992, 1], 
					[1200, 1] 
					],
					pagination: false,
					navigation: true,
					navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
				});
			});
		}
		//From Blog Slider
		if($('.news-slider21').length>0){
			$('.news-slider21').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items: 3,
					itemsCustom: [ 
					[0, 1], 
					[600, 2], 
					[1024, 3],
					],
					pagination: false,
					navigation: false,
				});
			});
		}
		//product home 4 Slider
		if($('.list-product-slider-home4').length>0){
			$('.list-product-slider-home4').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items: 3,
					itemsCustom: [ 
					[0, 1], 
					[480, 2], 
					[568, 2], 
					[992, 3], 
					[1200, 3] 
					],
					pagination: false,
					navigation: true,
					navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
				});
			});
		}
		//Single Relared Post
		if($('.fromblog-slider').length>0){
			$('.fromblog-slider').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items: 2,
					itemsCustom: [ 
					[0, 1], 
					[480, 1], 
					[768, 2], 
					[992, 2], 
					[1200, 2] 
					],
					pagination: false,
					navigation: true,
					navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
				});
			});
		}
		//Best Seller Right
		if($('.best-seller-right').length>0){
			$('.best-seller-right').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items: 1,
					itemsCustom: [ 
					[0, 1], 
					[480, 1], 
					[568, 2], 
					[736, 2], 
					[768, 1], 
					[992, 1], 
					[1200, 1] 
					],
					pagination: false,
					navigation: true,
					navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
				});
			});
		}
		//Great Deal category
		if($('.great-deal-cat-slider').length>0){
			$('.great-deal-cat-slider').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items: 5,
					itemsCustom: [ 
					[0, 1], 
					[480, 2], 
					[768, 3], 
					[992, 4], 
					[1200, 5] 
					],
					pagination: false,
					navigation: true,
					navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
				});
			});
		}
		//Slider Cat Parent
		if($('.slider-cat-parent').length>0){
			$('.slider-cat-parent').each(function(){
				if($(this).parents('.wpb_column.col-sm-12').length>0){
					$(this).find('.wrap-item').owlCarousel({
						items: 6,
						itemsCustom: [ 
						[0, 1], 
						[480, 2],
						[800, 3],
						[992, 4],
						[1024, 5],
						[1200, 6] 
						],
						pagination: false,
						navigation: true,
						navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
					});
				}
				else{
					$(this).find('.wrap-item').owlCarousel({
						items: 3,
						itemsCustom: [ 
						[0, 1], 
						[480, 2], 
						[768, 2], 
						[992, 2], 
						[1200, 3] 
						],
						pagination: false,
						navigation: true,
						autoHeight:true,
						navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
					});
				}
			});
		}
		//Hot Deal Slider
		if($('.hot-deal-tab-slider2 .hot-deal-slider').length>0){
			$('.hot-deal-tab-slider2 .hot-deal-slider').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items:4,
					itemsCustom: [ 
					[0, 1], 
					[480, 2], 
					[768, 2], 
					[992, 4], 
					[1200, 4] 
					],
					pagination: false,
					navigation: true,
					navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
				});
			});
		}
		//Product Best Seller
		if($('.product-bestseller-slider').length>0){
			$('.product-bestseller-slider').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items:1,
					itemsCustom: [ 
					[0, 1], 
					[480, 1], 
					[768, 1], 
					[992, 1], 
					[1200, 1] 
					],
					pagination: false,
					navigation: true,
					navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
				});
			});
		}
		//Category Best Sellser
		if($('.cat-bestsale-slider').length>0){
			$('.cat-bestsale-slider').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items: 1,
					itemsCustom: [ 
					[0, 1], 
					[480, 1], 
					[568, 2], 
					[736, 2], 
					[768, 1], 
					[992, 1], 
					[1200, 1] 
					],
					pagination: false,
					navigation: true,
					navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
				});
			});
		}
		//Paginav Featured Slider
		if($('.paginav-featured-slider').length>0){
			$('.paginav-featured-slider').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items: 1,
					itemsCustom: [ 
					[0, 1], 
					[480, 1], 
					[768, 1], 
					[992, 1], 
					[1200, 1] 
					],
					pagination: true,
					navigation: false,
				});
			});
		}
		//Category Brand Slider
		if($('.cat-brand-slider').length>0){
			$('.cat-brand-slider').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items: 2,
					itemsCustom: [ 
					[0, 2], 
					[480, 2], 
					[768, 2], 
					[992, 2], 
					[1200, 2] 
					],
					pagination: false,
					navigation: true,
					autoPlay:true,
					navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
				});
			});
		}
		//Testimonial Slider
		if($('.testimo-slider').length>0){
			$('.testimo-slider').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items:1,
					itemsCustom: [ 
					[0, 1], 
					[480, 1], 
					[768, 1], 
					[992, 1], 
					[1200, 1] 
					],
					pagination: false,
					navigation: true,
					navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
				});
			});
		}
		//Popualar Category Slider
		if($('.popular-cat-slider11').length>0){
			$('.popular-cat-slider11').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items: 5,
					itemsCustom: [ 
					[0, 1], 
					[480, 2], 
					[768, 3], 
					[992, 4], 
					[1200, 5] 
					],
					pagination: false,
					navigation: true,
					navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
				});
			});
		}
		//Hot Deal Slider Home 12
		if($('.hot-deal-tab-slider12 .hot-deal-slider').length>0){
			$('.hot-deal-tab-slider12 .hot-deal-slider').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items:5,
					itemsCustom: [ 
					[0, 1], 
					[480, 2], 
					[768, 3], 
					[992, 4], 
					[1200, 5] 
					],
					pagination: false,
					navigation: true,
					navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
				});
			});
		}
		//Owl Direct Nav
		if($('.owl-directnav').length>0){
			$('.owl-directnav').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items: 1,
					itemsCustom: [ 
					[0, 1], 
					[480, 1], 
					[768, 1], 
					[992, 1], 
					[1200, 1] 
					],
					pagination: false,
					navigation: true,
					navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
				});
			});
		}
		//Popualar Category Slider home 12
		if($('.content-popular12 .popular-cat-slider').length>0){
			$('.content-popular12 .popular-cat-slider').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items: 5,
					itemsCustom: [ 
					[0, 1], 
					[480, 2], 
					[768, 3], 
					[992, 4], 
					[1200, 5] 
					],
					pagination: false,
					navigation: true,
					navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
				});
			});
		}
		//Mega Hot Deal
		if($('.mega-hot-deal-slider').length>0){
			$('.mega-hot-deal-slider').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items: 1,
					itemsCustom: [ 
					[0, 1], 
					[480, 1], 
					[768, 1], 
					[992, 1], 
					[1200, 1] 
					],
					pagination: false,
					navigation: true,
					navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
				});
			});
		}	
		//Mega New Arrival
		if($('.mega-new-arrival-slider').length>0){
			$('.mega-new-arrival-slider').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items: 2,
					itemsCustom: [ 
					[0, 1], 
					[480, 1], 
					[768, 2], 
					[992, 2], 
					[1200, 2] 
					],
					pagination: false,
					navigation: true,
					navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
				});
			});
		}
		//Popup letter
		var content = $('#boxes-content').html();
		$('#boxes-content').html('');
		$('#boxes').html(content);
		if($('#boxes').html() != ''){
			var id = '#dialog';	
			//Get the screen height and width
			var maskHeight = $(document).height();
			var maskWidth = $(window).width();
		
			//Set heigth and width to mask to fill up the whole screen
			$('#mask').css({'width':maskWidth,'height':maskHeight});
			
			//transition effect		
			$('#mask').fadeIn(500);	
			$('#mask').fadeTo("slow",0.9);	
		
			//Get the window height and width
			var winH = $(window).height();
			var winW = $(window).width();
	              
			//Set the popup window to center
			$(id).css('top',  winH/2-$(id).height()/2);
			$(id).css('left', winW/2-$(id).width()/2);
		
			//transition effect
			$(id).fadeIn(2000); 	
		
			//if close button is clicked
			$('.window .close-popup').click(function (e) {
				//Cancel the link behavior
				e.preventDefault();
				
				$('#mask').hide();
				$('.window').hide();
			});		
			
			//if mask is clicked
			$('#mask').click(function () {
				$(this).hide();
				$('.window').hide();
			});
		}
		if($('.rtl-enable').length > 0){
			$('.vc_row[data-vc-full-width="true"]').each(function(){
				var style = $(this).attr('style');
				style = style.replace("left","right");
				$(this).attr('style',style);
			})
		}
		var w_width = $(window).width();
		$( window ).resize(function() {
			if($(window).width() >= 768) $('.main-nav>ul').slideDown();
	     //    if(prevWidth >= 768) menu_responsive();
		    // prevWidth = $(window).width();

			var c_width = $(window).width();
			setTimeout(function() {
				if($('.rtl-enable').length > 0 && c_width != w_width){
		            $('.vc_row[data-vc-full-width="true"]').each(function(){
						var style = $(this).attr('style');
						style = style.replace(" left:"," right:");
						$(this).attr('style',style);
					})
					w_width = c_width;
				}
			}, 2000);
			var image_height = $('.carousel').find('li').first().find('img').height();
			$('.carousel').find('li').find('img').css('height',image_height);
			// $('.title-category-dropdown').on('click',function(){
			// 	if(!$(this).hasClass('set-load-active') || $("#header").hasClass('menufixed')) $(this).next().slideToggle();
			// 	if($(this).hasClass('set-load-active') && $(window).width() < 1024) $(this).next().slideToggle();
			// });
		})
		//End popup letter
		var image_height = $('.carousel').find('li').first().find('img').height();
		$('.carousel').find('li').find('img').css('height',image_height);
	});
	$( document ).ajaxComplete(function( event,request, settings ) {
		$('.vc_gitem-woocommerce-product-price_html,.info-price').each(function(){
			var sale_price = $(this).find('del').html();
			if(sale_price){
				$(this).find('del').remove();
				$(this).append('<del>'+sale_price+'</del>');
			}
		})
	});

})(jQuery);