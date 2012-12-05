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

			require($_SERVER['DOCUMENT_ROOT'] . "/connections/contentgate.php"); 
			require($_SERVER['DOCUMENT_ROOT'] . "/connections/groupgate.php");

			echo '<div id="admintool_Dashboard">';
			echo '<table width="500" border="0" cellpadding="5">';
			echo '<tr><td width="250" style="border-style:solid; border-width:2px;"><strong>Client URL</strong></td><td width="250" style="border-style:solid; border-width:2px;"><strong>Client Name</strong></td><td width="200" style="border-style:solid; border-width:2px;"><strong>Content Page</strong></td></tr>';

			echo '<tr><td colspan=2>';
			if(isset($_SESSION['c'])){
				$cID = $_SESSION['c'];
				$query = 'SELECT * FROM Pages WHERE C_ID=' . substr($cID, 1);
			}
			else {
				$query = 'SELECT * FROM Pages';
			}
			$result = mysqli_query($contentConnection, $query);
			if (@mysqli_num_rows($result)){
				while($contentRow = $result->fetch_row()){
					$query = 'SELECT C_Name FROM Clients WHERE C_ID='.$contentRow[1];
					$clientResult = mysqli_query($groupConnection, $query);
					if(@mysqli_num_rows($clientResult)){
						while($clientRow = $clientResult->fetch_row()){
							echo '<tr><td>';
							echo '<strong><a href="javascript:editContent('.$contentRow[0].')" style="text-decoration:none">'.$contentRow[2].'</a></strong>';
							echo '</td><td>';
							echo $clientRow[0];
							echo '</td><td>';
							echo $contentRow[3];
							echo '</td></tr>';
						}
					}
					else {
						echo '<tr><td>';
						echo '<tr><td>';
						echo '<strong><a href="javascript:editContent('.$contentRow[0].')" style="text-decoration:none">'.$contentRow[2].'</a></strong>';
						echo '</td><td>';
						echo 'Error Retrieving Client Name';
						echo '</td><td>';
						echo $contentRow[3];
						echo '</td></tr>';
					}
				}
			}
			else {
				echo 'No Rows Returned';
			}
			echo '</td></tr>';
			echo '<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>';
			echo '<tr><td><a href="javascript:addContent()" style="text-decoration:none">Add A New Content Page</a></td><td>&nbsp;</td><td>&nbsp;</td></tr>';
			echo '</table>';
			
			$result->close();
			$clientResult->close();
			mysqli_close($contentConnection);
			mysqli_close($groupConnection);
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