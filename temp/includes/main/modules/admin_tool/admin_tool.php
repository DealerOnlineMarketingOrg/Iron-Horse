<?php // echo 'admin tool dashboard';
if (!session_id()) session_start();
echo '';
require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/main/modules/admin_tool/client/clientadmin.php");
?>