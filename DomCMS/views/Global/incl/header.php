<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= SITETITLE; ?></title>
    <link href="http://fonts.googleapis.com/css?family=Ubuntu|Open+Sans" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?= base_url(); ?>Assets/<?= DOMDIR; ?>css/global.css" type="text/css" />
    <link rel="stylesheet" href="<?= base_url(); ?>Assets/<?= THEMEDIR; ?>css/template.css" type="text/css" />
    <link rel="stylesheet" href="<?= base_url(); ?>Assets/<?= DOMDIR; ?>css/select2.css" type="text/css" />
    <link rel="stylesheet" href="<?= base_url(); ?>Assets/<?= DOMDIR; ?>css/validationEngine.jquery.css" type="text/css" />
    <?php 
		if(isset($extra_css)) {
			foreach($extra_css as $css) {
				echo '<link rel="stylesheet" href="' . $css->href . '" type="text/css" />' . "\n";	
			}
		}
	?>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>Assets/<?= DOMDIR; ?>js/select2.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>Assets/<?= DOMDIR; ?>js/plugin.iconNav.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>Assets/<?=DOMDIR; ?>js/jquery.formvalidation-en.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?= base_url(); ?>Assets/<?=DOMDIR; ?>js/jquery.formvalidation.js" charset="utf-8"></script>
    <?php
		if(isset($extra_js)) {
			foreach($extra_js as $js) {
				echo '<script type="text/javascript" src="' . $js->src . '" charset="utf-8"></script>' . "\n";	
			}
		}
	?>
</head>
<body>
