<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/contentgate.php");

$query='INSERT INTO Pages (C_ID, Page, Content) VALUES ("'.$_POST['clientID'].'", "'.$_POST['newPage'].'", "'.$_POST['contentPage'].'")';
$result = mysqli_query($contentConnection, $query);
if ($result === true){
	echo '<div id="admintool_Dashboard">';
	echo '<table width="500" border="0" cellpadding="5">';
	echo '<tr><td>Content Successfully Added.</td></tr>';
	echo '<tr><td><a href="javascript:contentAI()" style="text-decoration:none">Return to Content AI</td></tr>';
	echo '</table>';
}
else {
	echo 'Oh Boy!';
}
mysqli_free_result($result);
mysqli_close($groupConnection);
?>