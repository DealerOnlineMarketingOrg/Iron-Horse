<?php
if (!session_id()) session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/connections/groupgate.php");
echo '';
if(isset($_SESSION['c'])){
		
	$Tmp=$_SESSION['c'];
	$ID=substr($Tmp,1);
	$Type=$Tmp[0];
	echo 'You currently are working with <strong>';
	if($Type == 'g'){
		$query='SELECT * FROM Groups Where Group_ID="'.$ID.'"';
		$result = mysqli_query($groupConnection, $query);
		if (@mysqli_num_rows($result)){
			while($Row = $result->fetch_row()){
				echo 'Organization Name: '.$Row[1];
			}
		}
		else {
			echo 'Database error: No Groups returned.';
		}
		//echo 'group: '.$Type;
		//echo '<br/>';
		//echo 'Your id is: '.$ID;
	}

	elseif ($Type =='o'){
		$query='SELECT * FROM Organization Where Org_ID="'.$ID.'"';
		$result = mysqli_query($groupConnection, $query);
		if (@mysqli_num_rows($result)){
			while($Row = $result->fetch_row()){
				echo 'Group Name: '.$Row[1];
			}
		}
		else {
			echo 'Database error: No Organization returned.';
		}
		//echo 'Org: '.$Type;
		//echo '<br/>';
		//echo 'Your id is: '.$ID;
	}

	elseif ($Type =='c'){

		$query='SELECT * FROM Clients Where C_ID="'.$ID.'"';
		$result = mysqli_query($groupConnection, $query);
		if (@mysqli_num_rows($result)){
			while($Row = $result->fetch_row()){
				echo 'Client Name: '.$Row[1];
			}
		}
		else {
			echo 'Database error: No Client returned.';
		}
		//echo 'Client: '.$Type;
		//echo '<br/>';
		//echo 'Your id is: '.$ID;
	}
	else{
		echo 'Thanks for playing!';
	}
}
else {
	echo 'Thanks for playing!2';
}


//main stuff
echo '</strong>.<br/>';
//echo 'Dashboard Coming Soon!'; 
?>