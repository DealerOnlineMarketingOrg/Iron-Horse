<?php // echo 'user list and edit'; 

if (!session_id()) session_start();

echo '';

require_once($_SERVER['DOCUMENT_ROOT'] . "/lib/permissions.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/groupgate.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/acctgate.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/usergate.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/contgate.php");

$selected = $_SESSION['c'];

if (isset($_POST['selected'])){
	$selected = $_POST['selected'];
}

echo '<div id="mainContent_Body_List"><div id="mainContent_Body_List_Header_Bar">';
echo '<!-- begin header row of listing sections -->';
echo '<table class="mainContent_Body_List_Table">';
echo '<tr class="mainContent_Body_List_Table_Tr">';
echo '<th class="mainContent_Body_List_Table_Tr_Th mainContent_Body_List_Table_Tr_Th_Item_Edge_First">NAME</th>';
echo '<th class="mainContent_Body_List_Table_Tr_Th mainContent_Body_List_Table_Tr_Th_Item_Edge">EMAIL</th>';
echo '<th class="mainContent_Body_List_Table_Tr_Th mainContent_Body_List_Table_Tr_Th_Item_Edge">CELL&nbsp;PHONE</th>';
echo '<th class="mainContent_Body_List_Table_Tr_Th mainContent_Body_List_Table_Tr_Th_Item_Edge_Last">EDIT</th>';
echo '</tr>';

$s = $selected[0];

switch($s){
	case 'g': 
		$gQuery = 'SELECT Org_ID FROM Organization WHERE Group_ID = ' . substr($selected, 1);
		$gResult = mysqli_query($groupConnection, $gQuery);
		
		if (@mysqli_num_rows($gResult)){
			while ($orgID = mysqli_fetch_row($gResult)){
		
				$oquery = 'SELECT * FROM Clients WHERE Org_ID = ' . $orgID[0];
				$oresult = mysqli_query($groupConnection, $oquery);
		
				if (@mysqli_num_rows($oresult)){
					while ($client = mysqli_fetch_row($oresult)){
						
						$cquery = 'SELECT * FROM Contacts WHERE C_ID = ' . $client[0] . ' ORDER BY Contact_Last_Name ASC';
						$cresult = mysqli_query($contConnection, $cquery);
						
						if (@mysqli_num_rows($cresult)){
						while ($contact = mysqli_fetch_row($cresult)){
						
						echo '<tr class="mainContent_Body_List_Table_Tr">';
						echo '<td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge_First">';
						echo '<a style="text-decoration: none; color: #000;" href="javascript:viewContact('.$contact[0].')">';
						echo $contact[2].', '.$contact[1];
						echo '</a>';
						echo '</td><td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge">';
						echo $contact[3];
						echo '</td><td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge">';
						echo $contact[7];
						echo '<td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge_Last">';
						echo '<a href="javascript:editContact('.$contact[0].')">edit</a></td></tr>';
							}
						}
				
					}
				}
			}
		}
		break;
		
	case 'o': 
			$oquery = 'SELECT * FROM Clients WHERE Org_ID = ' . substr($selected, 1);
			$oresult = mysqli_query($groupConnection, $oquery);
		
			if (@mysqli_num_rows($oresult)){
				while ($client = mysqli_fetch_row($oresult)){
						
					$cquery = 'SELECT * FROM Contacts WHERE C_ID = ' . $client[0];
					$cresult = mysqli_query($contConnection, $cquery);
					
					if (@mysqli_num_rows($cresult)){
					while ($contact = mysqli_fetch_row($cresult)){
						
						echo '<tr class="mainContent_Body_List_Table_Tr">';
						echo '<td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge_First">';
						echo '<a style="text-decoration: none; color: #000;" href="javascript:viewContact('.$contact[0].')">';
						echo $contact[2].', '.$contact[1];
						echo '</a>';
						echo '</td><td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge">';
						echo $contact[3];
						echo '</td><td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge">';
						echo $contact[5];
						echo '<td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge_Last">';
						echo '<a href="javascript:editContact('.$contact[0].')">edit</a></td></tr>';
						}
					}
				
				}
			}
		break;
		
	case 'c': 
			$cquery = 'SELECT * FROM Contacts WHERE C_ID = ' . substr($selected, 1);
					$cresult = mysqli_query($contConnection, $cquery);
					
					if (@mysqli_num_rows($cresult)){
					while ($contact = mysqli_fetch_row($cresult)){
						
						echo '<tr class="mainContent_Body_List_Table_Tr">';
						echo '<td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge_First">';
						echo '<a style="text-decoration: none; color: #000;" href="javascript:viewContact('.$contact[0].')">';
						echo $contact[2].', '.$contact[1];
						echo '</a>';
						echo '</td><td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge">';
						echo $contact[3];
						echo '</td><td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge">';
						echo $contact[5];
						echo '<td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge_Last">';
						echo '<a href="javascript:editContact('.$contact[0].')">edit</a></td></tr>';
						}
					}
		break;
default:
		echo "Oops, something went wrong.";
		break;
}

echo '</table></div><!-- end data rows section --></div>';
?>