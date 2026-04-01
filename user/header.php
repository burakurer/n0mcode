<?php
require_once 'xo/functions.php';
loginControl();
?>
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="collapse navbar-collapse show" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-block d-md-none"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
                </ul>
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-mail"> </i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <?php 
                            require_once 'xo/functions.php';
                            dbConnect();
                            $duyuru=$db->prepare("SELECT * FROM ann");
                            $duyuru->execute();
                            $say=0;
                            while ($listele=$duyuru->fetch(PDO::FETCH_ASSOC)) { $say++; ?>
                                <a class="dropdown-item" target="_blank" href="<?php echo $listele['duyuru_url']; ?>"><i class="<?php echo htmlspecialchars($listele['duyuru_ikon']); ?>"></i> <?php echo htmlspecialchars($listele['duyuru_icerik']); ?></a>
                            <?php } ?>
                        </div>
                    </li>
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <span class="avatar avatar-online">
                                <?php 
                                require_once 'xo/functions.php';
                                dbConnect();
                                $user = $_SESSION['user_name'];
                                $usercek = $db->query("SELECT * FROM user WHERE user_name = '$user'")->fetch(PDO::FETCH_ASSOC);
                                if ( !empty($usercek['user_picture']) ){ ?>
                                    <img style=" border: 2px solid purple" src="<?php echo $usercek['user_picture']; ?>" alt="avatar">
                                <?php }
                                else { ?> 
                                    <img src="http://localhost/dox/n0mcode/theme/dox/images/usernone.png" alt="avatar">
                                <?php } ?>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="arrow_box_right"><a class="dropdown-item" href="my-account"><span class="avatar avatar-online">
                                <?php 
                                require_once 'xo/functions.php';
                                dbConnect();
                                $user = $_SESSION['user_name'];
                                $usercek = $db->query("SELECT * FROM user WHERE user_name = '$user'")->fetch(PDO::FETCH_ASSOC);
                                if ( !empty($usercek['user_picture']) ){ ?>
                                    <img style=" border: 2px solid purple" src="<?php echo $usercek['user_picture']; ?>" alt="avatar">
                                <?php }
                                else { ?> 
                                    <img src="http://localhost/dox/n0mcode/theme/dox/images/usernone.png" alt="avatar">
                                <?php } ?>
                                <span class="user-name text-bold-700 ml-1" >
                                    <?php
                                    date_default_timezone_set('Europe/Istanbul');
                                    $time = date('H');
                                    if ($time > 18 || $time < 4) {
                                        echo "İyi akşamlar ".htmlspecialchars($_SESSION['user_name']);
                                    }
                                    else{
                                        echo "İyi günler ".htmlspecialchars($_SESSION['user_name']);
                                    }
                                    ?>
                                </span></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><i class="ft-user"></i>Hesap türünüz: 
                                    <?php
                                    dbConnect();
                                    global $db;
                                    $sorgu = $_SESSION['user_name'];
                                    $vericek = $db->query("SELECT * FROM user WHERE user_name = '$sorgu'")->fetch(PDO::FETCH_ASSOC);
                                    if ($vericek) {
                                        $usersorgu = $vericek['user_yetki'];
                                        echo $usersorgu;
                                    }?>
                                </a>
                                <a class="dropdown-item" href="#"><i class="ft-activity"></i>İp adresiniz: <?php echo $_SERVER["REMOTE_ADDR"]; ?>
                                <a class="dropdown-item" href="#"><i class="ft-clock"></i>Sisteme giriş saatiniz: <?php echo $_SESSION['login_time']; ?>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" id="logout"><i class="ft-power"></i> Çıkış yap</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
</nav>
<script>
    document.getElementById("logout").addEventListener("click", function() {
      Swal.fire({
        title: 'Sistemden çıkış yap',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#5ED84F',
        cancelButtonColor: '#FA626B',
        confirmButtonText: 'Çıkış Yap',
        cancelButtonText: 'İptal'
    }).then((result) => {
        if (result.value) {
            Swal.fire({
                position: 'mid',
                icon: 'success',
                title: 'Sistemden başarıyla çıkış yaptınız',
                text: 'Otomatik olarak yönlendirileceksiniz',
                showConfirmButton: false,
                timer: 1000
            })
            var myVar = setInterval(myTimer, 1000);

            function myTimer() {
              var d = new Date();
              window.location.href = '../logout';
          }
      }
  })
});
</script>