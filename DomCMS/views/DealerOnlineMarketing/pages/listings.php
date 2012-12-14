<div class="wrapper content-padding">
    <div id="<?= $page_id; ?>" class="content-page">
    	<? if($msg) ?><div id="error_notification"><?= $msg; ?></div>
    	<?= $page_html; ?>
        <div class="clear"></div>
    </div>
</div>