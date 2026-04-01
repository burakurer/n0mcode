<?php
// error_reporting(0);
require_once 'root/n0mSystem/n0mGuard.php';
n0mDB_Connect();
$vericek = $db->query("SELECT * FROM setting WHERE n0m_setting = 1")->fetch(PDO::FETCH_ASSOC);
if ($vericek['n0m_maintenance'] == "1") {
	header('Location:bakim');
	die();
}
ob_start();
session_start();
if ($_SESSION['user_name']) {
	$sorgu = $_SESSION['user_name'];
	$vericek = $db->query("SELECT * FROM user WHERE user_name = '$sorgu'")->fetch(PDO::FETCH_ASSOC);
	if ($vericek) {
		$usersorgu = $vericek['user_yetki'];
		if ($usersorgu == "admin") {
			header('Location:root/main');
		}
		if ($usersorgu == "user"){
			header('Location:user/main');
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>n0mCode Kullanıcı Girişi</title>
	<link rel="stylesheet" type="text/css" href="loginf/login.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="loginf/wave.png">
	<div class="container">
		<div class="img">
			<img src="loginf/logo.png">
		</div>
		<div class="login-content">
			<form action="secureLogin.php" method="POST">
				<h2 class="title">Giriş yap</h2>
				<div class="input-div one">
					<div class="i">
						<i class="fas fa-user"></i>
					</div>
					<div class="div">
						<h5>Kullanıcı adı</h5>
						<input type="text" name="username" class="input" required>
					</div>
				</div>
				<div class="input-div pass">
					<div class="i"> 
						<i class="fas fa-lock"></i>
					</div>
					<div class="div">
						<h5>Şifre</h5>
						<input type="password" name="password" class="input" required>
					</div>
				</div>
				<div style="margin-top: 15px; margin-bottom: -10px" class="h-captcha" data-sitekey="<?php
				require_once 'root/n0mSystem/n0mGuard.php';
				n0mDB_Connect();
				$vericek = $db->query("SELECT * FROM hcaptcha WHERE hcaptcha = 1")->fetch(PDO::FETCH_ASSOC);
				if ( $vericek ){ 
					echo $vericek["hcaptcha_sitekey"];
				}
				?>"></div>
				<?php if($_GET['x']=='error'){ ?>
				<span class="muted">Giriş başarısız, <b>
					<?php
					switch ($_GET['q']) {
						case 'no':
						echo "şifre yada kullanıcı adı yanlış!";
						break;
						case 'captcha':
						echo "captcha hatası lütfen tekrar deneyin!";
						break;
						default:
						break;
					}}elseif($_GET['x']=='logout'){echo "Çıkış işlemi başarılı!";}
					?></b></span>
				<input type="submit" class="btn" name="secureLogin" value="Giriş yap">
				<input type="submit" class="btn" value="Kayıt ol [Devredışı]" disabled>
				<span class="muted">ip adresiniz: <b><?php echo $_SERVER["HTTP_CF_CONNECTING_IP"]; ?></b></span>
			</form>
		</div>
	</div>
	<script type="text/javascript" src="loginf/login.js"></script>
	<!-- <script src="https://hcaptcha.com/1/api.js" async defer></script> -->
</body>
</html>