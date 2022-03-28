<aside id="aside" class="sidebar" itemscope="itemscope" itemtype="https://schema.org/WPSideBar">
    <div class="aside-contents">
        <!-- navigation -->
        <nav id="primary" class="nav" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement">
            <ul class="animated fadeIn nolist">
	            
				<li><a href="<?php home_link(); ?>" class="link effect" itemprop="url" data-attr="<?php echo _( "Home" ); ?>"><?php echo _( "Home" ); ?></a></li>
				
				<?php
					$root = Config::Root;
					
					foreach ( $Blog->pages as $Page ) 
					{	
						if ( $Page->title != "" )
						{
							echo "<li><a href='{$root}{$Page->slug}' class='link effect' itemprop='url' data-attr='{$Page->title}'>{$Page->title}</a></li>";
						}
					}
					
					$fi       = new FilesystemIterator( Config::PostsDirectory, FilesystemIterator::SKIP_DOTS );
					$postsnum = iterator_count( $fi );
					
					$frontpage = Config::FrontPage;
					
					if ( ! empty( $frontpage ) && $postsnum > 0 )
					{
					?>
						<li><a href="<?php echo "{$root}posts"; ?>" class="link effect" itemprop="url" data-attr="<?php echo _( "Blog" ); ?>"><?php echo _( "Blog" ); ?></a></li>
					<?php
					}
				?>
			</ul>
        </nav>
        <!-- /navigation -->
    </div>
</aside>