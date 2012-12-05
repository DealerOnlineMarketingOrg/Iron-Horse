<?php

if (!session_id()) session_start();

echo '';

require_once($_SERVER['DOCUMENT_ROOT'] . "/lib/permissions.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/contgate.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/groupgate.php");


$selected = $_SESSION['c'];

//echo '<tr><td align="center"><strong>'.$permNum.'</strong></td></tr>';
$s = $selected[0];

echo '<div id="mainContent_Body_List"><div id="mainContent_Body_List_Header_Bar">';
echo '<!-- begin form for groups -->';
echo '<div id="mainContent_Body_Form">';
echo '<form id="editThis_Contact" action="javascript:editThis_Contact()">';
echo '<table>';
	
switch($s){
	case 'g':
	
		if(isset($_POST['id'])){
			$contQuery = 'SELECT * FROM Websites WHERE Id = ' . $_POST['id'];
			$result = mysqli_query($groupConnection, $contQuery);
			if (@mysqli_num_rows($result)){
				while($contRow = $contResult->fetch_row()){
					$Website_ID = $contRow[0];
					$C_ID = $contRow[1];
					$Url = $contRow[2];
					$Desc = $contRow[3];				
		
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Client</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					$cQuery = 'SELECT * FROM Clients WHERE C_ID = ' . $CID;
					$cResult = mysqli_query($groupConnection, $cQuery);
					if (@mysqli_num_rows($cResult)){
						while ($cRow = mysqli_fetch_row($cResult)){
							echo $cRow[1];
						}
					}
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">URL</td>';
					echo '<td class="mainContent_Body_Form_Fields">'.$Url.'</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Description</td>';
					echo '<td class="mainContent_Body_Form_Fields">'.$Desc.'</td>';
					echo '</tr>';
		
				}
			}
		}
		break;
	case 'o':
		if(isset($_POST['id'])){
			$contQuery = 'SELECT * FROM Websites WHERE Id = ' . $_POST['id'];
			$result = mysqli_query($groupConnection, $contQuery);
			if (@mysqli_num_rows($result)){
				while($contRow = $contResult->fetch_row()){
					$Website_ID = $contRow[0];
					$C_ID = $contRow[1];
					$Url = $contRow[2];
					$Desc = $contRow[3];				
		
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Client</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					$cQuery = 'SELECT * FROM Clients WHERE C_ID = ' . $CID;
					$cResult = mysqli_query($groupConnection, $cQuery);
					if (@mysqli_num_rows($cResult)){
						while ($cRow = mysqli_fetch_row($cResult)){
							echo $cRow[1];
						}
					}
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">URL</td>';
					echo '<td class="mainContent_Body_Form_Fields">'.$Url.'</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Description</td>';
					echo '<td class="mainContent_Body_Form_Fields">'.$Desc.'</td>';
					echo '</tr>';
		
				}
			}
		}
		break;
	case 'c':
		if(isset($_POST['id'])){
			$contQuery = 'SELECT * FROM Websites WHERE Id = ' . $_POST['id'];
			$result = mysqli_query($groupConnection, $contQuery);
			if (@mysqli_num_rows($result)){
				while($contRow = $contResult->fetch_row()){
					$Website_ID = $contRow[0];
					$C_ID = $contRow[1];
					$Url = $contRow[2];
					$Desc = $contRow[3];				
		
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Client</td>';
					echo '<td class="mainContent_Body_Form_Fields">';
					$cQuery = 'SELECT * FROM Clients WHERE C_ID = ' . $CID;
					$cResult = mysqli_query($groupConnection, $cQuery);
					if (@mysqli_num_rows($cResult)){
						while ($cRow = mysqli_fetch_row($cResult)){
							echo $cRow[1];
						}
					}
					echo '</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">URL</td>';
					echo '<td class="mainContent_Body_Form_Fields">'.$Url.'</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="mainContent_Body_Form_Labels">Description</td>';
					echo '<td class="mainContent_Body_Form_Fields">'.$Desc.'</td>';
					echo '</tr>';
		
				}
			}
		}
		break;
	default:
		echo "Oops, something went wrong.";
		break;

}
echo '</table></form></div><div id="mainContent_Body_Cancel_Btm"><a href="javascript:contactAdmin();">BACK</a></div><!-- end data rows section --></div>';
	$aResult->close();
	$uResult1->close();
	
	mysqli_close($acctConnection);
	mysqli_close($userConnection);
	mysqli_close($groupConnection);
/*else {
	echo '<div id="mainContent_Body_List"><div id="mainContent_Body_List_Header_Bar">';
	echo 'sorry';
	echo '</div></div>';
}*/


?>