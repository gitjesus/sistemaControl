/*
* jQuery.fn.border();
*
* Set transparent borders on elements
* $('element').border(); // 5px thick black border 30% opacity (.7)
* $('element').border('3px red .5'); // 3px thick red border 50% opacity
* $('element').border({ width: 10px, color: '#ffff00', alpha: 0.3 }); // 10px thick yellow border 70% opacity
*
* Version 0.2.2
* www.labs.skengdon.com/border
* www.labs.skengdon.com/border/js/border.min.js
*/
;(function($){
	$.fn.border = function( options ) {
		var settings = {
			width: 1,
			color: 'black',
			alpha: .7
		};
		
		if ( typeof options === 'string' ) {
			var h = options.split(' ');
			var options = {};
			options.width = parseFloat(h[0]);
			options.color = h[1];
			options.alpha = h[2];
		};
		$.extend(true, settings, options);
		
		return this.each(function() {
			if ( $(this).attr('data-borderId') ) {
				// If border allready appended remove it.
				$( '#' + $(this).attr('data-borderId') ).remove();
			};
			var tLeft = parseFloat($(this).offset().left),
				tTop = parseFloat($(this).offset().top),
				tPadding = $(this).css('paddingTop') + ' ' + $(this).css('paddingRight') + ' ' + $(this).css('paddingBottom') + ' ' + $(this).css('paddingLeft'),
				tWidth = parseFloat($(this).width()),
				tWidth = parseFloat($(this).width()),
				tHeight = parseFloat($(this).height()),
				tZIndex = ( $(this).css('zIndex') == 'auto' ) ? 1 : $(this).css('zIndex') - 1,
				tPosition = ( $(this).css('position') == 'fixed' ) ? 'fixed' : 'absolute',
				tId = 'border-' + Math.round( Math.random() * 1000000 );
			
			var border = document.createElement('div');
			
			$('body').append(border);
			$(border).css({
				position: tPosition,
				zIndex: tZIndex,
				left: tLeft - options.width,
				top: tTop - options.width,
				padding: tPadding,
				width: tWidth + options.width * 2,
				height: tHeight + options.width * 2,
				background: settings.color,
				opacity: settings.alpha,
				overflow: 'hidden'
			});
			
			$(border).attr('id', tId);
			
			$(this).css('position', ( $(this).css('position') == 'static' ) ? 'relative' : $(this).css('position'));
			$(this).css('zIndex', ++tZIndex );
			$(this).attr('data-borderId', tId);
		});
	};
}(jQuery));
