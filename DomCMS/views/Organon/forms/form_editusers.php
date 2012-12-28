<div class="wrapper content-padding">
    <div id="form_addgroups" class="content-page block">
        <form action="<?= base_url(); ?>admin/form_processor/users/add" method="post" enctype="multipart/form-data" class="validate">
            <fieldset>
                <legend>Edit User</legend>
                    <div>
                        <label for="text">Email Address:<abbr title="Required">*</abbr></label>
                        <input id="text" class="text validate[required,custom[email]]" name="email_address" type="email" />
                        <em>This is the email address the client uses to log in.</em>
                    </div>
                    <div>
                        <label for="text">First Name:<abbr title="Required">*</abbr></label>
                        <input id="text" class="text validate[required]" name="first_name" type="text" />
                        <em>Users First Name</em>
                    </div>
                    <div>
                        <label for="text">Last Name:<abbr title="Required">*</abbr></label>
                        <input id="text" class="text validate[required]" name="last_name" type="text" />
                        <em>Users Last Name</em>
                    </div>
						<div><label for="text">Address:</label>
								<input id="text" class="text" type="text" /><em>Note about this field</em>
						</div>
						<div><label for="text">City:</label>
								<input id="text" class="text" type="text" /><em>Note about this field</em>
						</div>
						<div><label for="select">State:</label>
								<select id="select" class="select" style="width:30%;">
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
								</select>
							<em>Note about this selection</em>
						</div>
						<div><label for="text">Zip:</label>
								<input id="text" class="text" type="text" /><em>Note about this field</em>
						</div>
                    <div>
                        <label for="text">Phone:<abbr title="Required">*</abbr></label>
                        <input id="text" class="text validate[required, custom[phone]]" name="phone" type="tel" />
                        <em>Users Phone Number</em>
                    </div>
					<div><label for="textarea">Notes:</label>
								<textarea id="textarea" cols="48" rows="8"></textarea><em class="clear">Note about this field</em>
					</div>
                    <div>
                        <label for="select">Permission Level:<abbr title="Required">*</abbr></label>
                        <select id="select" class="select validate[required]" style="width:30%;" name="user_level">
                            <option value="100000">Super-Admin</option>
                            <option value="200000">Admin</option>
                            <option value="300000">Group Admin/option>
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
            </fieldset>
        </form>
    </div>
</div>