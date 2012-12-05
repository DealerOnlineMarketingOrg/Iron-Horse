<?php 
//my account
if (!session_id()) session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/usergate.php");
if(isset($_SESSION['u'])){
	$userName12 = $_SESSION['u'];
	$query = 'SELECT * FROM Users WHERE User_Name = "'.$userName12.'"';
	if ($result = mysqli_query($userConnection, $query)){
		while($userRow = $result->fetch_row()){
		
		echo '<div id="topAccount_Area">';
		echo '<a href="javascript:editUser('.$userRow[0].');" id="topAccount_Edit_Link">';
		echo '<div id="topAccount_Box">';
		echo '<div id="topAccount_Edit_Icon"></div><div id="topAccount_Edit_Txt">MY ACCOUNT</div>';
		echo '</div></a></div>';
		}
	}
}
else {
	echo '<div id="topAccount_Area">';
	echo '<a href="#" id="topAccount_Edit_Link">';
	echo '<div id="topAccount_Box">';
	echo '<div id="topAccount_Edit_Icon"></div><div id="topAccount_Edit_Txt">MY ACCOUNT</div>';
	echo '</div></a></div>';
}




//logout
echo '<div id="topLogout_Area">';
echo '<a href="javascript:topLogout_Link();" id="topLogout_Link">';
echo '<div id="topLogout_Box"><div id="topLogout_Icon"></div><div id="topLogout_Txt">LOGOUT</div>';
echo '</div></a></div>';

//logo
echo '<div id="topLogo_Area"><a href="#"><div id="topLogo_Box"><img src="img/header/logo/Logo.png" width="150" height="38" border="0"></div></a></div>'; 

?>