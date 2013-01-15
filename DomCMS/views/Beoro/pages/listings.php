<div class="container<?= ((FLUIDLAYOUT) ? '-fluid' : ''); ?>">
    <div id="<?= $page_id; ?>" class="row-fluid">
        <div class="span12">
            <?php if($msg) { ?>
                <div id="error_notification"><?= $msg; ?></div>
            <?php } ?>
            <?= $page_html; ?>
        </div>
        <div class="clear"></div>
    </div>
</div>