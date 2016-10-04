<?php

require_once(ABSPATH.'wp-config.php');
require_once(ABSPATH.'wp-load.php');
global $wpdb;
global $ontap_dontap_version;

$table_name = $wpdb->prefix.'on_tap_locations';

$locations = $wpdb->get_results(
    "
        SELECT *
        FROM $table_name
        WHERE deleted = 1
        "
);

?>

<h1 class="ot-admin__main-heading">On Tap</h1>
<h2 class="nav-tab-wrapper" id="top-wrap">
    <a class="nav-tab" href="<?php echo admin_url(); ?>admin.php?page=on-tap%2Fon-tap-admin.php">Settings</a>
    <a class="nav-tab nav-tab-active" href="<?php echo admin_url(); ?>admin.php?page=on-tap%2Fon-tap-locations.php">Locations</a>
    <a class="nav-tab" href="<?php echo admin_url(); ?>admin.php?page=on-tap%2Fon-tap-add-new.php">Add New</a>
</h2>

<div class="ot-admin">
    <section class="ot-section">
        <h3 class="ot-admin__heading">All Locations</h3>

        <table class="ot-table">
            <tr class="ot-table__row ot-table__row--head">
                <th class="ot-table__head">Name</th>
                <th class="ot-table__head">Address</th>
                <th class="ot-table__head">Status</th>
                <th class="ot-table__head">Options</th>
            </tr>

            <?php foreach($locations as $loc): ?>
                <tr class="ot-table__row">
                    <td class="ot-table__cell">
                        <a class="ot-table__link" href="<?php echo admin_url(); ?>admin.php?page=on-tap%2Fon-tap-edit.php&loc=<?php $loc->id; ?>">
                            <?php echo $loc->location_name; ?>
                        </a>
                    </td>
                    <td class="ot-table__cell">
                        <?php
                        echo $loc->location_address1;
                        echo !empty($loc->location_address2) ? ' '.$loc->location_address2.', ' : ', ';
                        echo $loc->location_city . ', ' . $loc->location_state . ' ' . $loc->location_zip;

                        ?>
                    </td>
                    <td class="ot-table__cell">
                        <span class="ot-table__status <?php echo ($loc->on_tap) ? 'ot-table__status--enabled' : 'ot-table__status--disabled'; ?>">
                            <?php echo ($loc->on_tap) ? 'Enabled' : 'Disabled'; ?>
                        </span>
                    </td>
                    <td class="ot-table__cell">
                        <a class="ot-table__button ot-table__button--edit" href="<?php echo admin_url(); ?>admin.php?page=on-tap%2Fon-tap-edit.php&loc=<?php $loc->id; ?>">
                            Edit
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>
    </section>
</div>
