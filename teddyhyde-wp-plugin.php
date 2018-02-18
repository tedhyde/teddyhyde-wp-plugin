<?php
  /**
     * @package Teddy_Hyde_Wordpress
     * @version 0.0.8
   */

  /**
   Plugin Name: Teddy Hyde Wordpress
   Plugin URI: https://github.com/tedhyde/teddyhyde-wordpress-plugin
   Description: Teddy Hyde for Wordpress
   Author: Chris Dawson
   Version: 0.0.8
   Author URI: http://www.teddyhyde.com
   Text Domain: teddy-hyde-wordpress
   */

   /*
   Special thanks to Ozh for this code sample: http://planetozh.com/blog/wp-content/uploads/2009/05/ozh-configuration-pluginphp.txt
   From this blog post: http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/
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

  $url = get_site_url();
  // If we are using localhost, get that, otherwise assume https.
  if( 0 == strpos( $url, "http://localhost" ) ) {
    $hostname = substr( $url, strlen( "http://" ));
  }
  else {
    $hostname = substr( $url, strlen( "https://" ));
  }

$iframe = <<<EOD

<iframe height="150px" width="100%" frameborder="0" id="th" src="https://tx.teddyhyde.com/contribution/{$hostname}"></iframe>

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
    wp_enqueue_style( 'th_local_css' );
    wp_enqueue_script( 'teddyhyde_js', 'https://cdn.teddyhyde.com/0.0.1/teddyhyde-client-0.0.1.js');
    wp_enqueue_script( 'teddyhyde_jquery', 'https://code.jquery.com/jquery-1.8.2.min.js' );
    wp_enqueue_script( 'teddyhyde_jquery_popup', 'https://cdn.rawgit.com/vast-engineering/jquery-popup-overlay/1.7.13/jquery.popupoverlay.js' );
    wp_enqueue_script( 'teddyhyde_user_js', 'https://cdn.teddyhyde.com/0.0.1/teddyhyde-user.js' );
    wp_enqueue_style( 'teddyhyde_user_css', 'https://cdn.teddyhyde.com/0.0.1/teddyhyde-user.css' );
}

add_action('admin_init', 'teddyhyde_configuration_init' );
add_action('admin_menu', 'teddyhyde_configuration_add_page');

// Init plugin options to white list our options
function teddyhyde_configuration_init(){
	register_setting( 'teddyhyde_configuration_options', 'teddyhyde_configuration', 'teddyhyde_configuration_validate' );
}

// Add menu page
function teddyhyde_configuration_add_page() {
	add_options_page('TeddyHyde iFrame Options', 'TeddyHyde Options', 'manage_options', 'teddyhyde_configuration', 'teddyhyde_configuration_do_page');
}

// Draw the menu page itself
function teddyhyde_configuration_do_page() {
?>

<div class="wrap">
  <h2>Ozh's Sample Options</h2>
  <form method="post" action="options.php">
    <?php settings_fields('teddyhyde_configuration_options'); ?>
    <?php $options = get_option('teddyhyde_configuration'); ?>

    <script>
      console.log( "<?php echo htmlspecialchars( $options['popup'] ? $options['popup'] : $popup ); ?>" );
    </script>
    
    <table class="form-table">
      <tr valign="top">
	<th scope="row">Advertising-ish popup when payment is declined</th>
	<td>
	  <textarea cols="50" rows="6" name="teddyhyde_configuration[popup]">
            <?php echo htmlspecialchars( $options['popup'] ? $options['popup'] : $popup ); ?>
	  </textarea>
	</td>
      </tr>
      <tr valign="top">
	<th scope="row">iFrame configuration</th>
	<td>
	  <textarea cols="50" rows="6" name="teddyhyde_configuration[iframe]">
	    <?php echo htmlspecialchars( $options['popup'] ? $options['iframe'] : $iframe ); ?>
	  </textarea>
	</td>
      </tr>
    </table>
    <p class="submit">
      <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>
  </form>
</div>

<?php	
}

// Sanitize and validate input. Accepts an array, return a sanitized array.
function teddyhyde_configuration_validate($input) {
	// Our first value is either 0 or 1
	// $input['option1'] = ( $input['option1'] == 1 ? 1 : 0 );
	
	// Say our second option must be safe text with no HTML tags
        // $input['sometext'] =  wp_filter_nohtml_kses($input['sometext']);
	return $input;
}

?>
