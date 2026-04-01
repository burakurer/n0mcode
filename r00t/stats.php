<?php
require_once 'xo/functions.php';
dbConnect();
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="author" content="R6wm">
    <title>n0mCode - İstatistikler</title>
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

    <!-- fixed-top-->

    <?php include 'header.php' ?>

    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <?php include 'left-panelq.php' ?>

    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-4 col-12 mb-2">
                    <h3 class="content-header-title">İstatistikler</h3>
                </div>
            </div>
            <div class="content-body">
                <div class="row match-height">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">İstatistikler</h4>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <?php
                                //kullanıcı sayısı
                                    $user = "SELECT count(*) FROM user"; 
                                    $usersayi = $db->prepare($user); 
                                    $usersayi->execute(); 
                                    $usertoplamsayi = $usersayi->fetchColumn(); 
                                    if ($usertoplamsayi > 0) { ?>
                                        <div class="alert round bg-success alert-icon-left alert-dismissible mb-2" role="alert">
                                            <span class="alert-icon">
                                                <i class="ft-user"></i>
                                            </span>
                                            Sistemdeki kayıtlı kullanıcı sayısı 
                                            <code><?php echo $usertoplamsayi; ?></code>
                                        </div>
                                    <?php } ?>

                                    <?php
                                //kod sayısı
                                    $kod = "SELECT count(*) FROM code"; 
                                    $kodsayi = $db->prepare($kod); 
                                    $kodsayi->execute(); 
                                    $kodtoplamsayi = $kodsayi->fetchColumn(); 
                                    if ($kodtoplamsayi > 0) { ?>
                                        <div class="alert round bg-success alert-icon-left alert-dismissible mb-2" role="alert">
                                            <span class="alert-icon">
                                                <i class="la la-code"></i>
                                            </span>
                                            Sisteme eklenmiş toplam kod sayısı 
                                            <code><?php echo $kodtoplamsayi; ?></code>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
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