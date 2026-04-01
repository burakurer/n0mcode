<?php
error_reporting(0);
require_once 'n0mData.php';

function loginControl(){
	n0mDB_Connect();
	ob_start();
	session_start();
	global $db;
	if (isset($_SESSION['user_name'])) {
		$sorgu = $_SESSION['user_name'];
		$vericek = $db->query("SELECT * FROM user WHERE user_name = '$sorgu'")->fetch(PDO::FETCH_ASSOC);
		if ($vericek) {
			$yetkisorgu = $vericek['user_yetki'];
			if ($yetkisorgu != "admin") {
				header('Location:../login.php');
				die();
			}
		}else{
			header('Location:../login.php');
			die();
		}
	}else{
		header('Location:../login.php');
		die();
	}
}
?>