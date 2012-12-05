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
echo '<form id="editThis_Website" action="javascript:editThis_Website()">';
echo '<table>';

switch($s){
	case 'g':
		if(isset($_POST['websiteID'])){
		$query = "SELECT * FROM Websites WHERE ID=".$_POST['websiteID'];
	
			if ($result = mysqli_query($groupConnection, $query)){
				while($siteRow = $result->fetch_row()){
					$siteID = $siteRow[0];
					$siteCID=$siteRow[1];
					$siteUrl=$siteRow[2];
					$siteDesc=$siteRow[3];

					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Client&nbsp;Code</td>';
					echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="editWebsite_Client" disabled="disabled" value="';
					$cQuery = 'SELECT * FROM Clients WHERE C_ID ='.$siteCID;
					$cResult = mysqli_query($groupConnection, $cQuery);
					if (@mysqli_num_rows($cResult)){
						while($clientRow = $cResult->fetch_row()){
								echo $clientRow[12];
						}
					}
							
					echo '" /></td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">URL</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo '<input type="hidden" id="editSite_ID" value="'.$siteID.'"/>';
					echo '<input type="text" id="editSite_URL" value="'.$siteUrl.'" />';
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Description</td>';
					echo '<td class="mainContent_Body_Form_Fields"><textarea id="editSite_Desc">'.$siteDesc.'</textarea></td>';
					echo '</tr>';
					echo '<tr><td class="mainContent_Body_Form_Labels">&nbsp;</td><td class="mainContent_Body_Form_Buttons"><table class="formTable"><tr><td class="formDisable_Td">&nbsp;</td><td class="formSubmit_Td"><input class="formSubmit" type="submit" value="SUBMIT" /></td></tr></table></td></tr>';
					echo '</table></form></div>';
								
				}
			}
		}
		else {
			echo '<tr><td align="center"><strong>Please See System Administrator.</strong></td></tr>';
		}
		
		
		
		
		
		
	break;
	case 'o':
	if(isset($_POST['websiteID'])){
		$query = "SELECT * FROM Websites WHERE ID=".$_POST['websiteID'];
	
			if ($result = mysqli_query($groupConnection, $query)){
				while($siteRow = $result->fetch_row()){
					$siteID = $siteRow[0];
					$siteCID=$siteRow[1];
					$siteUrl=$siteRow[2];
					$siteDesc=$siteRow[3];

					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Client&nbsp;Code</td>';
					echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="editWebsite_Client" disabled="disabled" value="';
					$cQuery = 'SELECT * FROM Clients WHERE C_ID ='.$siteCID;
					if ($cResult = mysqli_query($groupConnection, $cQuery)){
						while($clientRow = $cResult->fetch_row()){
								echo $clientRow[12];
						}
					}
							
					echo '" /></td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">URL</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo '<input type="hidden" id="editSite_ID" value="'.$siteID.'"/>';
					echo '<input type="text" id="editSite_URL" value="'.$siteUrl.'" />';
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Description</td>';
					echo '<td class="mainContent_Body_Form_Fields"><textarea id="editSite_Desc">'.$siteDesc.'</textarea></td>';
					echo '</tr>';
					echo '<tr><td class="mainContent_Body_Form_Labels">&nbsp;</td><td class="mainContent_Body_Form_Buttons"><table class="formTable"><tr><td class="formDisable_Td">&nbsp;</td><td class="formSubmit_Td"><input class="formSubmit" type="submit" value="SUBMIT" /></td></tr></table></td></tr>';
					echo '</table></form></div>';
								
				}
			}
		}
		else {
			echo '<tr><td align="center"><strong>Please See System Administrator.</strong></td></tr>';
		}
		
	break;
	case 'c':
	if(isset($_POST['websiteID'])){
		$query = "SELECT * FROM Websites WHERE ID=".$_POST['websiteID'];
	
			if ($result = mysqli_query($groupConnection, $query)){
				while($siteRow = $result->fetch_row()){
					$siteID = $siteRow[0];
					$siteCID=$siteRow[1];
					$siteUrl=$siteRow[2];
					$siteDesc=$siteRow[3];

					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Client&nbsp;Code</td>';
					echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="editWebsite_Client" disabled="disabled" value="';
					$cQuery = 'SELECT * FROM Clients WHERE C_ID ='.$siteCID;
					$cResult = mysqli_query($groupConnection, $cQuery);
					if (@mysqli_num_rows($cResult)){
						while($clientRow = $cResult->fetch_row()){
								echo $clientRow[12];
						}
					}
							
					echo '" /></td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">URL</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo '<input type="hidden" id="editSite_ID" value="'.$siteID.'"/>';
					echo '<input type="text" id="editSite_URL" value="'.$siteUrl.'" />';
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Description</td>';
					echo '<td class="mainContent_Body_Form_Fields"><textarea id="editSite_Desc">'.$siteDesc.'</textarea></td>';
					echo '</tr>';
					echo '<tr><td class="mainContent_Body_Form_Labels">&nbsp;</td><td class="mainContent_Body_Form_Buttons"><table class="formTable"><tr><td class="formDisable_Td">&nbsp;</td><td class="formSubmit_Td"><input class="formSubmit" type="submit" value="SUBMIT" /></td></tr></table></td></tr>';
					echo '</table></form></div>';
								
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