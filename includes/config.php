<?php if ( ! defined( "FEATHER_INIT" ) ) die();
/**
 * Feather Configuration
 * Edit options only. Do not remove, simply leave any
 * settings blank to disable.
 */
abstract class Config {
	// Set the default language for the application. Changing this will require an actual valid translation file being available in /i18n/
	const i18n            = "en_GB";
	// The path to Feather. e.g: http://example.com/blog, Root = "/blog/" Must end with a trailing slash /.
	const Root            = "https://demo.getfeather.app/";
	// Global title if used by theme.
	const Title           = "Feather";
	// Global description used when a post or page has no summary.
	const Description     = "A lightweight, blazingly fast flat-file website engine";
	// Directory where your posts are stored.
	const PostsDirectory  = "posts/";
	// Directory where your pages are stored.
	const PagesDirectory  = "pages/";
	// Page to display as homepage. Must be available in the /pages/ directory. Leave blank to displays posts.
	const FrontPage       = "";
	// What theme to use. Must be available in the /themes/ directory.
	const Theme           = "chirp";
	// Minify the HTML source.
	const Minify          = true;
	// Number of posts to display before paginating.
	const PostsPerPage    = 5;
	// Use Parsedown for Markdown.
	const Parsedown       = true;
	// Date format. See: https://www.php.net/manual/en/datetime.format.php
	const DatePretty      = "M j, Y";
	// Title separator character.
	const TitleSeparator  = " — ";
	// Enable debug mode
	const DEBUG = false;
}
/**
 * That's all folks! Simple huh?
 *
 * DO NOT EDIT BELOW OR THE
 * INTERNET WILL EXPLODE
 *
 */

/**
 * If we're in debug, display errors
 */
if ( Config::DEBUG === true )
{
	ini_set( "display_errors", 1 );
	ini_set( "display_startup_errors", 1 );
	error_reporting( E_ALL );
}
/**
 * Active theme directory
 */
if ( ! function_exists( "get_theme_dir" ) )
{
	function get_theme_dir()
	{
		return Config::Root . "themes/" . Config::Theme . "/";
	}
}
if ( ! function_exists( "theme_dir" ) )
{
	function theme_dir()
	{
		echo Config::Root . "themes/" . Config::Theme . "/";
	}
}
/**
 * CSS directory
 */
if ( ! function_exists( "get_theme_css_dir" ) )
{
	function get_theme_css_dir()
	{
		return Config::Root . "themes/" . Config::Theme . "/assets/css/";
	}
}
if ( ! function_exists( "theme_css_dir" ) )
{
	function theme_css_dir()
	{
		echo Config::Root . "themes/" . Config::Theme . "/assets/css/";
	}
}
/**
 * JS directory
 */
if ( ! function_exists( "get_theme_js_dir" ) )
{
	function get_theme_js_dir()
	{
		return Config::Root . "themes/" . Config::Theme . "/assets/js/";
	}
}
if ( ! function_exists( "theme_js_dir" ) )
{
	function theme_js_dir()
	{
		echo Config::Root . "themes/" . Config::Theme . "/assets/js/";
	}
}
/**
 * img directory
 */
if ( ! function_exists( "get_theme_img_dir" ) )
{
	function get_theme_img_dir()
	{
		return Config::Root . "themes/" . Config::Theme . "/assets/img/";
	}
}
if ( ! function_exists( "theme_img_dir" ) )
{
	function theme_img_dir()
	{
		echo Config::Root . "themes/" . Config::Theme . "/assets/img/";
	}
}
/**
 * Media directory
 */
if ( ! function_exists( "get_media_dir" ) )
{
	function get_media_dir()
	{
		return Config::Root . "media/";
	}
}
if ( ! function_exists( "media_dir" ) )
{
	function media_dir()
	{
		echo Config::Root . "media/";
	}
}
/**
 * Addons directory
 */
if ( ! function_exists( "get_addons_dir" ) )
{
	function get_addons_dir()
	{
		return Config::Root . "addons/";
	}
}
if ( ! function_exists( "addons_dir" ) )
{
	function addons_dir()
	{
		echo Config::Root . "addons/";
	}
}
/**
 * Core CSS directory
 */
if ( ! function_exists( "get_core_css_dir" ) )
{
	function get_core_css_dir()
	{
		return Config::Root . "core/assets/css/";
	}
}
if ( ! function_exists( "core_css_dir" ) )
{
	function core_css_dir()
	{
		echo Config::Root . "core/assets/css/";
	}
}
/**
 * Core JS directory
 */
if ( ! function_exists( "get_core_js_dir" ) )
{
	function get_core_js_dir()
	{
		return Config::Root . "core/assets/js/";
	}
}
if ( ! function_exists( "core_js_dir" ) )
{
	function core_js_dir()
	{
		echo Config::Root . "core/assets/js/";
	}
}
/**
 * Core img directory
 */
if ( ! function_exists( "get_core_img_dir" ) )
{
	function get_core_img_dir()
	{
		return Config::Root . "core/assets/img/";
	}
}
if ( ! function_exists( "core_img_dir" ) )
{
	function core_img_dir()
	{
		echo Config::Root . "core/assets/img/";
	}
}
/**
 * Homepage URL
 */
if ( ! function_exists( "get_home_link" ) )
{
	function get_home_link()
	{
		return Config::Root;
	}
}
if ( ! function_exists( "home_link" ) )
{
	function home_link()
	{
		echo Config::Root;
	}
}
/**
 * Returns server root path
 */
if ( ! function_exists( "get_root_path" ) )
{
	function get_root_path()
	{
		return $_SERVER['DOCUMENT_ROOT'];
	}
}
if ( ! function_exists( "root_path" ) )
{
	function root_path()
	{
		echo $_SERVER['DOCUMENT_ROOT'];
	}
}
/**
 * Returns the base URL, including "http(s)"
 */
if ( ! function_exists( "get_base_url" ) )
{
	function get_base_url()
	{
		return ( isset( $_SERVER['HTTPS']) ? "https" : "http" ) . "://" . $_SERVER['HTTP_HOST'];
	}
}
if ( ! function_exists( "base_url" ) )
{
	function base_url()
	{
		echo ( isset( $_SERVER['HTTPS']) ? "https" : "http" ) . "://" . $_SERVER['HTTP_HOST'];
	}
}
/**
 * Returns the full URL, including "http(s)"
 */
if ( ! function_exists( "get_full_url" ) )
{
	function get_full_url()
	{
		return get_base_url() . filter_var( $_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL );
	}
}
if ( ! function_exists( "full_url" ) )
{
	function full_url()
	{
		echo get_base_url() . filter_var( $_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL );
	}
}
/**
 * Returns the current page, including whether a tag was included
 */
if ( ! function_exists( "get_page_url" ) )
{
	function get_page_url()
	{
		$str = Config::Root;

		if ( isset( $_GET['tag'] ) && $_GET['tag'] != "" )
		{
			$tag  = filter_var( $_GET['tag'], FILTER_SANITIZE_STRING );
			$str .= "tag/{$tag}/";
		}

		return $str;
	}
}
/**
 * Returns a link to a specific blog post
 */
if ( ! function_exists( "get_post_link" ) )
{
	function get_post_link( $post_slug )
	{
		return Config::Root . "post/" . $post_slug;
	}
}
/**
 * Returns a link to the archive of a specific tag
 */
if ( ! function_exists( "get_tag_link" ) )
{
	function get_tag_link( $tag_slug )
	{
		return Config::Root . "tag/" . $tag_slug;
	}
}
/**
 * Returns whether we can use the markdown conversion
 */
if ( ! function_exists( "using_parsedown" ) )
{
	function using_parsedown()
	{
		return ( file_exists( "includes/parsedown.php" ) && Config::Parsedown );
	}
}