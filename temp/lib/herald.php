<?php 

require("keeper.php");
require("../connections/usergate.php");
require("../connections/acctgate.php");

$password = stripslashes($_POST["password"]);
echo $password;
echo '<br />';
$username = stripslashes($_POST["username"]);
echo $username;
echo '<br />';
$userfirst ="Test";
$userlast ="Testerson";
$Org_id_set ="1";
$Group_id_set ="1";
$Perm_id_set ="0";

$query = "INSERT INTO Users (User_Name) VALUES ('" . mysqli_real_escape_string($userConnection, $username) . "')";
echo $query;
echo '<br />';
$result = mysqli_query($userConnection, $query);
echo $result;
echo '<br />';
if ($result){
	mysqli_close($userConnection);
	$hash = PassHash::hash($password);
	echo $hash;
	echo '<br />';
	$isGood = PassHash::check_password($hash, $password);
		if ($isGood){
		$query = "INSERT INTO ACCT_Info (Password, First_Name, Last_Name, Org_ID, Group_ID, Permission_ID) VALUES ('" . mysqli_real_escape_string($acctConnection, $hash) . "', '" . $userfirst . "', '" . $userlast ."', '". $Org_id_set ."', '". $Group_id_set . "', '" . $Perm_id_set ."')";
		$result = mysqli_query($acctConnection, $query);
		if ($result){
			mysqli_close($acctConnection);
			echo '<div align="center"><h2>Success</h2></div>';
		}
		else {
			mysqli_close($acctConnection);
			echo '<div align="center"><h2>Failed to insert password</h2></div>';
		}
	}
	else {
		mysqli_close($acctConnection);
		echo '<div align="center"><h2>Password failed validation</h2></div>';
	}
}
else {
	mysqli_close($userConnection);
	mysqli_close($acctConnection);
	echo '<div align="center"><h2>Failed to insert username</h2></div>';
}
?>