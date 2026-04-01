<?php
require_once '../xo/functions.php';
dbConnect();

if (isset($_POST['reupdate'])) {
	if($query = $db->prepare("UPDATE recaptcha SET recaptcha_sitekey =:sitekey, recaptcha_secretkey =:secretkey WHERE recaptcha =:x")){
		$sitekey = $_POST['sitekey'];
		$secretkey = $_POST['secretkey'];
		$x = 1;
		$result = $query->execute(array( 
			'sitekey' => $sitekey,
			'secretkey' => $secretkey,
			'x' => $x
		)); 
		if($result){
			header('Location:recaptcha?x=success');
		}
		else{
			header('Location:recaptcha?x=error');
		}
	}else{
		header('Location:recaptcha?x=error');
	}
}
?>
<!DOCTYPE html>
<html class="loading" lang="tr" data-textdirection="ltr">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta name="author" content="R6wm">
	<title>n0mCode - Eklentiler</title>
	<link rel="shortcut icon" type="image/x-icon" href="../../theme/theme-assets/images/ico/n0m.ico">
	<link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">
	<link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
	<!-- BEGIN VENDOR CSS-->
	<link rel="stylesheet" type="text/css" href="../../theme/theme-assets/css/vendors.css">
	<!-- END VENDOR CSS-->
	<!-- BEGIN CHAMELEON  CSS-->
	<link rel="stylesheet" type="text/css" href="../../theme/theme-assets/css/app-lite.css">
	<!-- END CHAMELEON  CSS-->
	<!-- BEGIN Page Level CSS-->
	<link rel="stylesheet" type="text/css" href="../../theme/theme-assets/css/core/menu/menu-types/vertical-menu.css">
	<link rel="stylesheet" type="text/css" href="../../theme/theme-assets/css/core/colors/palette-gradient.css">
	<!-- END Page Level CSS-->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

</head>

<body class="vertical-layout vertical-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-purple-blue" data-col="2-columns">
	<?php
	if (@$_GET['x'] == "success") { ?>
		<script>
			const Toast = Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000,
				timerProgressBar: true,
			})

			Toast.fire({
				icon: 'success',
				title: 'İşlem Başarılı'
			})
		</script>
		<meta http-equiv="refresh" content="3;recaptcha">
	<?php }
	if (@$_GET['x'] == "error") { ?>
		<script>
			const Toast = Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000,
				timerProgressBar: true,
			})

			Toast.fire({
				icon: 'error',
				title: 'İşlem Başarısız'
			})
		</script>
		<meta http-equiv="refresh" content="3;recaptcha">
	<?php } ?>

	<!-- fixed-top-->

	<?php include '../header.php' ?>

	<!-- ////////////////////////////////////////////////////////////////////////////-->


	<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow " data-scroll-to-active="true" data-img="../../theme/theme-assets/images/backgrounds/05.jpg">
		<div class="navbar-header">
			<ul class="nav navbar-nav flex-row">
				<li class="nav-item d-md-none">
					<li class="nav-item mr-auto"><img style="width: 220px; height: auto;" class="brand-logo navbar-brand" alt="n0mcode admin logo" src="../../theme/dox/images/n0madmin.png" />
					</li>
					<li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
				</ul>
			</div>
			<div class="main-menu-content">
				<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
					<li class="nav-item"><a href="#"><i><img src="../../theme/dox/images/re.png" style="width: 30px; height: 30px">
					</i><span class="menu-title">Google Recaptcha</span></a></li>
					<li class="nav-item"><a href="../addonx"><i class="ft-corner-up-left"></i><span class="menu-title">Geri dön</span></a>
					</li>
				</ul>
			</div>
			<div class="navigation-background"></div>
		</div>


		<!-- ////////////////////////////////////////////////////////////////////////////-->
		<div class="app-content content">
			<div class="content-wrapper">
				<div class="content-wrapper-before"></div>
				<div class="content-header row">
					<div class="content-header-left col-md-4 col-12 mb-2">
						<h3 class="content-header-title">Eklenti ayarları</h3>
					</div>
				</div>

				<div class="content-body">
					<div class="row match-height">
						<div class="col-xl-12 col-lg-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Google Recaptcha ayarları</h4>
									<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
								</div>
							</div>
						</div>
						<div class="col-xl-5 col-lg-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Google Recaptcha Durumu</h4>
									<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
								</div>
								<div class="card-content">
									<div class="card-body">
										<div class="card-text">
											<b><?php 
											try {
												/*
												* n0mAddons
												* Google reCaptcha Addons
												* Author by R6mw
												* Version 1.0
												* mami.wtf
												*/
												$db = new PDO("mysql:host=db;dbname=n0mcode;charset=utf8;", "root", "n0mcode");
												$addons_recaptcha = "recaptcha";
												$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
												$sql ="CREATE table $addons_recaptcha(
												recaptcha INT( 1 ) NOT NULL,
												recaptcha_sitekey VARCHAR( 50 ) NOT NULL, 
												recaptcha_secretkey VARCHAR( 50 ) NOT NULL);";
												$db->exec($sql);
												echo "Veritabanı işlemleri başarıyla tamamladı."."<br>";
												echo "Kurulum devam ediyor..."."<br>";
												try {
													if ($db->exec("INSERT INTO $addons_recaptcha (recaptcha, recaptcha_sitekey, recaptcha_secretkey) VALUES ('1','sitekey','secretkey')")) {
														echo "Kurulum tamamlandı!";
														sleep(3);
													}
													else{
														echo "Kurulumda hata oluştu.";
													}
												} catch (PDOException $e) {
													echo "Kurulumda hata oluştu."."<br>".$e;
												}
											} catch(PDOException $e) {
												echo "Google Recaptcha eklentisi aktif!<br>Versiyon 1.0";
											}
											?></b>
										</div>
									</div>
								</div>
							</div>
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Eklenti notu</h4>
									<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
								</div>
								<div class="card-content">
									<div class="card-body">
										<div class="card-text">
											<p>
												Eklentinin sağlıklık ve doğru çalışabilmesi için 
												<ul>
													<li><b>sitekey</b> ve <b>secretkey</b> değerlerini doğru giriniz</li>
													<li><b>login.php</b> dosyasını güncellediğinizden emin olunuz
														<ul>
															<li><b>login.php</b> dosyasını güncellemeden önce yedeğini kesinlikle alınız</li>
														</ul>
													</li>
												</ul>
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
						$vericek = $db->query("SELECT * FROM recaptcha WHERE recaptcha = 1")->fetch(PDO::FETCH_ASSOC);
						if ( $vericek ){ ?>

							<div class="col-xl-7 col-lg-12">
								<div class="card text-center">
									<div class="card-header">
										<h4 class="card-title">Google Recaptcha Anahtarları</h4>
										<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
									</div>
									<div class="card-content">
										<div class="card-body">
											<form action="#" method="POST">
												<div class="card-text">
													<dl class="row">
														<dt class="col-sm-2">Site key</dt>
														<dd class="col-sm-10">
															<fieldset class="form-group">
																<input type="text" name="sitekey" class="form-control" id="helpInput" value="<?php echo $vericek['recaptcha_sitekey'] ?>">
															</fieldset>
														</dd>
													</dl>
													<dl class="row">
														<dt class="col-sm-2">Secret key</dt>
														<dd class="col-sm-10">
															<fieldset class="form-group">
																<input type="text" name="secretkey" class="form-control" id="helpInput" value="<?php echo $vericek['recaptcha_secretkey'] ?>">
															</fieldset>
														</dd>
													</dl>
													<div class="text-right">
														<button type="submit" name="reupdate" class="btn btn-round btn-icon btn-outline-success mr-1"><i class="la la-key"></i> Anahtarları Kaydet</button>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">Eklenti kurulumu</h4>
										<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
									</div>
									<div class="card-content">
										<div class="card-body">
											
										</div>
									</div>
								</div>
							</div>
							<!-- <div class="col-xl-6 col-lg-12">
								<div class="card text-center">
									<div class="card-body">
										<?php
										$vericek = $db->query("SELECT * FROM setting WHERE n0m_setting = 1")->fetch(PDO::FETCH_ASSOC);
										?>
										<h5 class="card-title">Google Recaptcha durumu</h5>
										<p>Kullanıcı girişi sayfasında recaptcha sorgusu</p>
										<p class="card-text">Şuanki değer <code>
											<?php
											if ($vericek['n0m_userreg'] == "1") {
												echo "Açık";
											}
											else{
												echo "Kapalı";
											}
											?>
										</code></p>
										<form method="POST" action="../xo/functions.php">
											<div class="form-group">
												<h5>Recaptcha durumu</h5>
												<select class="custom-select" name="user_reg">
													<?php
													if ($vericek['n0m_userreg'] == "1") { ?>
														<option value="1" selected>açık</option>
														<option value="0">kapalı</option>
													<?php }
													else { ?>
														<option value="0" selected>kapalı</option>
														<option value="1">açık</option>
													<?php } ?>
												</select>
											</div>
											<div class="text-right">
												<button type="submit" name="user_reg_set" class="btn btn-round btn-icon btn-outline-danger mr-1"><i class="la la-warning"></i> Onayla</button>
											</div>
										</form>
									</div>
								</div>
							</div> -->
						</div>
					</div>
				</div>
			</div>
		<?php } ?>


		<!-- ////////////////////////////////////////////////////////////////////////////-->

		<?php include '../footer.php'; ?>

		<!-- BEGIN VENDOR JS-->
		<script src="../../theme/theme-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
		<!-- BEGIN VENDOR JS-->
		<!-- BEGIN PAGE VENDOR JS-->
		<!-- END PAGE VENDOR JS-->
		<!-- BEGIN CHAMELEON  JS-->
		<script src="../../theme/theme-assets/js/core/app-menu-lite.js" type="text/javascript"></script>
		<script src="../../theme/theme-assets/js/core/app-lite.js" type="text/javascript"></script>
		<!-- END CHAMELEON  JS-->
		<!-- BEGIN PAGE LEVEL JS-->
		<!-- END PAGE LEVEL JS-->
	</body>

	</html>