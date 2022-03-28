<?php if ( ! defined( "FEATHER_INIT" ) ) die(); ?>
	</div>
</div>
<!-- /wrappers -->

<!-- pagination -->
<?php if ( $Blog->has_pagination() ) : ?>
	<div class="postnavi">
		<div class="container">
			<ul class="nolist">
				<?php if ( $Blog->has_page_prev() ) : ?>
					<li class="prev">
						<a href="<?php echo $Blog->get_page_prev(); ?>" itemprop="url" data-attr="<?php echo _( "&larr; Newer Posts" ); ?>">
							<?php echo _( "&larr; Newer Posts" ); ?>
						</a>
					</li>
				<?php endif; ?>
	
				<?php if ( $Blog->has_page_next() ) : ?>
					<li class="next">
						<a href="<?php echo $Blog->get_page_next(); ?>" itemprop="url" data-attr="<?php echo _( "Older Posts &rarr;" ); ?>">
							<?php echo _( "Older Posts &rarr;" ); ?>
						</a>
					</li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
<?php endif; ?>
<!-- /pagination -->

<?php 
	/**
	 * Sidebar
	 */
	include( "includes/aside.php" );
?>

<!-- footer -->
<footer id="footer">
	<div class="fullwidth">
		<?php feather_version(); ?>
	</div>
</footer>
<!-- /footer-->

<script src="<?php theme_js_dir(); ?>plugins.min.js" defer="defer"></script>
<script src="<?php theme_js_dir(); echo (Config::DEBUG ? "theme.js" : "theme.min.js" ); ?>" defer="defer"></script>

<?php feather_footer(); ?>	
</body>
</html>