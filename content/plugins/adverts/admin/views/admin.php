<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   Adverts
 * @author    Michael Bragg <michael@michaelbragg.net>
 * @license   GPL-2.0+
 * @link      http://trinitymirror.github.io
 * @copyright 2013 Trinity Mirror Creative
 */
?>

<div class="wrap">

	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

<?php // Check tthat the user is allowed to update options
  if (!current_user_can('manage_options')) {
    wp_die('You do not have sufficient permissions to access this page.');
  }
?>

	<!-- @TODO: Provide markup for your options page here. -->

  <form method="post" action="options.php">
  <?php
    settings_fields( 'adverts-settings' );
    do_settings_sections( __FILE__ );
    // Get any stored settings
    $options = get_option( 'adverts-settings' );
  ?>
  <p>
    <input id="advert-upload" name="advert-submit" class="button" type="button" value="Add Build Guide">
  </p>
  <p id="new-setting">
  <?php

$attachment_id = (int) $options['build_guide'];

$image_attributes = wp_get_attachment_image( $attachment_id, 'thumbnail', 1 ); // returns an array

echo $image_attributes;
?>
  <input id="file-id" type="hidden" name="adverts-settings[build_guide]" value="<?php echo (isset($options['build_guide']) && $options['build_guide'] != '') ? $options['build_guide'] : ''; ?>">
  </p>


  <?php submit_button(); ?>

  </form>

</div>
