<div class="wrapper content-padding">
    <div id="form_addgroups" class="content-page block">
			<form action="#">
				<fieldset>
					<legend>Add New User</legend>
						<div><label for="text">User Name:<abbr title="Required">*</abbr></label>
								<input id="text" class="text" type="text"><em>Note about this field</em>
						</div>
						<div><label for="text">First Name:<abbr title="Required">*</abbr></label>
								<input id="text" class="text" type="text"><em>Note about this field</em>
						</div>
						<div><label for="text">Last Name:<abbr title="Required">*</abbr></label>
								<input id="text" class="text" type="text"><em>Note about this field</em>
						</div>
						<div><label for="text">Phone:<abbr title="Required">*</abbr></label>
								<input id="text" class="text" type="text"><em>Note about this field</em>
						</div>
						<div><label for="select">Permission Level:</label>
								<select id="select" class="select" style="width:30%;">
										<option value="0">Super-Admin</option>
                                        <option value="10">Admin</option>
                                        <option value="20">Organization Admin</option>
                                        <option value="30">Client Admin</option>
                                        <option value="40">Manager</option>
                                        <option value="50">User</option>
								</select>
							<em>Note about this selection</em>
						</div>
						<div><label for="select">Member of:</label>
								<select id="select" class="select" style="width:30%;">
										<option>DDI</option>
										<option>Dealer Online Marketing</option>
								</select>
							<em>Note about this selection</em>
						</div>
					<div class="submit">
						<input class="button green" type="submit" value="Submit">
						<input class="button green" type="button" value="Cancel">
					</div>
				</fieldset>
			</form>
    </div>
</div>