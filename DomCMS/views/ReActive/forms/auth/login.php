<!doctype html>
<!--[if lt IE 7 ]><html class="ie ie6" dir="ltr" lang="en-US"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" dir="ltr" lang="en-US"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" dir="ltr" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html dir="ltr" lang="en-US"> <!--<![endif]-->
<head>

<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" /> 

<title><?= SITETITLE; ?></title>

<link rel="stylesheet" href="<?= base_url() . 'Assets/' . THEMEDIR; ?>/css/ui-lightness/jquery-ui-1.8.18.custom.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?= base_url() . 'Assets/' . THEMEDIR; ?>/css/validationEngine.jquery.css" type="text/css"/>
<link rel="stylesheet" href="<?= base_url() . 'Assets/' . THEMEDIR; ?>/css/icons.css" type="text/css" />
<link rel="stylesheet" href="<?= base_url() . 'Assets/' . THEMEDIR; ?>/css/forms.css" type="text/css" />
<link rel="stylesheet" href="<?= base_url() . 'Assets/' . THEMEDIR; ?>/css/tables.css" type="text/css" />
<link rel="stylesheet" href="<?= base_url() . 'Assets/' . THEMEDIR; ?>/css/ui.css" type="text/css" />
<link rel="stylesheet" href="<?= base_url() . 'Assets/' . THEMEDIR; ?>/css/template.css" type="text/css" />
<link rel="stylesheet" href="<?= base_url() . 'Assets/' . THEMEDIR; ?>/css/responsiveness.css" type="text/css" />

<!-- jQuery -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
<!-- Validation engine -->
<script type="text/javascript" src="<?= base_url() . 'Assets/' . THEMEDIR; ?>/js/languages/jquery.validationEngine-en.js" charset="utf-8"></script>
<script type="text/javascript" src="<?= base_url() . 'Assets/' . THEMEDIR; ?>/js/jquery.validationEngine.js"></script>
<!-- Knob -->
<script type="text/javascript" src="<?= base_url() . 'Assets/' . THEMEDIR; ?>/js/jquery.knob.js"></script>

<!-- Caffeine custom JS -->
<script type="text/javascript" src="<?= base_url() . 'Assets/' . THEMEDIR; ?>/js/custom.js"></script>

<!--[if IE]> <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script> <![endif]--> 
<!--[if lte IE 7]> <script src="<?= base_url() . 'Assets/' . THEMEDIR; ?>/js/IE8.js" type="text/javascript"></script> <![endif]--> 

<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery("#login_form").validationEngine();
	});
</script>

</head>

<body id="index" class="home">
    <div id="loading-block"></div> <!-- Loading block -->
    
    <section id="login-container">
        <div id="login_header"></div>
		
		<form id="login_form" action="<?= base_url(); ?>authenticate" method="post">
			<div id="login_wrapper">
				<div class="login_wrapper_container">
					<div class="float_center_box">
						
						<div class="one-half logo-box">
							<img src="<?= base_url() . 'Assets/' . THEMEDIR; ?>/imgs/Logo.png" alt="DOM">
						</div>
						
						<div class="clear"></div>
						<div class="box">
							<div class="inner">
							
								<div class="contents">
									<div class="one-half username-half">
										<label>Email Address</label>
										<div class="field-box"><span class="icon awesome user for-input"></span><input name="email" type="text" class="w-icon validate[required]"></div>
										<div class="clear"></div>
									</div>
									<div class="one-half password-half">
										<label>Password</label>
										<div class="field-box"><span class="icon awesome lock for-input"></span><input  name="password" type="password" class="w-icon validate[required]"></div>
										<div class="clear"></div>
									</div>
									
									<div class="clear"></div>
									<div class="line-separator"></div>
									
									<div class="one-half">
										<a href="<?= base_url(); ?>reset_password">Forgot your password?</a>
									</div>
									<div class="one-half right">
										<input type="submit" value="Login" class="button blue tiny">
									</div>
									
									<div class="clear"></div>
									
								</div>
								<div class="clear"></div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
		
        <div id="login_footer">
        </div>
    </section>
    
</body> 
</html>