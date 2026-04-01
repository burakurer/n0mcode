<?php
require_once 'xo/functions.php';
dbConnect();
?>
<!DOCTYPE html>
<html class="loading" lang="tr" data-textdirection="ltr">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta name="author" content="R6wm">
	<title>n0mCode - Eklentiler</title>
	<link rel="shortcut icon" type="image/x-icon" href="../theme/theme-assets/images/ico/n0m.ico">
	<link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">
	<link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
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
		<meta http-equiv="refresh" content="3;settings">
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
		<meta http-equiv="refresh" content="3;settings">
	<?php } ?>

	<!-- fixed-top-->

	<?php include 'header.php' ?>

	<!-- ////////////////////////////////////////////////////////////////////////////-->


	<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true" data-img="../theme/theme-assets/images/backgrounds/05.jpg">
		<div class="navbar-header">
			<ul class="nav navbar-nav flex-row">
				<li class="nav-item d-md-none">
					<li class="nav-item mr-auto"><img style="width: 220px; height: auto;" class="brand-logo navbar-brand" alt="n0mcode admin logo" src="../theme/dox/images/n0madmin.png" /></li>
					<li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
				</li>
				</ul>
			</div>
			<div class="main-menu-content">
				<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
					<li class="nav-item"><a href="main"><i class="ft-corner-up-left"></i><span class="menu-title">Geri dön</span></a>
					</li>
					<li class="nav-item"><a href="addons/recaptcha.php"><i><img src="../theme/dox/images/re.png" style="width: 30px; height: 30px">
					</i><span class="menu-title">Google Recaptcha</span></a></li>
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
						<h3 class="content-header-title">Eklentiler</h3>
					</div>
				</div>
				<div class="content-body">
					<div class="row match-height">

					</div>
				</div>
			</div>
		</div>


		<!-- ////////////////////////////////////////////////////////////////////////////-->

		<?php include 'footer.php'; ?>

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