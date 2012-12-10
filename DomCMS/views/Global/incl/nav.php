<div id="nav">
    <div class="wrapper">
        <ul class="main_nav relative">
            <li class="dashboard">
            	<a href="<?= base_url(); ?>"><span>Dashboard</span></a>
                <div class="subnav" id="dashboard_nav">
                    <div class="pivot">&nbsp;</div>
                    <a href="#">Dashboard</a>
                    <a href="#">DPR</a>
                    <a href="#">Reports</a>
                    <div class="clear"></div>
                </div>
            </li>
            <li class="advertising">
            	<a href="<?= base_url(); ?>advertising"><span>Advertising</span></a>
                <div class="subnav" id="advertising_nav">
                    <div class="pivot">&nbsp;</div>
                    <a href="#">E-Blasts</a>
                    <a href="#">Newsletters</a>
                    <a href="#">CRM Templates</a>
                    <div class="clear"></div>
                </div>
            </li>
	<li class="creative">
            	<a href="<?= base_url(); ?>creative"><span>Creative</span></a>
                <div class="subnav" id="creative_nav">
                    <div class="pivot">&nbsp;</div>
                    <a href="#">Assets</a>
                    <a href="#">Logos</a>
                    <a href="#">Videos</a>
                    <a href="#">Audio</a>
                    <div class="clear"></div>
                </div>
            </li>
            <li class="content">
                <a href="<?= base_url(); ?>content"><span>Content</span></a>
                <div class="subnav" id="content_nav">
                    <div class="pivot">&nbsp;</div>
                    <a href="#">Content Pages</a>
                    <a href="#">New Cars</a>
                    <a href="#">Used Cars</a>
                    <a href="#">Specials</a>
                    <a href="#">Archive</a>
                    <div class="clear"></div>
                </div>
            </li>
            <li class="merchandising">
            	<a href="<?= base_url(); ?>merchandising"><span>Merchandising</span></a>
                <div class="subnav" id="merch_nav">
                    <div class="pivot">&nbsp;</div>
                    <a href="#">New Car Specials</a>
                    <a href="#">Used Car Specials</a>
                    <a href="#">Service Specials</a>
                    <a href="#">Parts Specials</a>
                    <a href="#">Body Shop Specials</a>
                    <div class="clear"></div>
                </div>
            </li>
            <li class="dms">
            	<a href="<?= base_url(); ?>dms"><span>DMS Database</span></a>
                <div class="subnav" id="dms_nav">
                    <div class="pivot">&nbsp;</div>
                    <a href="#">DMS</a>
                    <a href="#">Custom Report</a>
                    <div class="clear"></div>
                </div>
            </li>
            <li class="reputations">
            	<a href="<?= base_url(); ?>reputation"><span>Reputation</span></a>
                <div class="subnav" id="rep_nav">
                    <div class="pivot">&nbsp;</div>
                    <a href="#">Content Pages</a>
                    <a href="#">New Cars</a>
                    <a href="#">Used Cars</a>
                    <a href="#">Specials</a>
                    <a href="#">Archive</a>
                    <div class="clear"></div>
                </div>
            </li>
            <li class="admin">
            	<a href="<?= base_url(); ?>admin/"><span>Admin</span></a>
                <div class="subnav" id="admin_nav">
                    <div class="pivot">&nbsp;</div>
                    <a href="<?= base_url(); ?>admin/agency">Agency</a>
                    <a href="#">Groups</a>
                    <a href="#">Clients</a>
                    <a href="#">Users</a>
                    <a href="#">Contacts</a>
                    <a href="#">Websites</a>
                    <a href="#">Preferences</a>
                    <a href="#">My Account</a>
                    <div class="clear"></div>
                </div>
            </li>
        </ul>
        <div id="orgInfo">
            <h4>Agency Name:</h4>
            <h5>Dealer Online Marketing</h5>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.main_nav').IconNav({
            defaultIcon:$('li.<?= $active_button; ?>')
        });
    });
</script>
<div class="clear"></div>