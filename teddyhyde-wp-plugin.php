<?php
/**
   * Teddy Hyde Wordpress Plugin
   * @author xrd
   * @link http://teddyhyde.com
*/
function add_gated_excerpt( $content ) {
  
  $excerpt = preg_replace( '/(.*?)\n\n/', '<div id="excerpt">$1</div>', $content );
  $full = '<div id="full">' + $content + '</div>';
  return $excerpt + $content;
  
} 

add_filter( 'the_content', 'add_gated_excerpt' );

?>
