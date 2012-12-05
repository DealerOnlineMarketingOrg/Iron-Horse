<?php
if (!session_id()) session_start();
if(!isset($_SESSION['u'])){
	//echo "User not found, logging out.";
	session_destroy();
	header("Location: http://content.dealeronlinemarketing.com");
	echo "<meta http-equiv='refresh' content='0;url=http://content.dealeronlinemarketing.com'>";
}
if (!isset($_SESSION['t'])){
	//echo "tag variable not set";
	require_once($_SERVER['DOCUMENT_ROOT'] . '/connections/usergate.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/connections/acctgate.php');

	$query = "SELECT * FROM Users WHERE User_Name = '" . $_SESSION['u'] . "'";
	$result = mysqli_query($userConnection, $query);
	if (@mysqli_num_rows($result)){
		//echo ", user found, setting variable";
		$_SESSION['t'] = '-';
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
	$_SESSION['t'] = $_POST['selection'];
}
include($_SERVER['DOCUMENT_ROOT'] . '/includes/main/main.php');
?>