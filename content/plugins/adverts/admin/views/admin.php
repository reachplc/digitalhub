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
if ( ! current_user_can( 'manage_options' ) ) {
	wp_die( 'You do not have sufficient permissions to access this page.' );
}
?>

  <form method="post" action="options.php">

  <div class="inside">

    <h3>Build Guide</h3>

    <?php
	  settings_fields( 'adverts-settings' );
	  do_settings_sections( __FILE__ );
	  // Get any stored settings
	  $options = get_option( 'adverts-settings' );
	?>

    <p id="new-setting">
    <?php

	if ( ! empty( $options['_build_guide'] ) ) {
		$attachment_id = (int) $options['_build_guide'];
		$image_attributes = wp_get_attachment_image( $attachment_id, 'thumbnail', 1 ); // returns an array
		echo $image_attributes;
	}

	?>

    <input id="file-id" type="hidden" name="adverts-settings[_build_guide]" value="<?php echo (isset($options['_build_guide']) && $options['_build_guide'] != '') ? $options['_build_guide'] : ''; ?>">
    </p>

    <?php
	  echo '<p id="js-build-guide-controls"><input id="build-guide-upload" name="build-guide-submit" class="button" type="button" value="Add Build Guide"> ';
	if ( ! empty( $options['_build_guide'] ) ) {
		echo '<input id="build-guide-remove" name="build-guide-remove" class="button" type="button" value="Remove Build Guide">';
	}
	  echo '</p>';
	?>
  </div>


	<?php submit_button(); ?>

  </form>

</div>
