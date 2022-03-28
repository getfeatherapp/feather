<?php 
/**
 * This is a barebones starter theme for Feather. 
 * No bells, no whistles, just the essentials.
 */
if ( ! defined( "FEATHER_INIT" ) ) die();
// setup some vars
$root  = Config::Root;
$title = Config::Title;
$ver   = FEATHER_VERSION;
?>
<!DOCTYPE html>
<html lang="en-GB" itemscope itemtype="https://schema.org/WebSite" prefix="og://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title><?php echo $Blog->get_title(); ?></title>
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=5.0" />
<meta name="description" content="<?php echo Config::Description; ?>" />
<?php feather_head(); ?>
</head>
<body>
<?php
// main title
echo "<h1><a href='{$root}'>{$title}</a></h1>";

// 404
if ( $Blog->url === Url::Error404 ) 
{
	echo "<h2>Error 404: Post Not Found</h2>";
} 
// no posts
else if ( count( $Blog->posts ) === 0 ) 
{
	echo "<h2>No Posts Found</h2>";
} 
else 
{
	// display content
	foreach ( $Blog->posts as $entry ) 
	{
		echo "<article style='margin-top: 32px;'>";

		// single post link
		if ( $Blog->url === Url::Archive ) 
		{
			echo "<h2><a href='".get_post_link($entry->slug)."'>{$entry->title}</a></h2>";
		} 
		else 
		{
			// featured image
			if ( $entry->has_image() ) 
			{
				echo "<img src='{$entry->image}' />";
			}
			// title
			echo "<h2>{$entry->title}</h2>";
			// content
			echo $entry->content;
			// tags
			if ( $entry->has_tags() ) 
			{
				echo "<div class='tags'>Tags: ";
				
				foreach ( $entry->tags as $tag ) 
				{
					echo "<a href='{$root}tag/{$tag}'>{$tag}</a>; ";
				}
				
				echo "</div>";
			}
		}
		echo "</article>";
	}
	// pagination
	if ( $Blog->has_pagination() ) 
	{
		echo "<p>";
		
			if ( $Blog->has_page_prev() ) 
			{
				echo "<a href='{$Blog->get_page_prev()}'>&larr; Newer</a>";
				echo "&nbsp;&nbsp;";
			}
	
			if ( $Blog->has_page_next() ) 
			{
				echo "<a href='{$Blog->get_page_next()}'>Older &rarr;</a>";
			}
			
		echo "</p>";
	}

}
// footer
echo "<footer style='margin-top:32px;'>Built with Feather v{$ver}</footer>";
feather_head();
echo "</body></html>";