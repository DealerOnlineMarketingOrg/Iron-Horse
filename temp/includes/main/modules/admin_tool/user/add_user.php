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
echo '<form id="addNew_User" action="javascript:addNew_User()">';
echo '<table>';

switch($s){
	case 'g':
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">User&nbsp;Name</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="userName" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">First&nbsp;Name</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="firstName" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Last&nbsp;Name</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="lastName" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Phone</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="phoneNumber" value="'.$acctRow[5].'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Permission&nbsp;Level</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		
		echo '<select id="permID">';
		$selected1='';
		$query3 = "SELECT * FROM Permissions WHERE Permission_Num >= " . $permNum . " ORDER BY Permission_ID ASC";
		if ($result3 = mysqli_query($groupConnection, $query3)){
			while($permRow = $result3->fetch_row()){
				$selected1='';
				if($permID==$permRow[2]){	
					$selected1='selected="selected"';
				}
				else {
					$selected1='';
				}
				if($permRow[2] >= $permNum){
					echo '<option value="'.$permRow[2].'" '.$selected1.' >'.$permRow[1].'</option>';
				}
			}
		}
		
		echo '</select>';
						
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Member&nbsp;of</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		echo '<select id="cID" name="cID">';
		$oQuery = "SELECT * FROM Organization WHERE Group_ID=" . substr($selected, 1);
		$oResult = mysqli_query($groupConnection, $oQuery);
		if (@mysqli_num_rows($oResult)){
			while($oRow = $oResult->fetch_row()){
				//get clients within the current organization
				$query2 = "SELECT * FROM Clients WHERE Org_ID=" . $oRow[0];
				$result2 = mysqli_query($groupConnection, $query2);
				if (@mysqli_num_rows($result2)){
					while($clientRow = $result2->fetch_row()){
					//list client in dropdown
						echo '<option value="'.$clientRow[0].'" >'. $clientRow[12].' ('.$clientRow[1].')'.'</option>';
					}
				}
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
		echo '<td class="mainContent_Body_Form_Labels">User&nbsp;Name</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="userName" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">First&nbsp;Name</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="firstName" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Last&nbsp;Name</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="lastName" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Phone</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="phoneNumber" value="'.$acctRow[5].'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Permission&nbsp;Level</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		
		echo '<select id="permID">';
		$selected1='';
		$query3 = "SELECT * FROM Permissions WHERE Permission_Num >= " . $permNum . " ORDER BY Permission_ID ASC";
		if ($result3 = mysqli_query($groupConnection, $query3)){
			while($permRow = $result3->fetch_row()){
				$selected1='';
				if($permID==$permRow[2]){	
					$selected1='selected="selected"';
				}
				else {
					$selected1='';
				}
				if($permRow[2] >= $permNum){
					echo '<option value="'.$permRow[2].'" '.$selected1.' >'.$permRow[1].'</option>';
				}
			}
		}
		
		echo '</select>';
						
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Member&nbsp;of</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		echo '<select id="cID" name="cID">';
		//get clients within the current organization
		$query2 = "SELECT * FROM Clients WHERE Org_ID=" . substr($selected, 1);
		$result2 = mysqli_query($groupConnection, $query2);
		if (@mysqli_num_rows($result2)){
			while($clientRow = $result2->fetch_row()){
			//list client in dropdown
				echo '<option value="'.$clientRow[0].'" >'. $clientRow[12].' ('.$clientRow[1].')'.'</option>';
			}
		}
		echo '</select>';
		echo '</td>';
		echo '</tr>';
		
		
		echo '<tr><td class="mainContent_Body_Form_Labels">&nbsp;</td><td class="mainContent_Body_Form_Buttons"><table class="formTable"><tr><td class="formDisable_Td">&nbsp;</td><td class="formSubmit_Td"><input class="formSubmit" type="submit" value="SUBMIT" /></td></tr></table></td></tr>';
		echo '</table></form></div>';
	
	break;
	
	case 'c':
		
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">User&nbsp;Name</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="userName" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">First&nbsp;Name</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="firstName" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Last&nbsp;Name</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="lastName" value="" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Phone</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="phoneNumber" value="'.$acctRow[5].'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Permission&nbsp;Level</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		
		echo '<select id="permID">';
		$selected1='';
		$query3 = "SELECT * FROM Permissions WHERE Permission_Num >= " . $permNum . " ORDER BY Permission_ID ASC";
		if ($result3 = mysqli_query($groupConnection, $query3)){
			while($permRow = $result3->fetch_row()){
				$selected1='';
				if($permID==$permRow[2]){	
					$selected1='selected="selected"';
				}
				else {
					$selected1='';
				}
				if($permRow[2] >= $permNum){
					echo '<option value="'.$permRow[2].'" '.$selected1.' >'.$permRow[1].'</option>';
				}
			}
		}
		
		echo '</select>';
						
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Member&nbsp;of</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		echo '<select id="cID" name="cID">';
		//get clients within the current organization
		$query2 = "SELECT * FROM Clients WHERE C_ID=" . substr($selected, 1);
		$result2 = mysqli_query($groupConnection, $query2);
		if (@mysqli_num_rows($result2)){
			while($clientRow = $result2->fetch_row()){
			//list client in dropdown
				echo '<option value="'.$clientRow[0].'" >'. $clientRow[12].' ('.$clientRow[1].')'.'</option>';
			}
		}
		echo '</select>';
		echo '</td>';
		echo '</tr>';
		
		
		echo '<tr><td class="mainContent_Body_Form_Labels">&nbsp;</td><td class="mainContent_Body_Form_Buttons"><table class="formTable"><tr><td class="formDisable_Td">&nbsp;</td><td class="formSubmit_Td"><input class="formSubmit" type="submit" value="SUBMIT" /></td></tr></table></td></tr>';
		echo '</table></form></div>';
		
	break;
	
	default:
		echo "Oops, something went wrong.";
		break;

}



echo '<div id="mainContent_Body_Cancel_Btm"><a href="javascript:userAdmin();">BACK</a></div><!-- end data rows section --></div>';
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







