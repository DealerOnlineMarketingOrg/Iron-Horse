<?php
if (!session_id()) session_start();
if(!isset($_SESSION['u'])){
	//echo "User not found, logging out.";
	session_destroy();
	header("Location: http://content.dealeronlinemarketing.com");
	echo "<meta http-equiv='refresh' content='0;url=http://content.dealeronlinemarketing.com'>";
}
if (!isset($_SESSION['c'])){
	//echo "client variable not set";
	require_once($_SERVER['DOCUMENT_ROOT'] . '/connections/usergate.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/connections/acctgate.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/connections/groupgate.php');

	$query = "SELECT * FROM Users WHERE User_Name = '" . $_SESSION['u'] . "'";
	$result = mysqli_query($userConnection, $query);
	if (@mysqli_num_rows($result)){
		//echo ", user found";
		$userRow = mysqli_fetch_row($result);
		$query = "SELECT C_ID FROM ACCT_Info WHERE User_ID=" . $userRow[0];
		//echo $query;
		$result = mysqli_query($acctConnection, $query);
		//echo " " . @mysqli_num_rows($result);
		if (@mysqli_num_rows($result)){
			$cID = mysqli_fetch_row($result);
			$query = "SELECT Group_ID FROM Organization INNER JOIN (SELECT Org_ID FROM Clients WHERE C_ID = " . $cID[0] . ") AS Orgs_ID On Organization.Org_ID = Orgs_ID.Org_ID";
			$oResult = mysqli_query($groupConnection, $query);
			if (@mysqli_num_rows($oResult)){
				$gID = mysqli_fetch_row($oResult);
				$_SESSION['c'] = "g" . $gID[0];
			}
			//echo ", client found, setting session variable.";
			
			//echo " " . $cID[0];
			//$_SESSION['c'] = "c" . $cID[0];
			//echo " " . $_SESSION['c'];
		}
		else {
			//echo ", no clients returned, defaulting to c1.";
			$_SESSION['c'] = "c1";
		}
	}
	else {
		//echo ", no users returned, logging out.";
		session_destroy();
		header("Location: http://content.dealeronlinemarketing.com");
		echo "<meta http-equiv='refresh' content='0;url=http://content.dealeronlinemarketing.com'>";
	}
}
else {
	//echo "changing variable to new selection.";
	$_SESSION['c'] = $_POST['selection'];
}
//include($_SERVER['DOCUMENT_ROOT'] . '/includes/main/main.php');
?>