<?php

function dbConnect()
{
    try {
        global $db;
        $db = new PDO("mysql:host=db;dbname=n0mcode;charset=utf8;", "root", "n0mcode");
    } catch (PDOException $error) { ?>
        <div class="alert alert-danger alert-dismissible mb-2" role="alert">
            <h1 class="alert-heading mb-2">Kritik sistem hatası</h1>
            <p><b>Sisteminizde kritik bir hata var gibi görünüyor</b></p>
            <h3 class="alert-heading"><u>n0mcode Çıktısı</u></h3>
            <div style="border: 1px solid white; padding: 10px; ">
                <p>Çıktı zamanı: <code class="danger"><?php date_default_timezone_set('Europe/Istanbul');
                                                        echo date("H:i - d-m-Y"); ?></code></p>
                <p>Hata kodu:<br><code class="danger"><?php echo $error; ?></code></p>
            </div>
        </div>
    <?php }
}

function dbLogConnect()
{
    try {
        global $db;
        $db = new PDO("mysql:host=db;dbname=n0mcode;charset=utf8;", "root", "n0mcode");
    } catch (PDOException $error) { ?>
        <div class="alert alert-danger alert-dismissible mb-2" role="alert">
            <h1 class="alert-heading mb-2">Kritik sistem hatası</h1>
            <p><b>Sisteminizde kritik bir hata var gibi görünüyor</b></p>
            <h3 class="alert-heading"><u>n0mcode Çıktısı</u></h3>
            <div style="border: 1px solid white; padding: 10px; ">
                <p>Çıktı zamanı: <code class="danger"><?php date_default_timezone_set('Europe/Istanbul');
                                                        echo date("H:i - d-m-Y"); ?></code></p>
                <p>Hata kodu:<br><code class="danger"><?php echo $error; ?></code></p>
            </div>
        </div>
        <?php }
}

if (isset($_POST['todo_sil'])) {
    dbConnect();
    $id = $_POST['id'];

    if ($db->exec("DELETE FROM todo WHERE id='$id'")) {
        header('Location:../main?x=success');
    } else {
        header('Location:../main?x=error');
    }
}

function dbLogWConnect($status, $recaptcha, $log_pass)
{
    try {
        function GetIP()
        {
            if (getenv("HTTP_CLIENT_IP")) {
                $ip = getenv("HTTP_CLIENT_IP");
            } elseif (getenv("HTTP_X_FORWARDED_FOR")) {
                $ip = getenv("HTTP_X_FORWARDED_FOR");
                if (strstr($ip, ',')) {
                    $tmp = explode(',', $ip);
                    $ip = trim($tmp[0]);
                }
            } else {
                $ip = getenv("REMOTE_ADDR");
            }
            return $ip;
        }
        /*-----------------------------------------------------------*/
        dbConnect();
        # 2026 not: proje eski olduğu için ve diğer sql dosyasını bulamadığım için bypass ekledim
        // global $db;
        // dbLogConnect();
        // if ($query = $db->prepare("INSERT INTO n0mlog SET log_status =:status, log_recaptcha =:recaptcha, log_ip =:ip, log_uname =:uname, log_pass =:pass, log_web =:web, log_time =:ltime")) {
        //     $log_ip = GetIP();
        //     date_default_timezone_set('Europe/Istanbul');
        //     $log_time = date('H:i d.m.Y');
        //     $log_web = $_SERVER['HTTP_USER_AGENT'];
        //     $log_uname = $_POST['username'];
        //     $result = $query->execute(array(
        //         'status' => $status,
        //         'recaptcha' => $recaptcha,
        //         'ip' => $log_ip,
        //         'uname' => $log_uname,
        //         'pass' => $log_pass,
        //         'web' => $log_web,
        //         'ltime' => $log_time
        //     ));
        //     if ($result) {
        //         echo "başarılı";
        //         echo "
        //         'status' => $status,\n
        //         'recaptcha' => $recaptcha,\n
        //         'ip' => $log_ip,\n
        //         'uname' => $log_uname,\n
        //         'pass' => $log_pass,\n
        //         'web' => $log_web\n
        //         'ltime' => $log_time
        //         ";
        //     } else {
        //         echo "başarısız2";
        //         echo "
        //         'status' => $status,\n
        //         'recaptcha' => $recaptcha,\n
        //         'ip' => $log_ip,\n
        //         'uname' => $log_uname,\n
        //         'pass' => $log_pass,\n
        //         'web' => $log_web\n
        //         'ltime' => $log_time
        //         ";
        //     }
        // } else {
        //     echo "başarısız3";
        // }
        /*-----------------------------------------------------------*/
    } catch (PDOException $e) {
        echo "başarısız\n" . $e;
    }
}

function loginControl()
{
    dbConnect();
    ob_start();
    session_start();
    global $db;
    $sorgu = $_SESSION['user_name'];
    $vericek = $db->query("SELECT * FROM user WHERE user_name = '$sorgu'")->fetch(PDO::FETCH_ASSOC);
    if ($vericek) {
        $usersorgu = $vericek['user_yetki'];
        if ($usersorgu == "admin") {
            if (!isset($_SESSION['user_name'])) {
                header('Location:../login.php');
            }
        } else {
            header('Location:../login.php');
        }
    } else {
        header('Location:../login.php');
    }
}

function secureLogin()
{
    dbConnect();
    global $db;
    if (isset($_POST['secureLogin'])) {
        $vericek = $db->query("SELECT * FROM setting WHERE n0m_setting = 1")->fetch(PDO::FETCH_ASSOC);
        try {
            /*if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
                $vericek = $db->query("SELECT * FROM recaptcha WHERE recaptcha = 1")->fetch(PDO::FETCH_ASSOC);
                if ( $vericek ){ 
                    $secret = $vericek["recaptcha_secretkey"];
                }
                $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
                $responseData = json_decode($verifyResponse);
                if($responseData->success)
                {*/
            $username = htmlspecialchars_decode($_POST['username']);
            $password = md5($_POST['password']);
            if ($username && $password) {
                $sorgula = $db->prepare("SELECT * FROM user WHERE user_name=:username AND user_pass=:password");
                $sorgula->execute(array(
                    'username' => $username,
                    'password' => $password
                ));
                $verisay = $sorgula->rowCount();
                if ($verisay > 0) {
                    dbLogWConnect('1', '1', '********');
                    while ($yetkicek = $sorgula->fetch(PDO::FETCH_ASSOC)) {
                        if ($vericek['n0m_guard'] == "0") {
                            if ($yetkicek['user_yetki'] == "admin") {
                                session_start();
                                $_SESSION['user_name'] = $username;
                                date_default_timezone_set('Europe/Istanbul');
                                $login_time = date('H:i');
                                $_SESSION['login_time'] = $login_time;
                                header('Location:r00t/main');
                            } else if ($yetkicek['user_yetki'] == "user") {
                                session_start();
                                $_SESSION['user_name'] = $username;
                                date_default_timezone_set('Europe/Istanbul');
                                $login_time = date('H:i');
                                $_SESSION['login_time'] = $login_time;
                                header('Location:user/main');
                            } else {
                                header('Location:login.php?login=no');
                            }
                        } else {
                            if ($yetkicek['user_yetki'] == "admin") {
                                session_start();
                                $_SESSION['user_name'] = $username;
                                date_default_timezone_set('Europe/Istanbul');
                                $login_time = date('H:i');
                                $_SESSION['login_time'] = $login_time;
                                header('Location:r00t/main');
                            } else {
                                header('Location:login.php?login=no');
                            }
                        }
                    }
                } else {
                    dbLogWConnect('0', '1', $_POST['password']);
                    header('Location:login.php?x=error&q=acw');
                }
            } else {
                dbLogWConnect('0', '0', $_POST['password']);
                header('Location:login.php?x=error&q=acw');
            }
            /*}else {
                    header('Location:login.php?x=error&q=recaptcha');
                }
            }else {
                header('Location:login.php?x=error&q=recaptcha');
            }*/
        } catch (Exception $error) { ?>
            <div style="background-color: red; border: 3px solid black">
                <div class="alert alert-danger alert-dismissible mb-2" role="alert">
                    <h1 class="alert-heading mb-2">Kritik sistem hatası</h1>
                    <p><b>Sisteminizde kritik bir hata var gibi görünüyor</b></p>
                    <h3 class="alert-heading"><u>n0mcode Çıktısı</u></h3>
                    <div style="border: 1px solid white; padding: 10px; ">
                        <p>Çıktı zamanı: <code class="danger"><?php date_default_timezone_set('Europe/Istanbul');
                                                                echo date("H:i - d-m-Y"); ?></code></p>
                        <p>Hata kodu:<br><code class="danger"><?php echo $error; ?></code></p>
                    </div>
                </div>
            </div>
<?php }
    }
}

/* SİSTEM AYARLARI */
if (isset($_POST['n0m_guard_o'])) {
    dbConnect();
    if ($query = $db->prepare("UPDATE setting SET n0m_guard = :deger WHERE n0m_setting = :id")) {
        $deger = $_POST['n0m_guard'];
        $result = $query->execute(array(
            'deger' => $deger,
            'id'     => 1
        ));
        if ($result) {
            header('Location:../settings?x=success');
        } else {
            header('Location:../settings?x=error');
        }
    } else {
        header('Location:../settings?x=error');
    }
}

if (isset($_POST['user_reg_set'])) {
    dbConnect();
    if ($query = $db->prepare("UPDATE setting SET n0m_userreg = :deger WHERE n0m_setting = :id")) {
        $deger = $_POST['user_reg'];
        $result = $query->execute(array(
            'deger' => $deger,
            'id'     => 1
        ));
        if ($result) {
            header('Location:../settings?x=success');
        } else {
            header('Location:../settings?x=error');
        }
    } else {
        header('Location:../settings?x=error');
    }
}
/* SİSTEM AYARLARI */

/* KULLANICI İŞLEMLERİ */
if (isset($_POST['user_ekle'])) {
    dbConnect();
    if (empty($_POST['user_picture'])) {
        $user_picture = "https://mami.wtf/n0mcode/theme/dox/images/usern0m.png";
    } else {
        $user_picture = $_POST['user_picture'];
    }
    $user_name = $_POST['user_name'];
    $user_pass = md5($_POST['user_pass']);
    $user_mail = $_POST['user_mail'];
    $user_yetki = $_POST['user_yetki'];
    date_default_timezone_set('Europe/Istanbul');
    $user_reg = date('H:i d.m.Y');
    if (strlen($user_name) < 50) {
        if ($db->exec("INSERT INTO user (user_name,user_pass,user_mail,user_yetki,user_picture,user_reg) VALUES ('$user_name','$user_pass','$user_mail','$user_yetki','$user_picture','$user_reg')")) {
            header('Location:../users?x=success');
        } else {
            header('Location:../users?x=error');
        }
    } else {
        header('Location:../users?x=error');
    }
}

if (isset($_POST['user_guncelle'])) {
    dbConnect();
    if (strlen($user_name) < 50) {
        if ($query = $db->prepare("UPDATE user SET user_name = :isim, user_mail = :mail, user_yetki = :yetki, user_picture = :resim, user_notes = :not WHERE user_id = :id")) {
            $user_id = $_POST['user_id'];
            $user_name = $_POST['user_name'];
            $user_mail = $_POST['user_mail'];
            $user_yetki = $_POST['user_yetki'];
            $user_picture = $_POST['user_picture'];
            $user_notes = $_POST['user_notes'];
            $result = $query->execute(array(
                'isim' => $user_name,
                'mail' => $user_mail,
                'yetki' => $user_yetki,
                'resim' => $user_picture,
                'not'  => $user_notes,
                'id'   => $user_id
            ));
            if ($result) {
                header('Location:../users?x=success');
            } else {
                header('Location:../users?x=error');
            }
        } else {
            header('Location:../users?x=error');
        }
    } else {
        header('Location:../users?x=error');
    }
}

if (isset($_POST['user_delete'])) {
    dbConnect();
    $id = $_POST['id'];

    if ($db->exec("DELETE FROM user WHERE user_id='$id'")) {
        header('Location:../users?x=success');
    } else {
        header('Location:../users?x=error');
    }
}

if (isset($_POST['singup'])) {
    dbConnect();
    if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
        $vericek = $db->query("SELECT * FROM recaptcha WHERE recaptcha = 1")->fetch(PDO::FETCH_ASSOC);
        if ($vericek) {
            $secret = $vericek["recaptcha_secretkey"];
        }
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
        if ($responseData->success) {
            if (empty($_POST['picture'])) {
                $user_picture = "https://mami.wtf/n0mcode/theme/dox/images/usern0m.png";
            } else {
                $user_picture = $_POST['picture'];
            }
            $user_name = $_POST['username'];
            $user_pass = md5($_POST['password']);
            $user_mail = $_POST['email'];
            $user_yetki = "user";
            date_default_timezone_set('Europe/Istanbul');
            $user_reg = date('H:i d.m.Y');
            if (strlen($user_name) < 50) {
                $vericek = $db->query("SELECT * FROM user WHERE user_name = '$user_name'")->fetch(PDO::FETCH_ASSOC);
                if (!$vericek) {
                    if ($db->exec("INSERT INTO user (user_name,user_pass,user_mail,user_yetki,user_picture,user_reg) VALUES ('$user_name','$user_pass','$user_mail','$user_yetki','$user_picture','$user_reg')")) {
                        header('Location:../../login.php?x=success');
                    } else {
                        header('Location:../../login.php?x=error');
                    }
                } else {
                    header('Location:../../login.php?x=error&q=acm');
                }
            } else {
                header('Location:../../login.php?x=error&q=error');
            }
        } else {
            header('Location:../../login.php?x=error&q=recaptcha');
        }
    } else {
        header('Location:../../login.php?x=error&q=recaptcha');
    }
}
/* KULLANICI İŞLEMLERİ */

/* DUYURU İŞLEMLERİ */
if (isset($_POST['duyuru_ekle'])) {
    dbConnect();
    $ikon = $_POST['duyuru_ikon'];
    $icerik = $_POST['duyuru_icerik'];
    $url = $_POST['duyuru_url'];

    if ($db->exec("INSERT INTO ann (duyuru_ikon,duyuru_icerik,duyuru_url) VALUES ('$ikon','$icerik','$url')")) {
        header('Location:../announcements?x=success');
    } else {
        header('Location:../announcements?x=error');
    }
}

if (isset($_POST['duyuru_sil'])) {
    dbConnect();
    $id = $_POST['duyuru_id'];

    if ($db->exec("DELETE FROM ann WHERE duyuru_id='$id'")) {
        header('Location:../announcements?x=success');
    } else {
        header('Location:../announcements?x=error');
    }
}
/* DUYURU İŞLEMLERİ */

/* KOD İŞLEMLERİ */
if (isset($_POST['kod_guncelle'])) {
    dbConnect();
    if (strlen($_POST['code_icerik']) < 4500) {
        if ($query = $db->prepare("UPDATE code SET code_baslik =:baslik, code_icerik =:icerik, code_sahip =:sahip, code_public =:public WHERE code_id = :id")) {
            $code_id = $_POST['code_id'];
            $code_baslik = $_POST['code_baslik'];
            $code_icerik = $_POST['code_icerik'];
            $code_sahip = $_POST['code_sahip'];
            $code_public = $_POST['code_public'];
            $result = $query->execute(array(
                'baslik' => $code_baslik,
                'icerik' => $code_icerik,
                'sahip'  => $code_sahip,
                'public' => $code_public,
                'id'     => $code_id
            ));
            if ($result) {
                header('Location:../code-database?x=success');
            } else {
                header('Location:../code-database?x=error');
            }
        } else {
            header('Location:../code-database?x=error');
        }
    } else {
        header('Location:../code-database?x=error');
    }
}

if (isset($_POST['kod_sil'])) {
    dbConnect();
    $id = $_POST['id'];

    if ($db->exec("DELETE FROM code WHERE code_id='$id'")) {
        header('Location:../code-database?x=success');
    } else {
        header('Location:../code-database?x=error');
    }
}
/* KOD İŞLEMLERİ */

?>