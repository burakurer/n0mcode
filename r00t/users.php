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
    <title>n0mCode - Kullanıcılar</title>
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
        <meta http-equiv="refresh" content="3;users">
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
        <meta http-equiv="refresh" content="3;users">
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
                    <h3 class="content-header-title">Kullanıcılar</h3>
                </div>
            </div>
            <div class="content-body">
                <div class="row match-height">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Kullanıcı Listesi</h4>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <p class="card-text">Use <code class="highlighter-rouge">.table-striped</code> to
                                                    add zebra-striping to any table row within the <code class="highlighter-rouge">&lt;tbody&gt;</code>. This styling doesn't work in
                                                    IE8 and below as <code>:nth-child</code> CSS selector isn't supported.</p>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Resim</th>
                                                                <th>Kullanıcı adı</th>
                                                                <th>Eposta</th>
                                                                <th>Kayıt tarihi</th>
                                                                <th style="text-align: center">İşlem</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                            require_once 'xo/functions.php';
                                                            dbConnect();
                                                            $user=$db->prepare("SELECT * FROM `user` ORDER BY `user`.`user_id` DESC");
                                                            $user->execute();
                                                            $say=0;
                                                            while ($listele=$user->fetch(PDO::FETCH_ASSOC)) { $say++; ?>
                                                                <tr>
                                                                    <?php if(!empty($listele['user_picture'])){ ?>
                                                                        <td style="vertical-align: middle;">
                                                                            <img style="height: 75px; border-radius: 50%; width: 75px; border: 2px solid purple" src="<?php echo $listele['user_picture']; ?>">
                                                                        </td>
                                                                    <?php }
                                                                    else{ ?>
                                                                        <td style="vertical-align: middle;">
                                                                            <img style="height: 75px; border-radius: 50%; width: 75px; border: 2px solid purple" src="http://localhost/dox/n0mcode/theme/dox/images/usernone.png">
                                                                        </td>
                                                                    <?php }?>                                 
                                                                    <th style="vertical-align: middle;"><?php echo htmlspecialchars($listele['user_name']); ?></th>
                                                                    <td style="vertical-align: middle;"><?php echo htmlspecialchars($listele['user_mail']); ?></td>
                                                                    <td style="vertical-align: middle;"><?php echo $listele['user_reg']; ?></td>
                                                                    <td style="vertical-align: middle;">
                                                                        <center>
                                                                            <div class="btn-group">
                                                                                <button type="button" class="btn btn-round btn-outline-primary btn-min-width dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">İşlemler</button>
                                                                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                                    <form method="POST" action="user-ex">
                                                                                        <input type="text" name="id" hidden="" value="<?php echo $listele['user_id']; ?>">
                                                                                        <button class="dropdown-item" name="user_ex" type="submit" ><i class="ft-eye"></i> İncele</button>
                                                                                    </form>
                                                                                    <form method="POST" action="user-update">
                                                                                        <input type="text" name="id" hidden=""value="<?php echo $listele['user_id']; ?>">
                                                                                        <button class="dropdown-item" name="user_update" type="submit"><i class="ft-edit"></i> Düzenle</button>
                                                                                    </form>
                                                                                    <form method="POST" action="xo/functions.php">
                                                                                        <input type="text" name="id" hidden=""value="<?php echo $listele['user_id']; ?>">
                                                                                        <button class="dropdown-item" name="user_delete" type="submit"><i class="ft-trash-2"></i> Hesabı sil</button>
                                                                                    </form>
                                                                                    <div class="dropdown-divider"></div>
                                                                                    <form method="POST" action="user-codes">
                                                                                        <input type="text" name="id" hidden=""value="<?php echo $listele['user_id']; ?>">
                                                                                        <button class="dropdown-item" name="user_update" type="submit"><i class="ft-edit"></i> Eklediği kodları</button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </center>
                                                                    </td>
                                                                </tr>
                                                            <?php }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                    <a href="user-new">
                                                        <button type="button" class="btn btn-round btn-outline-success btn-lg btn-block">Yeni Kullanıcı Oluştur</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
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