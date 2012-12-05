<?php
if (!session_id()) session_start();
$selected = '';
if(isset($_SESSION['u'])){
require_once($_SERVER['DOCUMENT_ROOT'] . "/connections/groupgate.php");

//echo start
echo '<div id="topTag_Selector"><select id="selectTag_Dropdown" onchange="javascript:changeTag()"><option value="-"></option>';


//get the tags
$query = "SELECT * FROM Tags";
$result = mysqli_query($groupConnection, $query);
if (@mysqli_num_rows($result)){
	while ($tag = mysqli_fetch_row($result)){
		if (isset($_SESSION['t'])){
			if ($_SESSION['t'] == $tag[0]){
				$selected = 'selected="selected"';
			}
			else {
				$selected = '';
			}
		}
		echo '<option value="' . $tag[0] . '" '. $selected . '>' . $tag[1] . '</option>';
	}
}
else {
	echo '<option value="=">No tags found</option>';
}
echo '</select></div><div id="topTag_Area"><a href="javascript:topTag_Edit();" id="topTag_Edit_Link"><div id="topTag_Box"><div id="topTag_Edit_Icon"></div><div id="topTag_Edit_Txt">EDIT</div></div></a></div>';
}
else {
	echo 'sorry!';
}
?>