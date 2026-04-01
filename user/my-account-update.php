<?php
error_reporting(0);
require_once 'n0mGuard.php';
loginControl();
?>
<!DOCTYPE html>
<html class="loading" lang="tr" data-textdirection="ltr">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta name="author" content="R6wm">
	<title>n0mCode - Hesabım</title>
	<link rel="shortcut icon" type="image/x-icon" href="../theme/theme-assets/images/ico/n0m.ico">
	<link href="http://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">
	<link href="http://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
	<!-- BEGIN VENDOR CSS-->
	<link rel="stylesheet" type="text/css" href="../theme/theme-assets/css/vendors.css">
	<!-- END VENDOR CSS-->
	<!-- BEGIN CHAMELEON  CSS-->
	<link rel="stylesheet" type="text/css" href="../theme/theme-assets/css/app-lite.css">
	<!-- END CHAMELEON  CSS-->
	<!-- BEGIN Page Level CSS-->
	<link rel="stylesheet" type="text/css" href="../theme/theme-assets/css/core/menu/menu-types/vertical-menu.css">
	<link rel="stylesheet" type="text/css" href="../theme/theme-assets/css/core/colors/palette-gradient.css">
	<!-- END Page Level CSS-->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

</head>

<body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-purple-blue" data-col="2-columns">

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
		<meta http-equiv="refresh" content="3;my-account">
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
		<meta http-equiv="refresh" content="3;my-account">
	<?php } ?>

	<!-- fixed-top-->

	<?php include 'header.php' ?>

	<!-- ////////////////////////////////////////////////////////////////////////////-->


	<?php include 'includes/left-panelq.php' ?>


	<!-- ////////////////////////////////////////////////////////////////////////////-->


	<div class="app-content content">
		<div class="content-wrapper">
			<div class="content-wrapper-before"></div>
			<div class="content-header row">
				<div class="content-header-left col-md-4 col-12 mb-2">
					<h3 class="content-header-title">Hesabım</h3>
				</div>
			</div>
			<div class="content-body">
				<div class="row match-height">
					<div class="col-xl-12 col-lg-12">
						<div class="card">
							<?php
							require_once 'n0mGuard.php';
							n0mDB_Connect();
							if (isset($_POST['user_updatex'])){
								$sorgu = $_SESSION['user_name'];
								$usercek = $db->query("SELECT * FROM user WHERE user_name = '$sorgu'")->fetch(PDO::FETCH_ASSOC);
								if ($usercek) {
									if ($sorgu == $usercek['user_name']) { ?>
										<div class="card-content">
											<div class="card-body">
												<h3 class="card-title">Hesap ayarlarını güncelleme</h3>
												<div class="form-body">
													<form method="POST" action="n0mGuard.php">
														<div class="form-group">
															<input type="text" name="user_secret" hidden="" value="<?php echo $vericek['user_secret']; ?>">
															<h5>Resim</h5>
															<?php if(!empty($vericek['user_picture'])){ ?>
																<img style="height: 200px; width: 200px; border-radius: 50%;margin-bottom: 10px; border: 2px solid purple" src="<?php echo htmlspecialchars($vericek['user_picture']); ?>">
															<?php }
															else{ ?>
																<img style="height: 200px; width: 200px; border-radius: 50%;margin-bottom: 10px; border: 2px solid purple" src="http://localhost/dox/n0mcode/theme/dox/images/usernone.png">
															<?php }?>
															<input type="url" class="form-control" name="user_picture" value="<?php echo htmlspecialchars($vericek['user_picture']); ?>">
														</div>
														<div class="form-group">
															<h5>Kullanıcı adı</h5>
															<input type="text" class="form-control" readonly="readonly" name="user_name" value="<?php echo htmlspecialchars($vericek['user_name']); ?>">
														</div>
														<div class="form-group">
															<h5>Mail adresi</h5>
															<input type="email" class="form-control" name="user_mail" value="<?php echo htmlspecialchars($vericek['user_mail']); ?>">
														</div>
														<div class="form-group">
															<h5>Kayıt tarihi</h5>
															<input type="text" class="form-control" readonly="readonly" value="<?php echo $vericek['user_reg'] ?>">
														</div>
														<div class="form-group">
															<h5 for="icerik">Notları</h5>
															<textarea class="form-control" name="user_notes" id="icerik" rows="10"><?php echo htmlspecialchars($vericek['user_notes'])  ?></textarea>
														</div>
													</div>
													<div class="form-actions">
														<center>
															<button type="submit" name="user_update" class="btn btn-round btn-outline-success"><i class="ft-save"></i> Kaydet</button>
														</form>
														<a href="my-account">
															<button class="btn btn-round btn-outline-danger"><i class="ft-trash-2"></i> İptal Et</button>
														</a>
													</center>
												</div>
											</div>
										</div>
									<?php }else{
										header('Location:my-account');
									}}else{
										header('Location:my-account');
									}}else{
										header('Location:my-account');
									} ?>
								</div>
							</div>
							<div class="col-xl-12 col-lg-12">
								<div class="card" style="border-radius: 10px">
									<img src="../theme/dox/images/ad/ad.jpg" style="border-radius: 10px">
								</div>
							</div>
							<div class="col-xl-6 col-lg-12">
								<div class="card" style="border-radius: 10px">
									<img src="../theme/dox/images/ad/ad1.jpg" style="border-radius: 10px">
								</div>
							</div>
							<div class="col-xl-6 col-lg-12">
								<div class="card" style="border-radius: 10px">
									<img src="../theme/dox/images/ad/ip.gif" style="border-radius: 10px">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- ////////////////////////////////////////////////////////////////////////////-->

			<?php include 'includes/footer.php'; ?>

			<!-- BEGIN VENDOR JS-->
			<script src="../theme/theme-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
			<!-- BEGIN VENDOR JS-->
			<!-- BEGIN PAGE VENDOR JS-->
			<!-- END PAGE VENDOR JS-->
			<!-- BEGIN CHAMELEON  JS-->
			<script src="../theme/theme-assets/js/core/app-menu-lite.js" type="text/javascript"></script>
			<script src="../theme/theme-assets/js/core/app-lite.js" type="text/javascript"></script>
			<!-- END CHAMELEON  JS-->
			<!-- BEGIN PAGE LEVEL JS-->
			<!-- END PAGE LEVEL JS-->
		</body>

		</html>