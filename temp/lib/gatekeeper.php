<?php 

require("keeper.php"); 
require($_SERVER['DOCUMENT_ROOT'] . "/connections/usergate.php");
require($_SERVER['DOCUMENT_ROOT'] . "/connections/acctgate.php");
require($_SERVER['DOCUMENT_ROOT'] . "/connections/groupgate.php");
require($_SERVER['DOCUMENT_ROOT'] . "/connections/accessgate.php");

$password = stripslashes($_POST["password"]);
$username = stripslashes($_POST["username"]);

$bcrypt = new PassHash;

$query = "SELECT User_ID FROM Users WHERE User_Name='" . mysqli_real_escape_string($userConnection, $username) . "'";
$result = mysqli_query($userConnection, $query);
if (@mysqli_num_rows($result)){
	$userID = mysqli_fetch_array($result, MYSQLI_BOTH);
	mysqli_close($userConnection);
	$query = "SELECT * FROM ACCT_Info WHERE User_ID='" . $userID["User_ID"] . "'";
	$result = mysqli_query($acctConnection, $query);
	if (@mysqli_num_rows($result)){
		$acctInfo = mysqli_fetch_array($result, MYSQLI_BOTH);
		if ($acctInfo[11] == 1){
			$isGood = $bcrypt->check_password($acctInfo["Password"], $password);
			if ($isGood){
				mysqli_close($acctConnection);
				$query = "SELECT * FROM Groups WHERE Group_ID='" . $acctInfo["Group_ID"] . "'";
				$result = mysqli_query($groupConnection, $query);
				if (@mysqli_num_rows($result)){
					$query = "SELECT * FROM Organization WHERE Org_ID='" . $acctInfo["Org_ID"] . "'";
					$result = mysqli_query($groupConnection, $query);
					if (@mysqli_num_rows($result)){
						$query = "SELECT * FROM Permissions WHERE Permission_Num='" . $acctInfo["Permission_ID"] . "'";
						$result = mysqli_query($groupConnection, $query);
						if (@mysqli_num_rows($result)){
							if ($acctInfo["Generated"]){
								$fileName = $_SERVER['DOCUMENT_ROOT'] . "/logs/logins.log";
								if (file_exists($fileName)){
									if (filesize($fileName) >= 256000){
										$newFilename = $_SERVER['DOCUMENT_ROOT'] . "/logs/backup/" . date("Ymd-His", time());
										rename($fileName, $newFilename);
										$fh = fopen($fileName, 'w');
										$headerInfo = "Username,Login Date,IP Address,Result";
										fwrite($fh, $headerInfo);
										$loginData = $username . "," . date("Y-m-d H:i:s", time()) . "," . $_SERVER['REMOTE_ADDR'] . ",Reset Password";
										fwrite($fh, $loginData);
										fclose($fh);
										echo "generated";
									}
									else {
										$fh = fopen($filename, 'a');
										$loginData = $username . "," . date("Y-m-d H:i:s", time()) . "," . $_SERVER['REMOTE_ADDR'] . ",Reset Password";
										fwrite($fh, $loginData);
										fclose($fh);
										echo "generated";
									}
								}
								else {
									$fh = fopen($fileName, 'w');
									$headerInfo = "Username,Login Date,IP Address,Result";
									fwrite($fh, $headerInfo);
									$loginData = $username . "," . date("Y-m-d H:i:s", time()) . "," . $_SERVER['REMOTE_ADDR'] . ",Reset Password";
									fwrite($fh, $loginData);
									fclose($fh);
									echo "generated";
								}
							}
							else {
								$fileName = $_SERVER['DOCUMENT_ROOT'] . "/logs/logins.log";
								if (file_exists($fileName)){
									if (filesize($fileName) >= 256000){
										$newFilename = $_SERVER['DOCUMENT_ROOT'] . "/logs/backup/" . date("Ymd-His", time());
										rename($fileName, $newFilename);
										$fh = fopen($fileName, 'w');
										$headerInfo = "Username,Login Date,IP Address,Result";
										fwrite($fh, $headerInfo);
										$loginData = $username . "," . date("Y-m-d H:i:s", time()) . "," . $_SERVER['REMOTE_ADDR'] . ",success";
										fwrite($fh, $loginData);
										fclose($fh);
										echo true;
									}
									else {
										$fh = fopen($filename, 'a');
										$loginData = $username . "," . date("Y-m-d H:i:s", time()) . "," . $_SERVER['REMOTE_ADDR'] . ",success";
										fwrite($fh, $loginData);
										fclose($fh);
										echo true;
									}
								}
								else {
									$fh = fopen($fileName, 'w');
									$headerInfo = "Username,Login Date,IP Address,Result";
									fwrite($fh, $headerInfo);
									$loginData = $username . "," . date("Y-m-d H:i:s", time()) . "," . $_SERVER['REMOTE_ADDR'] . ",success";
									fwrite($fh, $loginData);
									fclose($fh);
									echo true;
								}
							}
						}
						else {
							$fileName = $_SERVER['DOCUMENT_ROOT'] . "/logs/logins.log";
							if (file_exists($fileName)){
								if (filesize($fileName) >= 256000){
									$newFilename = $_SERVER['DOCUMENT_ROOT'] . "/logs/backup/" . date("Ymd-His", time());
									rename($fileName, $newFilename);
									$fh = fopen($fileName, 'w');
									$headerInfo = "Username,Login Date,IP Address,Result";
									fwrite($fh, $headerInfo);
									$loginData = $username . "," . date("Y-m-d H:i:s", time()) . "," . $_SERVER['REMOTE_ADDR'] . ",failure";
									fwrite($fh, $loginData);
									fclose($fh);
									echo false;
								}
								else {
									$fh = fopen($filename, 'a');
									$loginData = $username . "," . date("Y-m-d H:i:s", time()) . "," . $_SERVER['REMOTE_ADDR'] . ",failure";
									fwrite($fh, $loginData);
									fclose($fh);
									echo false;
								}
							}
							else {
								$fh = fopen($fileName, 'w');
								$headerInfo = "Username,Login Date,IP Address,Result";
								fwrite($fh, $headerInfo);
								$loginData = $username . "," . date("Y-m-d H:i:s", time()) . "," . $_SERVER['REMOTE_ADDR'] . ",failure";
								fwrite($fh, $loginData);
								fclose($fh);
								echo false;
							}
						}				
					}
					else {
						$fileName = $_SERVER['DOCUMENT_ROOT'] . "/logs/logins.log";
						if (file_exists($fileName)){
							if (filesize($fileName) >= 256000){
								$newFilename = $_SERVER['DOCUMENT_ROOT'] . "/logs/backup/" . date("Ymd-His", time());
								rename($fileName, $newFilename);
								$fh = fopen($fileName, 'w');
								$headerInfo = "Username,Login Date,IP Address,Result";
								fwrite($fh, $headerInfo);
								$loginData = $username . "," . date("Y-m-d H:i:s", time()) . "," . $_SERVER['REMOTE_ADDR'] . ",failure";
								fwrite($fh, $loginData);
								fclose($fh);
								echo false;
							}
							else {
								$fh = fopen($filename, 'a');
								$loginData = $username . "," . date("Y-m-d H:i:s", time()) . "," . $_SERVER['REMOTE_ADDR'] . ",failure";
								fwrite($fh, $loginData);
								fclose($fh);
								echo false;
							}
						}
						else {
							$fh = fopen($fileName, 'w');
							$headerInfo = "Username,Login Date,IP Address,Result";
							fwrite($fh, $headerInfo);
							$loginData = $username . "," . date("Y-m-d H:i:s", time()) . "," . $_SERVER['REMOTE_ADDR'] . ",failure";
							fwrite($fh, $loginData);
							fclose($fh);
							echo false;
						}
					}
				}
				else {
					$fileName = $_SERVER['DOCUMENT_ROOT'] . "/logs/logins.log";
					if (file_exists($fileName)){
						if (filesize($fileName) >= 256000){
							$newFilename = $_SERVER['DOCUMENT_ROOT'] . "/logs/backup/" . date("Ymd-His", time());
							rename($fileName, $newFilename);
							$fh = fopen($fileName, 'w');
							$headerInfo = "Username,Login Date,IP Address,Result";
							fwrite($fh, $headerInfo);
							$loginData = $username . "," . date("Y-m-d H:i:s", time()) . "," . $_SERVER['REMOTE_ADDR'] . ",failure";
							fwrite($fh, $loginData);
							fclose($fh);
							echo false;
						}
						else {
							$fh = fopen($filename, 'a');
							$loginData = $username . "," . date("Y-m-d H:i:s", time()) . "," . $_SERVER['REMOTE_ADDR'] . ",failure";
							fwrite($fh, $loginData);
							fclose($fh);
							echo false;
						}
					}
					else {
						$fh = fopen($fileName, 'w');
						$headerInfo = "Username,Login Date,IP Address,Result";
						fwrite($fh, $headerInfo);
						$loginData = $username . "," . date("Y-m-d H:i:s", time()) . "," . $_SERVER['REMOTE_ADDR'] . ",failure";
						fwrite($fh, $loginData);
						fclose($fh);
						echo false;
					}
				}
			}
			else {
				mysqli_close($acctConnection);
				$fileName = $_SERVER['DOCUMENT_ROOT'] . "/logs/logins.log";
				if (file_exists($fileName)){
					if (filesize($fileName) >= 256000){
						$newFilename = $_SERVER['DOCUMENT_ROOT'] . "/logs/backup/" . date("Ymd-His", time());
						rename($fileName, $newFilename);
						$fh = fopen($fileName, 'w');
						$headerInfo = "Username,Login Date,IP Address,Result";
						fwrite($fh, $headerInfo);
						$loginData = $username . "," . date("Y-m-d H:i:s", time()) . "," . $_SERVER['REMOTE_ADDR'] . ",failure";
						fwrite($fh, $loginData);
						fclose($fh);
						echo false;
					}
					else {
						$fh = fopen($filename, 'a');
						$loginData = $username . "," . date("Y-m-d H:i:s", time()) . "," . $_SERVER['REMOTE_ADDR'] . ",failure";
						fwrite($fh, $loginData);
						fclose($fh);
						echo false;
					}
				}
				else {
					$fh = fopen($fileName, 'w');
					$headerInfo = "Username,Login Date,IP Address,Result";
					fwrite($fh, $headerInfo);
					$loginData = $username . "," . date("Y-m-d H:i:s", time()) . "," . $_SERVER['REMOTE_ADDR'] . ",failure";
					fwrite($fh, $loginData);
					fclose($fh);
					echo false;
				}
			}
		}
		else {
			mysqli_close($userConnection);
			mysqli_close($acctConnection);
			$fileName = $_SERVER['DOCUMENT_ROOT'] . "/logs/logins.log";
			if (file_exists($fileName)){
				if (filesize($fileName) >= 256000){
					$newFilename = $_SERVER['DOCUMENT_ROOT'] . "/logs/backup/" . date("Ymd-His", time());
					rename($fileName, $newFilename);
					$fh = fopen($fileName, 'w');
					$headerInfo = "Username,Login Date,IP Address,Result";
					fwrite($fh, $headerInfo);
					$loginData = $username . "," . date("Y-m-d H:i:s", time()) . "," . $_SERVER['REMOTE_ADDR'] . ",failure";
					fwrite($fh, $loginData);
					fclose($fh);
					echo false;
				}
				else {
					$fh = fopen($filename, 'a');
					$loginData = $username . "," . date("Y-m-d H:i:s", time()) . "," . $_SERVER['REMOTE_ADDR'] . ",failure";
					fwrite($fh, $loginData);
					fclose($fh);
					echo false;
				}
			}
			else {
				$fh = fopen($fileName, 'w');
				$headerInfo = "Username,Login Date,IP Address,Result";
				fwrite($fh, $headerInfo);
				$loginData = $username . "," . date("Y-m-d H:i:s", time()) . "," . $_SERVER['REMOTE_ADDR'] . ",failure";
				fwrite($fh, $loginData);
				fclose($fh);
				echo false;
			}
		}
	}
	else {
		mysqli_close($userConnection);
		mysqli_close($acctConnection);
		$fileName = $_SERVER['DOCUMENT_ROOT'] . "/logs/logins.log";
		if (file_exists($fileName)){
			if (filesize($fileName) >= 256000){
				$newFilename = $_SERVER['DOCUMENT_ROOT'] . "/logs/backup/" . date("Ymd-His", time());
				rename($fileName, $newFilename);
				$fh = fopen($fileName, 'w');
				$headerInfo = "Username,Login Date,IP Address,Result";
				fwrite($fh, $headerInfo);
				$loginData = $username . "," . date("Y-m-d H:i:s", time()) . "," . $_SERVER['REMOTE_ADDR'] . ",failure";
				fwrite($fh, $loginData);
				fclose($fh);
				echo false;
			}
			else {
				$fh = fopen($filename, 'a');
				$loginData = $username . "," . date("Y-m-d H:i:s", time()) . "," . $_SERVER['REMOTE_ADDR'] . ",failure";
				fwrite($fh, $loginData);
				fclose($fh);
				echo false;
			}
		}
		else {
			$fh = fopen($fileName, 'w');
			$headerInfo = "Username,Login Date,IP Address,Result";
			fwrite($fh, $headerInfo);
			$loginData = $username . "," . date("Y-m-d H:i:s", time()) . "," . $_SERVER['REMOTE_ADDR'] . ",failure";
			fwrite($fh, $loginData);
			fclose($fh);
			echo false;
		}
	}
}
else {
	mysqli_close($userConnection);
	mysqli_close($acctConnection);
	$fileName = $_SERVER['DOCUMENT_ROOT'] . "/logs/logins.log";
	if (file_exists($fileName)){
		if (filesize($fileName) >= 256000){
			$newFilename = $_SERVER['DOCUMENT_ROOT'] . "/logs/backup/" . date("Ymd-His", time());
			rename($fileName, $newFilename);
			$fh = fopen($fileName, 'w');
			$headerInfo = "Username,Login Date,IP Address,Result";
			fwrite($fh, $headerInfo);
			$loginData = $username . "," . date("Y-m-d H:i:s", time()) . "," . $_SERVER['REMOTE_ADDR'] . ",failure";
			fwrite($fh, $loginData);
			fclose($fh);
			echo false;
		}
		else {
			$fh = fopen($filename, 'a');
			$loginData = $username . "," . date("Y-m-d H:i:s", time()) . "," . $_SERVER['REMOTE_ADDR'] . ",failure";
			fwrite($fh, $loginData);
			fclose($fh);
			echo false;
		}
	}
	else {
		$fh = fopen($fileName, 'w');
		$headerInfo = "Username,Login Date,IP Address,Result";
		fwrite($fh, $headerInfo);
		$loginData = $username . "," . date("Y-m-d H:i:s", time()) . "," . $_SERVER['REMOTE_ADDR'] . ",failure";
		fwrite($fh, $loginData);
		fclose($fh);
		echo false;
	}
}
?>