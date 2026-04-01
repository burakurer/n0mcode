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
    <title>n0mCode - Kullanıcılar</title>
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
                    <h3 class="content-header-title">Kullanıcılar</h3>
                </div>
            </div>
            <div class="content-body">
                <div class="row match-height">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <?php
                            require_once 'n0mSystem/n0mGuard.php';
                            n0mDB_Connect();
                            if (isset($_POST['user_ex'])){
                                $secret = $_POST['secret']; 
                                $vericek = $db->query("SELECT * FROM user WHERE user_secret = '$secret'")->fetch(PDO::FETCH_ASSOC);
                                if ( $vericek ){ ?>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <h3 class="card-title">Kullanıcı inceleme</h3>
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <h5 for="sahip">Resim</h5>
                                                    <?php if(!empty($vericek['user_picture'])){ ?>
                                                        <img style="height: 200px; width: 200px; border-radius: 50%;margin-bottom: 10px; border: 2px solid purple" src="<?php echo $vericek['user_picture']; ?>">
                                                    <?php }
                                                    else{ ?>
                                                        <img style="height: 200px; width: 200px; border-radius: 50%;margin-bottom: 10px; border: 2px solid purple" src="http://localhost/dox/n0mcode/theme/dox/images/usernone.png">
                                                    <?php }?>
                                                </div>
                                                <div class="form-group">
                                                    <h5 for="sahip">Kullanıcı adı</h5>
                                                    <input type="text" id="sahip" class="form-control" readonly="readonly" value="<?php echo htmlspecialchars($vericek['user_name']) ?>">
                                                </div>
                                                <div class="form-group">
                                                    <h5>Hesap türü</h5>
                                                    <input type="text" id="baslik" class="form-control" readonly="readonly" value="<?php echo $vericek['user_yetki'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <h5 for="baslik">Mail adresi</h5>
                                                    <a href="mailto:<?php echo $vericek['user_mail'] ?>"><small class="text-muted">kullanıcıya mail yollamak için tıklayın</small></a>
                                                    <input type="text" id="baslik" class="form-control" readonly="readonly" value="<?php echo $vericek['user_mail'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <h5 for="tarih">Kayıt tarihi</h5>
                                                    <input type="text" id="tarih" class="form-control" readonly="readonly" value="<?php echo $vericek['user_reg'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <h5 for="icerik">Notları</h5>
                                                    <textarea class="form-control" id="icerik" rows="10" readonly="readonly"><?php echo htmlspecialchars($vericek['user_notes']) ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <form method="POST" action="user-update">
                                                    <center>
                                                        <input type="text" name="secret" hidden=""value="<?php echo $_POST['secret'] ?>">
                                                        <button type="submit" class="btn btn-round btn-outline-warning" name="user_update" type="submit"><i class="ft-edit"></i> Düzenle</button>
                                                    </form>
                                                    <a href="users">
                                                        <button class="btn btn-round btn-outline-primary"><i class="ft-corner-up-left"></i> Geri Dön</button>
                                                    </a>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                <?php }}
                                else{
                                    header('Location:users');
                                } ?>
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