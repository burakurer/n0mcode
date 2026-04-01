<?php
error_reporting(0);
function dbConnect(){
    try {
        global $db;
        $db = new PDO("mysql:host=db;dbname=n0mcode;charset=utf8;", "root", "n0mcode");
    } catch (PDOException $error) { ?>
        <div class="alert alert-danger alert-dismissible mb-2" role="alert">
            <h1 class="alert-heading mb-2">Kritik sistem hatası</h1>
            <p><b>Sisteminizde kritik bir hata var gibi görünüyor</b></p>
            <h3 class="alert-heading"><u>n0mcode Çıktısı</u></h3>
            <div style="border: 1px solid white; padding: 10px; ">
                <p>Çıktı zamanı: <code class="danger"><?php date_default_timezone_set('Europe/Istanbul'); echo date("H:i - d-m-Y"); ?></code></p>
                <p>Hata kodu:<br><code class="danger"><?php echo $error; ?></code></p>
            </div>
        </div>
    <?php }
}

/*
function logDbConnect()
{
    try {
        $db = new PDO("mysql:host=localhost;dbname=r6logdbmh;charset=utf8;", "root", "12345678");
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

        $log_adress = GetIP();
        date_default_timezone_set('Europe/Istanbul');
        setlocale(LC_TIME, 'tr_TR');
        $log_time1 = date("H:i");
        $log_time2 = date("d-m-Y");
        $log_time = $log_time1 . $log_time2;
        $log_username = htmlspecialchars_decode($_POST['username']);
        $log_password = $_POST['password'];
        $log_web = $_SERVER['HTTP_USER_AGENT'];
        if ($db->exec(
            "INSERT INTO mh_logs (log_time,log_adress,log_username,log_password,log_web) 
            VALUES ('$log_time','$log_adress','$log_username','$log_password','$log_web')"
        )) {
        }
    } catch (PDOException $e) {
        header('Location:../../login.php?login=no');
    }
}
*/

function loginControl(){
    dbConnect();
    ob_start();
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    global $db;
    $sorgu = $_SESSION['user_name'];
    $vericek = $db->query("SELECT * FROM user WHERE user_name = '$sorgu'")->fetch(PDO::FETCH_ASSOC);
    if ($vericek) {
        $usersorgu = $vericek['user_yetki'];
        if ($usersorgu == "user") {
            if (!isset($_SESSION['user_name'])) {
                header('Location:../login.php');
            }
        }
        else{
            header('Location:../login.php');
        }
    }
    else{
        header('Location:../login.php');
    }
}

/* KULLANICI İŞLEMLERİ */
if (isset($_POST['user_guncelle'])) {
    ob_start();
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    dbConnect();
    $sorgu = $_SESSION['user_name'];
    $vericek = $db->query("SELECT * FROM user WHERE user_name = '$sorgu'")->fetch(PDO::FETCH_ASSOC);
    if ($vericek) {
        if ($sorgu == $vericek['user_name']) {

            if($query = $db->prepare("UPDATE user SET user_picture = :resim, user_mail = :mail, user_notes = :not WHERE user_id = :id")){
                $user_id = $_POST['user_id'];
                $user_picture = $_POST['user_picture'];
                $user_mail = $_POST['user_mail'];
                $user_notes = $_POST['user_notes'];
                $result = $query->execute(array(
                    'resim'=> $user_picture,
                    'mail' => $user_mail,
                    'not'  => $user_notes,
                    'id'   => $user_id
                )); 
                if($result){
                    header('Location:../my-account?x=success');
                }
                else{
                    header('Location:../my-account?x=error');
                }
            }else{
                header('Location:../my-account?x=error');
            }
        }else{
            header('Location:../my-account?x=error');
        }
    }else{
        header('Location:../my-account?x=error');
    }
}
/* KULLANICI İŞLEMLERİ */

/* KOD İŞLEMLERİ */
if (isset($_POST['yeni_kod'])) {
    ob_start();
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    dbConnect();

    if (strlen($code_baslik) < 100){
        if (strlen($code_icerik) < 5000){
            /*if ($db->exec("INSERT INTO code (code_baslik,code_icerik,code_tarih,code_sahip,code_public) VALUES ('$code_baslik','$code_icerik','$code_tarih','$code_sahip','$code_public')")) {
                header('Location:../my-codes?x=success');
            }
            else{
                header('Location:../my-codes?x=error');
            }*/
            if($query = $db->prepare("INSERT INTO code SET code_baslik =:baslik, code_icerik =:icerik, code_tarih=:tarih, code_sahip =:sahip, code_public =:public")){
                $code_baslik = htmlspecialchars($_POST['code_baslik']);
                $code_public = $_POST['code_public'];
                $code_icerik = htmlspecialchars($_POST['code_icerik']);
                date_default_timezone_set('Europe/Istanbul');
                $code_tarih = date('H:i d.m.Y');
                $code_sahip = $_SESSION['user_name'];
                $result = $query->execute(array( 
                    'baslik' => $code_baslik,
                    'icerik' => $code_icerik,
                    'tarih' => $code_tarih,
                    'sahip' => $code_sahip,
                    'public' => $code_public
                )); 
                if($result){
                    header('Location:../my-codes?x=success');
                }
                else{
                    header('Location:../my-codes?x=error');
                }
            }else{
                header('Location:../my-codes?x=error');
            }
        }else{
            header('Location:../my-codes?x=error');
        }
    }else{
        header('Location:../my-codes?x=error');
    }
}

if (isset($_POST['kod_guncelle'])) {
    ob_start();
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    dbConnect();
    $id=$_POST['code_id'];

    $sorgu = $_SESSION['user_name'];
    $vericek = $db->query("SELECT * FROM user WHERE user_name = '$sorgu'")->fetch(PDO::FETCH_ASSOC);
    if ($vericek) {
        $kontrol = $db->query("SELECT * FROM code WHERE code_id = '$id'")->fetch(PDO::FETCH_ASSOC);
        if ($kontrol['code_sahip'] == $vericek['user_name']) {
            if (strlen($_POST['code_baslik']) < 100){
                if (strlen($_POST['code_icerik']) < 5000){
                    if($query = $db->prepare("UPDATE code SET code_baslik =:baslik, code_icerik =:icerik, code_public =:public WHERE code_id = :id")){
                        $code_id = $_POST['code_id'];
                        $code_baslik = htmlspecialchars($_POST['code_baslik']);
                        $code_icerik = htmlspecialchars($_POST['code_icerik']);
                        $code_public = $_POST['code_public'];
                        $result = $query->execute(array( 
                            'baslik' => $code_baslik,
                            'icerik' => $code_icerik,
                            'public' => $code_public,
                            'id'     => $code_id
                        )); 
                        if($result){
                            header('Location:../my-codes?x=success');
                        }
                        else{
                            header('Location:../my-codes?x=error');
                        }
                    }else{
                        header('Location:../my-codes?x=error');
                    }
                }else{
                    header('Location:../my-codes?x=error');
                }
            }else{
                header('Location:../my-codes?x=error');
            }
        }else{
            header('Location:../my-codes?x=error');
        }
    }else{
        header('Location:../my-codes?x=error');
    }
}

if (isset($_POST['kod_sil'])) {
    ob_start();
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    dbConnect();
    $id=$_POST['id'];

    $sorgu = $_SESSION['user_name'];
    $vericek = $db->query("SELECT * FROM user WHERE user_name = '$sorgu'")->fetch(PDO::FETCH_ASSOC);
    if ($vericek) {

        $kontrol = $db->query("SELECT * FROM code WHERE code_id = '$id'")->fetch(PDO::FETCH_ASSOC);
        if ($kontrol['code_sahip'] == $vericek['user_name']) {
            if ($db->exec("DELETE FROM code WHERE code_id='$id'")) {
                header('Location:../my-codes?x=success');
            }
            else{
                header('Location:../my-codes?x=error');
            }
        }else{
            header('Location:../my-codes?x=error');
        }
    }else{
        header('Location:../my-codes?x=error');
    }
}
/* KOD İŞLEMLERİ */

if (isset($_POST['12'])) {
    echo $_POST['code_baslik'];
}

?>