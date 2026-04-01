<!DOCTYPE html>
<html lang="en">
<head>
	<title>n0mCode Kayıt Ol</title>
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
						yeni hesap oluştur
					</span>
				</div>
				<?php
				require_once 'r00t/xo/functions.php';
				dbConnect();
				$vericek = $db->query("SELECT * FROM setting WHERE n0m_setting = 1")->fetch(PDO::FETCH_ASSOC);

				if ($vericek['n0m_userreg'] == "1") { ?>
					<form class="login100-form validate-form" method="POST" action="r00t/xo/functions.php">
						<div class="wrap-input100 validate-input m-b-26" data-validate="Lütfen geçerli bir kullanıcı adı giriniz">
							<span class="label-input100">Kullanıcı adı</span>
							<input class="input100" type="text" name="username">
							<span class="focus-input100"></span>
						</div>

						<div class="wrap-input100 validate-input m-b-18" data-validate = "Lütfen geçerli bir şifre giriniz">
							<span class="label-input100">Şifre</span>
							<input class="input100" type="password" name="password">
							<span class="focus-input100"></span>
						</div>

						<div class="wrap-input100 validate-input m-b-18" data-validate = "Lütfen geçerli bir eposta adresi giriniz">
							<span class="label-input100">Email</span>
							<input class="input100" type="email" name="email">
							<span class="focus-input100"></span>
						</div>

						<div class="wrap-input100 m-b-18" data-validate = "Lütfen geçerli bir url adresi giriniz">
							<span class="label-input100">Profil resmi</span>
							<input class="input100" type="url" name="picture">
							<span class="focus-input100"></span>
						</div>

						<div class="flex-sb-m w-full p-b-30">
							<div class="contact100-form-checkbox">
								<a href="login" class="txt1">
									Giriş yapmak için tıkla
								</a>
							</div>

							<div>
								<a href="#" class="txt1">
									Şifrenizi mi unuttunuz?
								</a>
							</div>
						</div>
						<div class="g-recaptcha" data-sitekey="<?php
						require_once 'r00t/xo/functions.php';
						dbConnect();
						$vericek = $db->query("SELECT * FROM recaptcha WHERE recaptcha = 1")->fetch(PDO::FETCH_ASSOC);
						if ( $vericek ){ 
							echo $vericek["recaptcha_sitekey"];
						}
						?>"></div>
						<div class="container-login100-form-btn" style="margin-top: 10px">
							<button class="login100-form-btn" name="singup">
								Kayıt ol
							</button>
						</div>
					</form>
				<?php }
				else{ ?>
					<center>
						<h3 style="padding: 30px; text-align: center;">Sistem yeni kullanıcı kaydına kapalıdır</h3>
						<a href="login">
							<button class="login100-form-btn" style="margin:10px 10px 30px">
								Giriş yap
							</button>
						</a>
					</center>
				<?php } ?>
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