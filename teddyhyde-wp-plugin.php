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

$popup = <<<EOD
<div id="wrapper">
  <div id="personal_ad_wrapper">
    <!-- Add content to the popup -->
    <div id="personal_ad_popup">
      <h2>Thanks for your visit.</h2>

      <div>
        You aren't interesting in contributing. I get that, everyone has
        moments where it just doesn't work. Thanks for visiting.
      </div>

      <div>
        Please watch this ad for 15 seconds and
        then you'll have full access to the post.
      </div>

      <div>
        While you wait:
        <a target="_new" href="https://admin.teddyhyde.com">
          <h3 class="underline">Why not create your own blog here?</h3>
        </a>
        Create your <strong>FREE Jekyll blog</strong> hosted on GitHub:
        <strong>fast and secure over HTTPS</strong>,
        with <strong>PWA notifications</strong> so your users never miss a post,
        and collect <strong>cryptocurrency micro-contributions</strong> with ease.
    </div>

  </div>
</div>


EOD;

$iframe = <<<'EOD'

<iframe height="150px" width="100%" frameborder="0" id="th" src="https://tx.teddyhyde.com/contribution/slowgramming.com"></iframe>

<div class="outer">
  <div id="thanks">
    Thank you for your contribution! Your support allows me to keep writing.
  </div>
</div>

<div class="outer">
  <div id="myad">
    Oh, so you don't want to contribute. Ok, please read this ad for a bit, and then you can read my blog.
  </div>
</div>

EOD;

function add_gated_excerpt( $content ) {
  global $popup, $iframe;
  $lines = explode("\n", $content);
  $excerpt = '<div id="excerpt">' . $lines[1] . '</div>';
  $full = '<div id="full">' . $content . '</div>';
  return ( $excerpt . $full . $iframe . $popup  );
} 

add_filter( 'the_content', 'add_gated_excerpt' );

add_action('wp_enqueue_scripts', 'th_assets_setup');
function th_assets_setup() {
    wp_register_style( 'teddyhyde_css', 'https://cdn.teddyhyde.com/0.0.1/teddyhyde-reveal-jekyll.css' );
    wp_enqueue_style( 'teddyhyde_css' );
    wp_register_style( 'th_local_css', 'https://poetry.teddyhyde.io/teddyhyde.css' );
    wp_enqueue_style( 'th_local_css' );
    wp_enqueue_script( 'teddyhyde_js', 'https://cdn.teddyhyde.com/0.0.1/teddyhyde-client-0.0.1.js');
    wp_enqueue_script( 'teddyhyde_jquery', 'https://code.jquery.com/jquery-1.8.2.min.js' );
    wp_enqueue_script( 'teddyhyde_jquery_popup', 'https://cdn.rawgit.com/vast-engineering/jquery-popup-overlay/1.7.13/jquery.popupoverlay.js' );
    wp_enqueue_script( 'teddyhyde_popup', 'https://poetry.teddyhyde.io/blog.js' );
}

?>
