<?php

global $wpdb;
global $ontap_dontap_version;

$locId = 1;

if (isset($_GET['loc'])) {
    $locId = $_GET['loc'];
} else {
    header(admin_url() . 'admin.php?page=on-tap%2Fon-tap-locations.php');
}

$location = $wpdb->get_results(
    "
    SELECT *
    FROM $table_name
    WHERE id = '$locId' && deleted = 1
    "
);

?>

<h1 class="ot-admin__main-heading">On Tap</h1>
<h2 class="nav-tab-wrapper" id="top-wrap">
    <a class="nav-tab" href="<?php echo admin_url(); ?>admin.php?page=on-tap%2Fon-tap-admin.php">Settings</a>
    <a class="nav-tab" href="<?php echo admin_url(); ?>admin.php?page=on-tap%2Fon-tap-locations.php">Locations</a>
    <a class="nav-tab" href="<?php echo admin_url(); ?>admin.php?page=on-tap%2Fon-tap-add-new.php">Add New</a>
    <a class="nav-tab nav-tab-active" href="<?php echo admin_url(); ?>admin.php?page=on-tap%2Fon-tap-locations.php">Edit Location</a>
</h2>

<div class="ot-admin">

    <?php if ($location): ?>
        <?php foreach ($location as $loc): ?>
        <section class="ot-section">
            <h3 class="ot-admin__heading">Edit a Location</h3>
            <h4 class="ot-admin__heading-description">Use this form to edit an existing location that you are on tap at.</h4>
        </section>

        <section class="ot-section">

            <form class="on-tap-add-edit" data-which="edit">
                <div class="loc">
                    <div class="loc__container">
                        <label for="loc-title" class="loc__label">Location Name</label>
                        <input class="loc__input loc__input--text loc-title" name="loc-title" value="<?php echo $loc->location_name; ?>">
                    </div>

                    <div class="loc__container">
                        <label for="loc-tap" class="loc__label">On Tap?</label>
                        <select name="loc-tap" class="loc__input loc__input--select loc-tap">
                            <option value="1" <?php echo $loc->on_tap ? 'selected="selected"' : '' ?>>Yes</option>
                            <option value="0"<?php echo $loc->on_tap ? '' : 'selected="selected"' ?>>No</option>
                        </select>
                    </div>

                    <div class="loc__container">
                        <h2 class="loc__section-title">Address</h2>
                        <label for="loc-address1" class="loc__label">Street Address 1</label>
                        <input class="loc__input loc__input--text loc-address1" name="loc-address1" value="<?php echo $loc->location_address1; ?>">
                    </div>

                    <div class="loc__container">
                        <label for="loc-address2" class="loc__label">Street Address 2</label>
                        <input class="loc__input loc__input--text loc-address2" name="loc-address2" value="<?php echo $loc->location_address2; ?>">
                    </div>

                    <div class="loc__container loc__container--third">
                        <label for="loc-city" class="loc__label">City</label>
                        <input class="loc__input loc__input--text loc-city" name="loc-city" value="<?php echo $loc->location_city; ?>">
                    </div>

                    <div class="loc__container loc__container--third">
                        <label for="loc-state" class="loc__label">City</label>
                        <select name="loc-state" class="loc__input loc__input--select loc-state">

                            <option value="OK" <?php echo $loc->location_city == 'OK' ? 'selected="selected"' : ''; ?>>Oklahoma</option>
                            <option value="TX" <?php echo $loc->location_city == 'TX' ? 'selected="selected"' : ''; ?>>Texas</option>
                        </select>
                    </div>

                    <div class="loc__container loc__container--third">
                        <label for="loc-zip" class="loc__label">ZIP</label>
                        <input class="loc__input loc__input--text loc-zip" name="loc-zip" value="<?php echo $loc->location_zip; ?>">
                    </div>

                    <input type="hidden" name="loc-id" class="loc-id" value="<?php echo $loc->id; ?>">

                    <div class="loc__container loc__container--third">
                        <button type="submit" class="loc__submit">Update Location</button>
                    </div>

                </div>
            </form>
        </section>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
