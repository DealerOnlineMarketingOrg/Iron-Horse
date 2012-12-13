<div id="nav">
    <div class="wrapper">
        <ul class="main_nav relative">
            <li class="dashboard">
            	<a href="<?= base_url(); ?>"><span>Reports</span></a>
                <div class="subnav" id="dashboard_nav">
                    <div class="pivot">&nbsp;</div>
                    <a href="<?= base_url(); ?>dashboard">Dashboard</a>
                    <a href="#">DPR</a>
                    <a href="#">Reports Query</a>
                    <a href="#">Game Day</a>
                    <a href="#">DMS Database</a>
                    <a href="#">Web</a>
                    <a href="#">Leads</a>
                    <div class="clear"></div>
                </div>
            </li>
            <li class="advertising">
            	<a href="<?= base_url(); ?>advertising"><span>Advertising</span></a>
                <div class="subnav" id="advertising_nav">
                    <div class="pivot">&nbsp;</div>
                    <a href="#" class="google">Google</a>
                    <a href="#" class="yahoo">Yahoo</a>
                    <a href="#" class="bing">Bing</a>
                    <a href="#" class="facebook">Facebook</a>
                    <div class="clear"></div>
                </div>
            </li>
			<li class="creative">
            	<a href="<?= base_url(); ?>creative"><span>Creative</span></a>
                <div class="subnav" id="creative_nav">
                    <div class="pivot">&nbsp;</div>
                    <a href="#">Campaigns</a>
                    <a href="#">E-Blasts</a>
                    <a href="#">Newsletters</a>
                    <a href="#">CRM Templates</a>
                    <a href="#">Specials</a>
                    <a href="#">Misc</a>
                    <div class="clear"></div>
                </div>
            </li>
            <li class="content">
                <a href="<?= base_url(); ?>content"><span>Content</span></a>
                <div class="subnav" id="content_nav">
                    <div class="pivot">&nbsp;</div>
                    <a href="#">Dealership Pages</a>
                    <a href="#">New Cars</a>
                    <a href="#">Used Cars</a>
                    <a href="#">Variable Ops Pages</a>
                    <a href="#">Fixed Ops Pages</a>
                    <div class="clear"></div>
                </div>
            </li>
            <li class="merchandising">
            	<a href="<?= base_url(); ?>merchandising"><span>Merchandising</span></a>
                <div class="subnav" id="merch_nav">
                    <div class="pivot">&nbsp;</div>
                    <a href="#">New Car</a>
                    <a href="#">Used Car</a>
                    <a href="#">Service</a>
                    <a href="#">Parts</a>
                    <a href="#">Body Shop</a>
                    <div class="clear"></div>
                </div>
            </li>
            <li class="reputation">
            	<a href="<?= base_url(); ?>reputation"><span>Reputation/Social</span></a>
                <div class="subnav" id="rep_nav">
                    <div class="pivot">&nbsp;</div>
                    <a href="#" class="google_plus">Google+</a>
                    <a href="#" class="yelp">Yelp</a>
                    <a href="#" class="yahoo">Yahoo</a>
                    <a href="#" class="bing">Bing</a>
                    <div class="clear"></div>
                </div>
            </li>
            <li class="admin">
            	<a href="<?= base_url(); ?>admin/"><span>Admin</span></a>
                <div class="subnav" id="admin_nav">
                    <div class="pivot">&nbsp;</div>
                    <a href="#">Portal</a>
                    <a href="<?= base_url(); ?>admin/agency">Agency</a>
                    <a href="#">Groups</a>
                    <a href="#">Clients</a>
                    <a href="#">Users</a>
                    <a href="#">Contacts</a>
                    <a href="#">Websites</a>
                    <a href="#">Master List</a>
                    <a href="#">My Account</a>
                    <div class="clear"></div>
                </div>
            </li>
        </ul>
        <div id="orgInfo">
            <h4><?= get_client_type(); ?></h4>
            <h5><?= get_client_name(); ?></h5>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.main_nav').IconNav({
            defaultIcon:$('li.<?= ACTIVE_BUTTON; ?>')
        });
    });
</script>
<div class="clear"></div>