<div class="full-width">
    <div id="edit_adduser" class="box">
    	<div class="inner">
            <form action="<?= base_url(); ?>admin/form_processor/users/edit" method="post" enctype="multipart/form-data" class="validate">
            	<div class="titlebar"><span class="icon awesome white browser"></span><span class="w-icon">Edit User: <?= $user->LastName . ', ' . $user->FirstName; ?></span></div>
                <div class="contents">
                    <div class="row">
                    	<label>Email Address</label>
                        <div class="field-box">
                            <span class="icon entypo user for-input"></span>
                            <input id="email_address" class="w-icon medium validate[required,custom[email]]" tabindex="1" value="<?= $user->EmailAddress; ?>" name="email_address" type="text" />
                        </div>
                    </div>
                    <div class="row">
                    	<label>First Name</label>
                       	<div class="field-box">
                        	<span class="icon entypo user for-input"></span>
                        	<input id="first_name" class="w-icon medium validate[required]" value="<?= $user->FirstName; ?>" tabindex="2" name="first_name" type="text" />
                        </div>
                    </div>
                    <div class="row">
                        <label>Last Name</label>
                    	<div class="field-box">
                        	<span class="icon entypo user for-input"></span>
                            <input id="last_name" class="w-icon medium validate[required]" value="<?= $user->LastName; ?>" tabindex="3" name="last_name" type="text" />
                        </div>
                    </div>
                    <div class="row">
						<?php
                            $i=1;
                            foreach($user->Address as $address) { ?>
                                <div class="<?= ((count($user->Address) == 1) ? 'full-width' : 'one-half'); ?>">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Address <?= $i; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label>Street</label>
                                                <div class="field-box">
                                                    <span class="icon entypo address for-input"></span>
                                                    <input id="address" name="street<?= $i; ?>" class="w-icon medium" type="text" value="<?= $address['street']; ?>" tabindex="4" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>City</label>
                                                <div class="field-box">
                                                    <span class="icon entypo address for-input"></span>
                                                    <input id="city" name="city<?= $i; ?>" class="w-icon medium" type="text" value="<?= $address['city']; ?>"  tabindex="5" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>State</label>
                                                <select name="state<?= $i; ?>" class="chzn-select medium" style="width:30%;">
                                                    <optgroup label="United States">
                                                    <?php foreach($states as $state) { ?>
                                                        <option <?= (($address['state'] == $state->Abbrev) ? 'selected="selected"' : ''); ?> value="<?= $state->Abbrev; ?>"><?= $state->Name; ?></option>
                                                    <? } ?>
                                                    </optgroup>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Zip Code</label>
                                                <div class="field-box">
                                                    <span class="icon entypo address for-input"></span>
                                                    <input id="zip" class="w-icon medium" value="<?= $address['zipcode']; ?>" tabindex="7" type="text" name="zip<?= $i; ?>" />
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <?php $i++; } ?>
                    </div>
                    <div class="row">
						<?php $i=1;foreach($user->Phones as $key => $value) { ?>
                            <div class="<?= ((count($user->Phones) == 1) ? 'full-width' : ((count($user->Phones) > 2) ? ((count($user->Phones) > 3) ? 'one-fourth' : 'one-third') : 'one-half')); ?>">
                                <table>
                                    <thead>
                                        <tr><th><span style="text-transform:capitalize;"><?= $key; ?></span></th></tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label>Phone Number</label>
                                                <div class="field-box">
                                                    <span class="icon entypo phone for-input"></span>
                                                    <input id="phone" class="w-icon medium validate[required, custom[phone]]" value="<?= $value; ?>" tabindex="8" name="phone<?=$i; ?>" type="text" />
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php $i++; } ?>
                    </div>
                    <div class="row">
                    	<label>Description</label>
                        <textarea id="desc" name="desc" cols="48" rows="8" tabindex="9" style="font-size:11px;"><?= $user->Notes; ?></textarea>
                    </div>
                    <div class="row">
                    	<label>Permission Level</label>
                        <select id="perms" placeholder="User Permissions" class="chzn-select validate[required]" style="width:30%;" name="user_level" tabindex="10">
                        	<?php foreach($levels as $level) { ?>
                            	<option <?= (($user->AccessLevel == $level->Level) ? 'selected="selected"' : ''); ?> value="<?= $level->Level; ?>"><?= $level->Name; ?></option>
                            <? } ?>
                        </select>
                    </div>
                    <div class="row last">
                    	<label>Membership</label>
                        <select id="owner" class="validate[required] chzn-select" placeholder="Member of?" style="width:30%;" name="owner" tabindex="11">
                            <option>DDI</option>
                            <option>Dealer Online Marketing</option>
                        </select>
                    </div>
                </div>
                <div class="bar-big">
                    <input type="submit" value="Submit" />
                    <input type="reset" value="Reset" />
                </div>
            </form>
        </div>
    </div>
</div>