<?php // echo 'user list and edit'; 

if (!session_id()) session_start();

echo '';

require_once($_SERVER['DOCUMENT_ROOT'] . "/lib/permissions.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/acctgate.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/usergate.php");



//User Name
//Client Assocation
//Active

$selected = $_SESSION['c'];

if (isset($_POST['selected'])){
	$selected = $_POST['selected'];
}


echo '<div id="mainContent_Body_List"><div id="mainContent_Body_List_Header_Bar">';
echo '<!-- begin header row of listing sections -->';
echo '<table class="mainContent_Body_List_Table">';
echo '<tr class="mainContent_Body_List_Table_Tr">';
echo '<th class="mainContent_Body_List_Table_Tr_Th mainContent_Body_List_Table_Tr_Th_Item_Edge_First">USERNAME</th>';
echo '<th class="mainContent_Body_List_Table_Tr_Th mainContent_Body_List_Table_Tr_Th_Item_Edge mainContent_Body_List_Table_Tr_Th_FLName">NAME</th>';
echo '<th class="mainContent_Body_List_Table_Tr_Th mainContent_Body_List_Table_Tr_Th_Item_Edge">STATUS</th>';
echo '<th class="mainContent_Body_List_Table_Tr_Th mainContent_Body_List_Table_Tr_Th_Item_Edge">CREATED</th>';
echo '<th class="mainContent_Body_List_Table_Tr_Th mainContent_Body_List_Table_Tr_Th_Item_Edge_Last">EDIT</th>';
echo '</tr>';

$s = $selected[0];
switch($s){
	case 'g':
		$gQuery = 'SELECT * FROM Clients INNER JOIN (SELECT Org_ID FROM Organization WHERE Group_ID = ' . substr($selected, 1) . ') AS Orgs On Clients.Org_ID = Orgs.Org_ID ORDER BY C_Code ASC';
		$gResult = mysqli_query($groupConnection, $gQuery);
		
		if (@mysqli_num_rows($gResult)){
			while ($client = mysqli_fetch_row($gResult)){
				$aQuery = 'SELECT * FROM ACCT_Info WHERE C_ID = ' . $client[0];
				$aResult = mysqli_query($acctConnection, $aQuery);
				if (@mysqli_num_rows($aResult)){
					while($userAcct = mysqli_fetch_row($aResult)){
						$uQuery = 'SELECT * FROM Users WHERE User_ID = ' . $userAcct[0] . ' ORDER BY User_Name ASC';
						$uResult = mysqli_query($userConnection, $uQuery);
						if (@mysqli_num_rows($uResult)){
							while($user = mysqli_fetch_row($uResult)){
								echo '<tr class="mainContent_Body_List_Table_Tr">';
								echo '<td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item2 mainContent_Body_List_Table_Tr_Td_Item_Edge_First">';
								echo $user[1];
								echo '</td>';
											
								echo '<td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Name mainContent_Body_List_Table_Tr_Td_Item_Edge">';
								echo $userAcct[3].', '.$userAcct[2];
								echo '</td>';
											
								echo '<td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Name mainContent_Body_List_Table_Tr_Td_Item_Edge">';
								echo '<div id="';
								if ($userAcct[11]==1){
									echo 'statusIcon_Active';
								}
								else {
									echo 'statusIcon_Disabled';
								}
								echo '"></div>';
											
								echo '</td>';
											
								echo '<td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Name mainContent_Body_List_Table_Tr_Td_Item_Edge">';
								echo $userAcct[12];
								echo '</td>';
											
								echo '<td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Name mainContent_Body_List_Table_Tr_Td_Item_Edge_Last">';
											
								if($permNum==0){
									echo '<a href="javascript:editUser('.$user[0].');">Edit</a>';
								}
								elseif($userAcct[9]>=10&&$permNum<=10){
									echo '<a href="javascript:editUser('.$user[0].');">Edit</a>';
								}
								elseif($userAcct[9]>=20&&$permNum<=20){
									echo '<a href="javascript:editUser('.$user[0].');">Edit</a>';
								}
								elseif($userAcct[9]>=30&&$permNum<=30){
									echo '<a href="javascript:editUser('.$user[0].');">Edit</a>';
								}
								elseif($userAcct[9]>=40&&$permNum<=40){
									echo '<a href="javascript:editUser('.$user[0].');">Edit</a>';
								}
								else{
									echo 'N/A';
								}
								echo '</td>';
								echo '</tr>';
								//User Ending 
							}
						}
					}
				}
			}
		}
		//ACCT ending
		break;
		
	case 'o': 
		$oquery = 'SELECT * FROM Clients WHERE Org_ID = ' . substr($selected, 1) . 'ORDER BY C_Code ASC';
		$oresult = mysqli_query($groupConnection, $oquery);
		
		if (@mysqli_num_rows($oresult)){
			while ($client = mysqli_fetch_row($oresult)){
						
		
				$aQuery = 'SELECT * FROM ACCT_Info WHERE C_ID = ' . $client[0];
				$aResult = mysqli_query($acctConnection, $aQuery);
				if (@mysqli_num_rows($aResult)){
					while($userAcct = mysqli_fetch_row($aResult)){
						$uQuery = 'SELECT * FROM Users WHERE User_ID = ' . $userAcct[0] . ' ORDER BY User_Name ASC';
						$uResult = mysqli_query($userConnection, $uQuery);
						if (@mysqli_num_rows($uResult)){
							while($user = mysqli_fetch_row($uResult)){
								echo '<tr class="mainContent_Body_List_Table_Tr">';
								echo '<td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item2 mainContent_Body_List_Table_Tr_Td_Item_Edge_First">';
								echo $user[1];
								echo '</td>';
											
								echo '<td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Name mainContent_Body_List_Table_Tr_Td_Item_Edge">';
								echo $userAcct[3].', '.$userAcct[2];
								echo '</td>';
											
								echo '<td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Name mainContent_Body_List_Table_Tr_Td_Item_Edge">';
								echo '<div id="';
								if ($userAcct[11]==1){
									echo 'statusIcon_Active';
								}
								else {
									echo 'statusIcon_Disabled';
								}
								echo '"></div>';
											
								echo '</td>';
											
								echo '<td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Name mainContent_Body_List_Table_Tr_Td_Item_Edge">';
								echo $userAcct[12];
								echo '</td>';
											
								echo '<td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Name mainContent_Body_List_Table_Tr_Td_Item_Edge_Last">';
								if($permNum==0){
									echo '<a href="javascript:editUser('.$user[0].');">Edit</a>';
								}
								elseif($userAcct[9]>=10&&$permNum<=10){
									echo '<a href="javascript:editUser('.$user[0].');">Edit</a>';
								}
								elseif($userAcct[9]>=20&&$permNum<=20){
									echo '<a href="javascript:editUser('.$user[0].');">Edit</a>';
								}
								elseif($userAcct[9]>=30&&$permNum<=30){
									echo '<a href="javascript:editUser('.$user[0].');">Edit</a>';
								}
								elseif($userAcct[9]>=40&&$permNum<=40){
									echo '<a href="javascript:editUser('.$user[0].');">Edit</a>';
								}
								else{
									echo 'N/A';
								}
								echo '</td>';
								echo '</tr>';
								//User Ending 
							}
						}
					}
				}
			}
		}
		//ACCT ending	
		break;
		
	case 'c':
		$aQuery = 'SELECT * FROM ACCT_Info WHERE C_ID = ' . substr($selected, 1);
		$aResult = mysqli_query($acctConnection, $aQuery);
		if (@mysqli_num_rows($aResult)){
			while($userAcct = mysqli_fetch_row($aResult)){
				$uQuery = 'SELECT * FROM Users WHERE User_ID = ' . $userAcct[0] . ' ORDER BY User_Name ASC';
				$uResult = mysqli_query($userConnection, $uQuery);
				if (@mysqli_num_rows($uResult)){
					while($user = mysqli_fetch_row($uResult)){
						echo '<tr class="mainContent_Body_List_Table_Tr">';
						echo '<td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Item2 mainContent_Body_List_Table_Tr_Td_Item_Edge_First">';
						echo $user[1];
						echo '</td>';
							
						echo '<td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Name mainContent_Body_List_Table_Tr_Td_Item_Edge">';
						echo $userAcct[3].', '.$userAcct[2];
						echo '</td>';
							
						echo '<td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Name mainContent_Body_List_Table_Tr_Td_Item_Edge">';
						echo '<div id="';
						if ($userAcct[11]==1){
							echo 'statusIcon_Active';
						}
						else {
							echo 'statusIcon_Disabled';
						}
						echo '"></div>';
							
						echo '</td>';
							
						echo '<td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Name mainContent_Body_List_Table_Tr_Td_Item_Edge">';
						echo $userAcct[12];
						echo '</td>';
							
						echo '<td class="mainContent_Body_List_Table_Tr_Td mainContent_Body_List_Table_Tr_Td_Name mainContent_Body_List_Table_Tr_Td_Item_Edge_Last">';
						if($permNum==0){
							echo '<a href="javascript:editUser('.$user[0].');">Edit</a>';
						}
						elseif($userAcct[9]>=10&&$permNum<=10){
							echo '<a href="javascript:editUser('.$user[0].');">Edit</a>';
						}
						elseif($userAcct[9]>=20&&$permNum<=20){
							echo '<a href="javascript:editUser('.$user[0].');">Edit</a>';
						}
						elseif($userAcct[9]>=30&&$permNum<=30){
							echo '<a href="javascript:editUser('.$user[0].');">Edit</a>';
						}
						elseif($userAcct[9]>=40&&$permNum<=40){
							echo '<a href="javascript:editUser('.$user[0].');">Edit</a>';
						}
						else{
							echo 'N/A';
						}
						echo '</td>';
						echo '</tr>';
						//User Ending 
					}
				}
				//ACCT ending
			}
		}
		break;
		
	default:
		echo "Oops, something went wrong.";
		break;

}
echo '</table></div>';
//<div id="mainContent_Body_Cancel_Btm"><a href="javascript:adminTools();">BACK</a></div>
echo '<!-- end data rows section --></div>';
	$aResult->close();
	$uResult1->close();
	
	mysqli_close($acctConnection);
	mysqli_close($userConnection);

?>