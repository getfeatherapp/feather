<?php if ( ! defined( "FEATHER_INIT" ) ) die();
/**
 * Include header and main 
 * post / page template
 */
include( "header.php" );
include( "single.php" );
/**
 * If this is a 404
 */
if ( $Blog->url === Url::Error404 ) 
{
	include( "404.php" );
} 
/**
 * If 0 posts
 */
else if ( count( $Blog->posts ) === 0 ) 
{
	include( "empty.php" );
} 
/**
 * If we have content
 */
else 
{
	foreach ( $Blog->posts as $entry ) 
	{
		$full = ( $Blog->url === Url::Post || $Blog->url === Url::Page );
		post( $entry, $full );
	}
}
/**
 * Include footer
 */
include( "footer.php" );