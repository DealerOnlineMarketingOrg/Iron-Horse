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
echo '<form id="editThis_Client" action="javascript:editThis_Client()">';
echo '<table>';

switch($s){
	case 'g':
		if(isset($_POST['clientID'])){
			$query = "SELECT * FROM Clients WHERE C_ID=".$_POST['clientID'];
			
			if ($result = mysqli_query($groupConnection, $query)){
			while($clientRow = $result->fetch_row()){
					$clientID =$clientRow[0];
					$clientName = $clientRow[1];
					$clientAddress = $clientRow[2];
					$clientAddress1 = $clientRow[3];
					$clientCity = $clientRow[4];
					$clientState = $clientRow[5];
					$clientZip = $clientRow[6];
					$clientPhone_Sales = $clientRow[7];
					$clientPhone_Service = $clientRow[8];
					$clientComment = $clientRow[9];
					$clientUrl = $clientRow[10];
					$clientUrl1 = $clientRow[11];
					$clientCode = $clientRow[12];
					$orgID = $clientRow[13];
					$clientActive = $clientRow[14];
			
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Name</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo '<input type="text" id="clientName" value="'.$clientName.'" />';
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Address</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo '<input type="text" id="clientAddress" value="'.$clientAddress.'" />';
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Address1</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo '<input type="text" id="clientAddress1" value="'.$clientAddress1.'" />';
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">City</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo '<input type="text" id="clientCity" value="'.$clientCity.'" />';
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
							$specialstate = '';
							if ($clientState == $stateRow[2]){
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
					echo '<td class="mainContent_Body_Form_Fields">';
					echo '<input type="text" id="clientZip" value="'.$clientZip.'" />';
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Phone Sales</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo '<input type="text" id="clientPhone_Sales" value="'.$clientPhone_Sales.'" />';
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Phone Service</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo '<input type="text" id="clientPhone_Service" value="'.$clientPhone_Service.'" />';
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Notes</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo '<textarea id="clientComment">'.$clientComment.'</textarea>';
					echo '</td>';
					echo '</tr>';
					// stuff
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Client&nbsp;Code</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo '<input type="text" id="clientCode" value="'.$clientCode.'" />';
					echo '</td>';
					echo '</tr>';
										
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Member&nbsp;Of:</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					
					echo '<input type="hidden" id="clientUrl" value="'.$clientUrl.'"/>';
					echo '<input type="hidden" id="clientUrl1" value="'.$clientUrl1.'"/>';
					echo '<input type="hidden" id="orgID" value="'.$orgID.'"/>';
					echo '<input type="hidden" id="clientID" value="'.$clientID.'"/>';
					echo '<input type="text" value="';
					
					$query1 = 'SELECT * FROM Organization WHERE Org_ID="'.$orgID.'"';
					if ($result1 = mysqli_query($groupConnection, $query1)){
						while($groupRow = $result1->fetch_row()){
							echo $groupRow[1];
						}
					}
					
					echo '" disabled="disabled" />';
					echo '</td>';
					echo '</tr>';
					echo '<tr><td class="mainContent_Body_Form_Labels">&nbsp;</td><td class="mainContent_Body_Form_Buttons"><table class="formTable"><tr><td class="formDisable_Td">&nbsp;</td><td class="formSubmit_Td"><input class="formSubmit" type="submit" value="SUBMIT" /></td></tr></table></td></tr>';
					echo '</table></form></div>';

					//check for ative stuff 
					
					if($permNum<=10){
					$uquery = "SELECT * FROM Users WHERE User_Name = '".$_SESSION['u']."'";
							if ($uresult = mysqli_query($userConnection, $uquery)){
								while($userRow = $uresult->fetch_row()){
										
									$aquery = "SELECT * FROM ACCT_Info WHERE User_ID = ".$userRow[0];
										if ($aresult = mysqli_query($acctConnection, $aquery)){
											while($acctRow = $aresult->fetch_row()){
												
												if($acctRow[6]==$clientID){
													echo 'CANNOT DISABLE AT THIS TIME.';
												}
												elseif($acctRow[6]!=$clientID&&$clientActive==1){
													echo '<div id="mainContent_Form_Disable_Btm"><a href="javascript:disableThis_Client('.$orgID.');">DISABLE</a></div>';
												}
												elseif($acctRow[6]!=$clientID&&$clientActive==0){
														echo '<div id="mainContent_Form_Enable_Btm"><a href="javascript:enableThis_Client('.$orgID.');">ENABLE</a></div>';
												}
											}
										}
								}
							}
					}
					
							
													
				}
			}
		}
		else {
			echo '<tr><td align="center"><strong>Please See System Administrator.</strong></td></tr>';
		}
		
		
		
		
		
		
	break;
	case 'o':
	if(isset($_POST['clientID'])){
			$query = "SELECT * FROM Clients WHERE C_ID=".$_POST['clientID'];
			
			if ($result = mysqli_query($groupConnection, $query)){
			while($clientRow = $result->fetch_row()){
					$clientID =$clientRow[0];
					$clientName = $clientRow[1];
					$clientAddress = $clientRow[2];
					$clientAddress1 = $clientRow[3];
					$clientCity = $clientRow[4];
					$clientState = $clientRow[5];
					$clientZip = $clientRow[6];
					$clientPhone_Sales = $clientRow[7];
					$clientPhone_Service = $clientRow[8];
					$clientComment = $clientRow[9];
					$clientUrl = $clientRow[10];
					$clientUrl1 = $clientRow[11];
					$clientCode = $clientRow[12];
					$orgID = $clientRow[13];
					$clientActive = $clientRow[14];
			
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Name</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo '<input type="text" id="clientName" value="'.$clientName.'" />';
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Address</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo '<input type="text" id="clientAddress" value="'.$clientAddress.'" />';
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Address1</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo '<input type="text" id="clientAddress1" value="'.$clientAddress1.'" />';
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">City</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo '<input type="text" id="clientCity" value="'.$clientCity.'" />';
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
							$specialstate = '';
							if ($clientState == $stateRow[2]){
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
					echo '<td class="mainContent_Body_Form_Fields">';
					echo '<input type="text" id="clientZip" value="'.$clientZip.'" />';
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Phone Sales</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo '<input type="text" id="clientPhone_Sales" value="'.$clientPhone_Sales.'" />';
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Phone Service</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo '<input type="text" id="clientPhone_Service" value="'.$clientPhone_Service.'" />';
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Notes</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo '<textarea id="clientComment">'.$clientComment.'</textarea>';
					echo '</td>';
					echo '</tr>';
					// stuff
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Phone Service</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo '<input type="text" id="clientCode" value="'.$clientCode.'" />';
					echo '</td>';
					echo '</tr>';
										
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Member&nbsp;Of:</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					
					echo '<input type="hidden" id="clientUrl" value="'.$clientUrl.'"/>';
					echo '<input type="hidden" id="clientUrl1" value="'.$clientUrl1.'"/>';
					echo '<input type="hidden" id="orgID" value="'.$orgID.'"/>';
					echo '<input type="hidden" id="clientID" value="'.$clientID.'"/>';
					echo '<input type="text" value="';
					
					$query1 = 'SELECT * FROM Organization WHERE Org_ID="'.$orgID.'"';
					if ($result1 = mysqli_query($groupConnection, $query1)){
						while($groupRow = $result1->fetch_row()){
							echo $groupRow[1];
						}
					}
					
					echo '" disabled="disabled" />';
					echo '</td>';
					echo '</tr>';
					echo '<tr><td class="mainContent_Body_Form_Labels">&nbsp;</td><td class="mainContent_Body_Form_Buttons"><table class="formTable"><tr><td class="formDisable_Td">&nbsp;</td><td class="formSubmit_Td"><input class="formSubmit" type="submit" value="SUBMIT" /></td></tr></table></td></tr>';
					echo '</table></form></div>';

					//check for ative stuff 
					
					if($permNum<=10){
					$uquery = "SELECT * FROM Users WHERE User_Name = '".$_SESSION['u']."'";
							if ($uresult = mysqli_query($userConnection, $uquery)){
								while($userRow = $uresult->fetch_row()){
										
									$aquery = "SELECT * FROM ACCT_Info WHERE User_ID = ".$userRow[0];
										if ($aresult = mysqli_query($acctConnection, $aquery)){
											while($acctRow = $aresult->fetch_row()){
												
												if($acctRow[6]==$clientID){
													echo 'CANNOT DISABLE AT THIS TIME.';
												}
												elseif($acctRow[6]!=$clientID&&$clientActive==1){
													echo '<div id="mainContent_Form_Disable_Btm"><a href="javascript:disableThis_Client('.$orgID.');">DISABLE</a></div>';
												}
												elseif($acctRow[6]!=$clientID&&$clientActive==0){
														echo '<div id="mainContent_Form_Enable_Btm"><a href="javascript:enableThis_Client('.$orgID.');">ENABLE</a></div>';
												}
											}
										}
								}
							}
					}
					
							
													
				}
			}
		}
		else {
			echo '<tr><td align="center"><strong>Please See System Administrator.</strong></td></tr>';
		}
	break;
	case 'c':
	if(isset($_POST['clientID'])){
			$query = "SELECT * FROM Clients WHERE C_ID=".$_POST['clientID'];
			
			if ($result = mysqli_query($groupConnection, $query)){
			while($clientRow = $result->fetch_row()){
					$clientID =$clientRow[0];
					$clientName = $clientRow[1];
					$clientAddress = $clientRow[2];
					$clientAddress1 = $clientRow[3];
					$clientCity = $clientRow[4];
					$clientState = $clientRow[5];
					$clientZip = $clientRow[6];
					$clientPhone_Sales = $clientRow[7];
					$clientPhone_Service = $clientRow[8];
					$clientComment = $clientRow[9];
					$clientUrl = $clientRow[10];
					$clientUrl1 = $clientRow[11];
					$clientCode = $clientRow[12];
					$orgID = $clientRow[13];
					$clientActive = $clientRow[14];
			
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Name</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo '<input type="text" id="clientName" value="'.$clientName.'" />';
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Address</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo '<input type="text" id="clientAddress" value="'.$clientAddress.'" />';
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Address1</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo '<input type="text" id="clientAddress1" value="'.$clientAddress1.'" />';
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">City</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo '<input type="text" id="clientCity" value="'.$clientCity.'" />';
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
							$specialstate = '';
							if ($clientState == $stateRow[2]){
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
					echo '<td class="mainContent_Body_Form_Fields">';
					echo '<input type="text" id="clientZip" value="'.$clientZip.'" />';
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Phone Sales</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo '<input type="text" id="clientPhone_Sales" value="'.$clientPhone_Sales.'" />';
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Phone Service</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo '<input type="text" id="clientPhone_Service" value="'.$clientPhone_Service.'" />';
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Notes</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo '<textarea id="clientComment">'.$clientComment.'</textarea>';
					echo '</td>';
					echo '</tr>';
					// stuff
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Phone Service</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo '<input type="text" id="clientCode" value="'.$clientCode.'" />';
					echo '</td>';
					echo '</tr>';
										
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Member&nbsp;Of:</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					
					echo '<input type="hidden" id="clientUrl" value="'.$clientUrl.'"/>';
					echo '<input type="hidden" id="clientUrl1" value="'.$clientUrl1.'"/>';
					echo '<input type="hidden" id="orgID" value="'.$orgID.'"/>';
					echo '<input type="hidden" id="clientID" value="'.$clientID.'"/>';
					echo '<input type="text" value="';
					
					$query1 = 'SELECT * FROM Organization WHERE Org_ID="'.$orgID.'"';
					if ($result1 = mysqli_query($groupConnection, $query1)){
						while($groupRow = $result1->fetch_row()){
							echo $groupRow[1];
						}
					}
					
					echo '" disabled="disabled" />';
					echo '</td>';
					echo '</tr>';
					echo '<tr><td class="mainContent_Body_Form_Labels">&nbsp;</td><td class="mainContent_Body_Form_Buttons"><table class="formTable"><tr><td class="formDisable_Td">&nbsp;</td><td class="formSubmit_Td"><input class="formSubmit" type="submit" value="SUBMIT" /></td></tr></table></td></tr>';
					echo '</table></form></div>';

					//check for ative stuff 
					
					if($permNum<=10){
					$uquery = "SELECT * FROM Users WHERE User_Name = '".$_SESSION['u']."'";
							if ($uresult = mysqli_query($userConnection, $uquery)){
								while($userRow = $uresult->fetch_row()){
										
									$aquery = "SELECT * FROM ACCT_Info WHERE User_ID = ".$userRow[0];
										if ($aresult = mysqli_query($acctConnection, $aquery)){
											while($acctRow = $aresult->fetch_row()){
												
												if($acctRow[6]==$clientID){
													echo 'CANNOT DISABLE AT THIS TIME.';
												}
												elseif($acctRow[6]!=$clientID&&$clientActive==1){
													echo '<div id="mainContent_Form_Disable_Btm"><a href="javascript:disableThis_Client('.$orgID.');">DISABLE</a></div>';
												}
												elseif($acctRow[6]!=$clientID&&$clientActive==0){
														echo '<div id="mainContent_Form_Enable_Btm"><a href="javascript:enableThis_Client('.$orgID.');">ENABLE</a></div>';
												}
											}
										}
								}
							}
					}
					
							
													
				}
			}
		}
		else {
			echo '<tr><td align="center"><strong>Please See System Administrator.</strong></td></tr>';
		}
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