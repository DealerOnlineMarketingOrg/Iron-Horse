<?php // echo 'admin tool dashboard'; 

if (!session_id()) session_start();

echo '';

require_once($_SERVER['DOCUMENT_ROOT'] . "/lib/permissions.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/groupgate.php");

if (isset($_SESSION['c'])){
	$selected = $_SESSION['c'];
}

echo '<div id="mainContent_Body_List"><div id="mainContent_Body_List_Header_Bar"><!-- begin header row of listing sections --><table class="mainContent_Body_List_Table"><tr class="mainContent_Body_List_Table_Tr"><th class="mainContent_Body_List_Table_Tr_Th mainContent_Body_List_Table_Tr_Th_Item_Edge_First">CODE</th><th class="mainContent_Body_List_Table_Tr_Th mainContent_Body_List_Table_Tr_Th_Name mainContent_Body_List_Table_Tr_Th_Item_Edge">CLIENT NAME</th><th class="mainContent_Body_List_Table_Tr_Th mainContent_Body_List_Table_Tr_Th_Item_Edge">STATUS</th><th class="mainContent_Body_List_Table_Tr_Th mainContent_Body_List_Table_Tr_Th_Item_Edge">EDIT</th><th class="mainContent_Body_List_Table_Tr_Th mainContent_Body_List_Table_Tr_Th_Item_Edge">SEE<br/>USERS</th><th class="mainContent_Body_List_Table_Tr_Th mainContent_Body_List_Table_Tr_Th_Item_Edge">WEBSITES</th><th class="mainContent_Body_List_Table_Tr_Th mainContent_Body_List_Table_Tr_Th_Item_Edge_Last">CONTACTS</th></tr>';

$s = $selected[0];
switch($s){
	case 'g':
		$query = 'SELECT * FROM Clients INNER JOIN (SELECT Org_ID FROM Organization WHERE Group_ID = ' . substr($selected, 1) . ') AS Orgs On Clients.Org_ID = Orgs.Org_ID ORDER BY C_Code ASC';
		$result = mysqli_query($groupConnection, $query);
		if (@mysqli_num_rows($result)){
			while ($client = mysqli_fetch_row($result)){
				echo '<tr class="mainContent_Body_List_Table_Tr">';
				echo '<td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge_First">';
						
				if ($permNum <=10) {
					echo '<a href="javascript:viewClient('.$client[0].')" style="text-decoration:none;">';
					echo $client[12];
					echo '</a>';
				}
				else {
					echo $client[12];
				}
						
				echo '</td><td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Name mainContent_Body_List_Table_Tr_Td_Item_Edge">';
				echo $client[1];
				echo '</td><td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge"><div id="';
				if ($client[14] == 1){
					echo 'statusIcon_Active';
				}
				else {
					echo 'statusIcon_Disabled';
				}
				echo '"></div></td><td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge">';
						
				echo '<a href="javascript:editClient('.$client[0].')" >';
				echo 'edit';
				echo '</a>';
				echo '</td><td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge"><a href="javascript:selectClient_Users('."'c" . $client[0] . "'".')">';
				echo '<div id="userIcon"></div>users</td></a><td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge">';
				echo '<a href="javascript:selectWebsites('."'".'c'.$client[0]."'".')"><div id="webIcon"></div>websites</a></td><td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge_Last">';
				echo '<a href="javascript:selectContacts('."'".'c'.$client[0]."'".')"><div id="viewIcon"></div>contacts</a></td></tr>';
			}
		}
		break;
	case 'o':
		$query = 'SELECT * FROM Clients WHERE Org_ID = ' . substr($selected, 1) . ' ORDER BY C_Code ASC';
		$result = mysqli_query($groupConnection, $query);
		if (@mysqli_num_rows($result)){
			while ($client = mysqli_fetch_row($result)){
				echo '<tr class="mainContent_Body_List_Table_Tr">';
				echo '<td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge_First">';
				if ($permNum <=10) {
					echo '<a href="javascript:viewClient('.$client[0].')" style="text-decoration:none;">';
					echo $client[12];
					echo '</a>';
				}
				else {
					echo $client[12];
				}
				echo '</td><td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Name mainContent_Body_List_Table_Tr_Td_Item_Edge">';
				echo $client[1];
				echo '</td><td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge"><div id="';
				if ($client[14] == 1){
					echo 'statusIcon_Active';
				}
				else {
					echo 'statusIcon_Disabled';
				}
				echo '"></div></td><td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge">';
				echo '<a href="javascript:editClient('.$client[0].')" >';
				echo 'edit';
				echo '</a>';
				echo '</td><td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge"><a href="javascript:selectClient_Users('."'c" . $client[0] . "'".')">';
				echo '<div id="userIcon"></div>users</td><td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge">';
				echo '<a href="javascript:selectWebsites('."'".'c'.$client[0]."'".')"><div id="webIcon"></div>websites</a></td><td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge_Last"><';
				echo '<a href="javascript:selectContacts('."'".'c'.$client[0]."'".')"><div id="viewIcon"></div>contacts</a></td></tr>';
			}
		}
		break;
	case 'c':
		$query = 'SELECT * FROM Clients WHERE C_ID = ' . substr($selected, 1) . ' ORDER BY C_Code ASC';
		$result = mysqli_query($groupConnection, $query);
		if (@mysqli_num_rows($result)){
			while ($client = mysqli_fetch_row($result)){
				echo '<tr class="mainContent_Body_List_Table_Tr">';
				echo '<td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge_First">';

				if ($permNum <=10) {
					echo '<a href="javascript:viewClient('.$client[0].')" style="text-decoration:none;">';
					echo $client[12];
					echo '</a>';
				}
				else {
					echo $client[12];
				}
				
				echo '</td><td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Name mainContent_Body_List_Table_Tr_Td_Item_Edge">';
				echo $client[1];
				echo '</td><td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge"><div id="';
				if ($client[14] == 1){
					echo 'statusIcon_Active';
				}
				else {
					echo 'statusIcon_Disabled';
				}
				echo '"></div></td><td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge">';
				echo '<a href="javascript:editClient('.$client[0].')" >';
				echo 'edit';
				echo '</a>';
				echo '</td><td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge"><a href="javascript:selectClient_Users('."'c" . $client[0] . "'".')">';
				echo '<div id="userIcon"></div>users</td><td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge">';
				echo '<a href="javascript:selectWebsites('."'".'c'.$client[0]."'".')"><div id="webIcon"></div>websites</a></td><td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge_Last">';
				echo '<a href="javascript:selectContacts('."'".'c'.$client[0]."'".')"><div id="viewIcon"></div>contacts</a></td></tr>';
			}
		}
		break;
	default:
		echo "Oops, something went wrong.";
		break;
}

echo '</table></div><!-- end data rows section --></div>';

?>