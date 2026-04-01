<?php
error_reporting(0);
require_once 'n0mConn.php';

n0mDB_Connect();
$vericek = $db->query("SELECT * FROM setting WHERE n0m_setting = 1")->fetch(PDO::FETCH_ASSOC);
if ($vericek['n0m_maintenance'] == "1") {
    header('Location:../bakim');
    die();
}


/* KULLANICI İŞLEMLERİ */
if (isset($_POST['user_update'])) {
    ob_start();
    session_start();
    n0mDB_Connect();
    $user_secret = $_POST['user_secret'];
    $sorgu = $_SESSION['user_name'];
    $vericek = $db->query("SELECT * FROM user WHERE user_name = '$sorgu'")->fetch(PDO::FETCH_ASSOC);
    if ($vericek) {
        if ($user_secret == $vericek['user_secret']) {
            if($query = $db->prepare("UPDATE user SET user_picture =:resim, user_mail =:mail, user_notes =:not WHERE user_secret =:secret")){
                if (empty(trim($_POST['user_picture']))) {
                    $user_picture = "https://mami.wtf/n0mcode/theme/dox/images/usern0m.png";
                }
                else{
                    $user_picture = trim($_POST['user_picture']);
                }
                if (empty(trim($_POST['user_mail']))) {
                    $user_mail = "lütfen mail adresinizi yazınız";
                }
                else{
                    $user_mail = trim($_POST['user_mail']);
                }
                $user_notes = trim($_POST['user_notes']);
                $result = $query->execute(array(
                    'resim'=> $user_picture,
                    'mail' => $user_mail,
                    'not'  => $user_notes,
                    'secret'   => $user_secret
                )); 
                if($result){
                    header('Location:my-account?x=success');
                }
                else{
                    header('Location:my-account?x=error');
                }
            }else{
                header('Location:my-account?x=error');
            }
        }else{
            header('Location:my-account?x=error');
        }
    }else{
        header('Location:my-account?x=error');
    }
}
if (isset($_POST['pass_update'])) {
    ob_start();
    session_start();
    n0mDB_Connect();
    $user_secret = $_POST['user_secret'];
    $sorgu = $_SESSION['user_name'];
    $vericek = $db->query("SELECT * FROM user WHERE user_name = '$sorgu'")->fetch(PDO::FETCH_ASSOC);
    if ($vericek) {
        if ($user_secret == $vericek['user_secret']) {
            if (isset($_POST['old_pass']) && isset($_POST['new_pass']) && isset($_POST['new_passc'])) {
                $old_pass = md5(trim($_POST['old_pass']));
                $new_pass = trim($_POST['new_pass']);
                $new_passc = trim($_POST['new_passc']);
                if ($new_pass == $new_passc) {
                    if ($old_pass == $vericek['user_pass']) {
                        if($query = $db->prepare("UPDATE user SET user_pass =:pass WHERE user_secret =:secret")){
                            $passu = md5($new_pass);
                            $result = $query->execute(array(
                                'pass'=> $passu,
                                'secret'  => $user_secret
                            )); 
                            if($result){
                                header('Location:my-account?x=success');
                            }
                            else{
                                header('Location:my-account?x=error');
                            }
                        }else{
                            header('Location:my-account?x=error');
                        }
                    }else{
                        header('Location:my-account?x=error');
                    }
                }else{
                    header('Location:my-account?x=error');
                }
            }else{
                header('Location:my-account?x=error');
            }
        }else{
            header('Location:my-account?x=error');
        }
    }else{
        header('Location:my-account?x=error');
    }
}
/* KULLANICI İŞLEMLERİ */

/* KOD İŞLEMLERİ */
if (isset($_POST['yeni_kod'])) {
    ob_start();
    session_start();
    n0mDB_Connect();
    $baslik_c = strlen(trim($_POST['code_baslik']));
    if ($baslik_c < 100 && $baslik_c > 0){
        $icerik_c = strlen(trim($_POST['code_icerik']));
        if ($icerik_c < 6500 && $icerik_c > 0){
            if($query = $db->prepare("INSERT INTO code SET code_baslik =:baslik, code_icerik =:icerik, code_tarih=:tarih, code_sahip =:sahip, code_public =:public")){
                $code_baslik = htmlspecialchars(trim($_POST['code_baslik']));
                $code_public = $_POST['code_public'];
                $code_icerik = htmlspecialchars(trim($_POST['code_icerik']));
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
                    header('Location:my-codes?x=success');
                }
                else{
                    header('Location:my-codes?x=error');
                }
            }else{
                header('Location:my-codes?x=error');
            }
        }else{
            header('Location:my-codes?x=error');
        }
    }else{
        header('Location:my-codes?x=error');
    }
}

if (isset($_POST['kod_guncelle'])) {
    ob_start();
    session_start();
    n0mDB_Connect();
    $id=$_POST['code_id'];
    $sorgu = $_SESSION['user_name'];
    $vericek = $db->query("SELECT * FROM user WHERE user_name = '$sorgu'")->fetch(PDO::FETCH_ASSOC);
    if ($vericek) {
        $kontrol = $db->query("SELECT * FROM code WHERE code_id = '$id'")->fetch(PDO::FETCH_ASSOC);
        if ($kontrol['code_sahip'] == $vericek['user_name']) {
            $baslik_c = strlen(trim($_POST['code_baslik']));
            if ($baslik_c < 100 && $baslik_c > 0){
                $icerik_c = strlen(trim($_POST['code_icerik']));
                if ($icerik_c < 4500 && $icerik_c > 0){
                    if($query = $db->prepare("UPDATE code SET code_baslik =:baslik, code_icerik =:icerik, code_public =:public WHERE code_id = :id")){
                        $code_id = $_POST['code_id'];
                        $code_baslik = htmlspecialchars(trim($_POST['code_baslik']));
                        $code_icerik = htmlspecialchars(trim($_POST['code_icerik']));
                        $code_public = $_POST['code_public'];
                        $result = $query->execute(array( 
                            'baslik' => $code_baslik,
                            'icerik' => $code_icerik,
                            'public' => $code_public,
                            'id'     => $code_id
                        )); 
                        if($result){
                            header('Location:my-codes?x=success');
                        }
                        else{
                            header('Location:my-codes?x=error');
                        }
                    }else{
                        header('Location:my-codes?x=error');
                    }
                }else{
                    header('Location:my-codes?x=error');
                }
            }else{
                header('Location:my-codes?x=error');
            }
        }else{
            header('Location:my-codes?x=error');
        }
    }else{
        header('Location:my-codes?x=error');
    }
}

if (isset($_POST['kod_sil'])) {
    ob_start();
    session_start();
    n0mDB_Connect();
    $id=$_POST['id'];
    $sorgu = $_SESSION['user_name'];
    $vericek = $db->query("SELECT * FROM user WHERE user_name = '$sorgu'")->fetch(PDO::FETCH_ASSOC);
    if ($vericek) {
        $kontrol = $db->query("SELECT * FROM code WHERE code_id = '$id'")->fetch(PDO::FETCH_ASSOC);
        if ($kontrol['code_sahip'] == $vericek['user_name']) {
            if ($db->exec("DELETE FROM code WHERE code_id='$id'")) {
                header('Location:my-codes?x=success');
            }
            else{
                header('Location:my-codes?x=error');
            }
        }else{
            header('Location:my-codes?x=error');
        }
    }else{
        header('Location:my-codes?x=error');
    }
}
/* KOD İŞLEMLERİ */

?>