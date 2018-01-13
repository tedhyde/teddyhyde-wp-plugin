<?php
  /**
     * @package Teddy_Hyde_Wordpress
     * @version 0.0.3
   */

  /**
   Plugin Name: Teddy Hyde Wordpress
   Plugin URI: https://github.com/tedhyde/teddyhyde-wordpress-plugin
   Description: Teddy Hyde for Wordpress
   Author: Chris Dawson
   Version: 0.0.3
   Author URI: http://www.teddyhyde.com
   Text Domain: teddy-hyde-wordpress
   */

function add_gated_excerpt( $content ) {
  
  $excerpt = preg_replace( '/(.*?)\n\n/', '<div id="excerpt">$1</div>', $content );
  $full = '<div id="full">' + $content + '</div>';
  return $excerpt + $content;
  
} 

add_filter( 'the_content', 'add_gated_excerpt' );

?>
