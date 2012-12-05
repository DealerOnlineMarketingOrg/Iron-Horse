<?php
if (!session_id()) session_start();

echo '';

require_once($_SERVER['DOCUMENT_ROOT'] . "/lib/permissions.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/acctgate.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/usergate.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/groupgate.php");

$selected = $_SESSION['c'];

echo '<div id="mainContent_Body_List"><div id="mainContent_Body_List_Header_Bar">';
echo '<!-- begin header row of listing sections -->';
echo '<table class="mainContent_Body_List_Table">';
echo '<tr class="mainContent_Body_List_Table_Tr">';
echo '<th class="mainContent_Body_List_Table_Tr_Th mainContent_Body_List_Table_Tr_Th_Item_Edge_First">NAME</th>';
echo '<th class="mainContent_Body_List_Table_Tr_Th mainContent_Body_List_Table_Tr_Th_Item_Edge">DESCRIPTION</th>';
echo '<th class="mainContent_Body_List_Table_Tr_Th mainContent_Body_List_Table_Tr_Th_Item_Edge">STATUS</th>';
echo '<th class="mainContent_Body_List_Table_Tr_Th mainContent_Body_List_Table_Tr_Th_Item_Edge_Last">EDIT</th>';
echo '</tr>';
if ($permNum==0){
$s = $selected[0];

switch($s){
	case 'g':
		$query = "SELECT * FROM Groups ORDER BY Group_Name ASC";
		
		if ($result = mysqli_query($groupConnection, $query)){
			while($groupsRow = $result->fetch_row()){
				echo '<tr class="mainContent_Body_List_Table_Tr">';
				echo '<td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item2 mainContent_Body_List_Table_Tr_Td_Item_Edge_First">';
				echo $groupsRow[1];
				echo '</td>';
				echo '<td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Name mainContent_Body_List_Table_Tr_Td_Item_Edge">';
				echo $groupsRow[2];
				echo '</td>';
				
				echo '<td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Name mainContent_Body_List_Table_Tr_Td_Item_Edge">';
				echo '<div id="';
				if ($groupsRow[3]==1){
					echo 'statusIcon_Active';
				}
				else {
					echo 'statusIcon_Disabled';
				}
				echo '"></div>';
						
				echo '</td>';				
				echo '<td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Name mainContent_Body_List_Table_Tr_Td_Item_Edge_Last">';
				echo '<a href="javascript:editGroup('.$groupsRow[0].');">Edit</a>';
				echo '</td>';
				echo '</tr>';
				
			}
		}
		echo '</table>';
		$result->close();

		mysqli_close($groupConnection);
	
	break;
		
	case 'o': 
		echo '<tr><td align="center"><strong>Please Choose a Group Level</strong></td></tr>';
		echo '</table>';
	break;
		
	case 'c':
		echo '<tr><td align="center"><strong>Please Choose a Group Level</strong></td></tr>';
		echo '</table>';
	
	break; 
	
	default:
		echo "Oops, something went wrong.";
		break;
}
}else {
	echo '<div id="mainContent_Body_List"><div id="mainContent_Body_List_Header_Bar">';
	echo 'sorry';
	echo '</div></div>';
}
?>