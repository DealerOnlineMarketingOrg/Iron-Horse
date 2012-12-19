<div id="nav">
    <div class="wrapper relative">
        <ul class="main_nav relative">
            <li class="reports">
            	<a href="<?= base_url(); ?>"><span>Reports</span></a>
                <div class="subnav" id="reports_nav">
                    <div class="pivot">&nbsp;</div>
                    <a href="/reports/dashboard">Dashboard</a>
                    <a href="/reports/dpr">DPR</a>
                    <a href="/reports/reports_query">Reports Query</a>
                    <a href="/reports/game_day">Game Day</a>
                    <a href="/reports/dms">DMS Database</a>
                    <a href="/reports/web">Web</a>
                    <a href="/reports/leads">Leads</a>
                    <div class="clear"></div>
                </div>
            </li>
            <li class="advertising">
            	<a href="/advertising"><span>Advertising</span></a>
                <div class="subnav" id="advertising_nav">
                    <div class="pivot">&nbsp;</div>
                    <a href="/advertising/google" class="google">Google</a>
                    <a href="/advertising/yahoo" class="yahoo">Yahoo</a>
                    <a href="/advertising/bing" class="bing">Bing</a>
                    <a href="/advertising/facebook" class="facebook">Facebook</a>
                    <div class="clear"></div>
                </div>
            </li>
			<li class="creative">
            	<a href="/creative"><span>Creative</span></a>
                <div class="subnav" id="creative_nav">
                    <div class="pivot">&nbsp;</div>
                    <a href="/creative/campaigns">Campaigns</a>
                    <a href="/creative/e_blasts">E-Blasts</a>
                    <a href="/creative/newsletters">Newsletters</a>
                    <a href="/creative/crm_templates">CRM Templates</a>
                    <a href="/creative/specials">Specials</a>
                    <a href="#">Misc</a>
                    <div class="clear"></div>
                </div>
            </li>
            <li class="content">
                <a href="/content"><span>Content</span></a>
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
            	<a href="/merchandising"><span>Merchandising</span></a>
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
<<<<<<< HEAD
            <li class="dms">
            	<a href="<?= base_url(); ?>dms"><span>DMS Database</span></a>
                <div class="subnav" id="dms_nav">
                    <div class="pivot">&nbsp;</div>
                    <a href="#">DMS</a>
                    <a href="#">Custom Report</a>
                    <div class="clear"></div>
                </div>
            </li>
            <li class="reputation">
            	<a href="<?= base_url(); ?>reputation"><span>Reputation</span></a>
=======
            <li class="reputation">
            	<a href="/reputation"><span>Reputation/Social</span></a>
>>>>>>> Development
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
            	<a href="/admin"><span>Admin</span></a>
                <div class="subnav" id="admin_nav">
                    <div class="pivot">&nbsp;</div>
                    <a href="#">Portal</a>
                    <a href="/admin/agency">Agency</a>
                    <a href="/admin/groups">Groups</a>
                    <a href="/admin/clients">Clients</a>
                    <a href="/admin/users">Users</a>
                    <a href="/admin/contacts">Contacts</a>
                    <a href="/admin/websites">Websites</a>
                    <a href="/admin/masterlist">Master List</a>
                    <a href="/admin/my_account">My Account</a>
                    <div class="clear"></div>
                </div>
            </li>
        </ul>
        <div id="orgInfo">
            <h4><?= get_client_type(); ?></h4>
            <h5><?= get_client_name(); ?></h5>
        </div>
        <div id="breadcrumbs">
        	<?= breadcrumb(); ?>
            <div class="clear"></div>
        </div>
        <div id="siteSearch">
            <form class="form-wrapper cf">
                <input type="text" placeholder="Search here..." required>
                <button type="submit">Search</button>
            </form>         
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
		$('li.<?= ACTIVE_BUTTON; ?>').find('a[href$="<?= SUBNAV_BUTTON; ?>"]').addClass('current');
        $('.main_nav').IconNav({
            defaultIcon:$('li.<?= ACTIVE_BUTTON; ?>')
        });
    });
</script>
<div class="clear"></div>