<!-- Sidebar -->
<nav id="sidebar">
    <div class="sidebar-top"></div>
    <!-- Nav menu -->
    <ul class="nav">
        <li class="active"><a href="<?= base_url(); ?>">Dashboard</a></li>
        <?php foreach($nav as $item) { ?>
        <li class="<?= $item['Class']; ?>"><a href="<?= $item['Href']; ?>"><?= $item['Label']; ?></a>
        <?php if(count($item['Subnav']) > 0) { ?>
            <ul class="submenu">
                <?php foreach($item['Subnav'] as $sub) { ?>
                    <li><a href="<?= $sub->Href; ?>"><?= $sub->Label; ?></a></li>
                <?php } //end subnav foreach?>
            </ul>
        <?php } //end count?>
        </li>
    <?php } //endforeach ?>
    </ul>
    <!-- /Nav menu -->
    <div class="blocks-separator"></div>
    <div class="clear"></div>
</nav> 
<!-- Sidebar -->
<script type="text/javascript">
	$(document).ready(function() {
		var $active = '<?= ACTIVE_BUTTON; ?>';
		$('ul.nav').children().each(function() {
			if($(this).hasClass('active')) {
				$(this).removeClass('active');	
			}
			if($(this).hasClass(active) {
				$('ul.nav li').removeClass('active');
				$('ul.nav').find('.'+$active).addClass('active');	
			}
		});
	});
</script>