<?php

if (!session_id()) session_start();

echo '';

require_once($_SERVER['DOCUMENT_ROOT'] . "/lib/permissions.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/contgate.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/groupgate.php");


$selected = $_SESSION['c'];



//echo '<tr><td align="center"><strong>'.$permNum.'</strong></td></tr>';
$s = $selected[0];

echo '<div id="mainContent_Body_List"><div id="mainContent_Body_List_Header_Bar">';
echo '<!-- begin form for groups -->';
echo '<div id="mainContent_Body_Form">';
echo '<form id="addNew_Contact" action="javascript:addNew_Contact()">';
echo '<table>';

switch($s){
	case 'g':
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">First&nbsp;Name</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactFirst_Name" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Last&nbsp;Name</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactLast_Name" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Work&nbsp;Email</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactEmail_Work" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Home&nbsp;Email</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactEmail_Home" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Work&nbsp;Phone</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactPhone_Work" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Home&nbsp;Phone</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactPhone_Home" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Cell&nbsp;Phone</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactCellphone" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Fax</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactFax" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Address</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactAddress" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Address&nbsp;2</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactAddress1" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">City</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactCity" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">State</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		echo '<select id="contactState">';
		$stateQuery = 'SELECT * FROM States';
		$stateResult = mysqli_query($groupConnection, $stateQuery);
		if (@mysqli_num_rows($stateResult)){
			while ($stateRow = mysqli_fetch_row($stateResult)){
				echo '<option value="' . $stateRow[2] . '">' . $stateRow[1] . '</option>';
			}
		}		
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Zip</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactZip" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Client</td>';
		echo '<td class="mainContent_Body_Form_Fields"><select id="clientID">';
		$query = 'SELECT * FROM Organization WHERE Group_ID = ' . substr($selected, 1);
		$result = mysqli_query($groupConnection, $query);
		if (@mysqli_num_rows($result)){
			while ($oRow = mysqli_fetch_row($result)){
				$oQuery = 'SELECT * FROM Clients WHERE Org_ID = ' . $oRow[0];
				$oResult = mysqli_query($groupConnection, $oQuery);
				if (@mysqli_num_rows($oResult)){
					while ($cRow = mysqli_fetch_row($oResult)){
						echo '<option value="' . $cRow[0] . '">' . $cRow[1] . '</option>';
					}
				}
			}
		}
		echo '</select>';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Comment</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactComment" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Contact&nbsp;Type</td>';
		echo '<td class="mainContent_Body_Form_Fields"><select id="contactType">';
		$query = 'SELECT * FROM Cont_Type';
		$result = mysqli_query($contConnection, $query);
		if (@mysqli_num_rows($result)){
			while ($row = mysqli_fetch_row($result)){
				echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
			}
		}
		echo '</select>';
		echo '</tr>';
		echo '<tr><td class="mainContent_Body_Form_Labels">&nbsp;</td><td class="mainContent_Body_Form_Buttons"><table class="formTable"><tr><td class="formDisable_Td">&nbsp;</td><td class="formSubmit_Td"><input class="formSubmit" type="submit" value="SUBMIT" /></td></tr></table></td></tr>';
		break;
	case 'o':
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">First&nbsp;Name</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactFirst_Name" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Last&nbsp;Name</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactLast_Name" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Work&nbsp;Email</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactEmail_Work" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Home&nbsp;Email</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactEmail_Home" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Work&nbsp;Phone</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactPhone_Work" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Home&nbsp;Phone</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactPhone_Home" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Cell&nbsp;Phone</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactCellphone" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Fax</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactFax" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Address</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactAddress" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Address&nbsp;2</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactAddress1" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">City</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactCity" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">State</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		echo '<select id="contactState">';
		$stateQuery = 'SELECT * FROM States';
		$stateResult = mysqli_query($groupConnection, $stateQuery);
		if (@mysqli_num_rows($stateResult)){
			while ($stateRow = mysqli_fetch_row($stateResult)){
				echo '<option value="' . $stateRow[2] . '">' . $stateRow[1] . '</option>';
			}
		}		
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Zip</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactZip" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Client</td>';
		echo '<td class="mainContent_Body_Form_Fields"><select id="clientID">';
		$query = 'SELECT * FROM Clients WHERE Org_ID = ' . substr($selected, 1);
		$result = mysqli_query($groupConnection, $query);
		if (@mysqli_num_rows($result)){
			while ($cRow = mysqli_fetch_row($result)){
				echo '<option value="' . $cRow[0] . '">' . $cRow[1] . '</option>';
			}
		}
		echo '</select>';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Comment</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactComment" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Contact&nbsp;Type</td>';
		echo '<td class="mainContent_Body_Form_Fields"><select id="contactType">';
		$query = 'SELECT * FROM Cont_Type';
		$result = mysqli_query($contConnection, $query);
		if (@mysqli_num_rows($result)){
			while ($row = mysqli_fetch_row($result)){
				echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
			}
		}
		echo '</select>';
		echo '</tr>';
		echo '<tr><td class="mainContent_Body_Form_Labels">&nbsp;</td><td class="mainContent_Body_Form_Buttons"><table class="formTable"><tr><td class="formDisable_Td">&nbsp;</td><td class="formSubmit_Td"><input class="formSubmit" type="submit" value="SUBMIT" /></td></tr></table></td></tr>';
		break;
	case 'c':
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">First&nbsp;Name</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactFirst_Name" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Last&nbsp;Name</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactLast_Name" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Work&nbsp;Email</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactEmail_Work" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Home&nbsp;Email</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactEmail_Home" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Work&nbsp;Phone</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactPhone_Work" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Home&nbsp;Phone</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactPhone_Home" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Cell&nbsp;Phone</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactCellphone" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Fax</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactFax" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Address</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactAddress" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Address&nbsp;2</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactAddress1" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">City</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactCity" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">State</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		echo '<select id="contactState">';
		$stateQuery = 'SELECT * FROM States';
		$stateResult = mysqli_query($groupConnection, $stateQuery);
		if (@mysqli_num_rows($stateResult)){
			while ($stateRow = mysqli_fetch_row($stateResult)){
				echo '<option value="' . $stateRow[2] . '">' . $stateRow[1] . '</option>';
			}
		}		
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Zip</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactZip" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Client</td>';
		echo '<td class="mainContent_Body_Form_Fields"><select id="clientID" disabled="disabled">';
		$query = 'SELECT * FROM Clients WHERE C_ID = ' . substr($selected, 1);
		$result = mysqli_query($groupConnection, $query);
		if (@mysqli_num_rows($result)){
			while ($cRow = mysqli_fetch_row($result)){
				echo '<option value="' . $cRow[0] . '" selected="selected">' . $cRow[1] . '</option>';
			}
		}
		echo '</select>';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Comment</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactComment" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Contact&nbsp;Type</td>';
		echo '<td class="mainContent_Body_Form_Fields"><select id="contactType">';
		$query = 'SELECT * FROM Cont_Type';
		$result = mysqli_query($contConnection, $query);
		if (@mysqli_num_rows($result)){
			while ($row = mysqli_fetch_row($result)){
				echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
			}
		}
		else {
			echo '<option value="-">Error getting contact type</option>';
		}
		echo '</select>';
		echo '</tr>';
		echo '<tr><td class="mainContent_Body_Form_Labels">&nbsp;</td><td class="mainContent_Body_Form_Buttons"><table class="formTable"><tr><td class="formDisable_Td">&nbsp;</td><td class="formSubmit_Td"><input class="formSubmit" type="submit" value="SUBMIT" /></td></tr></table></td></tr>';
		break;
	default:
		echo "Oops, something went wrong.";
		break;

}
echo '</table></form></div><div id="mainContent_Body_Cancel_Btm"><a href="javascript:contactAdmin();">BACK</a></div><!-- end data rows section --></div>';
	$aResult->close();
	$uResult1->close();
	
	mysqli_close($acctConnection);
	mysqli_close($userConnection);
	mysqli_close($groupConnection);
/*else {
	echo '<div id="mainContent_Body_List"><div id="mainContent_Body_List_Header_Bar">';
	echo 'sorry';
	echo '</div></div>';
}*/


?>