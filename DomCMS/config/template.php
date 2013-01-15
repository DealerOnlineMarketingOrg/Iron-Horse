<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Switch templates by changing these parameters.
$config['ThemeName'] = 'ItsBrain';
/*
	Since were using codeigniter the css and html need to be split up into different areas.
	All images, css and jscript files are located in the Assets/themes folders
	All html files are located in the DomCMS/views/themes folder.
	To include files accross all templates, you can use the Global folder to do this.
*/
$config['ThemeDir'] = 'themes/ItsBrain';
$config['GlobalDir'] = 'themes/Global';

//Default <title> tag
$config['Title'] = 'Dealer Online Marketing | Content Manager';
$config['CompanyName'] = 'Dealer Online Marketing';
$config['AppName'] = 'DomCMS';
$config['Logo'] = 'imgs/login_logo.png';
$config['AppVersion'] = 'Beta 0.2';
$config['GapiEmail'] = '';
$config['GapiPass'] = '';
$config['GoogleFonts'] = array('Cuprum','Open+Sans+Condensed:300','Open+Sans');

//Coding prefrences
$config['DocType'] = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
$config['Xmlns'] = 'http://www.w3.org/1999/xhtml';

//Meta tags stored in array for easily writing out with loop
$config['MetaTags'] = array(
	'ViewPort' => array(
		'name' 			=> 'viewport',
		'content' 		=> 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0',
	),'Http-Equiv' => array(
		'http-equiv' 	=> 'Content-Type',
		'content' 		=> 'text/html; charset=utf-8'
	)
);

//These are the files being included in the template. If we change themes, we can just change these values instead of changing and maintaining several different headers.
$config['Files'] = array(

	//this is an array that includes arrays. you would access this like $template['Files']['css'][0]['href'];
	'css' => array( 
		array('href' => '/css/reset.css'			,'screen' => 'all'),
		array('href' => '/css/dataTable.css'		,'screen' => 'screen,tv,projector'),
		array('href' => '/css/ui_custom.css'		,'screen' => 'all'),
		array('href' => '/css/fullcalendar.css'		,'screen' => 'all'),
		array('href' => '/css/icons.css'			,'screen' => 'screen,tv,projector,handheld'),
		array('href' => '/css/elfinder.css'			,'screen' => 'screen,tv,projector'),
		array('href' => '/css/wysiwyg.css'			,'screen' => 'screen,tv,projector,handheld'),
		array('href' => '/css/prettyPhoto.css'		,'screen' => 'screen,tv,projector')
	 ),
	 
	 //this is an array that includes arrays. you would access this like $template['Files']['js'][0]['src'];
	 'js' => array( 
		array('src' => 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js'),
		array('src' => '/js/plugins/spinner/jquery.mousewheel.js'),
		array('src' => 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js'),
		array('src'	=> '/js/plugins/spinner/ui.spinner.js'),
		array('src'	=> '/js/plugins/wysiwyg/jquery.wysiwyg.js'),
		array('src'	=> '/js/plugins/wysiwyg/wysiwyg.image.js'),
		array('src'	=> '/js/plugins/wysiwyg/wysiwyg.link.js'),
		array('src'	=> '/js/plugins/wysiwyg/wysiwyg.table.js'),
		array('src'	=> '/js/plugins/flot/jquery.flot.js'),
		array('src'	=> '/js/plugins/flot/jquery.flot.orderBars.js'),
		array('src'	=> '/js/plugins/flot/jquery.flot.pie.js'),
		array('src'	=> '/js/plugins/flot/jquery.flot.resize.js'),
		array('src'	=> '/js/plugins/tables/jquery.dataTables.js'),
		array('src'	=> '/js/plugins/tables/colResizable.min.js'),
		array('src'	=> '/js/plugins/forms/forms.js'),
		array('src'	=> '/js/plugins/forms/autogrowtextarea.js'),
		array('src'	=> '/js/plugins/forms/autotab.js'),
		array('src'	=> "/js/plugins/forms/autotab.js"),
		array('src'	=> "/js/plugins/forms/jquery.validationEngine-en.js"),
		array('src'	=> "/js/plugins/forms/jquery.validationEngine.js"),
		array('src'	=> "/js/plugins/forms/jquery.dualListBox.js"),
		array('src'	=> "/js/plugins/forms/chosen.jquery.min.js"),
		array('src'	=> "/js/plugins/forms/jquery.maskedinput.min.js"),
		array('src'	=> "/js/plugins/forms/jquery.inputlimiter.min.js"),
		array('src'	=> "/js/plugins/forms/jquery.tagsinput.min.js"),
		array('src'	=> "/js/plugins/other/calendar.min.js"),
		array('src'	=> "/js/plugins/other/elfinder.min.js"),
		array('src'	=> "/js/plugins/uploader/plupload.js"),
		array('src'	=> "/js/plugins/uploader/plupload.html5.js"),
		array('src'	=> "/js/plugins/uploader/plupload.html4.js"),
		array('src'	=> "/js/plugins/uploader/jquery.plupload.queue.js"),
		array('src'	=> "/js/plugins/ui/jquery.progress.js"),
		array('src'	=> "/js/plugins/ui/jquery.jgrowl.js"),
		array('src'	=> "/js/plugins/ui/jquery.tipsy.js"),
		array('src'	=> "/js/plugins/ui/jquery.alerts.js"),
		array('src'	=> "/js/plugins/ui/jquery.colorpicker.js"),
		array('src'	=> "/js/plugins/wizards/jquery.form.wizard.js"),
		array('src'	=> "/js/plugins/wizards/jquery.validate.js"),
		array('src'	=> "/js/plugins/ui/jquery.breadcrumbs.js"),
		array('src'	=> "/js/plugins/ui/jquery.collapsible.min.js"),
		array('src'	=> "/js/plugins/ui/jquery.ToTop.js"),
		array('src'	=> "/js/plugins/ui/jquery.listnav.js"),
		array('src'	=> "/js/plugins/ui/jquery.sourcerer.js"),
		array('src'	=> "/js/plugins/ui/jquery.timeentry.min.js"),
		array('src'	=> "/js/plugins/ui/jquery.prettyPhoto.js"),
		array('src'	=> "/js/custom.js"),
		array('src'	=> "/js/charts/chart.js")
	)
);

