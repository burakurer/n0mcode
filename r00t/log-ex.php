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
    <title>n0mCode - Güvenlik</title>
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


    <?php include 'left-panelq.php' ?>


    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-4 col-12 mb-2">
                    <h3 class="content-header-title">Güvenlik</h3>
                </div>
            </div>
            <div class="content-body">
                <div class="row match-height">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <?php
                            require_once 'xo/functions.php';
                            dbLogConnect();
                            if (isset($_POST['log_ex'])){
                                $id = $_POST['id']; 
                                $vericek = $db->query("SELECT * FROM n0mlog WHERE log_id = '$id'")->fetch(PDO::FETCH_ASSOC);
                                if ( $vericek ){ ?>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <h3 class="card-title">Log inceleme</h3>
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <h5 for="sahip">Giriş durumu</h5>
                                                    <input type="text" id="sahip" class="form-control" readonly="readonly" value="<?php if($vericek['log_status'] == 1){ echo 'başarılı'; }else{ echo 'başarısız'; } ?>">
                                                </div>
                                                <div class="form-group">
                                                    <h5 for="sahip">Recaptcha durumu</h5>
                                                    <input type="text" id="sahip" class="form-control" readonly="readonly" value="<?php if($vericek['log_recaptcha'] == 1){ echo 'başarılı'; }else{ echo 'başarısız'; } ?>">
                                                </div>
                                                <div class="form-group">
                                                    <h5 for="sahip">İp adresi</h5>
                                                    <input type="text" id="sahip" class="form-control" readonly="readonly" value="<?php echo $vericek['log_ip'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <h5 for="sahip">Kullanıcı adı input değeri</h5>
                                                    <input type="text" id="sahip" class="form-control" readonly="readonly" value="<?php echo $vericek['log_uname'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <h5 for="sahip">Şifre input değeri</h5>
                                                    <input type="text" id="sahip" class="form-control" readonly="readonly" value="<?php echo $vericek['log_pass'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <h5 for="sahip">Tarayıcı bilgisi</h5>
                                                    <input type="text" id="sahip" class="form-control" readonly="readonly" value="<?php echo $vericek['log_web'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <h5 for="sahip">Log tarihi</h5>
                                                    <input type="text" id="sahip" class="form-control" readonly="readonly" value="<?php echo $vericek['log_time'] ?>">
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <center>
                                                    <a href="security">
                                                        <button class="btn btn-round  btn-outline-primary"><i class="ft-corner-up-left"></i> Geri Dön</button>
                                                    </a>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }}
                            else{
                                header('Location:security');
                            } ?>
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