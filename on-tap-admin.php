<?php

global $wpdb;
global $ontap_dontap_version;

?>

<h1 class="ot-admin__main-heading">On Tap</h1>
<h2 class="nav-tab-wrapper" id="top-wrap">
    <a class="nav-tab nav-tab-active" href="<?php echo admin_url(); ?>admin.php?page=on-tap%2Fon-tap-admin.php">Settings</a>
</h2>

<div class="ot-admin">

    <form method="post" action="options.php" id="dp-admin-form">
        <?php settings_fields('ontap_settings_group'); ?>
        <?php do_settings_sections('ontap_settings_group'); ?>

        <section class="ot-section">
            <h3 class="ot-admin__heading">Google Maps</h3>
            <h4 class="ot-admin__heading-description">A Google Maps API key is required for this plugin to function.</h4>
            <input size="45" type="text" name="ontap_api_key" value="<?php echo esc_attr(get_option('ontap_api_key')); ?>" />
        </section>

        <table class="form-table">
            <tr valign="top">
                <td>
                    <?php submit_button(); ?>
                </td>
            </tr>
        </table>

    </form>
    
</div>
