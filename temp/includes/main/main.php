<?php 
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
echo '<!-- dialog window markup --><div id="dialog" title="Your session is about to expire!"><p>You will be logged off in <span id="timer-countdown"></span> seconds.</p><p>Do you want to continue your session?</p></div><script>/* setup the dialog */$("#dialog").dialog({autoOpen: false, modal: true, width: 400, height: 200, closeOnEscape: false, draggable: false, resizable: false, buttons: {\'Yes, Keep Working\': function(){/* Just close the dialog. We pass a reference to this button during the init of the script, so it\'ll automatically resume once clicked */$(this).dialog(\'close\');},\'No, Logoff\': function(){/* fire whatever the configured onTimeout callback is.*/ $.idleTimeout.options.onTimeout.call(this);}}});/* start the plugin */ $.idleTimeout(\'#dialog\', \'div.ui-dialog-buttonpane button:first\', { idleAfter: 1200, /* user is considered idle after this many seconds of no movement */ pollingInterval: 60, /* a request to keepalive.php (below) will be sent to the server after this many seconds */ keepAliveURL: \'./lib/keepalive.php\', serverResponseEquals: \'OK\', /* the response from keepalive.php must equal the text "OK" */ failedRequests: 10,onTimeout: function(){/* redirect the user when they timeout. */ $.get(\'./includes/login/logout.php\', function(data){window.location = \'index.php\';});},onIdle: function(){/* show the dialog when the user idles */ $(this).dialog("open");},onCountdown: function(counter){/* update the counter span inside the dialog during each second of the countdown */ $("#timer-countdown").html(counter);}, onResume: function(){/* the dialog is closed by a button in the dialog, no need to do anything else */}});</script>';
echo '<header id="topRed_Area"><div id="topRed_Bar"></div></header><!-- begin top grey area --><div id="topGrey_Background"><div id="topHeader_Wrapper">';
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/header/dropdown/dropdown.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/header/dropdown/tags.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/header/logo.php');
echo '</div></div><!-- end top grey area --><nav id="leftNavigation"><!-- begin nav area -->';

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/header/menu/navigation.php');

echo '</nav><!-- end nav area --><!-- begin top widget area -->';
echo '<section id="topWidget">';
echo '<div id="topWidget_Wrapper">';
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/main/modules/widget/widget.php');
echo '</div></section>';
echo '<!-- end top widget area --><!-- begin main wrapper --><div id="mainWrapper">';

echo '<!-- begin sidebar -->';
echo '<aside id="sidebar_Nav">';
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/main/modules/sidebar/sidebar.php');
echo '</aside>';
echo '<!-- end sidebar -->';


echo '<!-- begin main content --><section id="mainContent"><div id="mainContent_Area"><!-- begin notification area -->';
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/main/modules/notifications/notify.php');
echo '<!-- begin body top bar area --><div id="mainContent_Loc_Bar"><div id="mainContent_Loc_Bar_Icon"></div><div id="mainContent_Loc_Bar_Text">Dashboard</div><!-- JM admin tools main page --><div id="mainContent_Loc_Bar_Add"><div id="mainContent_Loc_Bar_Add_Icon"></div><div id="mainContent_Loc_Bar_Add_Text">ADD NEW</div></div></div><!-- end body top bar area --><!-- begin body top bar area --><div id="mainContent_Body"><div id="mainContent_Body_Black_Bar"></div><!-- JM future use --><!-- begin main content --><div id="mainContent_Body_Contents">';
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/main/modules/dashboard/dashboard.php');
echo '</div><!-- end main content --></div><!-- end body top bar area --></div></section><!-- end main content --></div><!-- end main wrapper -->';
?>