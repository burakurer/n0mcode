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
    <title>n0mCode - Anasayfa</title>
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
        <meta http-equiv="refresh" content="3;main">
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
        <meta http-equiv="refresh" content="3;main">
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
                    <h3 class="content-header-title">Anasayfa</h3>
                </div>
            </div>
            <div class="content-body">
                <div class="row match-height">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Son hesap etkinlikleri</h4>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <p class="card-text">Son 4 hesap etkinliğiniz. Şüpheli bir giriş var ise <a href="my-account">şifrenizi değiştirebilirsiniz</a></p>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Giriş Durumu</th>
                                                            <th scope="col">Hcaptcha</th>
                                                            <th scope="col">İp adresi</th>
                                                            <th scope="col">Tarayıcı</th>
                                                            <th scope="col">Tarih</th>
                                                            <th scope="col">İşlemler</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        n0mLogDB_Connect();
                                                        $log=$db->prepare("SELECT * FROM `n0mlog` ORDER BY `n0mlog`.`log_id` DESC");
                                                        $log->execute();
                                                        $say=0;
                                                        while ($listele=$log->fetch(PDO::FETCH_ASSOC)) {
                                                            if ($listele['log_uname'] == $_SESSION['user_name']) {
                                                                $say++;
                                                                if ($say <= 4) { ?>
                                                                    <tr>
                                                                        <td style="vertical-align: middle;">
                                                                            <?php if($listele['log_status'] == 1){ ?>
                                                                                <div style="font-size: 30px"><i class="ft-check-circle"></i></div>
                                                                            <?php }else{ ?>
                                                                                <div style="font-size: 30px"><i class="ft-x-circle"></i></div>
                                                                            <?php } ?>
                                                                        </td>
                                                                        <td style="vertical-align: middle;">
                                                                            <?php if($listele['log_hcaptcha'] == 1){ ?>
                                                                                <div style="font-size: 30px"><i class="ft-check-circle"></i></div>
                                                                            <?php }else{ ?>
                                                                                <div style="font-size: 30px"><i class="ft-x-circle"></i></div>
                                                                            <?php } ?>
                                                                        </td>
                                                                        <td style="vertical-align: middle;"><?php echo $listele['log_ip']; ?></td>
                                                                        <td style="vertical-align: middle;"><?php echo $listele['log_web']; ?></td>
                                                                        <td style="vertical-align: middle;"><?php echo $listele['log_time']; ?></td>
                                                                        <td style="vertical-align: middle;">
                                                                            <center>
                                                                                <form method="POST" target="_blank" action="https://mami.wtf/ip/sorgu">
                                                                                    <input type="text" name="ip" hidden="" value="<?php echo $listele['log_ip']; ?>">
                                                                                    <button type="submit" class="btn btn-round btn-outline-info btn-min-width" name="sorgula" type="submit"><i class="ft-search"></i> İp sorgula</button>
                                                                                </form>
                                                                            </center>
                                                                        </td>
                                                                    </tr>
                                                                <?php }}} ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Son eklediğim kodlar</h4>
                                    </div>
                                    <div class="card-content collapse show">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <p class="card-text">n0mCode'a hoşgeldiniz, burada son eklediğiniz son 4 kodu görebilirsiniz.</p>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Başlık</th>
                                                                    <th scope="col">Kod</th>
                                                                    <th scope="col">Tarih</th>
                                                                    <th scope="col" style="text-align: center">İşlem</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                n0mDB_Connect();
                                                                $code=$db->prepare("SELECT * FROM `code` ORDER BY `code`.`code_id` DESC");
                                                                $code->execute();
                                                                $say=0;
                                                                while ($listele=$code->fetch(PDO::FETCH_ASSOC)) {; 
                                                                    if ($listele['code_sahip'] == $_SESSION['user_name']) {
                                                                        if ($say <= 4) {
                                                                            ?>
                                                                            <tr>
                                                                                <th style="vertical-align: middle;"><?php echo htmlspecialchars($listele['code_baslik']); ?></th>
                                                                                <td style="vertical-align: middle;"><?php echo htmlspecialchars(mb_substr($listele['code_icerik'],0,100)); ?></td>
                                                                                <td style="vertical-align: middle;"><?php echo $listele['code_tarih']; ?></td>
                                                                                <td style="vertical-align: middle;">
                                                                                    <center>
                                                                                        <form method="POST" action="code-ex">
                                                                                            <input type="text" name="id" hidden="" value="<?php echo $listele['code_id']; ?>">
                                                                                            <button type="submit" class="btn btn-round btn-outline-info btn-min-width" name="code_ex"><i class="ft-info"></i> İncele</button>
                                                                                        </form>
                                                                                    </center>
                                                                                </td>
                                                                            </tr>
                                                                        <?php }}}
                                                                        ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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