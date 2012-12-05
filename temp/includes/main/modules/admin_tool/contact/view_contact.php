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
		$contQuery = 'SELECT * FROM Contacts WHERE Contact_ID = ' . $_POST['id'];
		if ($contResult = mysqli_query($contConnection, $contQuery)){
			while($contRow = $contResult->fetch_row()){
				$Contact_ID = $contRow[0];
				$FirstName = $contRow[1];
				$LastName = $contRow[2];
				$EmailWork = $contRow[3];
				$EmailHome = $contRow[4];
				$PhoneWork = $contRow[5];
				$PhoneHome = $contRow[6];
				$CellPhone = $contRow[7];
				$FaxPhone = $contRow[8];
				$Address = $contRow[9];
				$Address1 = $contRow[10];
				$City = $contRow[11];
				$State = $contRow[12];
				$Zip = $contRow[13];
				$Type = $contRow[14];
				$Comments = $contRow[15];
				$CID = $contRow[16];
				$VID = $contRow[17];
				
		
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">First Name</td>';
		echo '<td class="mainContent_Body_Form_Fields">'.$FirstName.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Last Name</td>';
		echo '<td class="mainContent_Body_Form_Fields">'.$LastName.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Work Email</td>';
		echo '<td class="mainContent_Body_Form_Fields"><a href="mailto:'.$EmailWork.'">'.$EmailWork.'</a></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Home Email</td>';
		echo '<td class="mainContent_Body_Form_Fields"><a href="mailto:'.$EmailHome.'">'.$EmailHome.'</a></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Work Phone</td>';
		echo '<td class="mainContent_Body_Form_Fields">'.$PhoneWork.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Home Phone</td>';
		echo '<td class="mainContent_Body_Form_Fields">'.$PhoneHome.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Cellphone</td>';
		echo '<td class="mainContent_Body_Form_Fields">'.$CellPhone.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Fax</td>';
		echo '<td class="mainContent_Body_Form_Fields">'.$FaxPhone.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Address</td>';
		echo '<td class="mainContent_Body_Form_Fields">'.$Address.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Address 2</td>';
		echo '<td class="mainContent_Body_Form_Fields">'.$Address1.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">City</td>';
		echo '<td class="mainContent_Body_Form_Fields">'.$City.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">State</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		
		echo $State;
		
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Zip</td>';
		echo '<td class="mainContent_Body_Form_Fields">'.$Zip.'</td>';
		echo '</tr>';
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
		echo '<td class="mainContent_Body_Form_Labels">Comment</td>';
		echo '<td class="mainContent_Body_Form_Fields">'.$Comments.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Contact Type</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		
		$query = 'SELECT * FROM Cont_Type WHERE Cont_ID = '.$Type;
		$result = mysqli_query($contConnection, $query);
		if (@mysqli_num_rows($result)){
			while ($row = mysqli_fetch_row($result)){
				 echo $row[1];
			}
		}
		
		echo '</tr>';
		
			}
		}
	}
	
		break;
	case 'o':
		if(isset($_POST['id'])){
		$contQuery = 'SELECT * FROM Contacts WHERE Contact_ID = ' . $_POST['id'];
		if ($contResult = mysqli_query($contConnection, $contQuery)){
			while($contRow = $contResult->fetch_row()){
				$Contact_ID = $contRow[0];
				$FirstName = $contRow[1];
				$LastName = $contRow[2];
				$EmailWork = $contRow[3];
				$EmailHome = $contRow[4];
				$PhoneWork = $contRow[5];
				$PhoneHome = $contRow[6];
				$CellPhone = $contRow[7];
				$FaxPhone = $contRow[8];
				$Address = $contRow[9];
				$Address1 = $contRow[10];
				$City = $contRow[11];
				$State = $contRow[12];
				$Zip = $contRow[13];
				$Type = $contRow[14];
				$Comments = $contRow[15];
				$CID = $contRow[16];
				$VID = $contRow[17];
				
		
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">First Name</td>';
		echo '<td class="mainContent_Body_Form_Fields">'.$FirstName.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Last Name</td>';
		echo '<td class="mainContent_Body_Form_Fields">'.$LastName.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Work Email</td>';
		echo '<td class="mainContent_Body_Form_Fields"><a href="mailto:'.$EmailWork.'">'.$EmailWork.'</a></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Home Email</td>';
		echo '<td class="mainContent_Body_Form_Fields"><a href="mailto:'.$EmailHome.'">'.$EmailHome.'</a></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Work Phone</td>';
		echo '<td class="mainContent_Body_Form_Fields">'.$PhoneWork.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Home Phone</td>';
		echo '<td class="mainContent_Body_Form_Fields">'.$PhoneHome.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Cellphone</td>';
		echo '<td class="mainContent_Body_Form_Fields">'.$CellPhone.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Fax</td>';
		echo '<td class="mainContent_Body_Form_Fields">'.$FaxPhone.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Address</td>';
		echo '<td class="mainContent_Body_Form_Fields">'.$Address.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Address 2</td>';
		echo '<td class="mainContent_Body_Form_Fields">'.$Address1.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">City</td>';
		echo '<td class="mainContent_Body_Form_Fields">'.$City.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">State</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		
		echo $State;
		
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Zip</td>';
		echo '<td class="mainContent_Body_Form_Fields">'.$Zip.'</td>';
		echo '</tr>';
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
		echo '<td class="mainContent_Body_Form_Labels">Comment</td>';
		echo '<td class="mainContent_Body_Form_Fields">'.$Comments.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Contact Type</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		
		$query = 'SELECT * FROM Cont_Type WHERE Cont_ID = '.$Type;
		$result = mysqli_query($contConnection, $query);
		if (@mysqli_num_rows($result)){
			while ($row = mysqli_fetch_row($result)){
				 echo $row[1];
			}
		}
		
		echo '</tr>';
		
			}
		}
	}
		break;
	case 'c':
		if(isset($_POST['id'])){
		$contQuery = 'SELECT * FROM Contacts WHERE Contact_ID = ' . $_POST['id'];
		if ($contResult = mysqli_query($contConnection, $contQuery)){
			while($contRow = $contResult->fetch_row()){
				$Contact_ID = $contRow[0];
				$FirstName = $contRow[1];
				$LastName = $contRow[2];
				$EmailWork = $contRow[3];
				$EmailHome = $contRow[4];
				$PhoneWork = $contRow[5];
				$PhoneHome = $contRow[6];
				$CellPhone = $contRow[7];
				$FaxPhone = $contRow[8];
				$Address = $contRow[9];
				$Address1 = $contRow[10];
				$City = $contRow[11];
				$State = $contRow[12];
				$Zip = $contRow[13];
				$Type = $contRow[14];
				$Comments = $contRow[15];
				$CID = $contRow[16];
				$VID = $contRow[17];
				
		
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">First Name</td>';
		echo '<td class="mainContent_Body_Form_Fields">'.$FirstName.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Last Name</td>';
		echo '<td class="mainContent_Body_Form_Fields">'.$LastName.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Work Email</td>';
		echo '<td class="mainContent_Body_Form_Fields"><a href="mailto:'.$EmailWork.'">'.$EmailWork.'</a></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Home Email</td>';
		echo '<td class="mainContent_Body_Form_Fields"><a href="mailto:'.$EmailHome.'">'.$EmailHome.'</a></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Work Phone</td>';
		echo '<td class="mainContent_Body_Form_Fields">'.$PhoneWork.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Home Phone</td>';
		echo '<td class="mainContent_Body_Form_Fields">'.$PhoneHome.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Cellphone</td>';
		echo '<td class="mainContent_Body_Form_Fields">'.$CellPhone.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Fax</td>';
		echo '<td class="mainContent_Body_Form_Fields">'.$FaxPhone.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Address</td>';
		echo '<td class="mainContent_Body_Form_Fields">'.$Address.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Address 2</td>';
		echo '<td class="mainContent_Body_Form_Fields">'.$Address1.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">City</td>';
		echo '<td class="mainContent_Body_Form_Fields">'.$City.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">State</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		
		echo $State;
		
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Zip</td>';
		echo '<td class="mainContent_Body_Form_Fields">'.$Zip.'</td>';
		echo '</tr>';
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
		echo '<td class="mainContent_Body_Form_Labels">Comment</td>';
		echo '<td class="mainContent_Body_Form_Fields">'.$Comments.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td class="mainContent_Body_Form_Labels">Contact Type</td>';
		echo '<td class="mainContent_Body_Form_Fields">';
		
		$query = 'SELECT * FROM Cont_Type WHERE Cont_ID = '.$Type;
		$result = mysqli_query($contConnection, $query);
		if (@mysqli_num_rows($result)){
			while ($row = mysqli_fetch_row($result)){
				 echo $row[1];
			}
		}
		
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