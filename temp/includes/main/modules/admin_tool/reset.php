<?php 
require($_SERVER['DOCUMENT_ROOT'] . "/lib/generator.php");
require($_SERVER['DOCUMENT_ROOT'] . "/lib/keeper.php");
require($_SERVER['DOCUMENT_ROOT'] . "/connections/acctgate.php");

$userID = $_POST["userID"];
$userEmail = $_POST["userEmail"];
//echo $userEmail;
//echo $userID;
$p1 = generatePassword(12,4);
$hash = PassHash::hash($p1);
$isGood = PassHash::check_password($hash, $p1);
if ($isGood){
	$query = "UPDATE ACCT_Info SET Password='". $hash ."', Generated=NOT Generated WHERE User_ID = ".$userID;
	$result = mysqli_query($acctConnection, $query);
	if ($result){
		mysqli_close($acctConnection);
		echo 'success';
	}
	else {
		mysqli_close($acctConnection);
	echo 'false';
	}
}
else {
	mysqli_close($acctConnection);
echo 'false';
}

$to = $userEmail ;
$subject = "Content.dealeronlinemarketing.com Password Reset";
$headers = "From: Support<support@dealeronlinemarketing.com>";
$headers .= "\nReply-To: support@dealeronlinemarketing.com";
$headers .= "\nX-Mailer: PHP/" . phpversion();
$message = 'Your Temporary Password is: ' . $p1;
$myredirect = "http://content.dealeronlinemarketing.com/reset.php";
//echo $to.'<br/>'.$subject.'<br/>'.$message.'<br/>'.$headers;
if (!mail($to, $subject, $message, $headers)) echo "<h1>The message could not be sent</h1>";
?>