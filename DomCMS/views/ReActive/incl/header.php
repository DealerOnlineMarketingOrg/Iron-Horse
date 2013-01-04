<!-- Header -->
<header id="header">
    <figure id="logo"><a href="#" class="logo"></a></figure>
    <? if(USERNAVIGATION) : ?>
    <section id="general-options">
        <?= ((ACCOUNT) ? '<a href="#" class="users tipsy-header" title="My Account"></a>' : ''); ?>
        <?= ((BOOKMARKS) ? '<a href="#" class="bookmark tipsy-header" title="My Bookmarks"></a>' : ''); ?>
        <?= ((SETTINGS) ? '<a href="#" class="settings tipsy-header" title="My Settings"></a>' : ''); ?>
        <?= ((PRIVACY) ? '<a href="#" class="privacy tipsy-header" title="Privacy"></a>' : ''); ?>
        <?= ((APPROVALS) ? '<a href="#" class="approval tipsy-header" title="Approval Queue"><span class="badge" title="You have 7 new Approvals waiting">7</span></a>' : ''); ?>
        <?= ((MESSAGES) ? '<a href="#" class="messages tipsy-header" title="My Messages"></a>' : ''); ?>
    </section>
    <? endif; ?>
    <? 
	
	/* ENABLED OR DISABLED FEATURES */
	if(DROPDOWNS) { ?>
        
        <!-- TAGS -->
        <section id="dropdowns" class="dropdown">
        <? if(CLIENTFILTER) { ?>
            <div class="client">
                <select id="client_dd" data-placeholder="Select a Agency, Group or Client" class="chzn-select" style="width:100%;">
                    <option value="0">Dealer Online Marketing</option>
                    <option value="1">DDI</option>
                </select>
            </div>
        <? } if(TAGFILTER) { ?>
        	<div class="tags">
                <select id="tags_dd" data-placeholder="Select Team" class="chzn-select" style="width:100%;">
                    <option value="0">Green Team</option>
                    <option value="1">Red Team</option>
                    <option value="2">Purple Team</option>
                </select>
            </div>
        <? } ?>
        </section>
        
        
    <? } ?>
    <section id="responsive-nav">
        <select id="nav_select">
            <option value="">Navigate</option>
            <option value="#" selected="selected">Dashboard</option>
            <option value="#">Reports</option>
            <option value="#">Advertising</option>
            <option value="#">Creative</option>
            <option value="#">Content</option>
            <option value="#">Merchandising</option>
            <option value="#">Reputation/Social</option>
            <option value="#">Admin</option>
        </select>
    </section>
    <a class="navbar-logout" href="<?= base_url(); ?>logout"><span class="icon awesome off"></span><br />Logout</a>
</header> 
<!-- /Header -->
<div class="clear"></div>