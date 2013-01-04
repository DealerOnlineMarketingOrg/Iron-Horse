<div id="<?= $page_id; ?>" class="full-width">
	<div class="box no-bg">
		<?php if($msg) { ?>
            <div id="error_notification"><?= $msg; ?></div>
        <?php } ?>
		<?= $page_html; ?>
    </div>
    <div class="clear"></div>
</div>