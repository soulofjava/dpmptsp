/**
 *
 * -------------------------------------------
 * Script for the template menu
 * -------------------------------------------
 *
 **/
(function () {
    "use strict";

    jQuery(document).ready(function () {
        if (jQuery('#main-menu') && jQuery('#main-menu').hasClass('gk-menu-classic')) {
            if (jQuery(window).width() > jQuery(document.body).attr('data-tablet-width')) {
                // fix for the iOS devices		
                jQuery('#main-menu li').each(function (i, el) {

                    if (jQuery(el).children('.sub-menu').length > 0) {
                        jQuery(el).addClass('haschild');
                    }
                });
                // main element for the iOS fix - adding the onmouseover attribute
                // and binding with the data-dblclick property to emulate dblclick event on
                // the mobile devices
                jQuery('#main-menu li a').each(function (i, el) {
                    el = jQuery(el);

                    el.attr('onmouseover', '');

                    if (el.parent().hasClass('haschild') && jQuery(document.body).attr('data-tablet') !== null) {
                        el.click(function (e) {
                            if (el.attr("data-dblclick") === undefined) {
                                e.stop();
                                el.attr("data-dblclick", new Date().getTime());
                            } else {
                                var now = new Date().getTime();
                                if (now - el.attr("data-dblclick") < 500) {
                                    window.location = el.attr('href');
                                } else {
                                    e.stop();
                                    el.attr("data-dblclick", new Date().getTime());
                                }
                            }
                        });
                    }
                });
                // main menu element handler
                var base = jQuery('#main-menu');
                
                /*base.find('.menu-cols-3 > .sub-menu').each(function(i, submenu) {
					console.log(submenu);
					
					var cols = jQuery(submenu).find('.sub-menu');
					console.log(cols);
					if(jQuery(cols).length > 1) {
						var max = jQuery(cols).first().outerHeight(true);
						
						for(var i = 0; i < jQuery(cols).length; i++) {
							console.log(jQuery(cols).get(i));
							console.log(jQuery(jQuery(cols).get(i)).outerHeight(true));
							max = jQuery(jQuery(cols).get(i)).outerHeight(true) > max ? jQuery(jQuery(cols).get(i)).outerHeight(true) : max;
						}
						
						console.log(max)
						
						jQuery(cols).css('height', max + "px");
					}
                });*/
                
                // if the main menu exists
                if (base.length > 0) {
                    // get the menu name...
                    var menuName = base.attr('id').replace('-', '');
                    // ... used to get the menu params
                    if (
                        $GK_MENU[menuName] &&
                        (
                            $GK_MENU[menuName].animation.indexOf('height') !== -1 ||
                            $GK_MENU[menuName].animation.indexOf('width') !== -1 ||
                            $GK_MENU[menuName].animation.indexOf('opacity') !== -1
                        )
                    ) {
                        base.find('li.haschild').each(function (i, el) {
                            el = jQuery(el);

                            if (el.children('.sub-menu').length > 0) {
                                var content = jQuery(el.children('.sub-menu').first());
                                var prevh = content.outerHeight();
                                var prevw = content.outerWidth() + 10;
                                var heightAnim = $GK_MENU[menuName].animation.indexOf('height') !== -1;
                                var widthAnim = $GK_MENU[menuName].animation.indexOf('width') !== -1;
                                var duration = $GK_MENU[menuName].animation_speed;

                                if (duration === 'normal') {
                                    duration = 500;
                                } else if (duration === 'fast') {
                                    duration = 250;
                                } else {
                                    duration = 1000;
                                }

                                var fxStart = {
                                    'height': heightAnim ? 0 : prevh,
                                    'width': widthAnim ? 0 : prevw,
                                    'opacity': 0
                                };
                                var fxEnd = {
                                    'height': prevh,
                                    'width': prevw,
                                    'opacity': 1
                                };

                                content.css(fxStart);
                                content.css({
                                    'left': 'auto',
                                    'overflow': 'hidden'
                                });

                                el.mouseenter(function () {
                                    content.css('display', 'block');
                                    var basicMargin = (el.parent().attr('id') == 'main-menu') ? -1 * ((prevw / 2) - (el.outerWidth() / 2)) : 0;                                                        
                                    // helper variables
                                    var pos = content.offset();
                                    var winWidth = jQuery(window).outerWidth();
                                    var winScroll = jQuery(window).scrollLeft();
                                                                
                                    // calculations
                                    var posStart = pos.left;
                                    var posEnd = pos.left + prevw;
                                    
                                    if(el.parent().attr('id') == 'main-menu') {
                                            content.css('margin-left', "-1px");
                                            pos = content.offset();
                                            posStart = pos.left;
                                            posEnd = pos.left + prevw;
                                            
                                            if(posStart < 0) {
                                                content.css('margin-left', parseInt(content.css('margin-left'), 10) + (-1 * posStart) + 10);
                                            }
                                            
                                            if(posEnd > winWidth + winScroll) {
                                                    var diff = (winWidth + winScroll) - posEnd;
                                                    content.css('margin-left', parseInt(content.css('margin-left'), 10) + diff - 24);
                                            }
                                    } else {
                                            var diff = (winWidth + winScroll) - posEnd;
                                            
                                            if(posEnd > winWidth + winScroll) {
                                                    content.css('margin-left', "120px");
                                            }
                                    }
                                                        
                                    content.stop(false, false, false);
                                    
                                    content.animate(
                                        fxEnd,
                                        duration,
                                        function () {
                                            if (content.outerHeight() === 0) {
                                                content.css('overflow', 'hidden');
                                            } else {
                                                content.css('overflow', 'visible');
                                            }
                                        }
                                    );
                                });
                                el.mouseleave(function () {
                                    content.css({
                                        'overflow': 'hidden'
                                    });
                                    //
                                    content.animate(
                                        fxStart,
                                        duration,
                                        function () {
                                            if (content.outerHeight() === 0) {
                                                content.css('overflow', 'hidden');
                                            } else {
                                                content.css('overflow', 'visible');
                                            }

                                            content.css('display', 'none');
                                        }
                                    );
                                });
                            }
                        });

                        var isIE8 = jQuery.browser.msie && +jQuery.browser.version === 8;

                        if (!isIE8) {
                            base.find('li.haschild').each(function (i, el) {
                                el = jQuery(el);
                                if (jQuery(el.children('.sub-menu').first())) {
                                    var content = jQuery(el.children('.sub-menu').first());
                                    content.css({
                                        'display': 'none'
                                    });
                                }
                            });
                        }
                    }
                }
            }
        } else if (jQuery('#main-menu') && jQuery('#main-menu').hasClass('gk-menu-overlay')) {
            // fix for the missing haschild classes		
            jQuery('#main-menu li').each(function (i, el) {
                if (jQuery(el).children('.sub-menu').length > 0) {
                    jQuery(el).addClass('haschild');
                }
            });

            var overlay = new jQuery('<div id="gk-menu-overlay">&nbsp;</div>');

            jQuery('body').append(overlay);
            overlay.animate({
                'opacity': 0
            }, 500, function () {
                overlay.css('display', 'none');
            });

            var overlaywrapper = new jQuery('<div id="gk-menu-overlay-wrap"><div><i id="gk-menu-overlay-close" class="fa fa-times"></i><h3 id="gk-menu-overlay-header"></h3><div id="gk-menu-overlay-content"></div></div></div>');

            jQuery('body').append(overlaywrapper);
            overlay.animate({
                'opacity': 0
            }, 500, function () {
                overlay.css('display', 'none');
            });
            overlaywrapper.animate({
                'opacity': 0
            }, 500, function () {
                overlaywrapper.css('display', 'none');
            });

            var overlaywrap = overlaywrapper.find('div').first();
            var header = jQuery('#gk-menu-overlay-header');
            var content = jQuery('#gk-menu-overlay-content');
            header.css('margin-top', '-100px');
            var submenus = [];

            jQuery('#gk-menu-overlay-close').click(function () {
                overlay.animate({
                    'opacity': 0
                }, 500, function () {
                    setTimeout(function () {
                        overlay.css('display', 'none');
                    }, 500);
                });
                overlaywrapper.animate({
                    'opacity': 0
                }, 500, function () {
                    setTimeout(function () {
                        overlay.css('display', 'none');
                    }, 500);
                });

                header.animate({
                    marginTop: '-100px'
                }, 500);

                setTimeout(function () {
                    overlay.removeClass('open');
                    overlaywrapper.removeClass('open');
                    header.html('');
                    content.html('');
                }, 600);
            });

            overlay.click(function (e) {
                e.stopPropagation();
                if (jQuery(e.target).attr('id') === 'gk-menu-overlay') {
                    jQuery('#gk-menu-overlay-close').trigger('click');
                }
            });

            jQuery('#main-menu').find('.haschild').each(function (i, el) {
                el = jQuery(el);
                if (el.parent().hasClass('menu')) {
                    var link = el.find('> a');
                    submenus[link.parent().attr('id')] = {
                        "link": link,
                        "submenu": el.find('.sub-menu').first()
                    };

                    link.click(function (e) {
                        e.preventDefault();
                        overlay.css('height', jQuery('body').height() + 32);
                        var menuID = jQuery(e.target).parent().attr('id');
                        header.html('');
                        header.append(submenus[menuID].link.clone());
                        content.html('');
                        content.append(submenus[menuID].submenu.clone());
						
						overlay.css('opacity', '0.01');
                        overlay.css('display', 'block');

                        overlaywrapper.css('opacity', 0);
                        overlaywrapper.css('display', 'block');

                        overlay.addClass('open');
                        overlaywrapper.css('margin-top', jQuery(window).scrollTop() + "px");
                        overlaywrapper.addClass('open');

                        overlay.css('opacity', '0.01');
                        overlay.animate({
                            'opacity': 0.98
                        }, 500);
                        overlaywrapper.animate({
                            'opacity': 1
                        }, 500);

                        overlaywrap.css('display', 'block');
                        overlaywrap.css('opacity', 0);

                        setTimeout(function () {
                            overlaywrap.animate({
                                'opacity': 1
                            }, 500);
                            header.animate({
                                marginTop: '25px'
                            }, 500);
                        }, 500);
                    });
                }
            });
        }
    });
})();