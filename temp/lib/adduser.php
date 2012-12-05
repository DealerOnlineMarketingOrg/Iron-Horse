<?php 

require("keeper.php");
require("../connections/usergate.php");
require("../connections/acctgate.php");



$userfirst = stripslashes($_POST["first_name"]);
$userlast = stripslashes($_POST["last_name"]);
$username = stripslashes($_POST["username"]);
$password = stripslashes($_POST["password"]);
$Org_id_set = stripslashes($_POST["org"]);
$Group_id_set = stripslashes($_POST["group"]);
$Perm_id_set = stripslashes($_POST["pid"]);
$Client_id = stripslashes($_POST["cid"]);

//echo $password;
//echo '<br />';
//echo $username;
//echo '<br />';
//$userfirst ="Test";
//$userlast ="Testerson";

//$Org_id_set ="1";
//$Group_id_set ="1";
//$Perm_id_set ="0";

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
		$query = "INSERT INTO ACCT_Info (Password, First_Name, Last_Name, Org_ID, Group_ID, Permission_ID, Generated) VALUES ('" . mysqli_real_escape_string($acctConnection, $hash) . "', '" . $userfirst . "', '" . $userlast ."', '". $Org_id_set ."', '". $Group_id_set . "', '" . $Perm_id_set ."', '0' )";
		$result = mysqli_query($acctConnection, $query);
		if ($result){
			mysqli_close($acctConnection);
			echo '<div align="center"><h2>Success</h2></div>';
			echo '<a href="index.php">Logout</a>';
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