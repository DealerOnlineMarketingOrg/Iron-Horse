<div id="blackout">&nbsp;</div>
<div id="form_popup" class="popup">
	<div class="close"><a href="javascript:remove_popup("#generic_popup","fast");">X</a></div>
    <h2><?= $formName; ?></h2>
    <?= $form; ?>
    <div class="clear"></div>
</div>
<script type="text/javascript" src="<?= base_url() . 'Assets/' . THEMEDIR . 'js/popup.js'; ?>"></script>