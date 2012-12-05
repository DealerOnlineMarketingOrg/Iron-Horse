<?php 
require("../lib/generator.php");
require("../lib/keeper.php");
require("usergate.php");
require("acctgate.php");

$email = stripslashes($_POST["email"]);
$query = "SELECT * FROM Users WHERE User_Name = '".mysqli_real_escape_string($userConnection,$email)."'";
$result = mysqli_query($userConnection, $query);
if (@mysqli_num_rows($result)){
	$g_password = generatePassword(12,4);
	$p1 = $g_password;
	$p2 = $g_password;
	$userID = mysqli_fetch_array($result, MYSQLI_BOTH);
	mysqli_close($userConnection);
	if (@mysqli_num_rows($result)){
		mysqli_close($userConnection);
		$hash = PassHash::hash($p1);
		$isGood = PassHash::check_password($hash, $p1);
		if ($isGood){
			$query = "UPDATE ACCT_Info SET Password='". $hash ."', Generated=NOT Generated WHERE User_ID = ".$userID["User_ID"]; 
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
	$to = $email ;
	$subject = "Content.dealeronlinemarketing.com Password Reset";
	$headers = "From: Support<support@dealeronlinemarketing.com>";
	$headers .= "\nReply-To: support@dealeronlinemarketing.com";
	$headers .= "\nX-Mailer: PHP/" . phpversion();
	$message = 'Your Temporary Password is: ' . $p2;
	$myredirect = "http://content.dealeronlinemarketing.com/reset.php";
	if (!mail($to, $subject, $message, $headers)) echo "<h1>The message could not be sent</h1>";
}
else {
	echo @mysqli_num_rows($result);
}
?>