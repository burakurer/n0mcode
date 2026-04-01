<?php
/*
* n0mCode © 2020
* n0mCore version 1.3
* Developer by R6w[M]uhammet
* kodfaresi.xyz & mami.wtf
*/
error_reporting(0);
function n0mDB_Connect(){
	try {
		global $db;
		$db = new PDO("mysql:host=db;dbname=n0mcode;charset=utf8;", "root", "n0mcode");
	} catch (PDOException $error) { ?>
		<!-- n0mReportSystem v1.0 -->
		<link rel="stylesheet" type="text/css" href="../theme/theme-assets/css/vendors.css">
		<link rel="stylesheet" type="text/css" href="../theme/theme-assets/css/app-lite.css">
		<div class="alert alert-danger alert-dismissible mb-2" role="alert">
			<h1 class="alert-heading mb-2">Kritik sistem hatası</h1>
			<h3 class="alert-heading"><u>n0mcode Çıktısı</u></h3>
			<div style="border: 1px solid white; padding: 10px; ">
				<p>Çıktı zamanı: <code class="danger"><?php date_default_timezone_set('Europe/Istanbul'); echo date("H:i - d-m-Y"); ?></code></p>
				<p>Hata kodu: <code class="danger">Veritabanı bağlantı hatası!</code></p>
				<p>Hatayı yöneticiye bildir! <code class="danger"><a href="mailto:root@kodfaresi.xyz">eposta</a></code></p>
			</div>
		</div>
		<?php die(); 
	}
}

function n0mLogDB_Connect(){
	try {
		global $db;
		$db = new PDO("mysql:host=db;dbname=n0mcode;charset=utf8;", "root", "n0mcode");
	} catch (PDOException $error) { ?>
		<!-- n0mReportSystem v1.0 -->
		<link rel="stylesheet" type="text/css" href="../theme/theme-assets/css/vendors.css">
		<link rel="stylesheet" type="text/css" href="../theme/theme-assets/css/app-lite.css">
		<div class="alert alert-danger alert-dismissible mb-2" role="alert">
			<h1 class="alert-heading mb-2">Kritik sistem hatası</h1>
			<h3 class="alert-heading"><u>n0mcode Çıktısı</u></h3>
			<div style="border: 1px solid white; padding: 10px; ">
				<p>Çıktı zamanı: <code class="danger"><?php date_default_timezone_set('Europe/Istanbul'); echo date("H:i - d-m-Y"); ?></code></p>
				<p>Hata kodu: <code class="danger">Veritabanı bağlantı hatası!</code></p>
				<p>Hatayı yöneticiye bildir! <code class="danger"><a href="mailto:root@kodfaresi.xyz">eposta</a></code></p>
			</div>
		</div>
		<?php die(); 
	}
}
?>