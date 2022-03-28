<?php if ( ! defined( "FEATHER_INIT" ) ) die();
	/**
	 * Fire up our theme options
	 */
	include_once( "includes/theme.php" );
?>
<!DOCTYPE html>
<html lang="en-GB" itemscope itemtype="https://schema.org/WebSite" prefix="og://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta name="theme-color" content="<?php echo Theme::PrimaryAccent; ?>" />
		<meta name="robots" content="noodp, noydir" />
		<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=5.0" />

		<meta property="og:locale" content="en_GB" />
		<meta property="og:type" content="website" />
		<meta property="og:url" content="<?php full_url(); ?>" />
		<meta property="og:site_name" content="<?php echo Config::Title; ?>" />
		
		<?php include( "includes/titles.php" ); ?>

		<link rel="icon" href="<?php core_img_dir(); ?>favicon.png" type="image/x-icon" />
		<link rel="canonical" href="<?php full_url(); ?>" />

		<link href="<?php theme_css_dir(); ?>minified.css.php" rel="stylesheet" />

		<style>
			/**
			 * Accent colors set in Theme Options
			 */
			h1 a:hover,
			h2 a:hover,
			h3 a:hover,
			h4 a:hover,
			h5 a:hover,
			h6 a:hover,
			a:hover,
			.effect::before
			{
				color: <?php echo Theme::PrimaryAccent; ?>!important;
			}
			
			.button,
			.effect::after,
			.fancy-heading:after,
			.contrast-toggle input:checked + i
			{
				background: <?php echo Theme::PrimaryAccent; ?>!important;
			}
		</style>

		<?php if ( Theme::Analytics != "" ) : ?>
			<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo Theme::Analytics; ?>"></script>
			<script>window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date());gtag('config', '<?php echo Theme::Analytics; ?>');</script>
		<?php endif;?>
		
		<?php feather_head(); ?>
	</head>
<body id="index">
	<!-- header -->
	<header id="main" itemscope="itemscope" itemtype="https://schema.org">
		<!-- box content -->
		<div class="fullwidth">

			<!-- logo -->
	        <div id="site-logo">
	            <a href="<?php home_link(); ?>" itemprop="url">
	                <div id="brand">
	                    <h2><?php echo Config::Title; ?></h2>
	                    <h3 class="notmobile"><?php echo Config::Description; ?></h3>
	                </div>
	            </a>
	        </div>
			<!-- /logo -->

	        <!-- sidebar toggle -->
            <button class="aside-toggle burger burger-collapse" type="button" aria-label="Menu">
				<span class="burger-box">
			    	<span class="burger-inner"></span>
				</span>
			</button>
            <!-- /sidebar toggle -->

		</div>
		<!-- /box content -->

    </header>
    <!-- /header -->

	<!-- wrappers -->
	<div id="blurred" class="not-active">
    	<div id="container">