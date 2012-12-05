<?php
if (!session_id()) session_start();
echo '';
require_once($_SERVER['DOCUMENT_ROOT'] . "/lib/permissions.php");
echo '<div id="topNav_Wrapper"><div id="topNav_Area"><ul id="topNav_Ul">';

if (isset($_SESSION['c'])){
	$selected = $_SESSION['c'];
}
echo '<li id="topNav_Li">';
if ($permissionLevel[0] == "1"){
	echo '<a id="dashboard_Link" class="selected" href="javascript:dashboard();">DASHBOARD</a></li>';
}
else {
	echo 'DASHBOARD</li>';
}
echo '<li id="topNav_Bars">|</li>';
echo '<li id="topNav_Li">';
if ($permissionLevel[5] == "1"){
	echo '<a id="adminTools_Link" class="" href="javascript:adminTools();">ADMIN TOOLS</a></li>';
	/*if ($permissionLevel[6] == "1" || $permissionLevel[7] == "1" || $permissionLevel[8] == "1" || $permissionLevel[9] == "1" || $permissionLevel[10] == "1"){
		echo '<ul class="subuls">';
		if ($permissionLevel[6] == "1"){
			if ($selected[0] == 'g'){
				echo '<li><a href="javascript:groupAdmin()">Group Administration</a></li>';
			}
		}
		if ($permissionLevel[7] == "1"){
			if ($selected[0] == 'o' || $selected[0] == 'g'){
				echo '<li><a href="javascript:orgAdmin()">Organization Administration</a></li>';
			}
		}
		if ($permissionLevel[8] == "1"){
			if ($selected[0] == 'c' || $selected[0] == 'o' || $selected[0] == 'g'){
				echo '<li><a href="javascript:clientAdmin()">Client Administration</a></li>';
			}
		}
		if ($permissionLevel[9] == "1"){
			echo '<li><a href="javascript:userAdmin()">User Administration</a></li>';
		}
		echo '</ul>';
	}
	echo '</li>';*/
}
else {
	echo 'ADMIN TOOLS</li>';
}
echo '<li id="topNav_Bars">|</li>';
echo '<li id="topNav_Li">';
if ($permissionLevel[12] == "1"){
	//if ($selected[0] != 'g' && $selected[0] != 'o'){
		echo '<a id="contentManager_Link" class="" href="javascript:contentManager();">CONTENT MANAGER</a></li>';
		/*echo '<ul class="subuls">';
		echo '<li><a href="javascript:addContent()">Add Content</a></li>';
		echo '<li><a href="javascript:selectContent()">Edit Content</a></li>';
		echo '</ul></li>';*/
	//}
}
else {
	echo 'CONTENT MANAGER</li>';
}
echo '<li id="topNav_Bars">|</li>';
echo '<li id="topNav_Li">';
if ($permissionLevel[11] == "1"){
	echo '<a id="dmsDatabase_Link" class="disableLink" href="javascript:dmsDatabase();">DMS DATABASE</a></li>';
}
else {
	echo 'DMS DATABASE</li>';
}
echo '<li id="topNav_Bars">|</li>';
echo '<li id="topNav_Li">';
if ($permissionLevel[11] == "1"){
	echo '<a id="merchandising_Link" class="disableLink" href="javascript:merchandising();">MERCHANDISING</a></li>';
}
else {
	echo 'MERCHANDISING</li>';
}
echo '<li id="topNav_Bars">|</li>';
echo '<li id="topNav_Li">';
if ($permissionLevel[1] == "1"){
	echo '<a id="media_Link" class="disableLink" href="javascript:media();">MEDIA</a></li>';
	//echo '<ul class="subuls">';
	//echo '<li><a href="#">New Car</a></li>';
	//echo '<li><a href="#">Used Car</a></li>';
	//echo '<li><a href="#">Service</a></li>';
	//echo '<li><a href="#">Parts</a></li>';
	//echo '<li><a href="#">Body Shop</a></li>';
	//echo '</ul>';
	//echo '</li>';
}
else {
	echo 'MEDIA</li>';
}
echo '<li id="topNav_Bars">|</li>';
echo '<li id="topNav_Li">';
if ($permissionLevel[2] == "1"){
	echo '<a id="outbound_Link" class="disableLink" href="javascript:outbound();">OUTBOUND</a></li>';
	if ($permissionLevel[3] == "1" || $permissionLevel[4] == "1"){
		//echo '<ul class="subuls">';
		if ($permissionLevel[3] == "1"){
			//echo '<li><a href="#">Keyword Tool</a></li>';
		}
		if ($permissionLevel[4] == "1"){
			//echo '<li><a href="#">SEM Builder</a></li>';
		}
		//echo '</ul>';
	}
	//echo '</li>';
}
else {
	echo 'OUTBOUND</li>';
}
echo '<li id="topNav_Bars">|</li>';
echo '<li id="topNav_Li">';
if ($permissionLevel[19] == "1"){
	echo '<a id="reports_Link" class="disableLink" href="javascript:reports();">REPORTS</a></li>';
	//echo '<ul class="subuls">';
	//echo '<li><a href="#">DPR</a></li>';
	//echo '</ul>';
	//echo '</li>';
}
else {
	echo 'REPORTS</li>';
}
echo '</ul></div><div id="topNav_FooterFade"></div></div>';
?>