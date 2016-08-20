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

        <form id="on-tap-add-new">
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
                        <option value="AL">Alabama</option>
                        <option value="AK">Alaska</option>
                        <option value="AZ">Arizona</option>
                        <option value="AR">Arkansas</option>
                        <option value="CA">California</option>
                        <option value="CO">Colorado</option>
                        <option value="CT">Connecticut</option>
                        <option value="DE">Delaware</option>
                        <option value="DC">District of Columbia</option>
                        <option value="FL">Florida</option>
                        <option value="GA">Georgia</option>
                        <option value="HI">Hawaii</option>
                        <option value="ID">Idaho</option>
                        <option value="IL">Illinois</option>
                        <option value="IN">Indiana</option>
                        <option value="IA">Iowa</option>
                        <option value="KS">Kansas</option>
                        <option value="KY">Kentucky</option>
                        <option value="LA">Louisiana</option>
                        <option value="ME">Maine</option>
                        <option value="MD">Maryland</option>
                        <option value="MA">Massachusetts</option>
                        <option value="MI">Michigan</option>
                        <option value="MN">Minnesota</option>
                        <option value="MS">Mississippi</option>
                        <option value="MO">Missouri</option>
                        <option value="MT">Montana</option>
                        <option value="NE">Nebraska</option>
                        <option value="NV">Nevada</option>
                        <option value="NH">New Hampshire</option>
                        <option value="NJ">New Jersey</option>
                        <option value="NM">New Mexico</option>
                        <option value="NY">New York</option>
                        <option value="NC">North Carolina</option>
                        <option value="ND">North Dakota</option>
                        <option value="OH">Ohio</option>
                        <option value="OK">Oklahoma</option>
                        <option value="OR">Oregon</option>
                        <option value="PA">Pennsylvania</option>
                        <option value="RI">Rhode Island</option>
                        <option value="SC">South Carolina</option>
                        <option value="SD">South Dakota</option>
                        <option value="TN">Tennessee</option>
                        <option value="TX" selected="selected">Texas</option>
                        <option value="UT">Utah</option>
                        <option value="VT">Vermont</option>
                        <option value="VA">Virginia</option>
                        <option value="WA">Washington</option>
                        <option value="WV">West Virginia</option>
                        <option value="WI">Wisconsin</option>
                        <option value="WY">Wyoming</option>
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
