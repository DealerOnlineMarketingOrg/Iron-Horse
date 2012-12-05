<?php
echo '';
if (!session_id()) session_start();



require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/permissions.php');


echo '<div id="sidebar_Nav_Area">';
echo '<div id="sidebar_Nav_Box">';
echo '<h3>ADMIN TOOLS</h3>';
echo '<div>';
echo '<ul>';
if ($permNum < 10){
	echo '<li><a href="javascript:groupAdmin();">ORGANIZATIONS</a></li>';
}
if ($permNum < 20){
	echo '<li><a href="javascript:orgAdmin();">GROUPS</a></li>';
}
if ($permNum < 30){
	echo '<li><a href="javascript:adminTools();">CLIENTS</a></li>';
}
echo '<li><a href="javascript:selectClient_Users(\'' . $_SESSION['c'] .'\');">USERS</a></li>';
echo '<li><a href="javascript:contactAdmin();">CONTACTS</a></li>';
echo '<li><a href="javascript:websiteAdmin();">WEBSITES</a></li>';
echo '</ul>';
echo '</div>';
if ($permNum < 20){
	echo '<h3>CONTENT MANAGER</h3>';
	echo '<div>';
	echo '<ul>';
	echo '<li>ADD NEW PAGE</li>';
	echo '<li>EDIT PAGE</li>';
	echo '<li>LIST CURRENT PAGES</li>';
	echo '</ul>';
	echo '</div>';
}
echo '<h3>DMS DATABASE</h3>';
echo '<div>';
echo '<ul>';
echo '<li>DMS</li>';
echo '<li>CUSTOM REPORT</li>';
echo '</ul>';
echo '</div>';
echo '<h3>MERCHANDISING</h3>';
echo '<div>';
echo '<ul>';
echo '<li>NEW CAR SPECIALS</li>';
echo '<li>USED CAR SPECIALS</li>';
echo '<li>SERVICE SPECIALS</li>';
echo '<li>PARTS SPECIALS</li>';
echo '<li>BODY SHOP SPECIALS</li>';
echo '</ul>';
echo '</div>';
echo '<h3>MEDIA</h3>';
echo '<div>';
echo '<ul>';
echo '<li>ASSETS</li>';
echo '<li>LOGOS</li>';
echo '<li>VIDEOS</li>';
echo '<li>AUDIO</li>';
echo '</ul>';
echo '</div>';
echo '<h3>CREATIVE</h3>';
echo '<div>';
echo '<ul>';
echo '<li>E-BLASTS</li>';
echo '<li>NEWSLETTERS</li>';
echo '<li>CRM TEMPLATES</li>';
echo '</ul>';
echo '</div>';
echo '<h3>REPORTS</h3>';
echo '<div>';
echo '<ul>';
echo '<li>DPR</li>';
echo '</ul>';
echo '</div>';
echo '</div>';
echo '</div>';
?>