<?php if ( ! defined( "FEATHER_INIT" ) ) die();

function post( $entry, $full )
{
	$frontpage = Config::FrontPage;
	$root      = Config::Root;
	$url       = get_full_url();
	$page_slug =  isset( $_GET['page'] ) ? filter_var( $_GET['page'], FILTER_SANITIZE_STRING ) : "";
	$tag_slug  =  isset( $_GET['tag'] ) ? filter_var( $_GET['tag'], FILTER_SANITIZE_STRING ) : "";
	$pg        =  isset( $_GET['pagination'] ) ? filter_var( $_GET['pagination'], FILTER_SANITIZE_NUMBER_INT ) : "";

	/**
	 * We don't want to load some things on pages,
	 * so let's check if we're on on single post
	 */
	if ( not_blank( 'post' ) )
	{
		echo "
		<article class='h-entry ".($full === true ? " single-entry" : "entry" )."' itemscope itemtype='https://schema.org/BlogPosting'>
			<div class='boxed'>
				<div class='boxed'>
		";
					if ( $full === true )
					{
						/**
						 * Title
						 */
						echo "<h1 class='p-name entry-title' itemprop='name headline mainEntityOfPage'>{$entry->title}</h1>";
						/**
						 * Postmeta
						 */
						echo "<div class='postmeta'>";
							echo "<time datetime={$entry->date_datetime()}>"._( 'Last Updated:' )." {$entry->date_pretty()}</time>";

							if ( $entry->has_tags() )
							{
								echo "<div class='tags'>";
									foreach ( $entry->tags as $tag )
									{
										echo "<a class='tag link effect' href='" . get_tag_link($tag) . "' itemprop='url' data-attr='{$tag}'>{$tag}</a>";
									}
								echo "</div>";
							}
						echo "</div>";
						/**
						 * Featured Image
						 */
						if ( $entry->has_image() )
						{
							echo "<figure class='featured-image alignwide'><img class='featured u-photo' src='{$entry->image}' alt='Featured Image' /></figure>";
						}
						/**
						 * Content
						 */
						echo "<div class='e-content entry-content' itemprop='articleBody'>{$entry->content}</div>";
						/**
						 * Microformats for standards & seo, hidden for
						 * display purposes but available to screenreaders
						 */
						echo "
                		<div class='published entry-date screen-reader-text' content='{$entry->date_datetime()}' itemprop='datePublished'>{$entry->date_pretty()}</div>
                		<div class='updated entry-date screen-reader-text' content='{$entry->date_datetime()}' itemprop='dateModified'>{$entry->date_pretty()}</div>
                		<div class='vcard author entry-author screen-reader-text' itemprop='author'><span class='fn'>".Theme::AuthorName."</span></div>
                        <div class='publisher entry-publisher screen-reader-text' itemprop='publisher'>".Config::Title."</div>
                		";
						/**
						 * Author Bio
						 */
						if ( Theme::AuthorBio != "" )
						{
							echo "
								<div itemscope itemtype='https://schema.org/Person' id='author-bio'>
									<div class='author-info'>
										<p class='author-title'>"._( 'About' )." ".(Theme::AuthorName ? Theme::AuthorName : 'the Author' )."</p>
										<p itemprop='description'>".Theme::AuthorBio."</p>
									</div>
								</div>
							";
						}
					}
		echo "
				</div>
			</div>
		</article>
		";
	}
	/**
	 * Frontpage
	 */
	else if ( ! empty( $frontpage ) && empty( $tag_slug ) && $page_slug !== 'posts' && $pg < 1 && $url == Config::Root )
	{
		echo "
		<article class='page " . ( $full === true ? " single-entry" : "entry" ) . "' itemscope itemtype='https://schema.org/WebPage'>
			<div class='boxed'>
				<div class='boxed'>
		";
					if ( $full === true )
					{
						echo "<div itemprop='mainContentOfPage'>";
							/**
							 * Title
							 */
							echo "<h1 class='p-name entry-title' itemprop='name headline mainEntityOfPage'>{$entry->summary}</h1>";
							/**
							 * Featured Image
							 */
							if ( $entry->has_image() )
							{
								echo "<figure class='featured-image alignfull'><img class='featured u-photo' src='{$entry->image}' alt='Featured Image' /></figure>";
							}
							/**
							 * Content
							 */
							echo "<div class='e-content entry-content' itemprop='articleBody'>{$entry->content}</div>";
						echo "</div>";
						/**
						 * Microformats for standards & seo, hidden for
						 * display purposes but available to screenreaders
						 */
						echo "
	            		<div class='published entry-date screen-reader-text' content='{$entry->date_datetime()}' itemprop='datePublished'>{$entry->date_pretty()}</div>
	            		<div class='updated entry-date screen-reader-text' content='{$entry->date_datetime()}' itemprop='dateModified'>{$entry->date_pretty()}</div>
	            		<div class='vcard author entry-author screen-reader-text' itemprop='author'><span class='fn'>".Theme::AuthorName."</span></div>
	                    <div class='publisher entry-publisher screen-reader-text' itemprop='publisher'>".Config::Title."</div>
	                    ";
					}
		echo "
				</div>
			</div>
		</article>
		";
	}
	/**
	 * Page
	 */
	else if ( not_blank( 'page' ) && $page_slug !== 'posts' )
	{
		echo "
		<article class='page " . ( $full === true ? " single-entry" : "entry" ) . "' itemscope itemtype='https://schema.org/WebPage'>
			<div class='boxed'>
				<div class='boxed'>
		";
					if ( $full === true )
					{
						echo "<div itemprop='mainContentOfPage'>";
							/**
							 * Title
							 */
							echo "<h1 class='p-name entry-title' itemprop='name headline mainEntityOfPage'>{$entry->summary}</h1>";
							/**
							 * Featured Image
							 */
							if ( $entry->has_image() )
							{
								echo "<figure class='featured-image alignfull'><img class='featured u-photo' src='{$entry->image}' alt='Featured Image' /></figure>";
							}
							/**
							 * Content
							 */
							echo "<div class='e-content entry-content' itemprop='articleBody'>{$entry->content}</div>";
						echo "</div>";
						/**
						 * Microformats for standards & seo, hidden for
						 * display purposes but available to screenreaders
						 */
						echo "
	            		<div class='published entry-date screen-reader-text' content='{$entry->date_datetime()}' itemprop='datePublished'>{$entry->date_pretty()}</div>
	            		<div class='updated entry-date screen-reader-text' content='{$entry->date_datetime()}' itemprop='dateModified'>{$entry->date_pretty()}</div>
	            		<div class='vcard author entry-author screen-reader-text' itemprop='author'><span class='fn'>".Theme::AuthorName."</span></div>
	                    <div class='publisher entry-publisher screen-reader-text' itemprop='publisher'>".Config::Title."</div>
	                    ";
					}
		echo "
				</div>
			</div>
		</article>
		";
	}
	/**
	 * Posts Index
	 */
	else
	{
		echo "
		<article class='h-entry ".($full === true ? " single-entry" : "entry" )."' itemscope itemtype='https://schema.org/BlogPosting'>
			<div class='boxed'>
				<div class='boxed'>
		";
					echo "<h2 class='entry-title'><a href='{$root}post/{$entry->slug}' itemprop='url'>{$entry->title}</a></h2>";
					echo "<div class='postmeta'><time datetime={$entry->date_datetime()}>"._( 'Last Updated:' )." {$entry->date_pretty()}</time></div>";
					echo "<div class='p-summary entry-summary'>{$entry->summary}</div>";
		echo "
				</div>
			</div>
		</article>
		";
	}
}