<!doctype html>
<html>
<head>
	<meta charset="UTF-8">    
    <title>Dealer Online Marketing | Content Manager</title>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Ubuntu:500" rel="stylesheet" type="text/css" />
    <!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="<?= base_url(); ?>Assets/<?= DOMDIR; ?>css/reset.css" type="text/css" />
    <link href="<?= base_url(); ?>Assets/<?= THEMEDIR; ?>css/login.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url(); ?>Assets/<?= DOMDIR; ?>css/validationEngine.jquery.css" type="text/css" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>Assets/<?=DOMDIR; ?>js/jquery.formvalidation-en.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>Assets/<?=DOMDIR; ?>js/jquery.formvalidation.js"></script>
</head>
<body>
    <div class="wrapper">
        <div class="logo"><h1>LOGIN</h1></div>
        <div class="lg-body">
            <div class="inner">
                <div id="lg-head">
                    <p>Login to gain access to our system</p>
                    <div class="separator"></div>
                </div>
                <div class="login">
                    <?= $form; ?>
                    
                </div>
            </div>
        </div>
    	<div id="footer">&copy; Copyright, <?= date('Y'); ?> DealerOnlineMarketing.com. All Rights Reserved.<br /><a href="#">Terms &amp; Conditions</a> | <a href="#">Privacy Policy</a> | <a href="http://www.dealeronlinemarketing.com" target="_blank">www.dealeronlinemarketing.com</a></div>     
    </div>
    <div id="popup"></div>
    <div id="warning_message"></div>
    <script type="text/javascript" src="<?= base_url(); ?>Assets/<?= DOMDIR; ?>js/login.js"></script>
</body>
</html>