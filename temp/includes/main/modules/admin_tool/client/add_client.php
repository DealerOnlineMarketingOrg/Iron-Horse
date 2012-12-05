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
echo '<form id="addNew_Client" action="javascript:addNew_Client()">';
echo '<table>';

switch($s){
	case 'g':
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Name</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		echo '<input type="text" id="clientName" value="" />';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Address</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		echo '<input type="text" id="clientAddress" value="" />';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Address1</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		echo '<input type="text" id="clientAddress1" value="" />';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">City</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		echo '<input type="text" id="clientCity" value="" />';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">State</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		echo '<select id="clientState" >';
		$stateQuery = 'SELECT * FROM States';
		$stateResult = mysqli_query($groupConnection, $stateQuery);
		if (@mysqli_num_rows($stateResult)){
			while ($stateRow = mysqli_fetch_row($stateResult)){
				echo '<option value="' . $stateRow[2] . '">' . $stateRow[1] . '</option>';
			}
		}
		echo '</select>';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Zip</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		echo '<input type="text" id="clientZip" value="" />';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Phone Sales</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		echo '<input type="text" id="clientPhone_Sales" value="" />';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Phone Service</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		echo '<input type="text" id="clientPhone_Service" value="" />';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Notes</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		echo '<textarea id="clientComment"></textarea>';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Client&nbsp;Code</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		echo '<input type="text" id="clientCode" value="" />';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Member&nbsp;Of:</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		echo '<input type="hidden" id="clientUrl" value=""/>';
		echo '<input type="hidden" id="clientUrl1" value=""/>';
		
		echo '<select id="orgID">';	
			$oquery1 = 'SELECT * FROM Organization WHERE Group_ID = '.substr ($selected,1);
			if ($oresult1 = mysqli_query($groupConnection, $oquery1)){
				while($orgRow = $oresult1->fetch_row()){
					echo '<option value="'.$orgRow[0].'">'.$orgRow[1].'</option>';
				}
			}
		echo '</select>';			
		
		echo '</td>';
		echo '</tr>';
		echo '<tr><td class="mainContent_Body_Form_Labels">&nbsp;</td><td class="mainContent_Body_Form_Buttons"><table class="formTable"><tr><td class="formDisable_Td">&nbsp;</td><td class="formSubmit_Td"><input class="formSubmit" type="submit" value="SUBMIT" /></td></tr></table></td></tr>';
		echo '</table></form></div>';	
		
		
		
	break;
	
	
	case 'o':
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Name</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		echo '<input type="text" id="clientName" value="" />';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Address</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		echo '<input type="text" id="clientAddress" value="" />';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Address1</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		echo '<input type="text" id="clientAddress1" value="" />';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">City</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		echo '<input type="text" id="clientCity" value="" />';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">State</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		echo '<select id="clientState" >';
		$stateQuery = 'SELECT * FROM States';
		$stateResult = mysqli_query($groupConnection, $stateQuery);
		if (@mysqli_num_rows($stateResult)){
			while ($stateRow = mysqli_fetch_row($stateResult)){
				echo '<option value="' . $stateRow[2] . '">' . $stateRow[1] . '</option>';
			}
		}
		echo '</select>';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Zip</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		echo '<input type="text" id="clientZip" value="" />';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Phone Sales</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		echo '<input type="text" id="clientPhone_Sales" value="" />';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Phone Service</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		echo '<input type="text" id="clientPhone_Service" value="" />';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Notes</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		echo '<textarea id="clientComment"></textarea>';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Client&nbsp;Code</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		echo '<input type="text" id="clientCode" value="" />';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Member&nbsp;Of:</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		echo '<input type="hidden" id="clientUrl" value=""/>';
		echo '<input type="hidden" id="clientUrl1" value=""/>';
		
		echo '<select id="orgID">';	
			$oquery1 = 'SELECT * FROM Organization WHERE Org_ID = '.substr ($selected,1);
			if ($oresult1 = mysqli_query($groupConnection, $oquery1)){
				while($orgRow = $oresult1->fetch_row()){
					echo '<option value="'.$orgRow[0].'">'.$orgRow[1].'</option>';
				}
			}
		echo '</select>';			
		
		echo '</td>';
		echo '</tr>';
		echo '<tr><td class="mainContent_Body_Form_Labels">&nbsp;</td><td class="mainContent_Body_Form_Buttons"><table class="formTable"><tr><td class="formDisable_Td">&nbsp;</td><td class="formSubmit_Td"><input class="formSubmit" type="submit" value="SUBMIT" /></td></tr></table></td></tr>';
		echo '</table></form></div>';

	break;
	case 'c':
		echo '<tr><td align="center"><strong>Please See System Administrator.</strong></td></tr>';		
	break;
	default:
		echo "Oops, something went wrong.";
		break;


}


echo '<div id="mainContent_Body_Cancel_Btm"><a href="javascript:clientAdmin();">BACK</a></div><!-- end data rows section --></div>';
	$aResult->close();
	$uResult1->close();
	
	mysqli_close($acctConnection);
	mysqli_close($userConnection);
	mysqli_close($groupConnection);
}
else {
	echo '<div id="mainContent_Body_List"><div id="mainContent_Body_List_Header_Bar">';
	echo '<strong>Please See System Administrator.</strong>';
	echo '</div></div>';
}
?>