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

echo '<table>';

switch($s){
	case 'g':
		if(isset($_POST['id'])){
			$query = "SELECT * FROM Clients WHERE C_ID=".$_POST['id'];
			
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
					echo $clientName;
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Address</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo $clientAddress;
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Address1</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo $clientAddress1;
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">City</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo $clientCity;
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">State</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo $clientState;
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Zip</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo $clientZip;
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Phone Sales</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo $clientPhone_Sales;
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Phone Service</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo $clientPhone_Service;
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Notes</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo $clientComment;
					echo '</td>';
					echo '</tr>';
					// stuff
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Client&nbsp;Code</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo $clientCode;
					echo '</td>';
					echo '</tr>';
										
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Member&nbsp;Of:</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					
					
					
					$query1 = 'SELECT * FROM Organization WHERE Org_ID="'.$orgID.'"';
					if ($result1 = mysqli_query($groupConnection, $query1)){
						while($groupRow = $result1->fetch_row()){
							echo $groupRow[1];
						}
					}
					
					
					echo '</td>';
					echo '</tr>';
					
					echo '</table></div>';


					
				
							
													
				}
			}
		}
		else {
			echo '<tr><td align="center"><strong>Please See System Administrator.</strong></td></tr>';
		}
		
		
		
		
		
		
	break;
	case 'o':
	if(isset($_POST['id'])){
			$query = "SELECT * FROM Clients WHERE C_ID=".$_POST['id'];
			
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
					echo $clientName;
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Address</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo $clientAddress;
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Address1</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo $clientAddress1;
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">City</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo $clientCity;
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">State</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo $clientState;
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Zip</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo $clientZip;
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Phone Sales</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo $clientPhone_Sales;
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Phone Service</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo $clientPhone_Service;
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Notes</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo $clientComment;
					echo '</td>';
					echo '</tr>';
					// stuff
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Client&nbsp;Code</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo $clientCode;
					echo '</td>';
					echo '</tr>';
										
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Member&nbsp;Of:</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					
					
					
					$query1 = 'SELECT * FROM Organization WHERE Org_ID="'.$orgID.'"';
					if ($result1 = mysqli_query($groupConnection, $query1)){
						while($groupRow = $result1->fetch_row()){
							echo $groupRow[1];
						}
					}
					
					
					echo '</td>';
					echo '</tr>';
					
					echo '</table></div>';


					
				
							
													
				}
			}
		}
		else {
			echo '<tr><td align="center"><strong>Please See System Administrator.</strong></td></tr>';
		}
		
	break;
	case 'c':
	if(isset($_POST['id'])){
			$query = "SELECT * FROM Clients WHERE C_ID=".$_POST['id'];
			
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
					echo $clientName;
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Address</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo $clientAddress;
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Address1</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo $clientAddress1;
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">City</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo $clientCity;
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">State</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo $clientState;
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Zip</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo $clientZip;
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Phone Sales</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo $clientPhone_Sales;
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Phone Service</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo $clientPhone_Service;
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Notes</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo $clientComment;
					echo '</td>';
					echo '</tr>';
					// stuff
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Client&nbsp;Code</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo $clientCode;
					echo '</td>';
					echo '</tr>';
										
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Member&nbsp;Of:</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					
					
					
					$query1 = 'SELECT * FROM Organization WHERE Org_ID="'.$orgID.'"';
					if ($result1 = mysqli_query($groupConnection, $query1)){
						while($groupRow = $result1->fetch_row()){
							echo $groupRow[1];
						}
					}
					
					
					echo '</td>';
					echo '</tr>';
					
					echo '</table></div>';


					
				
							
													
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