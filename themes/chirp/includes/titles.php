<?php if ( ! defined( "FEATHER_INIT" ) ) die();
/**
 * Set some vars
 */
$frontpage = Config::FrontPage;
$root      = Config::Root;
$url       = get_full_url();
$post      = $Blog->posts[0];
$page_slug = isset( $_GET['page'] ) ? filter_var( $_GET['page'], FILTER_SANITIZE_STRING ) : "";
$tag_slug  = isset( $_GET['tag'] ) ? filter_var( $_GET['tag'], FILTER_SANITIZE_STRING ) : "";
/**
 * Check if we're hitting a 404
 */
if ( $Blog->url != Url::Error404 )
{
	$content  = $post->content;
}
else
{
	$content = "";
}
/**
 * Manipulate the content for our description
 */
// strip styles
$content = preg_replace( "/<style\\b[^>]*>(.*?)<\\/style>/s", "", $content );
// strip images
$content = preg_replace("/<img[^>]+\>/i", "", $content);
// strip returns and newlines
$content = str_replace("\n",  ' ', $content );
$content = str_replace("\r",  ' ', $content );
$content = str_replace("&nbsp;",  ' ', $content );
// strip html
$content = strip_tags( $content );
// convert html back
$content = htmlspecialchars_decode( $content );
/**
 * If our post object isn't empty
 * and we're not on the posts archive
 * or tag archives
 */
if ( $post != "" && $page_slug != 'posts' && empty( $tag_slug ) )
{
	$htmltitle   = htmlentities( $post->title );
	$htmlsummary = htmlentities( $post->summary );
	$htmldesc    = htmlentities( substr( $content, 0, 155 ) )."...";
}
else
{
	$htmltitle   = htmlentities( Config::Title );
	$htmlsummary = htmlentities( Config::Description );
	$htmldesc    = htmlentities( Config::Description );
}
/**
 * Build our titles based on the 
 * page we're on
 */
// page is set as frontpage and we're on it
if ( ! empty( $frontpage ) && $url == Config::Root )
{
	$title = Config::Title . Config::TitleSeparator . $htmlsummary = ( $htmlsummary ? $htmlsummary : Config::Description );
}
// posts are set as frontpage and we're on it
else if ( empty( $frontpage ) && $url == Config::Root || $page_slug == 'posts' || ! empty( $tag_slug ) )
{
	$title = Config::Title . Config::TitleSeparator . Config::Description;
}
// everything else
else
{
	$title = ( $htmltitle ? $htmltitle : Config::Title ) . Config::TitleSeparator . $htmlsummary = ( $htmlsummary ? $htmlsummary : Config::Description );
}
/**
 * If we're on a post 
 */
if ( $Blog->url === Url::Post )
{	
	/**
	 * If we have a featured image
	 */
	if ( $post->has_image() == true )
	{
		echo "<meta property='og:image' content='{$post->image}' />".PHP_EOL;
		echo "<meta name='twitter:card' content='summary_large_image' />".PHP_EOL;
		echo "<meta name='twitter:image' content='{$post->image}' />".PHP_EOL;
	}

	echo '<title>'.$title.'</title>'.PHP_EOL;
	echo '<meta property="og:title" content="'.$title.'" />'.PHP_EOL;
	echo '<meta name="description" content="'.$htmldesc.'" />'.PHP_EOL;
	echo '<meta property="og:description" content="'.$htmldesc.'" />'.PHP_EOL;
	echo '<meta name="twitter:description" content="'.$htmldesc.'" />'.PHP_EOL;
}
/**
 * If we're on a page
 */
else if ( $Blog->url === Url::Page )
{	
	/**
	 * If we have a featured image
	 */
	if ( $post->has_image() == true )
	{
		echo "<meta property='og:image' content='{$post->image}' />".PHP_EOL;
		echo "<meta name='twitter:card' content='summary_large_image' />".PHP_EOL;
		echo "<meta name='twitter:image' content='{$post->image}' />".PHP_EOL;
	}

	echo '<title>'.$title . Config::TitleSeparator . $htmlsummary.'</title>'.PHP_EOL;
	echo '<meta property="og:title" content="'.$title . Config::TitleSeparator . $htmlsummary.'" />'.PHP_EOL;
	echo '<meta name="description" content="'.$htmldesc.'" />'.PHP_EOL;
	echo '<meta property="og:description" content="'.$htmldesc.'" />'.PHP_EOL;
	echo '<meta name="twitter:description" content="'.$htmldesc.'" />'.PHP_EOL;
}
/**
 * Everything else
 */
else
{
	echo '<title>'.$title . Config::TitleSeparator . $htmlsummary.'</title>'.PHP_EOL;
	echo '<meta property="og:title" content="'.$title . Config::TitleSeparator . $htmlsummary.'" />'.PHP_EOL;
	echo '<meta name="description" content="'.$htmldesc.'" />'.PHP_EOL;
	echo '<meta property="og:description" content="'.$htmldesc.'" />'.PHP_EOL;
	echo '<meta name="twitter:description" content="'.$htmldesc.'" />'.PHP_EOL;
}