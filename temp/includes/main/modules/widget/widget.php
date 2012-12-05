<?php

if (!session_id()) session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . '/connections/groupgate.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/connections/acctgate.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/connections/usergate.php');

$selected = $_SESSION['c'];
$count = 0;


echo '<div id="topWidget_Area">';
echo '<div id="topWidget_V_Bar"></div>';
echo '<div id="topWidget_Org_Area">';
echo '<div id="topWidget_Org_title">GROUPS</div>';
echo '<div id="topWidget_Org_Icon"></div>';
echo '<div id="topWidget_Org_Num">';
if ($selected[0] != 'g'){
	echo '1';
}
else if ($selected[0] == 'g') {
	$query = 'SELECT * FROM Organization WHERE Group_ID = ' . substr($selected, 1);
	$result = mysqli_query($groupConnection, $query);
	echo @mysqli_num_rows($result);
}
else {
	echo '??';
}
echo '</div>';
echo '</div>';
echo '<div id="topWidget_VD_Bar"></div>';
echo '<div id="topWidget_Client_Area">';
echo '<div id="topWidget_Client_Title">CLIENTS</div>';
echo '<div id="topWidget_Client_Icon"></div>';
echo '<div id="topWidget_Client_Num">';
if ($selected[0] == 'c'){
	echo '1';
}
else {
	if ($selected[0] == 'g'){
		$query = 'SELECT * FROM Organization WHERE Group_ID = ' . substr($selected, 1);
		$result = mysqli_query($groupConnection, $query);
		if (@mysqli_num_rows($result)){
			while ($org = mysqli_fetch_row($result)){
				$query = 'SELECT * FROM Clients WHERE Org_ID = ' . $org[0];
				$cResult = mysqli_query($groupConnection, $query);
				$count += @mysqli_num_rows($cResult);
			}
		}
		echo $count;
	}
	else if ($selected[0] == 'o') {
		$query = 'SELECT * FROM Clients WHERE Org_ID = ' . substr($selected, 1);
		$cResult = mysqli_query($groupConnection, $query);
		echo @mysqli_num_rows($cResult);
	}
	else {
		echo '??';
	}
	$count = 0;
}
echo '</div>';
echo '</div>';
echo '<div id="topWidget_VD_Bar"></div>';
echo '<div id="topWidget_Web_Area">';
echo '<div id="topWidget_Web_Title">WEBSITES</div>';
echo '<div id="topWidget_Web_Icon"></div>';
echo '<div id="topWidget_Web_Num">';
if ($selected[0] == 'c'){
	$query = 'SELECT * FROM Websites WHERE C_ID = ' . substr($selected, 1);
	$result = mysqli_query($groupConnection, $query);
	echo @mysqli_num_rows($result);
}
else if ($selected[0] == 'g'){
	$query = 'SELECT * FROM Organization WHERE Group_ID = ' . substr($selected, 1);
	$result = mysqli_query($groupConnection, $query);
	if (@mysqli_num_rows($result)){
		while ($org = mysqli_fetch_row($result)){
			$query = 'SELECT * FROM Clients WHERE Org_ID = ' . $org[0];
			$cResult = mysqli_query($groupConnection, $query);
			if (@mysqli_num_rows($cResult)){
				while ($client = mysqli_fetch_row($cResult)){
					$query = 'SELECT * FROM Websites WHERE C_ID = ' . $client[0];
					$wResult = mysqli_query($groupConnection, $query);
					$count += @mysqli_num_rows($wResult);
				}
			}
		}
	}
	echo $count;
}
else if ($selected[0] == 'o') {
	$query = 'SELECT * FROM Clients WHERE Org_ID = ' . substr($selected, 1);
	$cResult = mysqli_query($groupConnection, $query);
	if (@mysqli_num_rows($cResult)){
		while ($client = mysqli_fetch_row($cResult)){
			$query = 'SELECT * FROM Websites WHERE C_ID = ' . $client[0];
			$wResult = mysqli_query($groupConnection, $query);
			$count += @mysqli_num_rows($wResult);
		}
	}
	echo $count;
}
else {
	echo '??';
}
$count = 0;
echo '</div>';
echo '</div>';
echo '<div id="topWidget_VD_Bar"></div>';
echo '<div id="topWidget_User_Area">';
echo '<div id="topWidget_User_Title">USERS</div>';
echo '<div id="topWidget_User_Icon"></div>';
echo '<div id="topWidget_User_Num">';
if ($selected[0] == 'g'){
	$query = 'SELECT * FROM ACCT_Info WHERE Group_ID = ' . substr($selected, 1);
	$result = mysqli_query($acctConnection, $query);
	echo @mysqli_num_rows($result);
}
else if ($selected[0] == 'o'){
	$query = 'SELECT * FROM ACCT_Info WHERE Org_ID = ' . substr($selected, 1);
	$result = mysqli_query($acctConnection, $query);
	echo @mysqli_num_rows($result);
}
else if ($selected[0] == 'c'){
	$query = 'SELECT * FROM ACCT_Info WHERE C_ID = ' . substr($selected, 1);
	$result = mysqli_query($acctConnection, $query);
	echo @mysqli_num_rows($result);
}
else {
	echo '??';
}
echo '</div>';
echo '</div>';
echo '<div id="topWidget_V_Bar"></div></div>';
?>