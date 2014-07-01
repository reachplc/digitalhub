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

  <p>
    <input id="advert-upload" name="advert-submit" class="button" type="button" value="Add Image">
  </p>
  <p id="new-setting">
  <input id="file-id" type="text" name="fileid">
  </p>


  <?php submit_button(); ?>

  </form>

</div>
