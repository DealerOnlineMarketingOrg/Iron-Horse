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
echo '<form id="editThis_Contact" action="javascript:editThis_Contact()">';
echo '<table>';
	
switch($s){
	case 'g':
	
	if(isset($_POST['contactID'])){
		$contQuery = 'SELECT * FROM Contacts WHERE Contact_ID = ' . $_POST['contactID'];
		if ($contResult = mysqli_query($contConnection, $contQuery)){
			while($contRow = $contResult->fetch_row()){
				$Contact_ID = $contRow[0];
				$FirstName = $contRow[1];
				$LastName = $contRow[2];
				$EmailWork = $contRow[3];
				$EmailHome = $contRow[4];
				$PhoneWork = $contRow[5];
				$PhoneHome = $contRow[6];
				$CellPhone = $contRow[7];
				$FaxPhone = $contRow[8];
				$Address = $contRow[9];
				$Address1 = $contRow[10];
				$City = $contRow[11];
				$State = $contRow[12];
				$Zip = $contRow[13];
				$Type = $contRow[14];
				$Comments = $contRow[15];
				$CID = $contRow[16];
				$VID = $contRow[17];
				
		echo '<input type="hidden" id="contactID" value="'.$Contact_ID.'" />';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">First&nbsp;Name</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactFirst_Name" value="'.$FirstName.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Last&nbsp;Name</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactLast_Name" value="'.$LastName.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Work&nbsp;Email</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactEmail_Work" value="'.$EmailWork.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Home&nbsp;Email</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactEmail_Home" value="'.$EmailHome.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Work&nbsp;Phone</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactPhone_Work" value="'.$PhoneWork.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Home&nbsp;Phone</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactPhone_Home" value="'.$PhoneHome.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Cell&nbsp;Phone</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactCellphone" value="'.$CellPhone.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Fax</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactFax" value="'.$FaxPhone.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Address</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactAddress" value="'.$Address.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Address&nbsp;2</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactAddress1" value="'.$Address1.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">City</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactCity" value="'.$City.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">State</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		
		echo '<select id="contactState">';
		$stateQuery = 'SELECT * FROM States';
		$stateResult = mysqli_query($groupConnection, $stateQuery);
		if (@mysqli_num_rows($stateResult)){
			while ($stateRow = mysqli_fetch_row($stateResult)){
				$specialstate = '';
				if ($State == $stateRow[2]){
					$specialstate = 'selected="selected"';
				}
				else {
					$specialstate = '';
				}
				echo '<option '. $specialstate .' value="' . $stateRow[2] . '">' . $stateRow[1] . '</option>';
			}
		}		
		echo '</select>';
		
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Zip</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactZip" value="'.$Zip.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Client</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		
		echo '<select id="clientID">';
		$query = 'SELECT * FROM Organization WHERE Group_ID = ' . substr($selected, 1);
		$result = mysqli_query($groupConnection, $query);
		if (@mysqli_num_rows($result)){
			while ($oRow = mysqli_fetch_row($result)){
				$oQuery = 'SELECT * FROM Clients WHERE Org_ID = ' . $oRow[0];
				$oResult = mysqli_query($groupConnection, $oQuery);
				if (@mysqli_num_rows($oResult)){
					while ($cRow = mysqli_fetch_row($oResult)){
						$specialorg = '';
						if ($CID == $cRow[0]){
							$specialorg = 'selected="selected"';
						}
						else {
							$specialorg = '';
						}
						echo '<option '. $specialorg .' value="' . $cRow[0] . '">' . $cRow[1] . '</option>';
					}
				}
			}
		}
		echo '</select>';
		
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Comment</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactComment" value="'.$Comments.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Contact&nbsp;Type</td>';
		echo '<td class="mainContent_Body_Form_Fields"><select id="contactType">';
		$query = 'SELECT * FROM Cont_Type';
		$result = mysqli_query($contConnection, $query);
		if (@mysqli_num_rows($result)){
			while ($row = mysqli_fetch_row($result)){
				$specialtype = '';
				if ($Type == $row[0]){
					$specialtype = 'selected="selected"';
				}
				else {
					$specialtype = '';
				}
				echo '<option '. $specialtype .' value="' . $row[0] . '">' . $row[1] . '</option>';
			}
		}
		echo '</select>';
		echo '</tr>';
		echo '<tr><td class="mainContent_Body_Form_Labels">&nbsp;</td><td class="mainContent_Body_Form_Buttons"><table class="formTable"><tr><td class="formDisable_Td">&nbsp;</td><td class="formSubmit_Td"><input class="formSubmit" type="submit" value="SUBMIT" /></td></tr></table></td></tr>';
			}
		}
	}
	
		break;
	case 'o':
		if(isset($_POST['contactID'])){
		$contQuery = 'SELECT * FROM Contacts WHERE Contact_ID = '.$_POST['contactID'];
		if ($contResult = mysqli_query($contConnection, $contQuery)){
			while($contRow = $contResult->fetch_row()){
				$Contact_ID = $contRow[0];
				$FirstName = $contRow[1];
				$LastName = $contRow[2];
				$EmailWork = $contRow[3];
				$EmailHome = $contRow[4];
				$PhoneWork = $contRow[5];
				$PhoneHome = $contRow[6];
				$CellPhone = $contRow[7];
				$FaxPhone = $contRow[8];
				$Address = $contRow[9];
				$Address1 = $contRow[10];
				$City = $contRow[11];
				$State = $contRow[12];
				$Zip = $contRow[13];
				$Type = $contRow[14];
				$Comments = $contRow[15];
				$CID = $contRow[16];
				$VID = $contRow[17];
				
		echo '<input type="hidden" id="contactID" value="'.$Contact_ID.'" />';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">First&nbsp;Name</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactFirst_Name" value="'.$FirstName.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Last&nbsp;Name</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactLast_Name" value="'.$LastName.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Work&nbsp;Email</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactEmail_Work" value="'.$EmailWork.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Home&nbsp;Email</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactEmail_Home" value="'.$EmailHome.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Work&nbsp;Phone</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactPhone_Work" value="'.$PhoneWork.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Home&nbsp;Phone</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactPhone_Home" value="'.$PhoneHome.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Cell&nbsp;Phone</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactCellphone" value="'.$CellPhone.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Fax</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactFax" value="'.$FaxPhone.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Address</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactAddress" value="'.$Address.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Address&nbsp;2</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactAddress1" value="'.$Address1.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">City</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactCity" value="'.$City.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">State</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		
		echo '<select id="contactState">';
		$stateQuery = 'SELECT * FROM States';
		$stateResult = mysqli_query($groupConnection, $stateQuery);
		if (@mysqli_num_rows($stateResult)){
			while ($stateRow = mysqli_fetch_row($stateResult)){
				$specialstate = '';
				if ($State == $stateRow[2]){
					$specialstate = 'selected="selected"';
				}
				else {
					$specialstate = '';
				}
				echo '<option '. $specialstate .' value="' . $stateRow[2] . '">' . $stateRow[1] . '</option>';
			}
		}		
		echo '</select>';
		
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Zip</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactZip" value="'.$Zip.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Client</td>';
		echo '<td class="mainContent_Body_Form_Fields"><select id="clientID">';
		$query = 'SELECT * FROM Clients WHERE Org_ID = ' . substr($selected, 1);
		$result = mysqli_query($groupConnection, $query);
		if (@mysqli_num_rows($result)){
			while ($cRow = mysqli_fetch_row($result)){
				$specialorg = '';
				if ($CID == $cRow[0]){
					$specialorg = 'selected="selected"';
				}
				else {
					$specialorg = '';
				}
				echo '<option '. $specialorg .' value="' . $cRow[0] . '">' . $cRow[1] . '</option>';
			}
		}
		echo '</select>';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Comment</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactComment" value="'.$Comments.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Contact&nbsp;Type</td>';
		echo '<td class="mainContent_Body_Form_Fields"><select id="contactType">';
		$query = 'SELECT * FROM Cont_Type';
		$result = mysqli_query($contConnection, $query);
		if (@mysqli_num_rows($result)){
			while ($row = mysqli_fetch_row($result)){
				$specialtype = '';
				if ($Type == $row[0]){
					$specialtype = 'selected="selected"';
				}
				else {
					$specialtype = '';
				}
				echo '<option '. $specialtype .' value="' . $row[0] . '">' . $row[1] . '</option>';
			}
		}
		echo '</select>';
		echo '</tr>';
		echo '<tr><td class="mainContent_Body_Form_Labels">&nbsp;</td><td class="mainContent_Body_Form_Buttons"><table class="formTable"><tr><td class="formDisable_Td">&nbsp;</td><td class="formSubmit_Td"><input class="formSubmit" type="submit" value="SUBMIT" /></td></tr></table></td></tr>';
			}
		}
		}
		break;
	case 'c':
		if(isset($_POST['contactID'])){
		$contQuery = 'SELECT * FROM Contacts WHERE Contact_ID = '.$_POST['contactID'];
		if ($contResult = mysqli_query($contConnection, $contQuery)){
			while($contRow = $contResult->fetch_row()){
				$Contact_ID = $contRow[0];
				$FirstName = $contRow[1];
				$LastName = $contRow[2];
				$EmailWork = $contRow[3];
				$EmailHome = $contRow[4];
				$PhoneWork = $contRow[5];
				$PhoneHome = $contRow[6];
				$CellPhone = $contRow[7];
				$FaxPhone = $contRow[8];
				$Address = $contRow[9];
				$Address1 = $contRow[10];
				$City = $contRow[11];
				$State = $contRow[12];
				$Zip = $contRow[13];
				$Type = $contRow[14];
				$Comments = $contRow[15];
				$CID = $contRow[16];
				$VID = $contRow[17];
				
		echo '<input type="hidden" id="contactID" value="'.$Contact_ID.'" />';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">First&nbsp;Name</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactFirst_Name" value="'.$FirstName.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Last&nbsp;Name</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactLast_Name" value="'.$LastName.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Work&nbsp;Email</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactEmail_Work" value="'.$EmailWork.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Home&nbsp;Email</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactEmail_Home" value="'.$EmailHome.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Work&nbsp;Phone</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactPhone_Work" value="'.$PhoneWork.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Home&nbsp;Phone</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactPhone_Home" value="'.$PhoneHome.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Cell&nbsp;Phone</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactCellphone" value="'.$CellPhone.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Fax</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactFax" value="'.$FaxPhone.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Address</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactAddress" value="'.$Address.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Address&nbsp;2</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactAddress1" value="'.$Address1.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">City</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactCity" value="'.$City.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">State</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		
		echo '<select id="contactState">';
		$stateQuery = 'SELECT * FROM States';
		$stateResult = mysqli_query($groupConnection, $stateQuery);
		if (@mysqli_num_rows($stateResult)){
			while ($stateRow = mysqli_fetch_row($stateResult)){
				$specialstate = '';
				if ($State == $stateRow[2]){
					$specialstate = 'selected="selected"';
				}
				else {
					$specialstate = '';
				}
				echo '<option '. $specialstate .' value="' . $stateRow[2] . '">' . $stateRow[1] . '</option>';
			}
		}		
		echo '</select>';
		
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Zip</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactZip" value="'.$Zip.'" /></td>';
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
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="contactComment" value="'.$Comments.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Contact&nbsp;Type</td>';
		echo '<td class="mainContent_Body_Form_Fields"><select id="contactType">';
		$query = 'SELECT * FROM Cont_Type';
		$result = mysqli_query($contConnection, $query);
		if (@mysqli_num_rows($result)){
			while ($row = mysqli_fetch_row($result)){
				$specialtype = '';
				if ($Type == $row[0]){
					$specialtype = 'selected="selected"';
				}
				else {
					$specialtype = '';
				}
				echo '<option '. $specialtype .' value="' . $row[0] . '">' . $row[1] . '</option>';
			}
		}
		echo '</select>';
		echo '</tr>';
		echo '<tr><td class="mainContent_Body_Form_Labels">&nbsp;</td><td class="mainContent_Body_Form_Buttons"><table class="formTable"><tr><td class="formDisable_Td">&nbsp;</td><td class="formSubmit_Td"><input class="formSubmit" type="submit" value="SUBMIT" /></td></tr></table></td></tr>';
			}
		}
		}
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