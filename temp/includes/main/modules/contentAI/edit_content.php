<?php
//open session to check variables
if (!session_id()) session_start();
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
			require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/contentgate.php");

			$query = "SELECT * FROM Pages WHERE ID=" . $_POST['pageID'];
			$result = mysqli_query($contentConnection, $query);
			if (@mysqli_num_rows($result)){
				$contentInfo = $result->fetch_row();
				echo '<div id="admintool_Dashboard">';
				echo '<form id="editThis_Content" action="javascript:editThis_Content()">';
				echo '<input type="hidden" value="' . $_POST['pageID'] . '"id="pageID" />';

				echo '<table width="900" border="0" cellpadding="5">';
				echo '<tr><td width="900" align="center" style="border-style:solid; border-width:2px;"><strong>Edit Content</strong></td></tr>';
				echo '<tr><td><table width="900" border="0" cellpadding="5"><tr>';
				echo '<td>Client</td>';
				echo '<td>';
				$query = "SELECT * FROM Clients WHERE C_ID=" . $_SESSION['c'];
				$result = mysqli_query($groupConnection, $query);
				if (@mysqli_num_rows($result)){
					while($clientRow = $result->fetch_row()){		
						echo '<strong>'.$clientRow[1].'</strong>';
					}
				}
				echo '</td></tr>';

				echo '<tr><td>Dealer Page URL</td><td><input type="text" title="dealerPage" id="dealerPage" style="width:150px;" value="';
				echo $contentInfo[2];
				echo '"/></td>';
				echo '<tr><td>Content Page URL</td><td><input type="text" title="contentPage" id="contentPage" style="width:150px;" value="';
				echo $contentInfo[2];
				echo '"/></td>';
				echo '<tr><td>&nbsp;</td><td>&nbsp;</td></tr>';
				echo '<tr><td>&nbsp;</td><td align="right"><input type="submit" value="Update Content" /></td>';
				echo '</tr></table></td></tr></table></form>';
				echo '<div><a href="javascript:contentAI()">Return to Content Administration</a></div>';
			}
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