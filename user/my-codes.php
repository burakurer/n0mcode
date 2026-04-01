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
    <title>n0mCode - Kodlarım</title>
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
        <meta http-equiv="refresh" content="3;my-codes">
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
        <meta http-equiv="refresh" content="3;my-codes">
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
                    <h3 class="content-header-title">Kodlarım<h3>
                    </div>
                </div>
                <div class="content-body">
                    <div class="row match-height">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Sisteme eklediğiniz kodlar</h4>
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
                                                                    <th scope="col">Başlık</th>
                                                                    <th scope="col">Kod</th>
                                                                    <th scope="col">Tarih</th>
                                                                    <th scope="col" style="text-align: center">İşlem</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                require_once 'xo/functions.php';
                                                                dbConnect();
                                                                $code=$db->prepare("SELECT * FROM `code` ORDER BY `code`.`code_id` DESC");
                                                                $code->execute();
                                                                $say=0;
                                                                while ($listele=$code->fetch(PDO::FETCH_ASSOC)) { $say++; 
                                                                    if ($listele['code_sahip'] == $_SESSION['user_name']) {
                                                                        ?>
                                                                        <tr>
                                                                            <th style="vertical-align: middle;"><?php echo $listele['code_baslik']; ?></th>
                                                                            <td style="vertical-align: middle;"><?php echo mb_substr($listele['code_icerik'],0,300); ?></td>
                                                                            <td style="vertical-align: middle;"><?php echo $listele['code_tarih']; ?></td>
                                                                            <td style="vertical-align: middle;">
                                                                                <center>
                                                                                    <div class="btn-group">
                                                                                        <button type="button" class="btn btn-round btn-outline-primary btn-min-width dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ft-wrench"></i> İşlemler</button>
                                                                                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                                            <form method="POST" action="code-ex">
                                                                                                <input type="text" name="id" hidden="" value="<?php echo $listele['code_id']; ?>">
                                                                                                <button class="dropdown-item" name="code_ex" type="submit" ><i class="ft-eye"></i> İncele</button>
                                                                                            </form>
                                                                                            <form method="POST" action="code-update">
                                                                                                <input type="text" name="id" hidden=""value="<?php echo $listele['code_id']; ?>">
                                                                                                <button class="dropdown-item" name="code_update" type="submit"><i class="ft-edit"></i> Düzenle</button>
                                                                                            </form>
                                                                                            <form method="POST" action="xo/functions.php">
                                                                                                <input type="text" name="id" hidden=""value="<?php echo $listele['code_id']; ?>">
                                                                                                <button class="dropdown-item" name="kod_sil" type="submit"><i class="ft-trash-2"></i> Sil</button>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </center>
                                                                            </td>
                                                                        </tr>
                                                                    <?php }} ?>
                                                                </tbody>
                                                            </table>
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