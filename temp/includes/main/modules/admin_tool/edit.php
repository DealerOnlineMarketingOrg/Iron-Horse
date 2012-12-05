<?php 
if(isset($_POST['formID'])){
	
	// Fix Vars
	
	$formID = $_POST['formID'];
	$query = '';
	$query1 = '';
	$query2 = '';
	$result = '';
	$result1 = '';
	$result2 = '';
	
	switch($formID){
	case 'editThis_Group':
		//echo 'edit this group';
		require($_SERVER['DOCUMENT_ROOT'] . "/connections/groupgate.php");
		$query='SELECT * FROM Groups WHERE Group_ID='.$_POST['groupID'];
		$result = mysqli_query($groupConnection, $query);
		if (@mysqli_num_rows($result)){
			$row_cnt = mysqli_num_rows($result);
			//echo $row_cnt;
				if ($row_cnt==1){
					
					$query1='UPDATE Groups SET Group_Name="'.$_POST['groupName'].'", Group_Desc="'.$_POST['groupDesc'].'" WHERE Group_ID='.$_POST['groupID'];
					$result1 = mysqli_query($groupConnection, $query1);
					if ($result1===true){
						echo 'success';
					}
					else {
						echo 'Oh Boy!';
					}
					
				}
				elseif($row_cnt>1) { 
					echo 'Holy Cow!';
				}
				else { 
					echo 'Awe Man!';
				}
			mysqli_free_result($result);
			}
		else {
			echo 'Sorry Thanks for Playing';
		}
		mysqli_close($groupConnection);
		break;
	
	
	//Org
	case 'editThis_Org':
		//echo 'edit this org';
		require($_SERVER['DOCUMENT_ROOT'] . "/connections/groupgate.php");
		$query='SELECT * FROM Organization WHERE Org_ID='.$_POST['orgID'];
		$result = mysqli_query($groupConnection, $query);
		if (@mysqli_num_rows($result)){
			$row_cnt = mysqli_num_rows($result);
			if ($row_cnt==1){
				$query1='UPDATE Organization SET Org_Name="'.$_POST['orgName'].'", Group_ID="'.$_POST['groupID'].'", Group_ID2="'.$_POST['groupID2'].'" WHERE Org_ID='.$_POST['orgID'];
				$result1 = mysqli_query($groupConnection, $query1);
				if ($result1===true){
					echo 'success';
				}
				else {
					echo 'Oh Boy!';
					echo $result1;
				}		
			}
			elseif($row_cnt>1) { 
				echo 'Holy Cow!';
			}
			else { 
				echo 'Awe Man!';
			}
		mysqli_free_result($result);
		}
		else {
			echo 'Sorry Thanks for Playing';
		}
		mysqli_close($groupConnection);
		break;

	
	//Client
	case 'editThis_Client':
		//echo 'edit this client';
		require($_SERVER['DOCUMENT_ROOT'] . "/connections/groupgate.php");
		$query="SELECT * FROM Clients WHERE C_ID=".$_POST['clientID'];
		$result = mysqli_query($groupConnection, $query);
		if (@mysqli_num_rows($result)){
			$row_cnt = mysqli_num_rows($result);
			if ($row_cnt==1){
				$query1='UPDATE Clients SET C_Name="'.$_POST['clientName'].'", C_Address="'.$_POST['clientAddress'].'", C_Address1="'.$_POST['clientAddress1'].'", C_City="'.$_POST['clientCity'].'", C_State="'.$_POST['clientState'].'", C_Zip="'.$_POST['clientZip'].'", C_Phone_Sales="'.$_POST['clientPhone_Sales'].'", C_Phone_Service="'.$_POST['clientPhone_Service'].'", C_Comment="'.$_POST['clientComment'].'", C_URL="'.$_POST['clientUrl'].'", C_URL1="'.$_POST['clientUrl1'].'", C_Code="'.$_POST['clientCode'].'", Org_ID="'.$_POST['orgID'].'" WHERE C_ID='.$_POST['clientID'];
				$result1 = mysqli_query($groupConnection, $query1);
				if ($result1===true){
					echo 'success';
				}
				else {
					echo 'Oh Boy!';
					echo $result1;
				}
			}
			elseif($row_cnt>1) { 
				echo 'Holy Cow!';
			}
			else { 
				echo 'Awe Man!';
			}
			mysqli_free_result($result);
		}
		else {
			echo 'Sorry Thanks for Playing';
		}
		mysqli_close($groupConnection);
		break;
	
	
	//User
	case 'editThis_User':
		
		require($_SERVER['DOCUMENT_ROOT'] . "/connections/acctgate.php");
		require($_SERVER['DOCUMENT_ROOT'] . "/connections/usergate.php");
		
		$userID = $_POST['userID'];
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$phoneNumber = $_POST['phoneNumber'];
		$permID = $_POST['permID'];
		
		$query="SELECT * FROM Users WHERE User_ID=".$userID;
		$query1="SELECT * FROM ACCT_Info WHERE User_ID=".$userID;
		
		$result = mysqli_query($userConnection, $query);
		$result1 = mysqli_query($acctConnection, $query1);
		
		if (@mysqli_num_rows($result)&&@mysqli_num_rows($result1)){
			
			$query2='UPDATE ACCT_Info SET First_Name="'.$firstName.'", Last_Name="'.$lastName.'", Phone_Number="'.$phoneNumber.'", Permission_ID="'.$permID.'" WHERE User_ID="'.$userID.'"';
			
			$result2 = mysqli_query($acctConnection, $query2);
			
			if ($result2===true){
				echo 'success';
			}
			else {
				echo 'Oh Boy!';
			}
		}
		else { 
			echo 'Sorry Thanks for Playing';
		}
		mysqli_free_result($result);
		mysqli_free_result($result1);
		mysqli_free_result($result2);
		mysqli_close($acctConnection);
		mysqli_close($userConnection);
		break;
	
	//Contact
	case 'editThis_Contact':
		require($_SERVER['DOCUMENT_ROOT'] . "/connections/contgate.php");
		$query='UPDATE Contacts SET Contact_First_Name="'.$_POST['contactFirst_Name'].'", Contact_Last_Name="'.$_POST['contactLast_Name'].'", Contact_Email_Work="'.$_POST['contactEmail_Work'].'", Contact_Email_Home="'.$_POST['contactEmail_Home'].'", Contact_Phone_Work="'.$_POST['contactPhone_Work'].'", Contact_Phone_Home="'.$_POST['contactPhone_Home'].'", Contact_Cellphone="'.$_POST['contactCellphone'].'", Contact_Fax="'.$_POST['contactFax'].'", Contact_Address="'.$_POST['contactAddress'].'", Contact_Address1="'.$_POST['contactAddress1'].'", Contact_City="'.$_POST['contactCity'].'", Contact_State="'.$_POST['contactState'].'", Contact_Zip="'.$_POST['contactZip'].'", Cont_ID="'.$_POST['contactType'].'", Comments="'.$_POST['contactComment'].'", C_ID="'.$_POST['clientID'].'" WHERE Contact_ID='.$_POST['contactID'];
		$result = mysqli_query($contConnection, $query);
		if ($result===true){
			echo 'success';
		}
		else {
			echo 'Oh Boy!';
		}
		mysqli_free_result($result);
		mysqli_close($contConnection);
		break;
	
	//Website
	case 'editThis_Website':
		require($_SERVER['DOCUMENT_ROOT'] . "/connections/groupgate.php");
		$query='UPDATE Websites SET `Url`="'.$_POST['editSite_URL'].'", `Desc`="'.$_POST['editSite_Desc'].'" WHERE `Id`='.$_POST['editSite_ID'];
		$result = mysqli_query($groupConnection, $query);
		if ($result===true){
			echo 'success';
		}
		else {
			echo 'Oh Boy!';
		}
		mysqli_free_result($result);
		mysqli_close($groupConnection);
		break;
	
	//Permissions
	case 'editThis_Perm':
		echo 'true - perm';
		break;
		
	default:
		echo 'Sorry Try Again!';
	}
}
else {
	echo 'Sorry Try Again!';
}?>