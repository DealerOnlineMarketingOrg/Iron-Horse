<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/contentgate.php");

$query='UPDATE Pages SET C_ID="' . $_POST['clientID'] . '", Page="' . $_POST['dealerPage'] . '", Content="' . $_POST['contentPage'] . '" WHERE ID=' . $_POST['pageID'];
if ($result === true){
	echo '<div id="admintool_Dashboard">';
	echo '<table width="500" border="0" cellpadding="5">';
	echo '<tr><td>Content Successfully Updated.</td></tr>';
	echo '<tr><td><a href="javascript:contentAI()" style="text-decoration:none">Return to Content AI</td></tr>';
	echo '</table>';
}
else {
	echo 'Oh Boy!';
}
mysqli_free_result($result);
mysqli_close($groupConnection);
?>