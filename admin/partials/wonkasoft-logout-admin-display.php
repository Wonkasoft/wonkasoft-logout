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
<div class="wrap">
<h1>Wonkasoft Logout</h1>

<form method="post" action="options.php">
    <?php settings_fields( 'wonkasoft_logout_settings' ); ?>
    <?php do_settings_sections( 'wonkasoft_logout_settings' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Login Redirect URL</th>
        <td><input type="text" name="login_redirect" value="<?php echo esc_attr( get_option('login_redirect') ); ?>" /></td>
        </tr>

        <tr valign="top">
        <th scope="row">Logout Redirect URL</th>
        <td><input type="text" name="logout_redirect" value="<?php echo esc_attr( get_option('logout_redirect') ); ?>" /></td>
        </tr>
    </table>

    <?php submit_button(); ?>

</form>
</div>