<div class="wrapper content-padding">
    <div id="<?= $page_id; ?>" class="content-page">
    	<? if($msg) ?><div id="error_notification" class="red"><?= $msg; ?><div class="close">x</div></div>
        <h2><?= $formName; ?></h2>
		<?= $form; ?>
    </div>
</div>