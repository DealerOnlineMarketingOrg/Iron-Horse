<?php 

require("keeper.php");
require("../connections/usergate.php");
require("../connections/acctgate.php");

$password = stripslashes($_POST["password"]);
$username = stripslashes($_POST["username"]);

$query = "SELECT User_ID FROM Users WHERE User_Name='" . mysqli_real_escape_string($userConnection, $username) . "'";
$result = mysqli_query($userConnection, $query);
if (@mysqli_num_rows($result)){
	mysqli_close($userConnection);
	$row = mysqli_fetch_array($result, MYSQLI_BOTH);
	$hash = PassHash::hash($password);
	$isGood = PassHash::check_password($hash, $password);
		if ($isGood){
		$query = "UPDATE ACCT_Info SET Password='" . $hash . "', Generated=NOT Generated WHERE User_ID='" . $row["User_ID"] . "'";
		$result = mysqli_query($acctConnection, $query);
		if ($result){
			
			mysqli_close($acctConnection);
			echo true;
		}
		else {
			mysqli_close($acctConnection);
			echo false;
		}
	}
	else {
		mysqli_close($acctConnection);
		echo false;
	}
}
else {
	mysqli_close($userConnection);
	mysqli_close($acctConnection);
	echo false;
}
?>