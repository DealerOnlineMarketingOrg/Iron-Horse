<div class="full-width">
    <div id="edit_adduser" class="box">
    	<div class="inner">
            <form action="<?= base_url(); ?>admin/form_processor/users/add" method="post" enctype="multipart/form-data" class="validate">
            	<div class="titlebar"><span class="icon awesome white browser"></span><span class="w-icon">Edit User: <?= $user->Username; ?></span></div>
                	<div class="contents">
                        <div class="row">
                            <input id="email_address" class="large validate[required,custom[email]]" autofocus="autofocus" tabindex="1" placeholder="Email Address" name="email_address" type="email" />
                        </div>
                        <div class="row">
                            <input id="first_name" class="medium validate[required]" placeholder="First Name" tabindex="2" name="first_name" type="text" />
                        </div>
                        <div class="row">
                            <input id="last_name" class="medium validate[required]" placeholder="Last Name" tabindex="3" name="last_name" type="text" />
                        </div>
                        <div class="row">
                            <input id="address" class="large" type="text" placeholder="Address" tabindex="4" />
                            <input id="city" class="medium" type="text" placeholder="City" tabindex="5" />
                            <select name="state" id="select" placeholder="Select A State" class="chzn-select" tabindex="6" style="width:30%;">
                                <optgroup label="United States">
                                    <option value="AL">Alabama</option>
                                    <option value="AK">Alaska</option>
                                    <option value="AZ">Arizona</option>
                                    <option value="AR">Arkansas</option>
                                    <option value="CA">California</option>
                                    <option value="CO">Colorado</option>
                                    <option value="CT">Connecticut</option>
                                    <option value="DE">Delaware</option>
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
                                    <option value="TX">Texas</option>
                                    <option value="UT">Utah</option>
                                    <option value="VT">Vermont</option>
                                    <option value="VA">Virginia</option>
                                    <option value="WA">Washington</option>
                                    <option value="WV">West Virginia</option>
                                    <option value="WI">Wisconsin</option>
                                    <option value="WY">Wyoming</option>
                                </optgroup>
                            </select>
                            <input id="text" class="small" placeholder="Zip Code" tabindex="7" type="text" name="zip" />
                        </div>
                        <div class="row">
                            <input id="text" class="text validate[required, custom[phone]]" name="phone" type="tel" />
                            <em>Users Phone Number</em>
                        </div>
                        <div class="row">
                        	<textarea id="textarea" placeholder="Notes on the user" name="desc" cols="48" rows="8"></textarea>
                        </div>
                        <div class="row">
                            <select id="select" class="select validate[required]" style="width:30%;" name="user_level">
                                <option value="100000">Super-Admin</option>
                                <option value="200000">Admin</option>
                                <option value="300000">Group Admin</option>
                                <option value="400000">Client Admin</option>
                                <option value="500000">Manager</option>
                                <option value="600000">User</option>
                            </select>
                            <em>Users permission level</em>
                        </div>
                        <div>
                            <label for="select">Member of:<abbr title="Required">*</abbr></label>
                            <select id="select" class="select validate[required]" style="width:30%;" name="owner">
                                <option>DDI</option>
                                <option>Dealer Online Marketing</option>
                            </select>
                            <em>User belongs to this client</em>
                        </div>
                    <div class="submit">
                        <input class="button green" type="submit" value="Submit" name="submit" />
                        <input class="button grey" type="reset" value="Cancel" name="cancel" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>