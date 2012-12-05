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
echo '<form id="editThis_User" action="javascript:editThis_User()">';
echo '<table>';

switch($s){
	case 'g':
		if(isset($_POST['userID'])){
		$query = "SELECT * FROM Users WHERE User_ID=".$_POST['userID'];
		if ($result = mysqli_query($userConnection, $query)){
			while($userRow = $result->fetch_row()){
				$query1 = "SELECT * FROM ACCT_Info WHERE User_ID=".$_POST['userID'];
				if ($result1 = mysqli_query($acctConnection, $query1)){
					while($acctRow = $result1->fetch_row()){
						$userID=$userRow[0];
						$userEmail=$userRow[1];
						$permID=$acctRow[9];
						$userActive=$acctRow[11];
						echo '<tr>';
						echo '<td class="mainContent_Body_Form_Labels">User&nbsp;Name</td>';
						echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="userName" value="'.$userEmail.'" disabled="disabled" /></td>';
						echo '</tr>';
						echo '<tr>';
						echo '<td class="mainContent_Body_Form_Labels">First&nbsp;Name</td>';
						echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="firstName" value="'.$acctRow[2].'" /></td>';
						echo '</tr>';
						echo '<tr>';
						echo '<td class="mainContent_Body_Form_Labels">Last&nbsp;Name</td>';
						echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="lastName" value="'.$acctRow[3].'" /></td>';
						echo '</tr>';
						echo '<tr>';
						echo '<td class="mainContent_Body_Form_Labels">Phone</td>';
						echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="phoneNumber" value="'.$acctRow[5].'" /></td>';
						echo '</tr>';
						echo '<tr>';
						echo '<td class="mainContent_Body_Form_Labels">Permission&nbsp;Level</td>';
						echo '<td class="mainContent_Body_Form_Fields">';
						if($permissionLevel[10] == "1"){
							echo '<select id="permID">';
							$selected='';
							$query3 = "SELECT * FROM Permissions WHERE Permission_Num >= " . $permNum . " ORDER BY Permission_ID ASC";
							if ($result3 = mysqli_query($groupConnection, $query3)){
								while($permRow = $result3->fetch_row()){
									$selected='';
									if($permID==$permRow[2]){	
										$selected='selected="selected"';
									}
									else {
										$selected='';
									}
									if($permRow[2] >= $permNum){
										echo '<option value="'.$permRow[2].'" '.$selected.' >'.$permRow[1].'</option>';
									}
								}
							}
						}
						echo '</select>';
						
						echo '</td>';
						echo '</tr>';
						echo '<tr>';
						echo '<td class="mainContent_Body_Form_Labels">Member&nbsp;of</td>';
						echo '<td class="mainContent_Body_Form_Fields">';
						echo '<input type="text" value="';
						
						$clientQuery ='SELECT * FROM Clients WHERE C_ID = '.$acctRow[6];
						if ($clientResult = mysqli_query($groupConnection, $clientQuery)){
							while($clientRow = $clientResult->fetch_row()){
								echo $clientRow[1];
							}
						}
						
						echo '" disabled="disabled" /></td>';
						echo '</tr>';
						
						//help
						echo '<input type="hidden" id="userID" value="'.$userID.'"/>';
						
						echo '<tr><td class="mainContent_Body_Form_Labels">&nbsp;</td><td class="mainContent_Body_Form_Buttons"><table class="formTable"><tr><td class="formReset_Td">';
						if($_SESSION['u']==$userRow[1]){
							echo '';
						}
						else {
							echo '<a href="javascript:resetThis_User('.$userID.')">RESET PASSWORD</a></td>';
						}
						echo '<td class="formSubmit_Td"><input class="formSubmit" type="submit" value="SUBMIT" /></td></tr></table></td></tr>';
						echo '</table></form></div>';
						//check for ative stuff in user	
							if (isset($_SESSION['u'])){
								if($_SESSION['u']==$userRow[1]){
									if ($userActive==1) {
										echo 'CANNOT DISABLE AT THIS TIME.';
									}
									else{ 		
										echo 'SEE SYSTEM ADMININSTRATOR';
									}
								}
								else {
									if($userActive==1){
										echo '<div id="mainContent_Form_Disable_Btm"><a href="javascript:disableThis_User('.$userID.');">DISABLE</a></div>';
									}
									else{
										echo '<div id="mainContent_Form_Enable_Btm"><a href="javascript:enableThis_User('.$userID.');">ENABLE</a></div>';
									}
										
								}
							}
							else{
								echo 'SEE SYSTEM ADMININSTRATOR';
							}
							
								
					}
				}
			}
		}
		}
		
		
		
		
		
		
	break;
	case 'o':
	if(isset($_POST['userID'])){
		$query = "SELECT * FROM Users WHERE User_ID=".$_POST['userID'];
		if ($result = mysqli_query($userConnection, $query)){
			while($userRow = $result->fetch_row()){
				$query1 = "SELECT * FROM ACCT_Info WHERE User_ID=".$_POST['userID'];
				if ($result1 = mysqli_query($acctConnection, $query1)){
					while($acctRow = $result1->fetch_row()){
						$userID=$userRow[0];
						$userEmail=$userRow[1];
						$permID=$acctRow[9];
						$userActive=$acctRow[11];
						echo '<tr>';
						echo '<td class="mainContent_Body_Form_Labels">User&nbsp;Name</td>';
						echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="userName" value="'.$userEmail.'" disabled="disabled" /></td>';
						echo '</tr>';
						echo '<tr>';
						echo '<td class="mainContent_Body_Form_Labels">First&nbsp;Name</td>';
						echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="firstName" value="'.$acctRow[2].'" /></td>';
						echo '</tr>';
						echo '<tr>';
						echo '<td class="mainContent_Body_Form_Labels">Last&nbsp;Name</td>';
						echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="lastName" value="'.$acctRow[3].'" /></td>';
						echo '</tr>';
						echo '<tr>';
						echo '<td class="mainContent_Body_Form_Labels">Phone</td>';
						echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="phoneNumber" value="'.$acctRow[5].'" /></td>';
						echo '</tr>';
						echo '<tr>';
						echo '<td class="mainContent_Body_Form_Labels">Permission&nbsp;Level</td>';
						echo '<td class="mainContent_Body_Form_Fields">';
						if($permissionLevel[10] == "1"){
							echo '<select id="permID">';
							$selected='';
							$query3 = "SELECT * FROM Permissions WHERE Permission_Num >= " . $permNum . " ORDER BY Permission_ID ASC";
							if ($result3 = mysqli_query($groupConnection, $query3)){
								while($permRow = $result3->fetch_row()){
									$selected='';
									if($permID==$permRow[2]){	
										$selected='selected="selected"';
									}
									else {
										$selected='';
									}
									if($permRow[2] >= $permNum){
										echo '<option value="'.$permRow[2].'" '.$selected.' >'.$permRow[1].'</option>';
									}
								}
							}
						}
						echo '</select>';
						
						echo '</td>';
						echo '</tr>';
						echo '<tr>';
						echo '<td class="mainContent_Body_Form_Labels">Member&nbsp;of</td>';
						echo '<td class="mainContent_Body_Form_Fields">';
						echo '<input type="text" value="';
						
						$clientQuery ='SELECT * FROM Clients WHERE C_ID = '.$acctRow[6];
						if ($clientResult = mysqli_query($groupConnection, $clientQuery)){
							while($clientRow = $clientResult->fetch_row()){
								echo $clientRow[1];
							}
						}
						
						echo '" disabled="disabled" /></td>';
						echo '</tr>';
						
						//help
						echo '<input type="hidden" id="userID" value="'.$userID.'"/>';
						
						echo '<tr><td class="mainContent_Body_Form_Labels">&nbsp;</td><td class="mainContent_Body_Form_Buttons"><table class="formTable"><tr><td class="formReset_Td">';
						if($_SESSION['u']==$userRow[1]){
							echo '';
						}
						else {
							echo '<a href="javascript:resetThis_User('.$userID.')">RESET PASSWORD</a></td>';
						}
						echo '<td class="formSubmit_Td"><input class="formSubmit" type="submit" value="SUBMIT" /></td></tr></table></td></tr>';
						echo '</table></form></div>';
						//check for ative stuff in user	
							if (isset($_SESSION['u'])){
								if($_SESSION['u']==$userRow[1]){
									if ($userActive==1) {
										echo 'CANNOT DISABLE AT THIS TIME.';
									}
									else{ 		
										echo 'SEE SYSTEM ADMININSTRATOR';
									}
								}
								else {
									if($userActive==1){
										echo '<div id="mainContent_Form_Disable_Btm"><a href="javascript:disableThis_User('.$userID.');">DISABLE</a></div>';
									}
									else{
										echo '<div id="mainContent_Form_Enable_Btm"><a href="javascript:enableThis_User('.$userID.');">ENABLE</a></div>';
									}
										
								}
							}
							else{
								echo 'SEE SYSTEM ADMININSTRATOR';
							}
							
								
					}
				}
			}
		}
		}
	break;
	case 'c':
	if(isset($_POST['userID'])){
		$query = "SELECT * FROM Users WHERE User_ID=".$_POST['userID'];
		if ($result = mysqli_query($userConnection, $query)){
			while($userRow = $result->fetch_row()){
				$query1 = "SELECT * FROM ACCT_Info WHERE User_ID=".$_POST['userID'];
				if ($result1 = mysqli_query($acctConnection, $query1)){
					while($acctRow = $result1->fetch_row()){
						$userID=$userRow[0];
						$userEmail=$userRow[1];
						$permID=$acctRow[9];
						$userActive=$acctRow[11];
						echo '<tr>';
						echo '<td class="mainContent_Body_Form_Labels">User&nbsp;Name</td>';
						echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="userName" value="'.$userEmail.'" disabled="disabled" /></td>';
						echo '</tr>';
						echo '<tr>';
						echo '<td class="mainContent_Body_Form_Labels">First&nbsp;Name</td>';
						echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="firstName" value="'.$acctRow[2].'" /></td>';
						echo '</tr>';
						echo '<tr>';
						echo '<td class="mainContent_Body_Form_Labels">Last&nbsp;Name</td>';
						echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="lastName" value="'.$acctRow[3].'" /></td>';
						echo '</tr>';
						echo '<tr>';
						echo '<td class="mainContent_Body_Form_Labels">Phone</td>';
						echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="phoneNumber" value="'.$acctRow[5].'" /></td>';
						echo '</tr>';
						echo '<tr>';
						echo '<td class="mainContent_Body_Form_Labels">Permission&nbsp;Level</td>';
						echo '<td class="mainContent_Body_Form_Fields">';
						if($permissionLevel[10] == "1"){
							echo '<select id="permID">';
							$selected='';
							$query3 = "SELECT * FROM Permissions WHERE Permission_Num >= " . $permNum . " ORDER BY Permission_ID ASC";
							if ($result3 = mysqli_query($groupConnection, $query3)){
								while($permRow = $result3->fetch_row()){
									$selected='';
									if($permID==$permRow[2]){	
										$selected='selected="selected"';
									}
									else {
										$selected='';
									}
									if($permRow[2] >= $permNum){
										echo '<option value="'.$permRow[2].'" '.$selected.' >'.$permRow[1].'</option>';
									}
								}
							}
						}
						echo '</select>';
						
						echo '</td>';
						echo '</tr>';
						echo '<tr>';
						echo '<td class="mainContent_Body_Form_Labels">Member&nbsp;of</td>';
						echo '<td class="mainContent_Body_Form_Fields">';
						echo '<input type="text" value="';
						
						$clientQuery ='SELECT * FROM Clients WHERE C_ID = '.$acctRow[6];
						if ($clientResult = mysqli_query($groupConnection, $clientQuery)){
							while($clientRow = $clientResult->fetch_row()){
								echo $clientRow[1];
							}
						}
						
						echo '" disabled="disabled" /></td>';
						echo '</tr>';
						
						//help
						echo '<input type="hidden" id="userID" value="'.$userID.'"/>';
						
						echo '<tr><td class="mainContent_Body_Form_Labels">&nbsp;</td><td class="mainContent_Body_Form_Buttons"><table class="formTable"><tr><td class="formReset_Td">';
						
						if($_SESSION['u']==$userRow[1]){
							echo '';
						}
						else {
							echo '<a href="javascript:resetThis_User('.$userID.')">RESET PASSWORD</a></td>';
						}
						echo '<td class="formSubmit_Td"><input class="formSubmit" type="submit" value="SUBMIT" /></td></tr></table></td></tr>';
						echo '</table></form></div>';
						//check for ative stuff in user	
							if (isset($_SESSION['u'])){
								if($_SESSION['u']==$userRow[1]){
									if ($userActive==1) {
										echo 'CANNOT DISABLE AT THIS TIME.';
									}
									else{ 		
										echo 'SEE SYSTEM ADMININSTRATOR';
									}
								}
								else {
									if($userActive==1){
										echo '<div id="mainContent_Form_Disable_Btm"><a href="javascript:disableThis_User('.$userID.');">DISABLE</a></div>';
									}
									else{
										echo '<div id="mainContent_Form_Enable_Btm"><a href="javascript:enableThis_User('.$userID.');">ENABLE</a></div>';
									}
										
								}
							}
							else{
								echo 'SEE SYSTEM ADMININSTRATOR';
							}
							
					}
				}
			}
		}
		}
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
	
	$result->close();
	$result1->close();
	$result2->close();
	$result3->close();
	$result4->close();

	mysqli_close($acctConnection);
	mysqli_close($userConnection);
	mysqli_close($groupConnection);


?>