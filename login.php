<?php
require_once 'r00t/xo/functions.php';
dbConnect();
global $db;
ob_start();
session_start();
$sorgu = @$_SESSION['user_name'];
if ($sorgu) {
	$vericek = $db->query("SELECT * FROM user WHERE user_name = '$sorgu'")->fetch(PDO::FETCH_ASSOC);
	if ($vericek) {
		$usersorgu = $vericek['user_yetki'];
		if ($usersorgu == "admin") {
			header('Location:r00t/main');
		}
		if ($usersorgu == "user"){
			header('Location:user/main');
		}
	}
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
	<title>n0mCode Kullanıcı Girişi</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="loginf/images/icons/favicon.ico"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginf/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginf/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginf/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginf/vendor/animate/animate.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="loginf/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginf/vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginf/vendor/select2/select2.min.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="loginf/vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginf/css/util.css">
	<link rel="stylesheet" type="text/css" href="loginf/css/main.css">
	<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url('loginf/images/bg.jpeg');">
					<span class="login100-form-title-1">
						n0mCode kullanıcı girişi
					</span>
				</div>

				<form class="login100-form validate-form" method="POST" action="secureLogin.php">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Lütfen kullanıcı adınızı giriniz">
						<span class="label-input100">Kullanıcı adı</span>
						<input class="input100" type="text" name="username">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Lütfen şifrenizi giriniz">
						<span class="label-input100">Şifre</span>
						<input class="input100" type="password" name="password">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-sb-m w-full p-b-30">
						<div class="contact100-form-checkbox">
							<a href="singup" class="txt1">
								Kayıt olmak için tıkla
							</a>
						</div>

						<div>
							<a href="#" class="txt1">
								Şifrenizi mi unuttunuz?
							</a>
						</div>
					</div>
					<div class="g-recaptcha" data-sitekey="<?php
					echo '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI';
					/*require_once 'r00t/xo/functions.php';
					dbConnect();
					$vericek = $db->query("SELECT * FROM recaptcha WHERE recaptcha = 1")->fetch(PDO::FETCH_ASSOC);
					if ( $vericek ){ 
						echo $vericek["recaptcha_sitekey"];
					}*/
					?>"></div>
					<div class="container-login100-form-btn" style="margin-top: 10px">
						<button class="login100-form-btn" name="secureLogin">
							Giriş yap
						</button>
					</div>
				</form>
				<p class="txt1" style="text-align: center;">
					Güvenlik amaçlı ip adresiniz kayıt altına alınmaktadır. <br>
					İp adresiniz: <b><?php echo $_SERVER["REMOTE_ADDR"]; ?></b>
				</p>
			</div>
		</div>
	</div>

	<!--===============================================================================================-->
	<script src="loginf/vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="loginf/vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="loginf/vendor/bootstrap/js/popper.js"></script>
	<script src="loginf/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="loginf/vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="loginf/vendor/daterangepicker/moment.min.js"></script>
	<script src="loginf/vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="loginf/vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<script src="loginf/js/main.js"></script>
	<script src="https://www.google.com/recaptcha/api.js?hl=tr"></script>
</body>
</html>