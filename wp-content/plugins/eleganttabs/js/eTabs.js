/**
 * iw_Tabs.js v1.0.0
 */
;( function( window ) {
	
	'use strict';
	function extend( a, b ) {
		for( var key in b ) { 
			if( b.hasOwnProperty( key ) ) {
				a[key] = b[key];
			}
		}
		return a;
	}
	function IW_Tabs( el, options ) {
		this.el = el;
		this.options = extend( {}, this.options );
  		extend( this.options, options );
  		this._init();
	}
	IW_Tabs.prototype.options = {
		start : 0
	};
	IW_Tabs.prototype._init = function() {
		// tabs elems
		this.tabs = [].slice.call( this.el.querySelectorAll( 'nav > ul > li' ) );
		// content items
		this.items = [].slice.call( this.el.querySelectorAll( '.et-content-wrap > section' ) );
		// current index
		this.current = -1;
		// show current content item
		this._show();
		// init events
		this._initEvents();
	};
	IW_Tabs.prototype._initEvents = function() {
		var self = this;
		this.tabs.forEach( function( tab, idx ) {
			tab.addEventListener( 'click', function( ev ) {
				ev.preventDefault();
				self._show( idx );
			} );
		} );
	};
	IW_Tabs.prototype._show = function( idx ) {
		if( this.current >= 0 ) {
			this.tabs[ this.current ].className = this.items[ this.current ].className = '';
		}
		// change current
		this.current = idx != undefined ? idx : this.options.start >= 0 && this.options.start < this.items.length ? this.options.start : 0;
		this.tabs[ this.current ].className = 'tab-current';
		var anim = jQuery(this.items[ this.current ]).data('animation');
		this.items[ this.current ].className = 'content-current animated '+anim;
	};
	// add to global namespace
	window.IW_Tabs = IW_Tabs;
})( window );
/* Call tabs function */
(function() {
	var css = '<style type="text/css" id="tabs-dynamic-css">';
	[].slice.call( document.querySelectorAll( '.et-tabs' ) ).forEach( function( el ) {
		new IW_Tabs( el );
		
		var cn = el.className.split(" ");
		var cl = '';
		jQuery(cn).each(function(i,v){
			cl += "."+v;
		});
		var st = jQuery(cl).data("tab_style");
		var bg = jQuery(cl).data("active-bg");
		var color = jQuery(cl).data("active-text");
		switch(st){
			case 'bars':
				css += cl+' li.tab-current a{background:'+bg+'; color:'+color+';}\n';
				css += cl+' nav ul li.tab-current a, '+cl+' nav ul li.tab-current a > i{color:'+color+' !important;}\n';
				break;
			case 'iconbox':
				css += cl+' li.tab-current a{background:'+bg+'; color:'+color+' !important;}\n';
				css += cl+' nav ul li.tab-current a > i{color:'+color+' !important;}\n';
				css += cl+' nav ul li.tab-current::after{border-top-color:'+bg+';}\n';
				break;
			case 'underline':
				css += cl+' nav ul li a::after{background:'+bg+';}\n';
				css += cl+' nav ul li.tab-current a, '+cl+' nav ul li.tab-current a > i{color:'+color+' !important;}\n';
				break;
			case 'topline':
				css += cl+' nav ul li.tab-current a{box-shadow:inset 0px 3px 0px '+bg+';}\n';
				css += cl+' nav ul li.tab-current {border-top-color: '+color+';}\n';
				css += cl+' nav ul li.tab-current a, '+cl+' nav ul li.tab-current a > i{color:'+color+' !important;}\n';
				break;
			case 'iconfall':
			case 'circle':
			case 'square':
				css += cl+' nav ul li::before{background:'+bg+'; border-color:'+bg+';}\n';
				css += cl+' nav ul li.tab-current::after { border-color:'+bg+';}\n';
				css += cl+' nav ul li.tab-current a, '+cl+' nav ul li.tab-current a > i{color:'+color+' !important;}\n';
				break;
			case 'line':
				css += cl+' nav ul li.tab-current a{box-shadow:inset 0px -2px '+bg+';}\n';
				css += cl+' nav ul li.tab-current a, '+cl+' nav ul li.tab-current a > i{color:'+color+' !important;}\n';
				break;
			case 'linebox':
				css += cl+' nav ul li a::after{background:'+bg+';}\n';
				css += cl+' nav ul li.tab-current a, '+cl+' nav ul li.tab-current a > i{color:'+color+' !important;}\n';
				break;
			case 'flip':
				css += cl+' nav ul li a::after, '+cl+' nav ul li.tab-current a{background:'+bg+';}\n';
				css += cl+' nav ul li.tab-current a, '+cl+' nav ul li.tab-current a > i{color:'+color+' !important;}\n';
				break;
			case 'tzoid':
				var style = jQuery(cl + ' nav ul li').attr('style');
				console.log(style);
				css += cl+' nav ul li a::after{'+style+';}\n';
				css += cl+' li.tab-current a::after{background:'+bg+'; color:'+color+';}\n';
				css += cl+' nav ul li.tab-current a, '+cl+' nav ul li.tab-current a > i{color:'+color+' !important;}\n';
				break;
			case 'fillup':
				css += cl+' nav ul li.tab-current a::after{background:'+bg+';}\n';
				css += cl+' nav ul li a::after{background:'+bg+'; border-color: '+bg+';}\n';
				css += cl+' nav ul li.tab-current a, '+cl+' nav ul li.tab-current a > i{color:'+color+' !important;}\n';
				css += cl+' nav ul li a {border-color:'+color+' !important;}\n';
				break;
		}
		// css += cl+' li.tab-current a{background:'+bg+'; color:'+color+';}\n';
	});
	css += '</style>';
	jQuery("head").append(css);		
})();