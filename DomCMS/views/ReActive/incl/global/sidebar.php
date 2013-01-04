<!-- Sidebar -->
<nav id="sidebar">
    <div class="sidebar-top"></div>
    <!-- Nav menu -->
    <ul class="nav">
        <li <?= ((ACTIVE_BUTTON == 'reports' && SUBNAV_BUTTON == '/reports/dashboard') ? 'class="active"' : ''); ?>><a href="<?= base_url(); ?>reports/dashboard">Dashboard</a></li>
        <?php foreach($nav as $item) { ?>
        <li class="<?= $item['Class']; ?> <?= ((ACTIVE_BUTTON == $item['Class'] && SUBNAV_BUTTON != '/reports/dashboard') ? 'active' : ''); ?>"><a href="<?= $item['Href']; ?>"><?= $item['Label']; ?></a>
        <?php if(count($item['Subnav']) > 0) { ?>
            <ul class="submenu">
                <?php foreach($item['Subnav'] as $sub) { ?>
                    <li <?= ((SUBNAV_BUTTON == $sub->Href) ? 'class="current"' : ''); ?>><a href="<?= $sub->Href; ?>"><?= $sub->Label; ?></a></li>
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
