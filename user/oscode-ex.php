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
	<title>n0mCode - Açık kaynak kodlar</title>
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
					<h3 class="content-header-title">Açık kaynak kodlar</h3>
				</div>
			</div>
			<div class="content-body">
				<div class="row match-height">
					<div class="col-xl-12 col-lg-12">
						<div class="card">
							<?php
							require_once 'n0mGuard.php';
							n0mDB_Connect();
							if (isset($_POST['code_ex'])){
								$id = $_POST['id']; 
								$kontrol = $db->query("SELECT * FROM code WHERE code_id = '$id'")->fetch(PDO::FETCH_ASSOC);
								if ($kontrol['code_public'] == 1) {
									$cek = $db->query("SELECT * FROM code WHERE code_id = '$id'")->fetch(PDO::FETCH_ASSOC);
									if ( $cek ){ ?>
										<div class="card-content">
											<div class="card-body">
												<h3 class="card-title">Kod inceleme</h3>
												<div class="form-body">
													<div class="form-group">
														<h5 for="sahip">Kod sahibi</h5>
														<input type="text" id="sahip" class="form-control" readonly="readonly" value="<?php echo $cek['code_sahip'] ?>">
													</div>
													<div class="form-group">
														<h5 for="baslik">Başlık</h5>
														<input type="text" id="baslik" class="form-control" readonly="readonly" value="<?php echo $cek['code_baslik'] ?>">
													</div>
													<div class="form-group">
														<h5 for="tarih">Eklenme tarihi</h5>
														<input type="text" id="tarih" class="form-control" readonly="readonly" value="<?php echo $cek['code_tarih'] ?>">
													</div>
													<div class="form-group">
														<h5 for="icerik">Kod içeriği</h5>
														<textarea class="form-control" id="icerik" rows="25" readonly="readonly"><?php echo $cek['code_icerik'] ?></textarea>
													</div>
												</div>
												<div class="form-actions">
													<center>
														<a href="oscode">
															<button class="btn btn-round  btn-outline-primary"><i class="ft-corner-up-left"></i> Geri Dön</button>
														</a>
													</center>
												</div>
											</div>
										</div>
									</div>
								<?php }else{
									header('Location:oscode');
								}}else{
									header('Location:oscode');
								}}else{
									header('Location:oscode');
								} ?>
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