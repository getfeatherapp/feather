<?php if ( ! defined( "FEATHER_INIT" ) ) die();

class NotFoundException extends Exception {}

abstract class Url {
	const Archive  = 0;
	const Post     = 1;
	const Page     = 2;
	const Error404 = 3;
}

class Blog {
	public $posts;
	public $pages;
	public $url;

	private $_page_num;
	private $_page_num_total;

	function __construct( $post_slug, $page_slug, $pagination, $tag_slug, $is_rss )
	{
		/**
		 * Grab the frontpage setting
		 * from Config
		 */
		$frontpage = Config::FrontPage;
		/**
		 * We need to check if we're paginating posts
		 * when using the front page setting below else
		 * page 1 will display the frontpage
		 */
		$pg = isset( $_GET['pagination'] ) ? filter_var( $_GET['pagination'], FILTER_SANITIZE_NUMBER_INT ) : "";
		/**
		 * Fire up pages
		 */
		$this->pages           = Blog::loadPages();
		$this->_page_num       = 0;
		$this->_page_num_total = 1;
		/**
		 * Check if this is the Sitemap or RSS
		 */
		if ( not_blank( 'sitemap' ) ||  $is_rss === true )
		{
			$this->posts = Blog::loadPosts( $tag_slug );

			// pagination
			$this->_page_num       = $pagination;
			$offset                = Config::PostsPerPage * $this->_page_num;
			$length                = Config::PostsPerPage;
			$this->_page_num_total = ceil( count( $this->posts ) / $length);
			$this->url = Url::Archive;
		}
		/**
		 * If not Sitemap or RSS and Config is set to use 
		 * a page as the frontpage instead of posts
		 */
		else if ( ! empty( $frontpage ) && empty( $tag_slug ) && $pg < 1 )
		{
			// fetch single post
			if ( $post_slug !== "" )
			{
				try
				{
					$this->posts = [ new Post( $post_slug, "" )];
					$this->url   = Url::Post;
				}
				catch ( NotFoundException $e )
				{
					Header( "HTTP/1.1 404 Not Found" );
					$this->url = Url::Error404;
				}
			}
			// fetch frontpage
			else if ( $page_slug === "" )
			{
				try
				{
					$this->posts = [ new Page( $frontpage ) ];
					$this->url = Url::Page;
				}
				catch ( NotFoundException $e )
				{
					Header( "HTTP/1.1 404 Not Found" );
					$this->url = Url::Error404;
				}
			}
			// fetch posts index
			else if ( $page_slug === "posts" )
			{
				$this->posts = Blog::loadPosts( $tag_slug );

				// pagination
				$this->_page_num       = $pagination;
				$offset                = Config::PostsPerPage * $this->_page_num;
				$length                = Config::PostsPerPage;
				$this->_page_num_total = ceil( count( $this->posts ) / $length);

				// only return the posts that appear on that page, if displaying the archive page.
				if ( $is_rss !== true )
				{
					$this->posts = array_slice($this->posts, $offset, $length);
				}

				$this->url = Url::Archive;
			}
			// fetch page
			else if ( $page_slug !== "" )
			{
				try
				{
					$this->posts = [ new Page( $page_slug ) ];
					$this->url   = Url::Page;
				}
				catch  (NotFoundException $e )
				{
					Header( "HTTP/1.1 404 Not Found" );
					$this->url = Url::Error404;
				}
			}
		}
		/**
		 * If Config is set to use the default setting
		 * of displaying posts on the frontpage
		 */
		// fetch single post
		else if ( $post_slug !== "" )
		{
			try
			{
				$this->posts = [ new Post( $post_slug, "" ) ];
				$this->url = Url::Post;
			}
			catch ( NotFoundException $e )
			{
				Header( "HTTP/1.1 404 Not Found" );
				$this->url = Url::Error404;
			}
		}
		// fetch page
		else if ( $page_slug !== "" )
		{
			try
			{
				$this->posts = [ new Page( $page_slug ) ];
				$this->url   = Url::Page;
			}
			catch ( NotFoundException $e )
			{
				Header( "HTTP/1.1 404 Not Found" );
				$this->url = Url::Error404;
			}
		}
		// fetch posts index
		else
		{
			$this->posts = Blog::loadPosts( $tag_slug );

			// pagination
			$this->_page_num       = $pagination;
			$offset                = Config::PostsPerPage * $this->_page_num;
			$length                = Config::PostsPerPage;
			$this->_page_num_total = ceil( count( $this->posts ) / $length);

			// only return the posts that appear on that page, if displaying the archive page.
			if ( $is_rss !== true )
			{
				$this->posts = array_slice($this->posts, $offset, $length);
			}

			$this->url = Url::Archive;
		}
	}
	/**
	 * Return posts
	 */
	private function loadPosts( $tag )
	{
		$files = scandir(Config::PostsDirectory);
		$files = array_splice($files, 2);

		$posts = [];

		foreach ($files as $file)
		{
			try
			{
				$posts[] = new Post(rtrim($file, '.md'), $tag);
			}
			catch ( NotFoundException $e )
			{
				// do nothing
			}
		}

		// sort post by updated time
		usort( $posts, function ($a, $b)
		{
			return ($a->timestamp > $b->timestamp) ? -1 : 1;
		});

		return $posts;
	}
	/**
	 * Return pages
	 */
	private function loadPages()
	{
		$files = scandir(Config::PagesDirectory);
		$files = array_splice($files, 2);

		$pages = [];

		foreach ( $files as $file )
		{
			try
			{
				$pages[] = new Page(rtrim($file, '.md'));
			}
			catch ( NotFoundException $e )
			{
				// do nothing
			}
		}

		// sort pages by slug
		usort( $pages, function( $a, $b )
		{
			return strnatcmp( $a->slug, $b->slug );
		});

		return $pages;
	}
	/**
	 * Return the title
	 */
	public function get_title()
	{
		$str       = "";
		
		if ( $this->url === Url::Post || $this->url === Url::Page )
		{
			$str .= $this->posts[0]->title . ' ';
		}

		$str .= Config::Title;

		return $str;
	}
	/**
	 * Pagination
	 */
	public function get_page_num()
	{
		return $this->_page_num + 1;
	}

	public function get_page_prev()
	{
		return get_page_url() . "p/" . $this->_page_num;
	}

	public function get_page_next()
	{
		return get_page_url() . "p/" . ($this->_page_num + 2);
	}

	public function has_page_prev()
	{
		return ($this->_page_num === 0) ? false : true;
	}

	public function has_page_next()
	{
		return ($this->_page_num >= $this->_page_num_total - 1) ? false : true;
	}

	public function has_pagination()
	{
		return ($this->url === Url::Archive && ($this->has_page_next() || $this->has_page_prev())) ? true : false;
	}

	public function get_page_total() {
		return $this->_page_num_total;
	}
}