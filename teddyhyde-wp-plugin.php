function add_crypto_gated_excerpt( $content ) {
  $excerpt = preg_replace( '/(.*?)\n\n/', '<div id="excerpt">$1</div>', $content );
  $full = '<div id="full">' + $content + '</div>';
  return $excerpt + $content;
} // mdc_the_content

add_filter( 'the_content', 'add_crypto_gated_excerpt' );
