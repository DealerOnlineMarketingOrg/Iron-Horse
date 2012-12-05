<?php // echo 'user list and edit'; 

if (!session_id()) session_start();

echo '';

require_once($_SERVER['DOCUMENT_ROOT'] . "/lib/permissions.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/acctgate.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/usergate.php");

$selected = $_SESSION['c'];

if (isset($_POST['selected'])){
	$selected = $_POST['selected'];
}
//echo 'var: ' . $_POST['selected'];

echo '<div id="mainContent_Body_List"><div id="mainContent_Body_List_Header_Bar">';
echo '<!-- begin header row of listing sections -->';
echo '<table class="mainContent_Body_List_Table">';
echo '<tr class="mainContent_Body_List_Table_Tr">';
echo '<th class="mainContent_Body_List_Table_Tr_Th mainContent_Body_List_Table_Tr_Th_Item_Edge_First mainContent_Body_List_Table_Tr_Th_Item_Edge_Urlcode">CODE</th>';
echo '<th class="mainContent_Body_List_Table_Tr_Th mainContent_Body_List_Table_Tr_Th_Item_Edge">URL</th>';
echo '<th class="mainContent_Body_List_Table_Tr_Th mainContent_Body_List_Table_Tr_Th_Item_Edge_Last">VIEW</th>';
echo '</tr>';

$s = $selected[0];

switch($s){
	case 'g': 
		$query = 'SELECT * FROM Clients INNER JOIN (SELECT Org_ID FROM Organization WHERE Group_ID = ' . substr($selected, 1) . ') AS Orgs On Clients.Org_ID = Orgs.Org_ID ORDER BY C_Code ASC';
		$result = mysqli_query($groupConnection, $query);
		
		if (@mysqli_num_rows($result)){
			while ($client = mysqli_fetch_row($result)){
						
				$wquery = 'SELECT * FROM Websites WHERE C_ID = ' . $client[0];
				$wresult = mysqli_query($groupConnection, $wquery);
						
				if (@mysqli_num_rows($wresult)){
					while ($website = mysqli_fetch_row($wresult)){
						
						echo '<tr class="mainContent_Body_List_Table_Tr">';
						echo '<td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge_First">';
						echo '<a href="javascript:viewWebsite('.$website[0].')" style="color:#000;">'.$client[12].'</a>';
						echo '</td><td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge">';
						echo '<a target="new" href="';
						if (substr($website[2], 0, 7) == "http://"){
							echo $website[2];
						}
						elseif (substr($website[2], 0, 8) == "https://"){
							echo $website[2];
						}
						else {
							echo 'http://' . $website[2]; 
						}
						echo '" style="color:#000;">'.$website[2].'</a>';
						echo '<td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge_Last">';
						echo '<a href="javascript:editWebsite('.$website[0].')">edit</a></td></tr>';
					}
				}
				
			}
		}
		break;
		
	case 'o': 
		$oquery = 'SELECT * FROM Clients WHERE Org_ID = ' . substr($selected, 1) . ' ORDER BY C_Code ASC';
		$oresult = mysqli_query($groupConnection, $oquery);
		
		if (@mysqli_num_rows($oresult)){
			while ($client = mysqli_fetch_row($oresult)){
			
				$wquery = 'SELECT * FROM Websites WHERE C_ID = ' . $client[0];
				$wresult = mysqli_query($groupConnection, $wquery);
					
				if (@mysqli_num_rows($wresult)){
					while ($website = mysqli_fetch_row($wresult)){
						
						echo '<tr class="mainContent_Body_List_Table_Tr">';
						echo '<td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge_First">';
						echo '<a href="javascript:viewWebsite('.$website[0].')" style="color:#000;">'.$client[12].'</a>';
						echo '</td><td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge">';
						echo '<a target="new" href="';
						if (substr($website[2], 0, 7) == "http://"){
							echo $website[2];
						}
						elseif (substr($website[2], 0, 8) == "https://"){
							echo $website[2];
						}
						else {
							echo 'http://' . $website[2]; 
						}
						echo '" style="color:#000;">'.$website[2].'</a>';
						echo '<td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge_Last">';
						echo '<a href="javascript:editWebsite('.$website[0].')">edit</a></td></tr>';
					}
				}
				
			}
		}
		break;
		
	case 'c': 
		$oquery = 'SELECT * FROM Clients WHERE C_ID = ' . substr($selected, 1);
		$oresult = mysqli_query($groupConnection, $oquery);
			
		if (@mysqli_num_rows($oresult)){
			while ($client = mysqli_fetch_row($oresult)){
				$wquery = 'SELECT * FROM Websites WHERE C_ID = ' . $client[0] . ' ORDER BY Url ASC';
				$wresult = mysqli_query($groupConnection, $wquery);
								
				if (@mysqli_num_rows($wresult)){
					while ($website = mysqli_fetch_row($wresult)){
							
						echo '<tr class="mainContent_Body_List_Table_Tr">';
						echo '<td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge_First">';
						echo '<a href="javascript:viewWebsite('.$website[0].')" style="color:#000;">'.$client[12].'</a>';
						echo '</td><td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge">';
						echo '<a target="new" href="';
						if (substr($website[2], 0, 7) == "http://"){
							echo $website[2];
						}
						elseif (substr($website[2], 0, 8) == "https://"){
							echo $website[2];
						}
						else {
							echo 'http://' . $website[2]; 
						}
						echo '" style="color:#000;">'.$website[2].'</a>';
						echo '<td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item mainContent_Body_List_Table_Tr_Td_Item_Edge_Last">';
						echo '<a href="javascript:editWebsite('.$website[0].')">edit</a></td></tr>';
					}
				}
			}
		}
		break;
}