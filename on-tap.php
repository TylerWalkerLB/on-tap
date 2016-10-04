<?php
/*
Plugin Name: On Tap
Plugin URI: http://www.bittersistersbrewery.com
Description: This plugin will be used to store and display all locations that Bitter Sisters is currently on tap at
Version: 1.0.0
Author: Tyler Walker
Author URI: http://www.chadtylerwalker.com
License: GPL2
*/

//global values for both version of plugin and version of DB
global $ontapVersion;
$ontapVersion = '1.0.0';
global $ontap_dontap_version;
$ontap_dontap_version = '1.0.0';

require(plugin_dir_url(__FILE__).'on-tap-template-class.php');
//PageTemplater::get_instance();

//This action will add in the correct scripts for using front-end
function ontap_scripts() {
    global $wpdb;
    $table_name = $wpdb->prefix . "on_tap_locations";

    $locations = $wpdb->get_results(
        "
        SELECT *
        FROM $table_name
        WHERE on_tap = 1 && deleted = 1
        "
    );

    $googleAPIKey = get_option('ontap_api_key');

    wp_register_script('google-maps-api', 'https://maps.googleapis.com/maps/api/js?key=' . $googleAPIKey, array(), '1.0.0', true);
    wp_register_script('on-tap-map', plugin_dir_url(__FILE__).'assets/dist/js/ontap.js', array(), '1.0.0', true);

    wp_enqueue_script('google-maps-api');
    wp_enqueue_script('on-tap-map');

    wp_enqueue_style( 'ot-pres-styles', plugin_dir_url(__FILE__).'assets/dist/css/ontap.css');

    $adminUrl = get_admin_url();
    wp_localize_script('on-tap-map','ot_ajax',
        array(
            'ajaxUrl'   => admin_url('admin-ajax.php'),
            'admin_url' => $adminUrl,
            'locations' => $locations
        )
    );
}
add_action('wp_enqueue_scripts','ontap_scripts');



//This function will add scripts and css for the admin pages
function ontap_admin_scripts($hook) {
    $googleAPIKey = get_option('ontap_api_key');

    wp_enqueue_style( 'ot-admin-styles', plugin_dir_url(__FILE__).'assets/dist/css/ontap.css');
    wp_register_script('admin-google-maps-api', 'https://maps.googleapis.com/maps/api/js?key=' . $googleAPIKey, array(), '1.0.0', true);
    wp_register_script('on-tap-admin', plugin_dir_url(__FILE__).'assets/js/onTapAdmin.js', array(), '1.0.0', true);

    wp_enqueue_script('admin-google-maps-api');
    wp_enqueue_script('on-tap-admin');

    $adminUrl = get_admin_url();
    wp_localize_script('on-tap-admin','ot_ajax',
        array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'admin_url' => $adminUrl
        )
    );
}
add_action('admin_enqueue_scripts','ontap_admin_scripts');


function register_ontap_settings() {
    //register settings
    register_setting('ontap_settings_group','ontap_api_key');

}
//call register settings function
add_action('admin_init','register_ontap_settings');


//This action will add a menu page for the plugins options
function ontapAdmin() {
    //create menu page that is generated by _admin.php
    add_menu_page('On Tap','On Tap','manage_options','on-tap/on-tap-admin.php','','dashicons-exerpt-view',33);
    add_submenu_page('on-tap/on-tap-admin.php','on-tap/on-tap-admin.php','Settings', 'manage_options','on-tap/on-tap-admin.php');
    add_submenu_page('on-tap/on-tap-admin.php','Locations','Locations','manage_options','on-tap/on-tap-locations.php');
    add_submenu_page('on-tap/on-tap-admin.php','Add New','Add New','manage_options','on-tap/on-tap-add-new.php');
}
add_action('admin_menu','ontapAdmin');


//Create tables IMPORTANT
function ontap_data_install () {
    global $wpdb;
    global $ontap_dontap_version;

    //set variables for each table we want to create
    $table_name = $wpdb->prefix . "on_tap_locations";

    //find the charset for the DB. Could be changed depending on user
    $charset_collate = $wpdb->get_charset_collate();

    //add _table if dp_table does not already exist
    if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") !== $table_name) {
        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            location_name varchar(200) NULL,
            location_address1 varchar(250) NULL,
            location_address2 varchar(250) NULL,
            location_city varchar(150) NULL,
            location_state varchar(150) NULL,
            location_zip int(5) NULL,
            location_lat float(10,6) NULL,
            location_lng float(10,6) NULL,
            on_tap int(1) NOT NULL DEFAULT 1,
            deleted int(1) NOT NULL DEFAULT 1,
            UNIQUE KEY id (id)
            ) $charset_collate;";


        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);

        add_option('dp_data_version', $ontap_dontap_version);

    }

}// end ontap_dontap_install()
//register the DB table hook
register_activation_hook(__FILE__,'ontap_data_install');


// This function will add a shortcode
function ontap_shortcode($atts) {

    require_once(ABSPATH.'wp-config.php');
    require_once(ABSPATH.'wp-load.php');
    global $wpdb;

    $table_name = $wpdb->prefix.'on_tap_locations';

    $locations = $wpdb->get_results(
        "
        SELECT *
        FROM $table_name
        WHERE on_tap = 1 && deleted = 1
        "
    );

    ?>

    <h1>Find Bitter Sisters beer at your local bar!</h1>
    <hr>

    <div class="ot-map__container">
        <div class="ot-map" id="ot-map"></div>

        <section class="ot-locs">
            <?php foreach($locations as $loc): ?>
                <div class="ot-locs__container">
                    <h3 class="ot-locs__name">
                        <?php echo $loc->location_name; ?>
                    </h3>
                    <p class="ot-locs__address1"><?php echo $loc->location_address1; ?></p>
                    <?php if (!empty($loc->location_address2)): ?>
                        <p class="ot-locs__address2"><?php echo $loc->location_address2; ?></p>
                    <?php endif; ?>
                    <p class="ot-locs__address3">
                        <?php echo $loc->location_city . ', ' . $loc->location_state . ' ' . $loc->location_zip; ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </section>
    </div>

    <?php
}// end ontap_shortcode
add_shortcode('ontap','ontap_shortcode');


function ontap_add_edit() {
    global $wpdb;

    $table_name = $wpdb->prefix.'on_tap_locations';

    $which  = $_POST['which'];
    $title  = $_POST['title'];
    $addr1  = $_POST['addr1'];
    $addr2  = $_POST['addr2'];
    $city   = $_POST['city'];
    $state  = $_POST['state'];
    $zip    = $_POST['zip'];
    $lat    = $_POST['lat'];
    $lng    = $_POST['lng'];

    if ($which == 'new') {
        if (
        $wpdb->query($wpdb->prepare(
            "INSERT INTO $table_name
    (location_name, location_address1, location_address2, location_city, location_state, location_zip, location_lat, location_lng)
    VALUES (%s, %s, %s, %s, %s, %d, %f, %f)",
            array(
                $title,
                $addr1,
                $addr2,
                $city,
                $state,
                $zip,
                $lat,
                $lng
            )
        ))
        ) {
            echo true;
        } else {
            echo false;
        }
    }

    die();

}
add_action('wp_ajax_ontap_add_edit','ontap_add_edit');
