(function ($, window, _) {
	'use strict';
    
	var $doc = $(document),
			win = $(window),
			body = $('body'),
			thb_ease = new BezierEasing(0.77,0,0.175,1),
			thb_md = new MobileDetect(window.navigator.userAgent);
	
	
	var SITE = {
		thb_menuscroll: false,
		thb_cartscroll: false,
		init: function() {
			var self = this,
					obj;
			
			for (obj in self) {
				if ( self.hasOwnProperty(obj)) {
					var _method =  self[obj];
					if ( _method.selector !== undefined && _method.init !== undefined ) {
						if ( $(_method.selector).length > 0 ) {
							_method.init();
						}
					}
				}
			}
		},
		pace: {
			selector: 'body',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				if (container.hasClass('thb-preload')) {
					Pace.on("done", function(){
						TweenMax.to( $('.pace'), 1, { y: -window.innerHeight, ease: thb_ease, onComplete: function() { $('.pace').remove(); } } );
					});
				}
			}
		},
		skrollr: {
			selector: '.parallax_bg',
			init: function() {
				window.skroller = skrollr.init({
					forceHeight: false,
					easing: thb_ease,
					mobileCheck: function() {
						return false;
					}
				});
			}
		},
		custom_scroll: {
			selector: '.custom_scroll',
			init: function(el) {
				var base = this,
					container = el ? el : $(base.selector);
				
				container.each(function() {
					var _this = $(this),
							id = _this.attr('id'),
							horizontal = _this.data('horizontal') ? _this.data('horizontal') : false,
							params = {
								scrollX: horizontal, 
								scrollY: !horizontal,
								scrollbars: true,
								mouseWheel: !horizontal,
								click: true,
								interactiveScrollbars: true,
								shrinkScrollbars: 'scale',
								fadeScrollbars: false
							};

						if (_this.attr('id').indexOf('album-scroll') > -1) {
							var children = _this.find('.album_list'),
									w = 0;
							
							params.eventPassthrough = true;
							$.each(children, function() {
								w += $(this).outerWidth(true) + 4;
							});
							_this.find('>ul').width(w+10);
						}
						if (el && SITE.thb_cartscroll) {
							SITE.thb_cartscroll.refresh();
						} else {
							var newScroll = new IScroll('#'+id, params);
							if (_this.attr('id') === 'menu-scroll') {
								SITE.thb_menuscroll = newScroll;	
							}
							if (_this.attr('id') === 'cart-scroll') {
								SITE.thb_cartscroll = newScroll;	
							}
						}
						
					_this.on('touchmove', function (e) { e.preventDefault(); });
				});		 
			}
		},
		shareButton: {
			selector: '.share_button',
			init: function() {
				var base = this,
						container = $(base.selector);
						
				container.each(function() {
					var _this = $(this),
							target = $(_this.attr('href')),
							social = target.find('.social'),
							shareMain = new TimelineLite({ paused: true, onStart: function() { target.css('display', 'flex').addClass('active'); }, onReverseComplete: function() { target.css('display', 'none').removeClass('active'); } }),
							el = target.find('a');
					
					
					shareMain
						.to(target, 0.5, {opacity:1, ease: thb_ease}, "start")
						.staggerFrom(el, 0.5, { rotationX: '-90deg', opacity:0, ease: thb_ease}, 0.1);
					
					_this.on('click',function() {
						shareMain.timeScale(1).restart();
						return false;
					});
					$doc.keyup(function(e) {
						if (e.keyCode === 27 && shareMain.progress() > 0) { // ESC button
							shareMain.timeScale(1.5).reverse();
						}
					});
					target.on('click', function() {
						shareMain.timeScale(1.5).reverse();
					});
					social.on('click', function() {
						var left = (screen.width/2)-(640/2),
								top = (screen.height/2)-(440/2)-100;
						window.open($(this).attr('href'), 'mywin', 'left='+left+',top='+top+',width=640,height=440,toolbar=0');
						return false;
					});
				});
				
			}
		},
		lightbox: {
			selector: '.gallery, .isotope-grid, .collection_album, .lightbox-gallery, .multiscroll, .single-post .post-content',
			init: function() {
				var base = this,
					container = $(base.selector),
					download = $('body').hasClass('lightbox-download-enabled') ? true : false,
					zoom = $('body').hasClass('lightbox-zoom-enabled') ? true : false,
					autoplay = $('body').hasClass('lightbox-autoplay-enabled') ? true : false,
					effect = $('body').data('lightbox-effect');

				container.each(function() {
					$(this).lightGallery({
						selector: '[rel="lightbox"]',
						thumbnail: false,
						autoplay: false,
						mode: effect,
						autoplayControls: autoplay,
						pause: themeajax.settings.lightbox_autoplay_duration * 1000,
						zoom: zoom,
						download: download,
						hash: false,
						cssEasing: 'cubic-bezier(.77,0,.175,1)',
						easing: thb_ease,
						hideBarsDelay: 99999
					});
				});
			}
		},
		reviews: {
			selector: '#respond',
			init: function() {
				var base = this,
						container = $(base.selector);

				container.on( 'click', 'p.stars a', function(){
					var that = $(this);
					
					setTimeout(function(){ that.prevAll().addClass('active'); }, 10);
				});
			}
		},
		multiScroll: {
			selector: '.multiscroll',
			init: function() {
				var base = this,
					container = $(base.selector),
					autoplay = container.data('autoplay') === 'on' ? container.data('autoplay-speed') : false,
					slides = container.find('.ms-section'),
					body = $('body'),
					timeout;
				
				container.multiscroll({
					scrollingSpeed: 1000,
					easing: 'cubic-bezier(.77,0,.175,1)',
					menu: false,
					sectionsColor: [],
					navigation: true,
					navigationPosition: 'right',
					loopBottom: true,
					loopTop: true,
					css3: true,
					paddingTop: 0,
					paddingBottom: 0,
					normalScrollElements: null,
					keyboardScrolling: true,
					touchSensitivity: 5,
					
					// Custom selectors
					sectionSelector: '.ms-section',
					leftSelector: '.ms-left',
					rightSelector: '.ms-right',
					
					//events
					onLeave: function(index, nextIndex, direction){
						if (!container.hasClass('split')) {
							var color = slides.eq(nextIndex - 1).data('color');
						
							body.removeClass('logo-light logo-dark').addClass(color);
						}
					},
					afterRender: function(){
						if (!container.hasClass('split')) {
							var color = slides.eq(0).data('color');
						
							body.removeClass('logo-light logo-dark').addClass(color);
						}
						if ($('body').hasClass('thb-preload')) {
							Pace.on("done", function(){
								if (autoplay) {
									timeout = setInterval( function() {
										container.multiscroll.moveSectionDown();
									}, autoplay );
								}
							});
						} else if (autoplay) {
		        	timeout = setInterval( function() {
		        		container.multiscroll.moveSectionDown();
		        	}, autoplay );
						}
					}
				});
			}
		},
		fullMenu: {
			selector: '.thb-full-menu',
			init: function() {
				var base = this,
					container = $(base.selector),
					li_org = container.find('a'),
					children = container.find('li.menu-item-has-children');
				
				children.each(function() {
					var _this = $(this),
							menu = _this.find('>.sub-menu'),
							li = menu.find('>li>a'),
							tl = new TimelineMax({paused: true});
					
					tl
						.to(menu, 0.5, {autoAlpha: 1 }, "start")
						.staggerTo(li, 0.1, {opacity: 1, y: 0 }, 0.03, "start");
					
					_this.hoverIntent(
						function() {
							_this.addClass('sfHover');
							tl.timeScale(1).restart();
						},
						function() {
							_this.removeClass('sfHover');
							tl.timeScale(1.5).reverse();
						}
					);
				});
			}
		},
		responsiveNav: {
			selector: '#navigation-menu',
			init: function() {
				var base = this,
					container = $(base.selector),
					mt = $('.mobile-toggle'),
					mt_ani = new TimelineLite({ paused: true }),
					nav_menu = container.find('.navigation-menu>li'),
					menu_speed = container.data('menu-speed'),
					overlay = $('.menu_overlay'),
					behaviour = container.data('behaviour'),
					span = behaviour === 'thb-submenu' ? container.find('.navigation-menu li:has(".sub-menu")>a') : container.find('.navigation-menu li:has(".sub-menu")>a span');
				
				TweenLite.set(mt.find('.thb-top-line, .thb-bottom-line'), { drawSVG: "0% 26.5%"});

				mt_ani
					.to($('body'), 0, { className:"+=menu-open" }, "start" )
					.to(mt.find('.thb-mid-line'), 1, { drawSVG: "50% 50%", ease: thb_ease }, "start" )
					.to(mt.find('.thb-top-line, .thb-bottom-line'), 1, { drawSVG: "62% 100%", ease: thb_ease }, "start" )
					.to(container, 0.5, { x: 0, ease: thb_ease }, "start")
					.to(overlay, 0.5, { scaleX: 1, ease: thb_ease }, "start+=0.2")
					.staggerFromTo(nav_menu, menu_speed, { rotationX: '90deg', opacity:0}, { rotationX: '0', scaleX:1, opacity:1, ease: thb_ease}, 0.04);
					
				$('.mobile-toggle').on('click', function() {
					var _this = $(this),
							toggle = _this.data('toggle');
					if (!toggle) {
						mt_ani.timeScale(1).play();
						
						_this.data('toggle', 'on');
					} else {
						mt_ani.timeScale(1).reverse();
						_this.removeData('toggle');
					}
					return false;
				});
				overlay.on('click', function() {
					mt_ani.timeScale(1).reverse();
					$('.mobile-toggle').removeData('toggle');
					return false;
				});
				span.on('click', function(e){
					var that = $(this),
							parent = that.parents('a').length ?  that.parents('a') : that,
							menu = parent.next('.sub-menu');
					
					if (parent.hasClass('active')) {
						parent.removeClass('active');
						menu.slideUp('200', function() {
							setTimeout(function () {
								SITE.thb_menuscroll.refresh();
							}, 10);
						});
					} else {
						parent.addClass('active');
						menu.slideDown('200', function() {
							setTimeout(function () {
								SITE.thb_menuscroll.refresh();
							}, 10);
						});
					}
					e.stopPropagation();
					e.preventDefault();
				});
				
			}
		},
		isotope: {
			selector: '.isotope-grid',
			init: function() {
				var base = this,
				container = $(base.selector);
								
				container.each(function() {
					var that = $(this),
						el = that.children('.item'),
						org = [];
					
					var $grid = that.isotope({
						itemSelector : '.item',
						transitionDuration : 0,
						layoutMode: 'packery'
					});
					$grid.imagesLoaded().progress( function() {
					  $grid.isotope('layout');
					});
				});
			}
		},
		updateCart: {
			selector: '#side-cart',
			init: function() {
				SITE.updateCart.quick_cart();
				body.bind('wc_fragments_refreshed added_to_cart', SITE.updateCart.quick_cart);
			},
			quick_cart: function() {
				var base = this,
						container = $(base.selector);
		
				SITE.custom_scroll.init($('#side-cart').find('.custom_scroll'));
				$('#side-cart').on('click', '.quick_cart', function() {
					body.toggleClass('open-cart');
					return false;
				});
				$('.cart_placeholder').on('click', function() {
					body.toggleClass('open-cart');
					return false;
				});
			}
		},
		ajaxAddToCart: {
			selector: '.ajax_add_to_cart',
			init: function() {
				var base = this,
						container = $(base.selector),
						the_button;
				
				container.on('click', function() {
					the_button = $(this);
				});
				body.on('added_to_cart', function() {
					the_button.find('.thb_button_icon').html(themeajax.l10n.added_svg);
					the_button.find('span').text(themeajax.l10n.added);
				});
			}
		},
		atvImg: {
			selector: '.atvImg',
			init: function() {
				var base = this,
						container = $(base.selector);
				
					atvImg();
			}
		},
		albumOverlay: {
			selector: '.album_overlay',
			init: function() {
				var base = this,
						container = $(base.selector);

				container.each(function() {
					var _this = $(this),
						overlayInner = _this.find('.album_no, h3, hr, aside'),
						overlayHover = new TimelineLite({ paused: true }),
						line = _this.find('hr');
					
					if (!thb_md.mobile()) {
						overlayHover
							.add(TweenLite.to(_this, 0.2, {opacity:1, ease: thb_ease}))
							.add(TweenMax.staggerFromTo(overlayInner, 0.21, { rotationX: '45deg', y: 20, opacity:0}, { rotationX: '0', scaleX:1, y: 0, opacity:1, ease: thb_ease}, 0.07));
						
						_this.hoverIntent(function() {
							overlayHover.timeScale(1).play();
						}, function() {
							overlayHover.timeScale(1.5).reverse();
						});
					} else {
						TweenLite.to(_this, 0.2, {opacity:1, ease: thb_ease});
						TweenLite.to(_this.find('hr'), 0.2, {opacity:1, scaleX:1, ease: thb_ease});
					}
				});
			}
		},
		panHover: {
			selector: '.pan-hover',
			init: function() {
				var base = this,
						container = $(base.selector);

				container.each(function() {
					var _this = $(this),
							inner = _this.find('.pan-hover-inside');
					
					inner.panr({ moveTarget: '.photo_link', scaleDuration: 0.7, sensitivity: 30, scaleTo: 1.07, panDuration: 1 });
				});
			}
		},
		photoProof: {
			selector: '.proof-it',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				container.on('click', function() {
					var _this = $(this),
							id = _this.data('id'),
							photo = _this.parents('.photo');
					
					_this.addClass('loading');
					$.ajax( themeajax.url, {
						method : 'POST',
						data : {
							action : 'thb_proof',
							id : id,
							checked : !photo.hasClass('checked')
						},
						success : function(data) {
							photo.toggleClass('checked');
							_this.removeClass('loading');	
						}
					});
				});
			}
		},
		fixedMe: {
			selector: '.thb-fixed',
			init: function(el) {
				var base = this,
						container = el ? el : $(base.selector),
						a = $('#wpadminbar'),
						ah = (a ? a.outerHeight() : 0);
				
				if (!thb_md.mobile()) {
					container.each(function() {
						var _this = $(this);
						
						_this.stick_in_parent({
							offset_top: ah,
							spacer: '.sticky-content-spacer',
							recalc_every: 50
						});
					});
					
					$('.post-content, .products').imagesLoaded(function() {
						$(document.body).trigger("sticky_kit:recalc");
					});
					win.on('resize', _.debounce(function(){
						$(document.body).trigger("sticky_kit:recalc");
					}, 30));
				}
			}
		},
		carousel: {
			selector: '.slick',
			init: function(el) {
				var base = this,
					container = el ? el : $(base.selector);
				
				container.each(function() {
					var that = $(this),
							columns = that.data('columns'),
							navigation = (that.data('navigation') === true ? true : false),
							autoplay = (that.data('autoplay') === false ? false : true),
							pagination = (that.data('pagination') === true ? true : false),
							speed = (that.data('speed') ? that.data('speed') : 1000),
							fade = (that.data('fade') === true ? true : false);
					
					var args = {
						dots: pagination,
						arrows: navigation,
						infinite: false,
						speed: speed,
						slidesToShow: columns,
						autoplay: autoplay,
						autoplaySpeed: 6000,
						pauseOnHover: true,
						focusOnSelect: true,
						adaptiveHeight: true,
						accessibility: false,
						fade: fade,
						cssEase: 'ease-in-out',
						prevArrow: '<button type="button" class="slick-nav slick-prev"><i class="fa fa-angle-left"></i></button>',
						nextArrow: '<button type="button" class="slick-nav slick-next"><i class="fa fa-angle-right"></i></button>',
						responsive: [
							{
								breakpoint: 1025,
								settings: {
									slidesToShow: (columns < 3 ? columns : 3)
								}
							},
							{
								breakpoint: 780,
								settings: {
									slidesToShow: (columns < 2 ? columns : 2)
								}
							},
							{
								breakpoint: 640,
								settings: {
									slidesToShow: (columns < 2 ? columns : 1)
								}
							}
						]
					};
					that.imagesLoaded(function() {
						that.slick(args);
					});
				});
			}
		},
		albumHeight: {
			selector: '.vertical',
			init: function(el) {
				var base = this,
					container = $(base.selector);
					

				base.control(container);
				
				win.resize(_.debounce(function(){
					base.control(container);
				}, 50));
			},
			control: function(el, off) {
				var h = el.offset().top,
						f = el.offset(),
						a = $('#wpadminbar'),
						ah = (a ? a.outerHeight() : 0);
				
				el.each(function() {
					var _this = $(this),
							article = _this.find('.item'),
							height = $('.page-padding').height();

					article.height(height);
					
				});
			}
		},
		swiper: {
			selector: '.swiper-container',
			init: function() {
				var base = this,
						container = $(base.selector),
						gallery = $('.swiper-gallery'),
						arrows = container.find('.thb-arrow'),
						pagination = gallery.find('.swiper-pagination span'),
						autoplay = gallery.data('autoplay') === 'on' ? gallery.data('autoplay-speed') : false,
						effect = gallery.data('effect') ? gallery.data('effect') : 'slide',
						speed = gallery.data('speed') ? gallery.data('speed') : 1000,
						slides_count = gallery.find('.swiper-slide').length,
						thumbnails = $('.swiper-thumbnails'),
						tt = $('.thumbnail-toggle'),
						tt_ani = new TimelineLite({ paused: true }),
						arrow_ani = new TimelineLite({ paused: true }),
						body = $('body');
				

				if (autoplay && arrows) {
					TweenLite.set(container.find('.thb-progress'), { drawSVG: "0% 0%"});			
					arrow_ani
						.to(gallery.find('.thb-progress'), (autoplay / 1000), { drawSVG: "0% 100%" }, "start");
				}
				if (thumbnails.length) {
					var thumbnail_progress = CSSRulePlugin.getRule('.thb-thumbnails .swiper-slide:after');
					
					TweenLite.set($('.thb-gallery-icon'), { drawSVG: "0% 74%"});
					TweenLite.set($('.thb-thumbnail-icon'), { drawSVG: "0% 48%"});
				
					tt_ani
						.to($('.thb-gallery-icon'), 1, { drawSVG: "73.7% 100%", ease: thb_ease }, "start" )
						.to($('.thb-thumbnail-icon'), 1, { drawSVG: "49% 97.5%", ease: thb_ease }, "start" )
						.to($('.thb-thumbnails'), 0.5, { x: 0, ease: thb_ease }, "start")
						.to($('.thb-thumbnails .swiper-container'), 0.5, { opacity: 1, ease: thb_ease }, "start");
					
					tt.on('click', function() {
						var _this = $(this),
								toggle = _this.data('toggle');
						if (!toggle) {
							tt_ani.timeScale(1).play();
							_this.data('toggle', 'on');
						} else {
							tt_ani.timeScale(1).reverse();
							_this.removeData('toggle');
						}
						return false;
					});
					
				}
				
				// General Slider
				var params = {
					nextButton: '.swiper-button-next',
					prevButton: '.swiper-button-prev',
					speed: speed,
					pagination: '.swiper-pagination',
					paginationClickable: true,
					loop: slides_count > 1 ? true : false,
					effect: effect,
					autoplay: autoplay,
					autoplayDisableOnInteraction: false,
					keyboardControl: true,
					mousewheelControl: true,
					onInit: function(e) {
						var i = e.activeIndex,
								color = e.slides.eq(i).data('color');

						body.addClass(color);
						if (win.width() > 1024 && arrows) {
							
							gallery.find('.thb-arrow').each(function(){
								var _that = $(this);
								
								container.bind('mousemove', function(e){
									var cursor_area = _that.parents('.swiper-cursor'),
											offset = cursor_area.offset(),
											mouseX = Math.min(e.pageX - offset.left, cursor_area.width()),
											mouseY = e.pageY - offset.top;
									if (mouseX < 0) { mouseX = 0; }
									if (mouseY < 0) { mouseY = 0; }

									TweenMax.set(_that, {x:mouseX -40, y:mouseY -40, force3D:true});

								});
							});
							
						}
						if (thumbnails.length) {
							var thumbnail_progress = CSSRulePlugin.getRule('.thb-thumbnails .swiper-slide:after');
							
							if (autoplay && arrows) {
								arrow_ani
									.to(thumbnail_progress, (autoplay / 1000), {cssRule:{width: '100%'}}, "start");
							}
						}
						if (pagination) {
							pagination.on('click', function() {
								var _this = $(this),
										i = _this.index();
								e.slideTo(i);
							});
						}
						win.on('orientationchange', function() {
							_.defer(function() {
								e.update();
							});
						}); 					
					},
					onAutoplayStart: function() {
						if (thumbnails && autoplay && arrows) {
							if (slides_count > 1) {
								arrow_ani.play();
							}
						}
					},
					onAutoplayStop: function() {
						if (thumbnails && autoplay && arrows) {
							if (slides_count > 1) {
								arrow_ani.stop();
							}
						}
					},
					onSlideChangeStart: function(swiper) {
						var activeIndex = swiper.slides.eq(swiper.activeIndex).attr('data-swiper-slide-index'),
								color = swiper.slides.eq(activeIndex).data('color');
						
						if (thumbnails && autoplay && arrows) {
							if (slides_count > 1) {
								arrow_ani.reverse();
							}
						}
						body.removeClass('logo-light logo-dark').addClass(color);
						if (pagination) {
							pagination.removeClass('swiper-pagination-bullet-active');
							pagination.eq(activeIndex).addClass('swiper-pagination-bullet-active');
						}
					},
					onSlideChangeEnd: function() {
						if (thumbnails && autoplay && arrows) {
							if (slides_count > 1) {
								arrow_ani.restart();
							}
						}
					}
				};
				if (effect === 'cube' ) {
					params.cube = {
						shadow: false,
						slideShadows: false
					};
					params.direction = 'vertical';
				}
				if (thumbnails ) {
					params.loopedSlides = slides_count;
				}
				var swiperGallery = new Swiper(gallery, params);
				
				// Thumbnails
				if (thumbnails.length) {
					
					var params2 = {
						direction: 'vertical',
						slidesPerView: 5,
						spaceBetween: 1,
						loop: slides_count > 1 ? true : false,
						loopedSlides: slides_count,
						centeredSlides: true,
						touchRatio: 0.2,
						autoplayDisableOnInteraction: false,
						slideToClickedSlide: true
					};
					
					var swiperThumbnails= new Swiper(thumbnails, params2);
				
					swiperGallery.params.control = swiperThumbnails;
					swiperThumbnails.params.control = swiperGallery;
					
				}
			}
		},
		paginationStyle2: {
			selector: '.pagination-style2',
			init: function() {
				var base = this,
						container = $(base.selector),
						load_more = $('.thb_load_more'),
						page = 2;
								
				load_more.on('click', function(){
					var _this = $(this),
							text = _this.text(),
							count = _this.data('count');
					
					_this.text(themeajax.l10n.loading).addClass('loading');
					
					$.post( themeajax.url, { 
							action: 'thb_ajax',
							page : page++
					}, function(data){
						
						var d = $.parseHTML($.trim(data)),
								l = d ? d.length : 0;
							
						if( data === '' || data === 'undefined' || data === 'No More Posts' || data === 'No $args array created') {
							_this.text(themeajax.l10n.nomore).removeClass('loading').off('click');
						} else {
							$(d).appendTo(container).hide().imagesLoaded(function() {
								$(d).show();
								if(container.data('isotope')) {
									container.isotope( 'appended', $(d) );
									container.isotope('layout');
								}
								TweenMax.set($(d), {opacity: 0, y:100});
								TweenMax.staggerTo($(d), l*0.25, { y: 0, opacity:1, ease: Quart.easeOut}, 0.25);
							});
							
							if (l < count){
								_this.text(themeajax.l10n.nomore).removeClass('loading');
							} else {
								_this.text(text).removeClass('loading');
							}
						}
						
					});
					return false;
				});
			}
		},
		paginationStyle3: {
			selector: '.pagination-style3',
			init: function() {
				var base = this,
						container = $(base.selector),
						page = 2,
						count = container.data('count');
								
				var scrollFunction = _.debounce(function(){
					if (win.scrollTop() >= $doc.height() - win.height() - 60) {
						win.off("scroll", scrollFunction);
						container.addClass('thb-loading');

						$.post( themeajax.url, { 
							action: 'thb_ajax',
							page : page++
						}, function(data){
							
							var d = $.parseHTML($.trim(data)),
									l = d ? d.length : 0;
							
							container.removeClass('thb-loading');
							
							if( data === '' || data === 'undefined' || data === 'No More Posts' || data === 'No $args array created') {
								
							} else {
								$(d).appendTo(container).hide().imagesLoaded(function() {
									$(d).show();
									if (container.data('isotope')) {
										container.isotope( 'appended', $(d) );
										container.isotope('layout');
									}
									TweenMax.set($(d), {opacity: 0, y:100});
									TweenMax.staggerTo($(d), l*0.25, { y: 0, opacity:1, ease: Quart.easeOut}, 0.25);
								});
								
								if (l >= count) {
									win.on('scroll', scrollFunction);
								}
							}
							
						});
					}
				}, 30);
				
				win.scroll(scrollFunction);
			}
		},
		widgets: {
			selector: '.widget',
			init: function() {
				var base = this,
						container = $(base.selector),
						demos = $('.thb-demo-holder');
				
				$('h6', container).on('click', function() {
					$(this).parents('.widget').toggleClass('active');
					return false;
				});
			}
		},
		custom_select: {
			selector: 'select:not(.state_select):not(.country_to_state):not(#calc_shipping_state):not(#rating)',
			init: function() {
				var base = this,
						container = $(base.selector);
						
				container.selectric({
					maxHeight: 300,
					responsive: true,
					expandToItemText: true,
					arrowButtonMarkup:'<b class="button selectric-button">&#x25be;</b>'
				}).on('change', function() {
					var selector = $(this).val(),
							style1 = $('.isotope-grid'),
							style3 = $('.slick.vertical');

					if (style1.length > 0) {
						style1.isotope({ filter: selector });
					} else if (style3.length > 0) {
						style3.slick('slickUnfilter');
						if (selector === '*') {
							return;	
						} else {
							style3.slick('slickFilter', selector);
						}
						SITE.albumHeight.init();
					}
					
				});
			}
		},
		quantity: {
			selector: '.quantity',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				// Quantity buttons
				$( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<input type="button" value="+" class="plus" />' ).prepend( '<input type="button" value="-" class="minus" />' );
			
				$doc.on( 'click', '.plus, .minus', function() {
			
					// Get values
					var $qty		= $( this ).closest( '.quantity' ).find( '.qty' ),
						currentVal	= parseFloat( $qty.val() ),
						max			= parseFloat( $qty.attr( 'max' ) ),
						min			= parseFloat( $qty.attr( 'min' ) ),
						step		= $qty.attr( 'step' );
			
					// Format values
					if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) { currentVal = 0; }
					if ( max === '' || max === 'NaN' ) { max = ''; }
					if ( min === '' || min === 'NaN' ) { min = 0; }
					if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) { step = 1; }
			
					// Change the value
					if ( $( this ).is( '.plus' ) ) {
			
						if ( max && ( max === currentVal || currentVal > max ) ) {
							$qty.val( max );
						} else {
							$qty.val( currentVal + parseFloat( step ) );
						}
			
					} else {
			
						if ( min && ( min === currentVal || currentVal < min ) ) {
							$qty.val( min );
						} else if ( currentVal > 0 ) {
							$qty.val( currentVal - parseFloat( step ) );
						}
			
					}
			
					// Trigger change event
					$qty.trigger( 'change' );
			
				});
			}	
		},
		contact: {
			selector: '.contact_map',
			init: function() {
				var base = this,
						container = $(base.selector),
						y_pan = $('.contact-content').height(),
						tween = TweenLite.to($('.contact_map'), 1, {y:-y_pan, ease: thb_ease}).reverse(),
						tween_data = 0;

				if (win.width() > 1024) {
					$('#contact_area.style1').on('mousewheel', function(event) {
							var direction = event.deltaY;
	
						if(!tween.isActive()){
							if (direction < 0 && tween_data === 0) {
								tween_data = 1;
								tween.reversed(!tween.reversed());
							} else if (direction > 0 && tween_data === 1){
								tween_data = 0;
								tween.reversed(!tween.reversed());
							}
						}
					});
				}
				container.each(function() {
					var that = $(this),
						mapzoom = that.data('map-zoom'),
						maplat = that.data('map-center-lat'),
						maplong = that.data('map-center-long'),
						pinlatlong = that.data('latlong'),
						pinimage = that.data('pin-image'),
						style = $('body').hasClass('dark-theme') ? "1" : "0",
						mapstyle;
					
					switch(style) {
						case "1":
							mapstyle = [{"stylers":[{"hue":"#ff1a00"},{"invert_lightness":true},{"saturation":-100},{"lightness":33},{"gamma":0.5}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#2D333C"}]}];
							break;
						default:
							mapstyle = [{"featureType":"poi","stylers":[{"visibility":"off"}]},{"stylers":[{"saturation":-70},{"lightness":37},{"gamma":1.15}]},{"elementType":"labels","stylers":[{"gamma":0.26},{"visibility":"off"}]},{"featureType":"road","stylers":[{"lightness":0},{"saturation":0},{"hue":"#ffffff"},{"gamma":0}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"lightness":50},{"saturation":0},{"hue":"#ffffff"}]},{"featureType":"administrative.province","stylers":[{"visibility":"on"},{"lightness":-50}]},{"featureType":"administrative.province","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"administrative.province","elementType":"labels.text","stylers":[{"lightness":20}]}];
							break;
					}
					
					var centerlatLng = new google.maps.LatLng(maplat,maplong);
					
					var mapOptions = {
						center: centerlatLng,
						styles: mapstyle,
						zoom: mapzoom,
						draggable: false,
						mapTypeId: google.maps.MapTypeId.ROADMAP,
						scrollwheel: false,
						panControl: false,
						zoomControl: false,
						mapTypeControl: false,
						scaleControl: false,
						streetViewControl: false
					};
					
					var map = new google.maps.Map(that[0], mapOptions);
					
					google.maps.event.addListenerOnce(map, 'tilesloaded', function() {
						if(pinimage.length > 0) {
							var pinimageLoad = new Image();
							pinimageLoad.src = pinimage;
							
							$(pinimageLoad).load(function(){
								base.setMarkers(map, pinlatlong, pinimage);
							});
						}
						else {
							base.setMarkers(map, pinlatlong, pinimage);
						}
					});
				});
			},
			setMarkers: function(map, pinlatlong, pinimage) {
				var infoWindows = [];
				
				function showPin (i) {
					var latlong_array = pinlatlong[i].lat_long.split(','),
							pin = new google.maps.MarkerImage(pinimage, null, null, null, new google.maps.Size(42,61)),
							marker = new google.maps.Marker({
								position: new google.maps.LatLng(latlong_array[0],latlong_array[1]),
								map: map,
								animation: google.maps.Animation.DROP,
								icon: pin,
								optimized: false
							}),
							contentString = '<div class="marker-info-win">'+
							'<h4 class="marker-heading">'+pinlatlong[i].title+'</h4>'+
							'<p>'+pinlatlong[i].information+'</p>'+ 
							'</div>';
					
					// info windows 
					var infowindow = new InfoBox({
							alignBottom: true,
							content: contentString,
							disableAutoPan: false,
							maxWidth: 360,
							closeBoxMargin: "10px 10px 10px 10px",
							closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif",
							pixelOffset: new google.maps.Size(-180, -80),
							zIndex: null,
							infoBoxClearance: new google.maps.Size(1, 1)
					});
					infoWindows.push(infowindow);
					
					google.maps.event.addListener(marker, 'click', (function(marker, i) {
						return function() {
							infoWindows[i].open(map, this);
						};
					})(marker, i));
				}
				
				for (var i = 0; i + 1 <= pinlatlong.length; i++) {  
					setTimeout(showPin, i * 250, i);
				}
			}
		},
	};
	
	$doc.ready(function() {
		SITE.init();
	});

})(jQuery, this, _);