<?php

global $wpdb;
global $ontap_dontap_version;

?>

<h1 class="ot-admin__main-heading">On Tap</h1>
<h2 class="nav-tab-wrapper" id="top-wrap">
    <a class="nav-tab" href="<?php echo admin_url(); ?>admin.php?page=on-tap%2Fon-tap-admin.php">Settings</a>
    <a class="nav-tab" href="<?php echo admin_url(); ?>admin.php?page=on-tap%2Fon-tap-locations.php">Locations</a>
    <a class="nav-tab nav-tab-active" href="<?php echo admin_url(); ?>admin.php?page=on-tap%2Fon-tap-add-new.php">Add New</a>
</h2>

<div class="ot-admin">
    <section class="ot-section">
        <h3 class="ot-admin__heading">Add New Location</h3>
        <h4 class="ot-admin__heading-description">Use this form to add new locations that you are on tap at.</h4>
    </section>

    <section class="ot-section">

        <form class="on-tap-add-edit" data-which="new">
            <div class="loc">
                <div class="loc__container">
                    <label for="loc-title" class="loc__label">Location Name</label>
                    <input class="loc__input loc__input--text loc-title" name="loc-title" value="">
                </div>

                <div class="loc__container">
                    <h2 class="loc__section-title">Address</h2>
                    <label for="loc-address1" class="loc__label">Street Address 1</label>
                    <input class="loc__input loc__input--text loc-address1" name="loc-address1" value="">
                </div>

                <div class="loc__container">
                    <label for="loc-address2" class="loc__label">Street Address 2</label>
                    <input class="loc__input loc__input--text loc-address2" name="loc-address2" value="">
                </div>

                <div class="loc__container loc__container--third">
                    <label for="loc-city" class="loc__label">City</label>
                    <input class="loc__input loc__input--text loc-city" name="loc-city" value="">
                </div>

                <div class="loc__container loc__container--third">
                    <label for="loc-state" class="loc__label">City</label>
                    <select name="loc-state" class="loc__input loc__input--select loc-state">
                        <option value="OK">Oklahoma</option>
                        <option value="TX" selected="selected">Texas</option>
                    </select>
                </div>

                <div class="loc__container loc__container--third">
                    <label for="loc-zip" class="loc__label">ZIP</label>
                    <input class="loc__input loc__input--text loc-zip" name="loc-zip" value="">
                </div>

                <div class="loc__container loc__container--third">
                    <button type="submit" class="loc__submit">Add Location</button>
                </div>

            </div>
        </form>
    </section>
</div>
