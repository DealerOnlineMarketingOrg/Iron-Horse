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
                            <div class="one-half">
                                <h4>Address <?= $i; ?></h4>
                                <div>
                                    <label>Street</label>
                                    <div class="field-box">
                                        <span class="icon entypo address for-input"></span>
                                        <input id="address" class="w-icon medium" type="text" value="<?= $address['street']; ?>" tabindex="4" />
                                    </div>
                                </div>
                                <div>
                                    <label>City</label>
                                    <div class="field-box">
                                        <span class="icon entypo address for-input"></span>
                                        <input id="city" class="w-icon medium" type="text" value="<?= $address['city']; ?>"  tabindex="5" />
                                    </div>
                                </div>
                                <div>
                                	<label>State</label>
                                    <div class="field-box">
                                        <select name="state" class="chzn-select medium">
                                            <optgroup label="United States">
                                            <?php foreach($states as $state) { ?>
                                                <option <?= (($address['state'] == $state->Abbrev) ? 'selected="selected"' : ''); ?> value="<?= $state->Abbrev; ?>" style="width:252px;"><?= $state->Name; ?></option>
                                            <? } ?>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                	<label>Zip Code</label>
                                    <div class="field-box">
                                        <span class="icon entypo address for-input"></span>
                                        <input id="zip" class="w-icon medium" value="<?= $address['zipcode']; ?>" tabindex="7" type="text" name="zip" />
                                    </div>
                                </div>
                            </div>
					<?php $i++; } ?>
                    </div>
                    <div class="row">
                    	<label>Phone Number</label>
                        <div class="field-box">
                        	<span class="icon entypo phone for-input"></span>
                        	<input id="phone" class="w-icon medium mask validate[required, custom[phone]]" data-mask="999999" placeholder="Phone Number" tabindex="8" name="phone" type="text" />
                        </div>
                    </div>
                    <div class="row">
                    	<label>Description</label>
                        <textarea id="desc" placeholder="Notes on the user" name="desc" cols="48" rows="8" tabindex="9" style="font-size:11px;"></textarea>
                    </div>
                    <div class="row">
                    	<label>Permission Level</label>
                        <select id="perms" placeholder="User Permissions" class="chzn-select validate[required]" style="width:30%;" name="user_level" tabindex="10">
                            <option value="600000">Super-Admin</option>
                            <option value="500000">Admin</option>
                            <option value="400000">Group Admin</option>
                            <option value="300000">Client Admin</option>
                            <option value="200000">Manager</option>
                            <option value="100000">User</option>
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