<?php
if (!session_id()) session_start();
$selected = '';
if(isset($_SESSION['u'])){
require_once($_SERVER['DOCUMENT_ROOT'] . "/lib/permissions.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/groupgate.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/acctgate.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/usergate.php");

//echo start
echo '<div id="topDealer_Selector"><select id="selectDealer_Dropdown" onchange="javascript:changeClient()">';


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
	//echo $group;
}

//echo $permNum.'<br/>';
//get all active groups
$gQuery = "SELECT * FROM Groups WHERE Active = 1";
$gResult = mysqli_query($groupConnection, $gQuery);
if (@mysqli_num_rows($gResult)){
	while ($gRow = mysqli_fetch_row($gResult)){
		//if user is a group admin or less
		if ($permNum >= 10){
			//if user is not a member of this group
			if ($group != $gRow[0]){
				//skip and go to next
				continue;
			}
		}
		
		//output the group name
		//groups
		if(isset($_SESSION['c'])){
			if ($_SESSION['c']=='g'.$gRow[0]){
				$selected = 'selected="selected"';
			}
			else {$selected = '';}
		}
		if ($permNum <= 10){
			echo '<optgroup label="';
			echo 'Groups">';
			echo '</optgroup>';
			
			echo '<option value="g'.$gRow[0].'" '.$selected.'><strong>'.$gRow[1].'</strong></option>';
			
		}
		
		//get all the active organizations in this group
		$oQuery = "SELECT * FROM Organization WHERE Group_ID =" .  $gRow[0] . " AND Active = 1";
		$oResult = mysqli_query($groupConnection, $oQuery);
		if (@mysqli_num_rows($oResult)){
			while ($oRow = mysqli_fetch_row($oResult)){
				//if user is an organization admin or less
				if ($permNum >= 20){
					//if user is not a member of this organization
					if ($org != $oRow[0]){
						//skip and go to next
						continue;
					}
				}
				//output the organization name
				//output the org
				if(isset($_SESSION['c'])){
					if ($_SESSION['c']=='o'.$oRow[0]){
						$selected = 'selected="selected"';
					}
					else {
						$selected = '';
					}
				}
				if ($permNum <= 20){
					echo '<optgroup label="';
					echo '&nbsp;&nbsp;';
					echo 'Organization">';
					echo '</optgroup>';
					echo '<option value="o'.$oRow[0].'" '.$selected.'>';
					if ($permNum <= 10){
						echo '&nbsp;&nbsp;&nbsp;';
					}
					echo '<strong>'.$oRow[1].'</strong></option>';
					echo '<optgroup label="';
					if ($permNum <= 10){
						echo '&nbsp;&nbsp;';
					}
					echo '&nbsp;&nbsp;&nbsp;Clients">';
					echo '</optgroup>';
				}
				//echo $oRow[1];
				//check if tag is selected
				if ($_SESSION['t'] != '-'){
					//get all the active clients in this organization with this tag
					$cQuery = "SELECT * FROM Clients WHERE Org_ID =" . $oRow[0] . " AND Active = 1 AND Tag = " . $_SESSION['t'];
					//echo $cQuery;
					$cResult = mysqli_query($groupConnection, $cQuery);
					if (@mysqli_num_rows($cResult)){
						while ($cRow = mysqli_fetch_row($cResult)){
							//if user is a client admin or less
							if ($permNum >= 30){
								//if user is not a member of this client
								if ($client != $cRow[0]){
									//skip and go to next
									continue;
								}
							}
							//output the client name
							if(isset($_SESSION['c'])){
								if ($_SESSION['c']=='c'.$cRow[0]){
									$selected = 'selected="selected"';
								}
								else {
									$selected = '';
								}
							}
							echo '<option value="c'.$cRow[0].'" '.$selected.'>';

							if ($permNum <= 20){
								echo '&nbsp;&nbsp;&nbsp;';
								if ($permNum <= 10){
									echo '&nbsp;&nbsp;';
								}
							}
							echo $cRow[1].'</option>';
							//echo $cRow[1];
						}
					}
				}
				else {
					//get all the active clients in this organization
					$cQuery = "SELECT * FROM Clients WHERE Org_ID =" . $oRow[0] . " AND Active = 1";
					//echo $cQuery;
					$cResult = mysqli_query($groupConnection, $cQuery);
					if (@mysqli_num_rows($cResult)){
						while ($cRow = mysqli_fetch_row($cResult)){
							//if user is a client admin or less
							if ($permNum >= 30){
								//if user is not a member of this client
								if ($client != $cRow[0]){
									//skip and go to next
									continue;
								}
							}
							//output the client name
							if(isset($_SESSION['c'])){
								if ($_SESSION['c']=='c'.$cRow[0]){
									$selected = 'selected="selected"';
								}
								else {
									$selected = '';
								}
							}
							echo '<option value="c'.$cRow[0].'" '.$selected.'>';
							if ($permNum <= 20){
								echo '&nbsp;&nbsp;&nbsp;';
								if ($permNum <= 10){
									echo '&nbsp;&nbsp;';
								}
							}
							echo $cRow[1].'</option>';
							//echo $cRow[1];
						}
					}
				}
				if ($permNum == 0){
					$cQuery = "SELECT * FROM Clients WHERE Org_ID =" . $oRow[0] . " AND Active = 0";
					$cResult = mysqli_query($groupConnection, $cQuery);
					if (@mysqli_num_rows($cResult)){
						while ($cRow = mysqli_fetch_row($cResult)){
						//output the client name
							echo $cRow[1];
						}
					}
					echo '</optgroup>';
				}
			}
			echo '</optgroup>';
		}
		//if user is a super-admin
		if ($permNum == 0){
			$oQuery = "SELECT * FROM Organization WHERE Group_ID =" .  $gRow[0] . " AND Active = 0";
			$oResult = mysqli_query($groupConnection, $oQuery);
			if (@mysqli_num_rows($oResult)){
				while ($oRow = mysqli_fetch_row($oResult)){
					//output the organization name
					//echo $oRow[1];
					if(isset($_SESSION['c'])){
						if ($_SESSION['c']=='o'.$oRow[0]){
							$selected = 'selected="selected"';
						}
						else {$selected = '';}
					}
					echo '<option value="o'.$oRow[0].'" '.$selected.'>&nbsp;&nbsp;&nbsp;<strong>'.$oRow[1].'</strong></option>';
					echo '<optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Clients">';
					//get all the inactive clients in this organization
					$cQuery = "SELECT * FROM Clients WHERE Org_ID =" . $oRow[0] . " AND Active = 0";
					$cResult = mysqli_query($groupConnection, $cQuery);
					if (@mysqli_num_rows($cResult)){
						while ($cRow = mysqli_fetch_row($cResult)){
							//output the client name
							//echo $cRow[1];
							if(isset($_SESSION['c'])){
								if ($_SESSION['c']=='c'.$cRow[0]){
									$selected = 'selected="selected"';
								}
								else {$selected = '';}
							}
							echo '<option value="c'.$cRow[0].'" '.$selected.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$cRow[1].'</option>';
						}
						echo '</optgroup>';
					}
				}
				echo '</optgroup>';
			}
		}
	}
}
//if the client is a super-admin
if ($permNum == 0){
	//select all inactive groups
	$gQuery = "SELECT * FROM Groups WHERE Active = 0";
	$gResult = mysqli_query($groupConnection, $gQuery);
	if (@mysqli_num_rows($gResult)){
		while ($gRow = mysqli_fetch_row($gResult)){
			//output group name
			if(isset($_SESSION['c'])){
				if ($_SESSION['c']=='g'.$gRow[0]){
					$selected = 'selected="selected"';
				}
				else {$selected = '';}
			}
			echo '<option value="g'.$gRow[0].'" '.$selected.'><strong>'.$gRow[1].'</strong></option>';
			//select all inactive organizations
			$oQuery = "SELECT * FROM Organization WHERE Group_ID =" .  $gRow[0] . " AND Active = 0";
			$oResult = mysqli_query($groupConnection, $oQuery);
			if (@mysqli_num_rows($oResult)){
				while ($oRow = mysqli_fetch_row($oResult)){
					//output organization name
					//echo $oRow[1];
					if(isset($_SESSION['c'])){
						if ($_SESSION['c']=='o'.$oRow[0]){

							$selected = 'selected="selected"';
						}
						else {$selected = '';}
					}
					echo '<option value="o'.$oRow[0].'" '.$selected.'>&nbsp;&nbsp;&nbsp;<strong>'.$oRow[1].'</strong></option>';
					echo '<optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Clients">';
					//select all inactive clients
					$cQuery = "SELECT * FROM Clients WHERE Org_ID =" . $oRow[0] . " AND Active = 0";
					$cResult = mysqli_query($groupConnection, $cQuery);
					if (@mysqli_num_rows($cResult)){
						while ($cRow = mysqli_fetch_row($cResult)){
							//output client name
							//echo $cRow[1];
							if(isset($_SESSION['c'])){
								if ($_SESSION['c']=='c'.$cRow[0]){
									$selected = 'selected="selected"';
								}
								else {$selected = '';}
							}
							echo '<option value="c'.$cRow[0].'" '.$selected.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$cRow[1].'</option>';
						}
					}
				}
			}
		}
	}
}

echo '</select></div>';
}
else
{echo 'sorry!';}


?>