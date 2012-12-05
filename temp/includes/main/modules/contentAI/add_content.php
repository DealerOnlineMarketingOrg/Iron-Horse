<?php
//open session to check variables
if (!session_id()) session_start();
echo '';
//make sure session isn't being injected
if(isset($_REQUEST['_SESSION'])) die("Nice try, buddy.");
//check if session id is blank
if (session_id() == ''){
	//unset session variable
	unset($_SESSION['question']);
    //go to login page
	header("location:http://content.dealeronlinemarketing.com");
}
//session id exists
else {
	//check if variable is set
	if (isset($_SESSION['question'])){
		//check if variable is correct
		if ($_SESSION['question'] == 42){
		//show desired page

			require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/groupgate.php");

			echo '<div id="admintool_Dashboard">';
			echo '<form id="addNew_Content" action="javascript:addNew_Content()">';

			echo '<table width="900" border="0" cellpadding="5">';
			echo '<tr><td width="900" align="center" style="border-style:solid; border-width:2px;"><strong>Add New Content</strong></td></tr>';
			echo '<tr><td><table width="900" border="0" cellpadding="5"><tr>';
			echo '<td>Current<br/>Client</td>';
			echo '<td>';
			$query = "SELECT * FROM Clients WHERE C_ID=" . substr($_SESSION['c'], 1);
			$result = mysqli_query($groupConnection, $query);
			if (@mysqli_num_rows($result)){
				while($clientRow = $result->fetch_row()){		
					echo '<strong>'.$clientRow[1].'</strong>';
				}
			}
			echo '</td></tr>';

			echo '<tr><td>Dealer Page URL</td><td><input type="text" title="newPage" id="newPage" style="width:150px;" value=""/></td>';
			echo '<tr><td>Content Page URL</td><td><input type="text" title="contentPage" id="contentPage" style="width:150px;" value=""/></td>';
			echo '<tr><td>&nbsp;</td><td>&nbsp;</td></tr>';
			echo '<tr><td>&nbsp;</td><td align="right"><input type="submit" value="Add Content" /></td>';
			echo '</tr></table></td></tr></table></form>';
			echo '<div><a href="javascript:contentAI()">Return to Content Administration</a></div>';
		}
		//variable is not correct
		else {
			//unset session
			session_unset();
			//show login page
			header("location:http://content.dealeronlinemarketing.com");
		}
	}
	//variable is not set
	else {
		//unset session
		session_unset();
		//show login page
		header("location:http://content.dealeronlinemarketing.com");
	}
}
?>