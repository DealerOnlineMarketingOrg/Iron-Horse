<?php

if (!session_id()) session_start();

echo '';

require_once($_SERVER['DOCUMENT_ROOT'] . "/lib/permissions.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/acctgate.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/usergate.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/groupgate.php");


$selected = $_SESSION['c'];


if ($permNum <= '10'){
$s = $selected[0];

echo '<div id="mainContent_Body_List"><div id="mainContent_Body_List_Header_Bar">';
echo '<!-- begin form for groups -->';
echo '<div id="mainContent_Body_Form">';
echo '<form id="addNew_Website" action="javascript:addNew_Website()">';
echo '<table>';

switch($s){
	case 'g':
		echo '<tr><td align="center"><strong>Please Choose a Client Level</strong></td></tr>';
	break;
	case 'o':
		echo '<tr><td align="center"><strong>Please Choose a Client Level</strong></td></tr>';
	break;
	case 'c':
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Client&nbsp;Code</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="editWebsite_Client" disabled="disabled" value="';
		$cQuery = 'SELECT * FROM Clients WHERE C_ID ='. substr($selected,1);
		if ($cResult = mysqli_query($groupConnection, $cQuery)){
			while($clientRow = $cResult->fetch_row()){
			echo $clientRow[12];
			}
		}
		echo '" />';
		echo '<input type="hidden" id="editWebsite_Client_ID" value="';
		$cQuery = 'SELECT * FROM Clients WHERE C_ID ='. substr($selected,1);
		if ($cResult = mysqli_query($groupConnection, $cQuery)){
			while($clientRow = $cResult->fetch_row()){
			echo $clientRow[0];
			}
		}
		echo '" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">URL</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		echo '<input type="text" id="editWebsite_Url" value="" />';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Description</td>';
		echo '<td class="mainContent_Body_Form_Fields"><textarea id="editWebsite_Desc"></textarea></td>';
		echo '</tr>';
		echo '<tr><td class="mainContent_Body_Form_Labels">&nbsp;</td><td class="mainContent_Body_Form_Buttons"><table class="formTable"><tr><td class="formDisable_Td">&nbsp;</td><td class="formSubmit_Td"><input class="formSubmit" type="submit" value="SUBMIT" /></td></tr></table></td></tr>';
		echo '</table></form></div>';
								
	break;
	default:
		echo "Oops, something went wrong.";
		break;

}



echo '<div id="mainContent_Body_Cancel_Btm"><a href="javascript:websiteAdmin();">BACK</a></div><!-- end data rows section --></div>';
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