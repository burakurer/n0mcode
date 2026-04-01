<?php
require_once 'root/n0mSystem/n0mGuard.php';
n0mDB_Connect();
$vericek = $db->query("SELECT * FROM setting WHERE n0m_setting = 1")->fetch(PDO::FETCH_ASSOC);
if ($vericek['n0m_maintenance'] == "0") {
	header('Location:login');
	die();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>n0mCode | Sistem Bakımdadır</title>
	<link rel="stylesheet" type="text/css" href="bakim.css">
</head>
<body>
	<div id="wrapper">
		<div class="grid">
			<span class="server"></span>
			<span class="server"></span>
			<span class="server"></span>
			<span class="server"></span>
			<span class="server"></span>
		</div>
		<div class="content">          
			<h1><b>Sisteme şuanda bakım yapılıyor, lütfen daha sonra tekrar deneyiniz</b></h1>
		</div>
	</div>  
</body>
</html>