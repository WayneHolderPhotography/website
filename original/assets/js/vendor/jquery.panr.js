/*
 	panr - v0.0.1
 	jQuery plugin for zoom & pan elements on mousemove
	by Robert Bue (@robert_bue)

	Powered by the Greensock Tweening Platform
	http://www.greensock.com
	Greensock License info at http://www.greensock.com/licensing/
 	
 	Dual licensed under MIT and GPL.
 */

;(function ( $, window, document, undefined ) {

	// Create the defaults once
	var pluginName = "panr",
		defaults = {
			moveTarget: false,
			sensitivity: 20,
			scale: false,
			scaleOnHover: true,
			scaleTo: 1.05,
			scaleDuration: .25,
			panY: true,
			panX: true,
			panDuration: 1.25,
			resetPanOnMouseLeave: true,
			onEnter: function(){},
			onLeave: function(){}
		};

	// The actual plugin constructor
	function Plugin ( element, options ) {
		this.element = element;
		this.settings = $.extend( {}, defaults, options );
		this._defaults = defaults;
		this._name = pluginName;
		this.init();
	}

	Plugin.prototype = {
		init: function () {

			var settings = this.settings,
			target = $(this.element),
			w = target.width(),
			h= target.height(),
			targetWidth = target.width() - settings.sensitivity,
			targetHeight = target.height() - settings.sensitivity,
			cx = (w-targetWidth)/targetWidth,
			x,
			y,
			panVars,
			xPanVars,
			yPanVars,
			mouseleaveVars;

			if ( settings.scale || (!settings.scaleOnHover && settings.scale) ) {
				TweenMax.set(target, { scale: settings.scaleTo, ease: Quart.easeOut });
			}

			// moveTarget
			if ( jQuery.type(settings.moveTarget) === "string" ) {
				settings.moveTarget = $(this.element).parent(settings.moveTarget);
			}

			// If no target provided we'll use the hovered element
			if ( !settings.moveTarget ) {
				settings.moveTarget = $(this.element);
			}

			settings.moveTarget.on('mousemove', function(e){

				x = e.pageX - target.offset().left - (w / 2); // mouse x coordinate relative to the container
				y = e.pageY - target.offset().top - (h / 2); // mouse x coordinate relative to the container
				
				if ( settings.panX ) {
					xPanVars = { x: -cx*x };	
				}

				if ( settings.panY ) {
					yPanVars = { y: -cx*y };
				}

				panVars = $.extend({}, xPanVars, yPanVars, {ease: new BezierEasing(0.77,0,0.175,1)});

				// Pan element
				TweenMax.to(target, settings.panDuration, panVars);
			});

			// On mouseover
			settings.moveTarget.on('mouseenter', function(e){
				
				if ( settings.scaleOnHover ) {
					// Scale up element
					TweenMax.to(target, settings.scaleDuration, { scale: settings.scaleTo, ease: new BezierEasing(0.77,0,0.175,1) });
				}

				settings.onEnter(target);
			});

			if ( !settings.scale || (!settings.scaleOnHover && !settings.scale) ) {

					mouseleaveVars = { scale: 1, x: 0, y: 0, ease: new BezierEasing(0.77,0,0.175,1) };

			} else {
				if ( settings.resetPanOnMouseLeave ) {
					mouseleaveVars = { scale: 1, x: 0, y: 0, ease: new BezierEasing(0.77,0,0.175,1) };
				}
			}

			settings.moveTarget.on('mouseleave', function(e){
				// Reset element
				TweenMax.to(target, settings.scaleDuration, mouseleaveVars );

				settings.onLeave(target);
			});
		}
	};

	$.fn[ pluginName ] = function ( options ) {
		return this.each(function() {
			if ( !$.data( this, "plugin_" + pluginName ) ) {
				$.data( this, "plugin_" + pluginName, new Plugin( this, options ) );
			}
		});
	};

})( jQuery, window, document );