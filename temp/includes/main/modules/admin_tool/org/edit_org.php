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
echo '<form id="editThis_Org" action="javascript:editThis_Org()">';
echo '<table>';

switch($s){
	case 'g':
		if(isset($_POST['orgID'])){
		$query = "SELECT * FROM Organization WHERE Org_ID=".$_POST['orgID'];
	
			if ($result = mysqli_query($groupConnection, $query)){
				while($orgRow = $result->fetch_row()){
					$orgID = $orgRow[0];
					$orgName=$orgRow[1];
					$orgGroup=$orgRow[2];
					$orgGroup2=$orgRow[3];
					$orgActive=$orgRow[4];
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Name</td>';
					echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="editOrg_Name" value="'.$orgName.'" /></td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Member&nbsp;Of:</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					echo '<input type="hidden" id="editOrg_Group" value="'.$orgGroup.'"/>';
					echo '<input type="hidden" id="orgID" value="'.$orgID.'"/>';
					echo '<input type="text" value="';
					
					$query1 = 'SELECT * FROM Groups WHERE Group_ID="'.$orgGroup.'"';
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

					//check for ative stuff in group		
							if ($orgActive==1) {
								$oquery = "SELECT * FROM Clients WHERE Org_ID = ".$orgID." AND Active=1";
					
								if ($oresult = mysqli_query($groupConnection, $oquery)){
								
									if(@mysqli_num_rows($oresult)){
										echo 'CANNOT DISABLE AT THIS TIME.';
									}
									else {
										echo '<div id="mainContent_Form_Disable_Btm"><a href="javascript:disableThis_Org('.$orgID.');">DISABLE</a></div>';
									}
								}
							}
							elseif ($orgActive==0) {
								echo '<div id="mainContent_Form_Enable_Btm"><a href="javascript:enableThis_Org('.$orgID.');">ENABLE</a></div>';
							}
													
				}
			}
		}
		else {
			echo 'sorry';
		}
		
		
		
		
		
		
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



echo '<div id="mainContent_Body_Cancel_Btm"><a href="javascript:orgAdmin();">BACK</a></div><!-- end data rows section --></div>';
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