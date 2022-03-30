<?php if ( ! defined( "FEATHER_INIT" ) ) die();
/** 
 * Setup some vars
 */
$baseurl = Config::Root;
/**
 * Human Sitemap
 */
?>
<!DOCTYPE html>
<html lang="en-GB" itemscope itemtype="https://schema.org/WebSite" prefix="og://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title><?php echo Config::Title; ?></title>
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=5.0" />
<meta name="description" content="<?php echo Config::Description; ?>" />
<?php feather_head(); ?>
</head>
<body>
<style>
	#sitemap
	{
		font-family: "Helvetica", Arial, sans-serif;
	    font-size: 18px;
	    font-weight: 400;
	    line-height: 1.8em;
	    margin: 0 auto;
	    margin-top: 8%;
	    position: relative;
	    z-index: 5;
	    padding: 0 0 0 75px;
	}
	
	#sitemap h1
	{
		font-size: 600%;
		margin-bottom: 100px;
		margin-top: 0;
	}
	
	#sitemap h2
	{
		font-size: 110%;
		margin-bottom: 10px;
		margin-top: 0;
	}
	
	#sitemap ul
	{
		margin: 0;
		padding: 0 0 0 5px;
		list-style: none;
	}
	
	#sitemap ul li
	{
		font-size: 20px;
	}
	
	#sitemap ul li:last-of-type
	{
		margin-bottom: 35px;
	}
	
	#sitemap ul li a
	{
		color: #61718a;
	}
	
	#sitemap ul li a:hover
	{
		color: #111111;
	}
</style>

<div id="sitemap">
	<h1><?php echo _( "Sitemap" ); ?></h1>
	<ul>
		<li>
			<h2><?php echo _( "Pages:" ); ?></h2>
			<ul>
				<li><a href="<?php echo $baseurl.$page->slug; ?>"><?php echo $baseurl.$page->slug; ?></a></li>
				<?php
					foreach ($Blog->pages as $key => $page) 
					{
						echo "<li><a href='".$baseurl.$page->slug."'>".$baseurl.$page->slug."</a></li>";
					}
				?>
			</ul>
		</li>
		<li>
			<?php if ( ! empty( $Blog->posts ) ) : echo "<h2>"._( "Posts:" )."</h2>"; endif; ?>
			<ul>
				<?php
					foreach ($Blog->posts as $key => $post) 
					{
						echo "<li><a href='".$baseurl."post/".$post->slug."'>".$baseurl."post/".$post->slug."</a></li>";
					}
				?>
			</ul>
		</li>
	</ul>
</div>
<?php
// footer
feather_footer();
echo "</body></html>";
/**
 * XML Sitemap
 */
function return_url( $url, $date, $change, $priority ) 
{
	return "\n<url>\n<loc>{$url}</loc>\n<lastmod>{$date}</lastmod>\n<changefreq>{$change}</changefreq>\n<priority>{$priority}</priority>\n</url>\n";
}

$sitemap  = '<?xml version="1.0" encoding="UTF-8"?>
<!-- XML Sitemap Generate by https://getfeather.app/ -->
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
';

    foreach ($Blog->pages as $key => $page) 
	{
		$sitemap .= return_url("{$baseurl}{$page->slug}", gmdate("c", $page->edited), "monthly", "1.0");
	}
	
	foreach ($Blog->posts as $key => $post) 
	{
		$sitemap .= return_url("{$baseurl}post/{$post->slug}", gmdate("c", $post->edited), "monthly", "0.8");
	}

$sitemap .= '</urlset>';

$fp = fopen( dirname(__DIR__) . '/sitemap.xml', 'w' );

fwrite( $fp, $sitemap );
fclose( $fp );