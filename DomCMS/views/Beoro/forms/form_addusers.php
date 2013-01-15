<div class="full-width">
    <div id="edit_adduser" class="box">
    	<div class="inner">
            <form action="<?= base_url(); ?>admin/form_processor/users/add" method="post" enctype="multipart/form-data" class="validate">
            	<div class="titlebar"><span class="icon awesome white browser"></span><span class="w-icon">Edit User: Username</span></div>
                <div class="contents">
                    <div class="row">
                    	<label>Email Address</label>
                        <div class="field-box">
                            <span class="icon entypo user for-input"></span>
                            <input id="email_address" class="w-icon medium mask validate[required,custom[email]]" data-mask="999999" autofocus="autofocus" tabindex="1" placeholder="Email Address" name="email_address" type="text" />
                        </div>
                    </div>
                    <div class="row">
                    	<label>First Name</label>
                       	<div class="field-box">
                        	<span class="icon entypo user for-input"></span>
                        	<input id="first_name" class="w-icon medium mask validate[required]" data-mask="999999" placeholder="First Name" tabindex="2" name="first_name" type="text" />
                        </div>
                    </div>
                    <div class="row">
                        <label>Last Name</label>
                    	<div class="field-box">
                        	<span class="icon entypo user for-input"></span>
                            <input id="last_name" class="w-icon medium mask validate[required]" data-mask="999999" placeholder="Last Name" tabindex="3" name="last_name" type="text" />
                        </div>
                    </div>
                    <div class="row">
                    	<label>Address</label>
                        <div class="field-box">
                        	<span class="icon entypo address for-input"></span>
                        	<input id="address" class="w-icon medium mask" data-mask="999999" type="text" placeholder="Address" tabindex="4" />
                        </div>
                    </div>
                    <div class="row">
                    	<label>City</label>
                        <div class="field-box">
                        	<span class="icon entypo address for-input"></span>
                        	<input id="city" class="w-icon medium mask" data-mask="999999" type="text" placeholder="City" tabindex="5" />
                        </div>
                    </div>
                    <div class="row">
                    	<label>State</label>
                        <select name="state" id="select" placeholder="Select A State" class="chzn-select medium" tabindex="6" style="width:30%;">
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
                    </div>
                    <div class="row">
                    	<label>Zip Code</label>
                        <div class="field-box">
                            <span class="icon entypo address for-input"></span>
                            <input id="zip" class="w-icon medium mask" data-mask="999999" placeholder="Zip Code" tabindex="7" type="text" name="zip" />
                        </div>
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
                    <div class="row last">
                    	<label>Permission Level</label>
                        <?= permission_selector(); ?>
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