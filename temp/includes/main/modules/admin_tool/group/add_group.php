<?php

if (!session_id()) session_start();

echo '';

require_once($_SERVER['DOCUMENT_ROOT'] . "/lib/permissions.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/acctgate.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/usergate.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/groupgate.php");


$selected = $_SESSION['c'];



//echo '<tr><td align="center"><strong>'.$permNum.'</strong></td></tr>';
if ($permNum == '0'){
$s = $selected[0];

echo '<div id="mainContent_Body_List"><div id="mainContent_Body_List_Header_Bar">';
echo '<!-- begin form for groups -->';
echo '<div id="mainContent_Body_Form">';
echo '<form id="addNew_Group" action="javascript:addNew_Group()">';
echo '<table>';

switch($s){
	case 'g':
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Name</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="addNew_Group_Name" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Description</td>';
		echo '<td class="mainContent_Body_Form_Fields"><textarea id="addNew_Group_Desc"></textarea></td>';
		echo '</tr>';
		echo '<tr><td class="mainContent_Body_Form_Labels">&nbsp;</td><td class="mainContent_Body_Form_Buttons"><table class="formTable"><tr><td class="formDisable_Td">&nbsp;</td><td class="formSubmit_Td"><input class="formSubmit" type="submit" value="SUBMIT" /></td></tr></table></td></tr>';
		
		
		
	break;
	case 'o':
	echo '<tr><td align="center"><strong>Please Choose a Group Level</strong></td></tr>';
	break;
	case 'c':
	echo '<tr><td align="center"><strong>Please Choose a Group Level</strong></td></tr>';
	break;
	default:
		echo "Oops, something went wrong.";
		break;

}
echo '</table></form></div><div id="mainContent_Body_Cancel_Btm"><a href="javascript:groupAdmin();">BACK</a></div><!-- end data rows section --></div>';
	$aResult->close();
	$uResult1->close();
	
	mysqli_close($acctConnection);
	mysqli_close($userConnection);
	mysqli_close($groupConnection);
}
else {
	echo '<div id="mainContent_Body_List"><div id="mainContent_Body_List_Header_Bar">';
	echo 'sorry';
	echo '</div></div>';
}


?>