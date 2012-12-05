<?php 
if(isset($_POST['formID'])){
	
	$formID = $_POST['formID'];
	//echo $formID;
	if($formID=='enableThis_Group'){
		require($_SERVER['DOCUMENT_ROOT'] . "/connections/groupgate.php");
		$query='SELECT * FROM Groups WHERE Group_ID='.$_POST['groupID'];
		$result = mysqli_query($groupConnection, $query);
		if (@mysqli_num_rows($result)){
			$row_cnt = @mysqli_num_rows($result);
				if ($row_cnt==1){
					
					$query1='UPDATE Groups SET Active="1" WHERE Group_ID='.$_POST['groupID'];
					$result1 = mysqli_query($groupConnection, $query1);
					if ($result1===true){
						echo 'success';
					}
					else {
						echo 'Oh Boy!';
					}
					
				}
				elseif($row_cnt>1) { 
					echo 'Holy Cow!';
				}
				else { 
					echo 'Awe Man!';
				}
			mysqli_free_result($result);
			}
		else {
			echo 'Sorry Thanks for Playing';
		}
		mysqli_close($groupConnection);
		
	}
	
	elseif($formID=='enableThis_Org'){
		require($_SERVER['DOCUMENT_ROOT'] . "/connections/groupgate.php");
		$query='SELECT * FROM Organization WHERE Org_ID='.$_POST['orgID'];
		$result = mysqli_query($groupConnection, $query);
		if (@mysqli_num_rows($result)){
			$row_cnt =@ mysqli_num_rows($result);
				if ($row_cnt==1){
					
					$query1='UPDATE Organization SET Active="1" WHERE Org_ID='.$_POST['orgID'];
					$result1 = mysqli_query($groupConnection, $query1);
					if ($result1===true){
						echo 'success';
					}
					else {
						echo 'Oh Boy!';
					}
					
				}
				elseif($row_cnt>1) { 
					echo 'Holy Cow!';
				}
				else { 
					echo 'Awe Man!';
				}
			mysqli_free_result($result);
			}
		else {
			echo 'Sorry Thanks for Playing';
		}
		mysqli_close($groupConnection);
	}
	
	elseif($formID=='enableThis_Client'){
		require($_SERVER['DOCUMENT_ROOT'] . "/connections/groupgate.php");
		require($_SERVER['DOCUMENT_ROOT'] . "/connections/acctgate.php");
		$query="SELECT * FROM Clients WHERE C_ID=".$_POST['clientID'];
		$result = mysqli_query($groupConnection, $query);
		if (@mysqli_num_rows($result)){
			$row_cnt = @mysqli_num_rows($result);
				if ($row_cnt==1){
					
					$uQuery = 'SELECT * FROM ACCT_Info WHERE C_ID=' . $_POST['clientID'];
					$uResult = mysqli_query($acctConnection, $uQuery);
					if (@mysqli_num_rows($uResult)){
						while ($uRow = mysqli_fetch_row($uResult)){
							$dQuery = 'UPDATE ACCT_Info SET Active=1 WHERE User_ID=' . $uRow[0];
							$dResult = mysqli_query($acctConnection, $dQuery);
						}
					}
					
					$query1='UPDATE Clients SET Active="1" WHERE C_ID='.$_POST['clientID'];
					$result1 = mysqli_query($groupConnection, $query1);
					if ($result1===true){
						echo 'success';
					}
					else {
						echo 'Oh Boy!';
					}
				}
				elseif($row_cnt>1) { 
					echo 'Holy Cow!';
				}
				else { 
					echo 'Awe Man!';
				}
			mysqli_free_result($result);
			}
		else {
			echo 'Sorry Thanks for Playing';
		}
		mysqli_close($groupConnection);
	}
	
	elseif($formID=='enableThis_User'){
		//echo 'true - user';
		require($_SERVER['DOCUMENT_ROOT'] . "/connections/acctgate.php");
		$query="SELECT * FROM ACCT_Info WHERE User_ID=".$_POST['userID'];
		$result = mysqli_query($acctConnection, $query);
		if (mysqli_num_rows($result)){
			$row_cnt = mysqli_num_rows($result);
				if ($row_cnt==1){
					
					$query1='UPDATE ACCT_Info SET Active="1" WHERE User_ID='.$_POST['userID'];
					$result1 = mysqli_query($acctConnection, $query1);
					if ($result1===true){
						echo 'success';
					}
					else {
						echo 'Oh Boy!';
					}
					
				}
				elseif($row_cnt>1) { 
					echo 'Holy Cow!';
				}
				else { 
					echo 'Awe Man!';
				}
			mysqli_free_result($result);
			}
		else {
			echo 'Sorry Thanks for Playing';
		}
		mysqli_close($acctConnection);
	}
	
	
	elseif($formID=='enableThis_Perm'){
		echo 'true - perm';
	}
	
	else{
		echo 'Sorry Try Again!';
	}

}else{echo 'Sorry Try Again!';}?>