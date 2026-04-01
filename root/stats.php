<?php
error_reporting(0);
require_once 'n0mSystem/n0mGuard.php';
loginControl();
?>
<!DOCTYPE html>
<html class="loading" lang="tr" data-textdirection="ltr">

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


    <?php include 'includes/left-panelq.php' ?>

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
                    <div class="col-lg-4 col-md-12">
                        <div class="card text-center">
                            <div class="card-body">
                                <h4 class="card-title">Kayıtlı kullanıcı sayısı</h4>
                                <h6 class="card-subtitle text-muted">Sisteme kayıt olan bütün kullanıcıların sayısı</h6>
                            </div>
                            <img src="../theme/dox/images/undraw_people_tax5.png" width="100%">
                            <div class="card-body">
                                <p class="card-text">
                                    <?php
                                    //kullanıcı sayısı
                                    $user = "SELECT count(*) FROM user"; 
                                    $usersayi = $db->prepare($user); 
                                    $usersayi->execute(); 
                                    $usertoplamsayi = $usersayi->fetchColumn(); 
                                    if ($usertoplamsayi > 0) { ?>
                                        Kayıtlı <u><?php echo $usertoplamsayi; ?></u> adet kullanıcı var
                                    <?php } else { ?>
                                        Kayıtlı kullanıcı bulunmuyor
                                    <?php } ?>
                                </p>
                                <a href="users" class="card-link">Kullanıcı listesi</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="card text-center">
                            <div class="card-body">
                                <h4 class="card-title">Sisteme girilmiş kod sayısı</h4>
                                <h6 class="card-subtitle text-muted">Sisteme girilmiş olan bütün kodların sayısı</h6>
                            </div>
                            <img src="../theme/dox/images/undraw_code_review_l1q9.png" width="100%">
                            <div class="card-body">
                                <p class="card-text">
                                    <?php
                                    //kod sayısı
                                    $kod = "SELECT count(*) FROM code"; 
                                    $kodsayi = $db->prepare($kod); 
                                    $kodsayi->execute(); 
                                    $kodtoplamsayi = $kodsayi->fetchColumn(); 
                                    if ($kodtoplamsayi > 0) { ?>
                                        Toplam <u><?php echo $kodtoplamsayi; ?></u> adet kod var
                                    <?php } else { ?>
                                        Sisteme eklenmiş kod bulunmuyor
                                    <?php } ?>
                                </p>
                                <a href="code-database" class="card-link">Kod veritabanı</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="card text-center">
                            <div class="card-body">
                                <h4 class="card-title">Kayıt edilmiş log sayısı</h4>
                                <h6 class="card-subtitle text-muted">n0mGuard Kayıt altına alınmış toplam log sayısı</h6>
                            </div>
                            <img src="../theme/dox/images/undraw_authentication_fsn5.png" width="100%">
                            <div class="card-body">
                                <p class="card-text">
                                    <?php
                                    n0mLogDB_Connect();
                                    //log sayısı
                                    $log = "SELECT count(*) FROM n0mlog"; 
                                    $logsayi = $db->prepare($log); 
                                    $logsayi->execute(); 
                                    $logtoplamsayi = $logsayi->fetchColumn(); 
                                    if ($logtoplamsayi > 0) { ?>
                                        Toplam <u><?php echo $logtoplamsayi; ?></u> adet log var
                                    <?php } else { ?>
                                        Kayıtlı log bulunmuyor
                                    <?php } ?>
                                </p>
                                <a href="security" class="card-link">Güvenlik</a>
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