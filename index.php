<?php
/**
 * Turn it on!
 */
define( "FEATHER_INIT", "true" );
/**
 * Feather Version
 */
define( "FEATHER_VERSION", "1.0.5" );
/**
 * Include main files
 */
require_once( "core/core.php" );
require_once( "includes/config.php" );
require_once( "includes/blog.php" );
require_once( "includes/entry.php" );
/**
 * Compress the source for performance
 */
if ( Config::Minify === true && Config::DEBUG === false )
{
	include_once( "includes/minify.php" );
	feather_compression_start();
}
/**
 * Hello, Bonjour, Hola, Guten tag...
 *
 * i18n translations
 */
if ( function_exists( "gettext" ) )
{
	// locale from config
	$i18n = Config::i18n;

	// set locale
	putenv( "LANGUAGE=$i18n" );
	setlocale( LC_ALL, $i18n );

	// i18n textdomain
	bindtextdomain( "messages", "./i18n" );

	// indicates encoding
	bind_textdomain_codeset( "messages", "UTF-8" );

	// set textdomain
	textdomain( "messages" );
}
/**
 * Parsedown
 */
if ( using_parsedown() )
{
	include( "includes/parsedown.php" );
}
/**
 * Start your engines
 */
$post_slug  = "";
$page_slug  = "";
$pagination = 0;
$tag        = "";
$is_rss     = not_blank( 'rss' );
/**
 * Check request is not empty
 */
function not_blank( $var )
{
	return ( isset( $_GET[$var] ) && $_GET[$var] !== "" );
}
/**
 * Request a post
 */
if ( not_blank( 'post' ) )
{
	$post_slug = $_GET['post'];
}
/**
 * Request a page
 */
else if ( not_blank( 'page' ) )
{
	$page_slug = $_GET['page'];
}
else
{
	// archive with or without tags
	if ( not_blank( 'tag' ) )
	{
		$tag = strtolower( filter_var( $_GET['tag'], FILTER_SANITIZE_STRING ) );
	}
	// pagination
	if ( not_blank( 'pagination' ) )
	{
		$pagination = filter_var( $_GET['pagination'], FILTER_SANITIZE_NUMBER_INT ) - 1;
	}
}
/**
 * Blog init
 */
$Blog = new Blog( $post_slug, $page_slug, $pagination, $tag, $is_rss );
/**
 * RSS
 */
if ( $is_rss === true )
{
	$rss = $_GET['rss'];
	include( "includes/rss.php" );
	die();
}
/**
 * Sitemap
 */
if ( not_blank( 'sitemap' ) )
{
	include( "includes/sitemap.php" );
	die();
}
/**
 * Theme
 */
include( "themes/" . Config::Theme . "/index.php" );
/**
 * We can now kill the process so no other processing gets run
 * (may happen on free webhosts that put code at the end of your blog)
 */
die();