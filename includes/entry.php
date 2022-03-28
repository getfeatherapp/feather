<?php if ( ! defined( "FEATHER_INIT" ) ) die();

class Entry {
	public $slug;
	public $title;
	public $summary;
	public $image;
	public $tags;
	public $accent;
	public $content;
	public $timestamp;
	public $edited;

	public function __construct( $slug, $tag, $url ) 
	{
		$fullpath  = ( $url == Url::Post ) ? Config::PostsDirectory : Config::PagesDirectory;
		$fullpath .= $slug . ".md";

		if ( ! file_exists( $fullpath ) ) 
		{
			throw new NotFoundException();
		}
		/**
		 * Parse the file to get our data
		 */
		$file_contents = file_get_contents($fullpath);
		$lines         = explode("\n", $file_contents);
		$this->slug    = filter_var( $slug, FILTER_SANITIZE_STRING ); // from filename
		$this->title   = filter_var( trim( substr( $lines[0], strpos( $lines[0], ":" ) + 1 ) ), FILTER_SANITIZE_STRING ); // line 1 slug
		$this->summary = filter_var( trim( substr( $lines[1], strpos( $lines[1], ":" ) + 1 ) ), FILTER_SANITIZE_STRING ); // line 2 title
		$this->image   = filter_var( trim( substr( $lines[2], strpos( $lines[2], ":" ) + 1 ) ), FILTER_SANITIZE_URL ); // line 3 summary
		$tags          = filter_var( strtolower( trim( substr( $lines[3], strpos( $lines[3], ":" ) + 1 ) ) ), FILTER_SANITIZE_STRING ); // line 4 tags
		$this->accent  = filter_var( trim( substr( $lines[4], strpos( $lines[4], ":" ) + 1 ) ), FILTER_SANITIZE_STRING ); // line 5 accent
		/**
		 * Parse tags
		 */
		if ($tags !== "") 
		{
			$this->tags = explode( ", ", $tags );
		} 
		else 
		{
			$this->tags = [];
		}
		if ( $tag !== "" ) 
		{
			if ( ! in_array( $tag, $this->tags ) ) 
			{
				throw new NotFoundException();
			}
		}
		$metadata_length = 5;
		/**
		 * Parsedown
		 */
		if ( using_parsedown() ) 
		{
			$Parsedown     = new Parsedown();
			$this->content = $Parsedown->text( implode("\n", array_slice( $lines, $metadata_length ) ) );
		} 
		else 
		{
			$this->content = "<p>" . implode("<br/>", array_slice( $lines, $metadata_length ) ) . "</p>";
		}
		// file create / edit times
		$this->timestamp = filectime( $fullpath );
		$this->edited    = filemtime( $fullpath );
	}
	/**
	 * Featured image function
	 */
	public function has_image() 
	{
		if ( isset( $this->image ) && $this->image != "" ) 
		{
			return true;
		}
		
		return false;
	}
	/**
	 * Tags function
	 */
	public function has_tags() 
	{
		if ( isset( $this->tags ) && count( $this->tags ) > 0 ) 
		{
			return true;
		}
		return false;
	}
	/**
	 * Date formatting
	 */
	public function date_pretty() 
	{
		return gmdate( Config::DatePretty, $this->timestamp );
	}
	public function date_datetime() 
	{
		return gmdate( "Y-m-d\TH:i:s", $this->timestamp );
	}
}
// post
class Post extends Entry {
	public function __construct( $slug, $tag ) 
	{
		parent::__construct($slug, $tag, Url::Post);
	}
}
// page
class Page extends Entry {
	public function __construct( $slug ) 
	{
		parent::__construct($slug, "", Url::Page);
	}
}