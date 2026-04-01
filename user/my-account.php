
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

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


    <?php include 'left-panelq.php' ?>


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
                    <?php
                    require_once 'xo/functions.php';
                    dbConnect();
                    $user_name = $_SESSION['user_name']; 
                    $vericek = $db->query("SELECT * FROM user WHERE user_name = '$user_name'")->fetch(PDO::FETCH_ASSOC);
                    if ( $vericek ){ ?>
                        <div class="col-xl-6 col-lg-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="form-body">
                                            <h2 style="text-align: center;">Hesap Özetin</h2>
                                            <form method="POST" action="my-account-update">
                                                <div class="form-group">
                                                    <center>
                                                        <?php if(!empty($vericek['user_picture'])){ ?>
                                                            <img style="height: 200px; width: 200px; border-radius: 50%;margin-bottom: 10px; border: 2px solid purple" src="<?php echo $vericek['user_picture']; ?>">
                                                        <?php }
                                                        else{ ?>
                                                            <img style="height: 200px; width: 200px; border-radius: 50%;margin-bottom: 10px; border: 2px solid purple" src="http://localhost/dox/n0mcode/theme/dox/images/usernone.png">
                                                        <?php }?>
                                                    </center>
                                                </div>
                                                <div class="form-group">
                                                    <h4><i class="ft-user"></i> Kullanıcı adı:
                                                        <b><?php echo htmlspecialchars($vericek['user_name']) ?></b>
                                                    </h4>
                                                </div>
                                                <div class="form-group">
                                                    <h4><i class="ft-calendar"></i> Kayıt tarihi:
                                                        <b><?php echo htmlspecialchars($vericek['user_reg']) ?></b>
                                                    </h4>
                                                </div>
                                                <div class="form-group">
                                                    <h4><i class="ft-mail"></i> Eposta adresi:
                                                        <b><?php echo htmlspecialchars($vericek['user_mail']) ?></b>
                                                    </h4>
                                                </div>
                                                <div class="form-group">
                                                    <fieldset class="form-group">
                                                        <i class="ft-clipboard"></i> Notlarım
                                                        <textarea class="form-control" id="helpInputTop" name="user_notes" id="icerik" rows="10"><?php echo htmlspecialchars($vericek['user_notes'])  ?></textarea>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <center>
                                                    <button type="submit" name="user_update" class="btn btn-round  btn-outline-warning"><i class="ft-edit"></i> Düzenle</button>
                                                </form>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12">
                            <div>
                                <div class="card">
                                    <div class="card-header">
                                        <h2 style="text-align: center;"><i class="ft-lock"></i> Hesap güvenliği</h2>
                                    </div>
                                    <form method="POST" action="xo/functions.php">
                                        <div class="card-body">
                                            <h5>Şifremi değiştir</h5>
                                            <fieldset class="form-group">
                                                Geçerli şifreniz
                                                <input type="password" class="form-control" name="old_pass" required="required" disabled="">
                                            </fieldset>
                                            <fieldset class="form-group">
                                                Yeni şifreniz
                                                <input type="password" class="form-control" name="new_pass" required="required" disabled="">
                                            </fieldset>
                                            <fieldset class="form-group">
                                                Yeni şifrenizi tekrar giriniz
                                                <input type="password" class="form-control" name="new_passc" required="required" disabled="">
                                            </fieldset>

                                            <center>
                                                <button type="submit" name="pass_update" disabled="" class="btn btn-round btn-outline-danger btn-min-width mr-1 mb-1"><i class="ft-lock"></i> Şifremi değiştir</button>
                                            </center>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
                else{
                    header('Location:my-account');
                } ?>
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