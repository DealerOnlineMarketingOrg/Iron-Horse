<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title><?= SITETITLE; ?></title>
    <meta name="description" content="" />
    <meta name="author" content="Dealer Online Marketing, LLC | www.dealeronlinemarketing.com" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    
    <?php
	
		echo load_default_css();
	
		if(isset($extra_css)) :
			foreach($extra_css as $css) :
				if(file_exists(FCPATH . $css->href)) :
					echo '<link rel="stylesheet" href="' . base_url() . $css->href . '" type="text/css" />' . "\n";	
				endif;
			endforeach;
		endif;
	
		echo load_default_js();
		
		if(isset($extra_js)) {
			foreach($extra_js as $js) {
				if(file_exists(FCPATH . $js->src)) :
					echo '<script type="text/javascript" src="' . base_url() . $js->src . '" charset="utf-8"></script>' . "\n";	
				endif;
			}
		}
		
		if(THEMEDIR == 'Organon') : ?>
			<script type="text/javascript">
                $(document).ready(function() {
                    $('.user-profile a, .dashboard .badge').tooltip({ placement:'top'});
					$('.brand,.navbar-search input').tooltip({placement:'bottom'});
					$('.main-navigation .badge').tooltip({placement:'right'});
                });
            </script>
		<? endif; ?>
</head>
<body>
