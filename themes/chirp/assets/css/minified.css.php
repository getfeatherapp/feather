<?php
/**
 * Grab all individual stylesheets, concatenate
 * minify and compress
 */
header( 'Content-type: text/css' );
ob_start( 'compress' );

	function compress( $buffer )
	{
		/* remove comments */
    	$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);

    	/* remove tabs, spaces, newlines, etc. */
    	$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);

    	return $buffer;
	}
  	/**
	 * CSS files for compression
	 */
	include( 'framework.css' );
	include( 'scaffolding.css' );
  	include( 'helpers.css' );
  	include( 'odometer.css' );
  	include( 'prism.css' );
  	include( 'typography.css' );
  	include( 'theme.css' );
	include( 'contrast.css' );
  	include( 'print.css' );
ob_end_flush();