<div id="nav">
    <div class="wrapper relative">
        <ul class="main_nav relative">
    	<?php foreach($nav as $item) { ?>
			<li class="<?= $item['Class']; ?>"><a href="<?= $item['Href']; ?>"><?= $item['Label']; ?></a>
            <?php if(count($item['Subnav']) > 0) { ?>
				<div class="subnav" id="<?= $item['Class']; ?>_nav">
                    <div class="pivot">&nbsp;</div>
                	<?php foreach($item['Subnav'] as $sub) { ?>
						<a href="<?= $sub->Href; ?>"><?= $sub->Label; ?></a>
					<?php } //end subnav foreach?>
				</div>
			<?php } //end count?>
			</li>
        <?php } //endforeach ?>
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