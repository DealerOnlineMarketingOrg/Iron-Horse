<?php 
if(isset($_POST['formID'])){
	
	$formID = $_POST['formID'];
	
	switch($formID){
	//Group
	case 'addNew_Group':
		require($_SERVER['DOCUMENT_ROOT'] . "/connections/groupgate.php");
		$query='INSERT INTO Groups (Group_Name, Group_Desc) VALUES ("'.$_POST['groupName'].'", "'.$_POST['groupDesc'].'")';
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
	
	//Org
	case 'addNew_Org':
		require($_SERVER['DOCUMENT_ROOT'] . "/connections/groupgate.php");
		$query='INSERT INTO Organization (Org_Name, Group_ID, Group_ID2) VALUES ("'.$_POST['orgName'].'", "'.$_POST['groupID'].'", "'.$_POST['groupID2'].'")';
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
	
	//Client
	case 'addNew_Client':
		require($_SERVER['DOCUMENT_ROOT'] . "/connections/groupgate.php");
		$query='INSERT INTO Clients (C_Name, C_Address, C_Address1, C_City, C_State, C_Zip, C_Phone_Sales, C_Phone_Service, C_Comment, C_URL, C_URL1, C_Code, Org_ID, C_Created) VALUES ("' . $_POST['clientName'] . '", "' . $_POST['clientAddress'] . '", "' . $_POST['clientAddress1'] . '", "' . $_POST['clientCity'] . '", "' . $_POST['clientState'] . '", "' . $_POST['clientZip'] . '", "' . $_POST['clientPhone_Sales'] . '", "' . $_POST['clientPhone_Service'] . '", "' . $_POST['clientComment'] . '", "' . $_POST['clientUrl'] . '", "' . $_POST['clientUrl1'] . '", "' . $_POST['clientCode'] . '", "' . $_POST['orgID'] . '", "' . date('Y-m-d') . '")';
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
	
	//User
	case 'addNew_User':
		require($_SERVER['DOCUMENT_ROOT'] . "/connections/groupgate.php");
		require($_SERVER['DOCUMENT_ROOT'] . "/connections/acctgate.php");
		require($_SERVER['DOCUMENT_ROOT'] . "/connections/usergate.php");
		require($_SERVER['DOCUMENT_ROOT'] . "/lib/generator.php");
		require($_SERVER['DOCUMENT_ROOT'] . "/lib/keeper.php");
			
		$userName = $_POST['userName'];
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$phoneNumber = $_POST['phoneNumber'];
		$cID = $_POST['cID'];
		$permID = $_POST['permID'];
		
		//make password 
		$p1 = generatePassword(12,4);
		$hash = PassHash::hash($p1);
		$isGood = PassHash::check_password($hash, $p1);
		if ($isGood){
			$password=$hash;
		}
		else { 
			echo 'oops!';
		}
		//start
		$query='SELECT * from Clients WHERE C_ID='.$cID;
		$result = mysqli_query($groupConnection, $query);
		if (@mysqli_num_rows($result)){
			while($clientRow = $result->fetch_row()){
				$orgID= $clientRow[13];
				$query1='SELECT * from Organization WHERE Org_ID='.$orgID;
				$result1 = mysqli_query($groupConnection, $query1);
				if (@mysqli_num_rows($result1)){
					while($orgRow = $result1->fetch_row()){
						$groupID = $orgRow[2];
						//Insert data into Users
						$query2='INSERT INTO Users (User_Name) VALUES ("'.$userName.'")';
						$result2 = mysqli_query($userConnection, $query2);
						//grab new userid
						$query3='SELECT * FROM Users WHERE User_Name="'.$userName.'" ORDER BY User_ID DESC LIMIT 1';
						$result3 = mysqli_query($userConnection, $query3);
						if (@mysqli_num_rows($result3)){
							while($userRow = $result3->fetch_row()){
								$uID= $userRow[0];
								//Insert data into ACCT_Info
								$query4='INSERT INTO ACCT_Info (User_ID, Password, First_Name, Last_Name, Email, Phone_Number, C_ID, Org_ID, Group_ID, Permission_ID, Generated, Active, CreatedOn) VALUES ("'.$uID.'", "'.$password.'", "'.$firstName.'", "'.$lastName.'", "", "'.$phoneNumber.'", "'.$cID.'", "'.$orgID.'", "'.$groupID.'", "'.$permID.'", "1", "1", "' . date('Y-m-d') . '")';
								$result4 = mysqli_query($acctConnection, $query4);

								if ($result2===true&&$result4===true){
									echo 'success';
									//Build EMail
									$to = $userName ;
									$subject = "Content.dealeronlinemarketing.com Welcome - Login Info";
									$headers = "From: Support<support@dealeronlinemarketing.com>";
									$headers .= "\nReply-To: support@dealeronlinemarketing.com";
									$headers .= "\nX-Mailer: PHP/" . phpversion();
									$message = '';
									$message .= 'Your Temporary Password is: ' . $p1;
										
									//Send EMail
									if (!mail($to, $subject, $message, $headers)){ 
										echo "<h1>The message could not be sent</h1>";
									}								
								}
								else {
									echo 'Oh Boy!';
								}
							}
						}
						else {
							echo 'failure';
						}
					}
				}
				else {
					echo 'failure';
				}
			}
		}
		break;
			
	//Contact
	case 'addNew_Contact':
		require($_SERVER['DOCUMENT_ROOT'] . "/connections/contgate.php");
		$query='INSERT INTO Contacts (Contact_First_Name, Contact_Last_Name, Contact_Email_Work, Contact_Email_Home, Contact_Phone_Work, Contact_Phone_Home, Contact_Cellphone, Contact_Fax, Contact_Address, Contact_Address1, Contact_City, Contact_State, Contact_Zip, Cont_ID, Comments, C_ID) VALUES ("'.$_POST['contactFirst_Name'].'", "'.$_POST['contactLast_Name'].'", "'.$_POST['contactEmail_Work'].'", "'.$_POST['contactEmail_Home'].'", "'.$_POST['contactPhone_Work'].'", "'.$_POST['contactPhone_Home'].'", "'.$_POST['contactCellphone'].'", "'.$_POST['contactFax'].'", "'.$_POST['contactAddress'].'", "'.$_POST['contactAddress1'].'", "'.$_POST['contactCity'].'", "'.$_POST['contactState'].'", "'.$_POST['contactZip'].'", "'.$_POST['contactType'].'", "'.$_POST['contactComments'].'", "'.$_POST['clientID'].'")';
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
	case 'addNew_Website':
		require($_SERVER['DOCUMENT_ROOT'] . "/connections/groupgate.php");
		$query='INSERT INTO Websites (`Url`, `Desc`, `C_ID`) VALUES ("'.$_POST['websiteUrl'].'", "'.$_POST['websiteDesc'].'", ' .$_POST['clientID'] . ')';
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
	/*else {
		echo 'failure';
	}*/
		
	mysqli_free_result($result);
	mysqli_free_result($result1);
	mysqli_free_result($result2);
	mysqli_free_result($result3);
	mysqli_close($groupConnection);
	mysqli_close($acctConnection);
	mysqli_close($userConnection);


		

	
	
	//Permissions
	/*case 'addNew_Perm':
		echo 'true - perm';
		break;
	}*/

	default:
		echo 'Sorry Try Again!';
	}
}
else {
	echo 'Sorry Try Again!';
}?>