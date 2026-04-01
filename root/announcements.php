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
  <title>n0mCode - Duyurular</title>
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
    <meta http-equiv="refresh" content="3;announcements">
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
    <meta http-equiv="refresh" content="3;announcements">
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
          <h3 class="content-header-title">Duyurular</h3>
        </div>
      </div>
      <div class="content-body">
        <div class="row match-height">
          <div class="col-xl-7 col-lg-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Aktif Duyurular</h4>
              </div>
              <div class="card-content collapse show">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">İkon</th>
                          <th scope="col">İçerik</th>
                          <th scope="col">Url</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $duyuru=$db->prepare("SELECT * FROM ann");
                        $duyuru->execute();
                        $say=0;
                        while ($listele=$duyuru->fetch(PDO::FETCH_ASSOC)) { $say++; ?>
                          <tr>
                            <th scope="row"><i class="<?php echo $listele['duyuru_ikon']; ?>"></i> <?php echo htmlspecialchars($listele['duyuru_ikon']); ?></th>
                            <td><?php echo htmlspecialchars($listele['duyuru_icerik']); ?></td>
                            <td><?php echo htmlspecialchars($listele['duyuru_url']); ?></td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-5 col-lg-12">
            <div>
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Duyuru İşlemleri</h4>
                </div>
              </div>
            </div>
            <div>
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Duyuru Ekle</h4>
                </div>
                <form method="POST" action="n0mSystem/n0mGuard.php">
                  <div class="card-body">
                    <h5>Duyuru ikonu seçiniz</h5>
                    <p>İkon listesi için <a target="_blank" href="https://themeselection.com/demo/chameleon-admin-template/html/ltr/vertical-menu-template/icons-feather.html">tıklayın</a></p>
                    <fieldset class="form-group">
                      <input type="text" class="form-control" required="" id="helpInput" name="duyuru_ikon" placeholder="ft-heart">
                    </fieldset>

                    <h5 class="mt-2">Duyuru url giriniz</h5>
                    <p>Boş bırakabilirsiniz</p>
                    <fieldset class="form-group">
                      <input type="text" class="form-control" id="helpInput" name="duyuru_url" placeholder="https://mami.wtf">
                    </fieldset>

                    <h5 class="mt-2">Duyuru içeriği giriniz</h5>
                    <p>Max 70 karakter uzunluğunda duyuru içeriği girebilirsiniz</p>
                    <fieldset class="form-group">
                      <input type="text" class="form-control" required="" id="helpInput" name="duyuru_icerik" placeholder="Hello world!">
                    </fieldset>
                    <center>
                      <button type="submit" name="duyuru_ekle" class="btn btn-round btn-outline-success btn-min-width mr-1 mb-1"><i class="ft-save"></i> Kaydet</button>
                    </center>
                  </div>
                </form>
              </div>
            </div>
            <div>
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Duyuru Sil</h4>
                </div>
                <form method="POST" action="n0mSystem/n0mGuard.php">
                  <div class="card-body">
                    <h5>Silmek istediğiniz duyuruyu seçiniz</h5>
                    <fieldset class="form-group">
                      <select class="custom-select" id="customSelect" name="duyuru_id">
                        <option selected>duyuru seçiniz..</option>
                        <?php
                        $duyuru=$db->prepare("SELECT * FROM ann");
                        $duyuru->execute();
                        $say=0;
                        while ($listele=$duyuru->fetch(PDO::FETCH_ASSOC)) { $say++; ?>
                          <option value="<?php echo $listele['duyuru_id']; ?>"><?php echo htmlspecialchars($listele['duyuru_icerik']); ?></option>
                        <?php } ?>
                      </select>
                    </fieldset>
                    <center>
                      <button type="submit" name="duyuru_sil" class="btn btn-round btn-outline-danger btn-min-width mr-1 mb-1"><i class="ft-trash-2"></i> Sil</button>
                    </center>
                  </div>
                </form>
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