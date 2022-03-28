<?php if ( ! defined( "FEATHER_INIT" ) ) die();	
/**
 * Core functions that output 
 * in the document <head>
 */
if ( ! function_exists( "feather_head" ) )
{
	function feather_head()
	{
		echo "
			<meta name='generator' content='Feather ".FEATHER_VERSION."' />
			<link href='".get_core_css_dir()."emoji.min.css' rel='stylesheet' async='async' />
			<link href='".get_core_css_dir()."animate.min.css' rel='stylesheet' async='async' />
			
			<script src='".get_core_js_dir()."jquery.min.js' defer='defer'></script>
		";
	}
}
/**
 * Core functions that output 
 * before the closing </body>
 */
if ( ! function_exists( "feather_footer" ) )
{
	function feather_footer()
	{
		// do core
	}
}
/**
 * Core app versioning
 */
if ( ! function_exists( "feather_version" ) )
{
	function feather_version()
	{
		echo "
			<style>
				.getfeatherapp { margin-top:-3px;opacity:0.5; }
				body.contrast .getfeatherapp { filter:invert(100%);opacity:0.5; }
			</style>
			Built with <img class='getfeatherapp' src='".get_core_img_dir()."feather.png' alt='Feather' width='12px' height='12px' /> <a href='//getfeather.app'>Feather</a> v".FEATHER_VERSION."
		";
	}
}