(function($) {
	/**
	 * Throw errors, for "unsafe" actions, and bad code
	 */
    "use strict";

    /**
     * A simple check for mobile devices
     */
	var isMobile =
	{
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
            return navigator.userAgent.match(/IEMobile/i) || navigator.userAgent.match(/WPDesktop/i);
        },
        any: function() {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };

    /**
     * Set some vars
     */
    var docHeight          = $( document ).height();
    var winHeight          = $( window ).height();
    var body               = $( "body" );
    var header             = $( "header#main" );
    var codeHeight         = $( "#page pre, body.single-post pre" ).height();
    
	/**
 	 * Sidebar toggle
 	 */
 	$( ".aside-toggle" ).on( "click", function(e) {
	 	$( this ).toggleClass( "is-active" );
        $( "#blurred" ).toggleClass( "is-active" );
 		$( "#aside" ).toggleClass( "toggled" );
        $( 'body' ).toggleClass( 'has-aside' );

        return false;
 	});
	
	/**
	 * Add class to code and pre for prismJS
	 */
    $( "code, pre, pre > code" ).each( function() {
       $( this ).addClass( "language-markup" );
    });
    
	/**
     * Add schema url to all links
     */
    $( "a" ).attr( "itemprop", "url" );
 
    /**
	 * Change img title to alt to prevent nasty
	 * hover tooltips but keep SEO value
	 */
    $( "img" ).each( function() {
       $( this ).attr( "alt", $( this ).attr( "title" ) );
       $( this ).removeAttr( "title" );
    });
	
	/**
     * Remove some items if mobile
     */
    if ( isMobile.any() )
    {
        // do something
    }
	else
	{
        // do something
    }
})(jQuery);