<?php
if (!session_id()) session_start();
$selected = '';
if(isset($_SESSION['u'])){
require_once($_SERVER['DOCUMENT_ROOT'] . "/lib/permissions.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/groupgate.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/acctgate.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/usergate.php");

//start of dropdown
echo '<div id="topDealer_Selector">';

//get the user id
$query = "SELECT * FROM Users WHERE User_Name = '" . $_SESSION['u'] . "'";
$result = mysqli_query($userConnection, $query);
if (@mysqli_num_rows($result)){
	$user = mysqli_fetch_row($result);
}
//get the user's associated client, organization, and group
$uQuery = 'SELECT * FROM ACCT_Info WHERE User_ID = "' . $user[0] . '"';
$uResult = mysqli_query($acctConnection, $uQuery);
if (@mysqli_num_rows($uResult)){
	$acctInfo = mysqli_fetch_row($uResult);
	$group = $acctInfo[8];
	$org = $acctInfo[7];
	$client = $acctInfo[6];
	
}


//start of first row of dropdown and selected
echo '<dl id="sample" class="dropdown">';

//Future use
//javascript:changeClient()

//check for tag empty
if($_SESSION['t']=="-"){
	//check perm for super admin
	if ($permNum==0){
	// get group for super admin
	$gQuery = "SELECT * FROM Groups WHERE Group_ID=".$group;
	$gResult = mysqli_query($groupConnection, $gQuery);
	if (@mysqli_num_rows($gResult)){
		while ($gRow = mysqli_fetch_row($gResult)){
			//group that super admin belongs to
			echo '<dt><a href="#"><span>'.$gRow[1].'</span></a></dt>';
			echo '<dd><ul>';
			echo '<li id="firstSelection"><a href="#">'.$gRow[1].'<span class="value">'.$gRow[0].'</span></a></li>';
			
			$oQuery = "SELECT * FROM Organization WHERE Group_ID=".$gRow[0] . ' ORDER BY Org_Name';
			$oResult = mysqli_query($groupConnection, $oQuery);
			if (@mysqli_num_rows($oResult)){
				while ($oRow = mysqli_fetch_row($oResult)){
					//orgs that are in group that super admin is part of 
					echo '<li>&nbsp;&nbsp;&nbsp;<a href="#">'.$oRow[1].'<span class="value">'.$oRow[0].'</span></a></li>';
					
					//get the clients that are in the orgs that belong to the group that super admin is part of
					$cQuery = "SELECT * FROM Clients WHERE Org_ID =" . $oRow[0] . ' ORDER BY C_Name';
					$cResult = mysqli_query($groupConnection, $cQuery);
					if (@mysqli_num_rows($cResult)){
						while ($cRow = mysqli_fetch_row($cResult)){
							echo '<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">'.$cRow[1].'<span class="value">'.$cRow[0].'</span></a></li>';
						}
					}
					
					
				}
			}
			
			
		}
	}
	//get other groups for super admin
	$gQuery = "SELECT * FROM Groups WHERE Group_ID <>".$group." ORDER BY Group_Name";
	$gResult = mysqli_query($groupConnection, $gQuery);
	if (@mysqli_num_rows($gResult)){
		while ($gRow = mysqli_fetch_row($gResult)){
			//groups that super admin does not belong to
			echo '<li><a href="#">'.$gRow[1].'<span class="value">'.$gRow[0].'</span></a></li>';
			$oQuery = "SELECT * FROM Organization WHERE Group_ID=".$gRow[0] . ' ORDER BY Org_Name';
			$oResult = mysqli_query($groupConnection, $oQuery);
			if (@mysqli_num_rows($oResult)){
				while ($oRow = mysqli_fetch_row($oResult)){
					//orgs that are not in group that super admin is part of 
					echo '<li>&nbsp;&nbsp;&nbsp;<a href="#">'.$oRow[1].'<span class="value">'.$oRow[0].'</span></a></li>';
					$cQuery = "SELECT * FROM Clients WHERE Org_ID =" . $oRow[0] . ' ORDER BY C_Name';
					$cResult = mysqli_query($groupConnection, $cQuery);
					if (@mysqli_num_rows($cResult)){
						while ($cRow = mysqli_fetch_row($cResult)){
							echo '<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">'.$cRow[1].'<span class="value">'.$cRow[0].'</span></a></li>';
						}
					}
				}
			}
		}
	}
	echo '</ul>';
	echo '</dd>';
	echo '</dl>';
}


// echo '<li><a href="#">Brazil<img class="flag" src="br.png" alt="" /><span class="value">BR</span></a></li>';
}
}
if($_SESSION['t']<>"-"){

}

?>