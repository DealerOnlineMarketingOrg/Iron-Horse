<?php
if (!session_id()) session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/usergate.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/acctgate.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/groupgate.php");
$query = "SELECT User_ID FROM Users WHERE User_Name = '" . $_SESSION['u'] . "'";
$result = mysqli_query($userConnection, $query);
if (@mysqli_num_rows($result)){
	$row = mysqli_fetch_row($result);
	$userNum = $row[0];
}
$query = "SELECT Permission_ID FROM ACCT_Info WHERE User_ID = '" . $userNum . "'";
$result = mysqli_query($acctConnection, $query);
if (@mysqli_num_rows($result)){
	$row = mysqli_fetch_row($result);
	$permNum = $row[0];
}
$query = "SELECT Permission_Level FROM Permissions WHERE Permission_Num = '" . $permNum . "'";
$result = mysqli_query($groupConnection, $query);
if (@mysqli_num_rows($result)){
	$row = mysqli_fetch_row($result);
	$permissionLevel = $row[0];
}
else {
	$permissionLevel = "11000000000000000001";
}
?>