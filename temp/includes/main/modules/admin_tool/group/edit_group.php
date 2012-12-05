<?php

if (!session_id()) session_start();

echo '';

require_once($_SERVER['DOCUMENT_ROOT'] . "/lib/permissions.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/acctgate.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/usergate.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/groupgate.php");


$selected = $_SESSION['c'];



//echo '<tr><td align="center"><strong>'.$permNum.'</strong></td></tr>';
if ($permNum == '0'){
$s = $selected[0];

if(isset($_POST['groupID'])){
	$query = "SELECT * FROM Groups WHERE Group_ID=".$_POST['groupID'];
	if ($result = mysqli_query($groupConnection, $query)){
	while($groupRow = $result->fetch_row()){
			$groupID = $_POST['groupID'];
			$groupName=$groupRow[1];
			$groupDesc=$groupRow[2];
			$groupActive=$groupRow[3];
			//echo $groupName;
			//echo $groupDesc;


echo '<div id="mainContent_Body_List"><div id="mainContent_Body_List_Header_Bar">';
echo '<!-- begin form for groups -->';
echo '<div id="mainContent_Body_Form">';
echo '<form id="editThis_Group" action="javascript:editThis_Group()">';
echo '<table>';

switch($s){
	case 'g':
		echo '<input type="hidden" id="groupID" value="'.$groupID.'"/>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Name</td>';
		echo '<td class="mainContent_Body_Form_Fields"><input type="text" id="editGroup_Name" value="'.$groupName.'" /></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Description</td>';
		echo '<td class="mainContent_Body_Form_Fields"><textarea id="editGroup_Desc">'.$groupDesc.'</textarea></td>';
		echo '</tr>';
		echo '<tr><td class="mainContent_Body_Form_Labels">&nbsp;</td><td class="mainContent_Body_Form_Buttons"><table class="formTable"><tr><td class="formDisable_Td">';
		echo '&nbsp;</td><td class="formSubmit_Td"><input class="formSubmit" type="submit" value="SUBMIT" /></td></tr></table></td></tr>';
		echo '</table></form></div>';
		
		//check for ative stuff in group		
		if ($groupActive==1) {
			$oquery = "SELECT * FROM Organization WHERE Group_ID = ".$groupID." AND Active=1";

			if ($oresult = mysqli_query($groupConnection, $oquery)){
			
				if(@mysqli_num_rows($oresult)){
					echo 'CANNOT DISABLE AT THIS TIME.';
				}
				else {
					echo '<div id="mainContent_Form_Disable_Btm"><a href="javascript:disableThis_Group('.$groupID.');">DISABLE</a></div>';
				}
			}
		}
		elseif ($groupActive==0) {
			echo '<div id="mainContent_Form_Enable_Btm"><a href="javascript:enableThis_Group('.$groupID.');">ENABLE</a></div>';
		}
				
		
		
	break;
	case 'o':
	echo '<tr><td align="center"><strong>Please Choose a Group Level</strong></td></tr>';
	echo '</table></form></div>';
	break;
	case 'c':
	echo '<tr><td align="center"><strong>Please Choose a Group Level</strong></td></tr>';
	echo '</table></form></div>';
	break;
	default:
		echo "Oops, something went wrong.";
		break;

}


	
echo '<div id="mainContent_Body_Cancel_Btm"><a href="javascript:groupAdmin();">BACK</a></div><!-- end data rows section --></div>';
	$aResult->close();
	$uResult1->close();
	
	mysqli_close($acctConnection);
	mysqli_close($userConnection);
	mysqli_close($groupConnection);
			}
	}

$result->close();

mysqli_close($groupConnection);

}
}
else {
	echo '<div id="mainContent_Body_List"><div id="mainContent_Body_List_Header_Bar">';
	echo 'sorry';
	echo '</div></div>';
}


?>