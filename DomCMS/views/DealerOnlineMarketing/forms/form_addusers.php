<div class="wrapper content-padding">
    <div id="form_addgroups" class="content-page block">
        <form action="<?= base_url(); ?>admin/form_processor/users/add" method="post" enctype="multipart/form-data" class="validate">
            <fieldset>
                <legend>Add New User</legend>
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
                    <div>
                        <label for="text">Phone:<abbr title="Required">*</abbr></label>
                        <input id="text" class="text validate[required, custom[phone]]" name="phone" type="tel" />
                        <em>Users Phone Number</em>
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