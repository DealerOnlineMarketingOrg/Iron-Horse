<?php
if (!session_id()) session_start();
if (!isset($_SESSION['question'])){
	$_SESSION['question'] = 42;
}
else {
	if ($_SESSION['question'] != 42){
		$_SESSION['question'] = 42;
	}
}
if (!isset($_SESSION['u'])){
	$_SESSION['u'] = $_POST['username'];
}
else {
	unset($_SESSION['u']);
	$_SESSION['u'] = $_POST['username'];
}
if (!isset($_SESSION['t'])){
	$_SESSION['t'] = '-';
}
include($_SERVER['DOCUMENT_ROOT'] . '/includes/header/dropdown/change.php');
include($_SERVER['DOCUMENT_ROOT'] . '/includes/main/main.php');
?>