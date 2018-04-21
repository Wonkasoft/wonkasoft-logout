<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://wonkasoft.com
 * @since      1.0.0
 *
 * @package    Wonkasoft_Logout
 * @subpackage Wonkasoft_Logout/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wonkasoft-logout-wrap">
<div class="logo"><img src="<?php echo plugins_url( '../img/Logo_rec.svg', __FILE__ ); ?>"></div>

<form method="post" action="options.php">
    <?php settings_fields( 'wonkasoft_logout_settings' ); ?>
    <?php do_settings_sections( 'wonkasoft_logout_settings_page' ); ?>

    <?php submit_button(); ?>

</form>
</div>