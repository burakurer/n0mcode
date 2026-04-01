<?php
/*
* n0mCode © 2020
* n0mCore version 1.3
* Developer by R6w[M]uhammet
* kodfaresi.xyz & mami.wtf
*/
error_reporting(0);
require_once 'n0mCore.php';
n0mDB_Connect();
n0mLogDB_Connect();

function dbLogWConnect($status, $hcaptcha, $log_pass)
{
    try {
        // function GetIP()
        // {
        //     if (getenv("HTTP_CLIENT_IP")) {
        //         $ip = getenv("HTTP_CLIENT_IP");
        //     } elseif (getenv("HTTP_X_FORWARDED_FOR")) {
        //         $ip = getenv("HTTP_X_FORWARDED_FOR");
        //         if (strstr($ip, ',')) {
        //             $tmp = explode(',', $ip);
        //             $ip = trim($tmp[0]);
        //         }
        //     } else {
        //         $ip = getenv("REMOTE_ADDR");
        //     }
        //     return $ip;
        // }
        /*-----------------------------------------------------------*/
        n0mDB_Connect();
        global $db;
        n0mLogDB_Connect();
        if($query = $db->prepare("INSERT INTO n0mlog SET log_status =:status, log_hcaptcha =:hcaptcha, log_ip =:ip, log_uname =:uname, log_pass =:pass, log_web =:web, log_time =:ltime")){
            $log_ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
            date_default_timezone_set('Europe/Istanbul');
            $log_time = date('H:i d.m.Y');
            $log_web = $_SERVER['HTTP_USER_AGENT'];
            $log_uname = htmlspecialchars(trim($_POST['username']));
            $result = $query->execute(array( 
                'status' => $status,
                'hcaptcha' => $hcaptcha,
                'ip' => $log_ip,
                'uname' => $log_uname,
                'pass' => htmlspecialchars(trim($log_pass)),
                'web' => $log_web,
                'ltime' => $log_time
            )); 
            if($result){
            }
            else{
            }
        }else{
        }
    } catch (PDOException $e) {
    }
}

function secureLogin(){
    n0mDB_Connect();
    global $db;
    if (isset($_POST['secureLogin'])) {
        $vericekx = $db->query("SELECT * FROM setting WHERE n0m_setting = 1")->fetch(PDO::FETCH_ASSOC);
        try {
            if (true){
            // if(isset($_POST['h-captcha-response']) && !empty($_POST['h-captcha-response'])){
                // $vericek = $db->query("SELECT * FROM hcaptcha WHERE hcaptcha = 1")->fetch(PDO::FETCH_ASSOC);
                // if ( $vericek ){ 
                //     $secret = $vericek["hcaptcha_secretkey"];
                // }
                // $response = $_POST['h-captcha-response'];
                // $remoteip = $_SERVER["REMOTE_ADDR"];
                // $verifyResponse = file_get_contents("https://hcaptcha.com/siteverify?secret=".$secret."&response=".$response."&remoteip=".$remoteip);
                // $responseData = json_decode($verifyResponse);
                // if($responseData->success)
                # 2026 not: bu proje arşiv niteliğinde olduğu için hcaptcha bypass ekledim
                if(true)
                {
                    $username = htmlspecialchars_decode(trim($_POST['username']));
                    $password = md5($_POST['password']);
                    if ($username && $password) {
                        $sorgula = $db->prepare("SELECT * FROM user WHERE user_name=:username AND user_pass=:password");
                        $sorgula->execute(array(
                            'username' => $username,
                            'password' => $password
                        ));
                        $verisay = $sorgula->rowCount();
                        if ($verisay > 0) {
                            dbLogWConnect('1','1','********');
                            while($yetkicek=$sorgula->fetch(PDO::FETCH_ASSOC)){
                                if ($vericekx['n0m_guard'] == "0")  {
                                    if ($yetkicek['user_yetki']== "admin") {
                                        session_start();
                                        $_SESSION['user_name'] = $username;
                                        date_default_timezone_set('Europe/Istanbul');
                                        $login_time = date('H:i');
                                        $_SESSION['login_time'] = $login_time;
                                        header('Location:root/main');
                                    }
                                    else if ($yetkicek['user_yetki']== "user"){
                                        session_start();
                                        $_SESSION['user_name'] = $username;
                                        date_default_timezone_set('Europe/Istanbul');
                                        $login_time = date('H:i');
                                        $_SESSION['login_time'] = $login_time;
                                        header('Location:user/main');
                                    }
                                    else{
                                        header('Location:login.php?login=no');
                                    }
                                }
                                else{
                                    if ($yetkicek['user_yetki']== "admin") {
                                        session_start();
                                        $_SESSION['user_name'] = $username;
                                        date_default_timezone_set('Europe/Istanbul');
                                        $login_time = date('H:i');
                                        $_SESSION['login_time'] = $login_time;
                                        header('Location:root/main');
                                    }
                                    else{
                                        header('Location:login.php?login=no');
                                    }
                                }
                            }
                        }else {
                            dbLogWConnect('0','1',$_POST['password']);
                            header('Location:login.php?x=error&q=no');
                        }
                    }else {
                        dbLogWConnect('0','1',$_POST['password']);
                        header('Location:login.php?x=error&q=no');
                    }
                }else {
                    dbLogWConnect('0','0',$_POST['password']);
                    header('Location:login.php?x=error&q=captcha');
                }
            }else {
                dbLogWConnect('0','0',$_POST['password']);
                header('Location:login.php?x=error&q=captcha');
            }
        } catch (Exception $error) {}
    }
}

/* İP BAN SİSTEMİ */
if (isset($_POST['ip-ban'])) {
    $ipadresi = $_POST['ip'];
    $banlist = "banlist.txt";
    if (file_exists($banlist)) {
        $banlist = fopen($banlist, 'a');
        $ban = fwrite($banlist, "\n$ipadresi");
        if ($ban) {
            header('Location:../security?x=success');
        }
        else{
            header('Location:../security?x=error');
        }
        fclose($banlist);
    }
    else{
        header('Location:../security?x=error');
    }
}
/* İP BAN SİSTEMİ */

/* SİSTEM AYARLARI */
if (isset($_POST['n0m_guard_o'])) {
    n0mDB_Connect();
    if($query = $db->prepare("UPDATE setting SET n0m_guard = :deger WHERE n0m_setting = :id")){
        $deger = $_POST['n0m_guard'];
        $result = $query->execute(array( 
            'deger' => $deger,
            'id'     => 1
        )); 
        if($result){
            header('Location:../settings?x=success');
        }
        else{
            header('Location:../settings?x=error');
        }
    }else{
        header('Location:../settings?x=error');
    }
}

if (isset($_POST['n0m_maintenance_o'])) {
    n0mDB_Connect();
    if($query = $db->prepare("UPDATE setting SET n0m_maintenance = :deger WHERE n0m_setting = :id")){
        $deger = $_POST['n0m_maintenance'];
        $result = $query->execute(array( 
            'deger' => $deger,
            'id'     => 1
        )); 
        if($result){
            header('Location:../settings?x=success');
        }
        else{
            header('Location:../settings?x=error');
        }
    }else{
        header('Location:../settings?x=error');
    }
}

if (isset($_POST['user_reg_set'])) {
    n0mDB_Connect();
    if($query = $db->prepare("UPDATE setting SET n0m_userreg = :deger WHERE n0m_setting = :id")){
        $deger = $_POST['user_reg'];
        $result = $query->execute(array( 
            'deger' => $deger,
            'id'     => 1
        )); 
        if($result){
            header('Location:../settings?x=success');
        }
        else{
            header('Location:../settings?x=error');
        }
    }else{
        header('Location:../settings?x=error');
    }
}

if (isset($_POST['n0m_hcaptcha_o'])) {
    n0mDB_Connect();
    if($query = $db->prepare("UPDATE hcaptcha SET hcaptcha_sitekey =:sitekey, hcaptcha_secretkey =:secretkey WHERE hcaptcha =:id")){
        $sitekey = trim($_POST['sitekey']);
        $secretkey = trim($_POST['secretkey']);
        echo $sitekey." - ".$secretkey;
        $result = $query->execute(array(
            'sitekey' => $sitekey,
            'secretkey' => $secretkey,
            'id' => 1
        )); 
        if($result){
            header('Location:../settings?x=success');
        }
        else{
            header('Location:../settings?x=error');
        }
    }else{
        header('Location:../settings?x=error');
    }
}
/* SİSTEM AYARLARI */

/* KULLANICI İŞLEMLERİ */
if (isset($_POST['user_ekle'])) {
    n0mDB_Connect();
    if (strlen($user_name) < 50) {
        if($query = $db->prepare("INSERT INTO user SET user_name =:username, user_pass =:userpass, user_mail =:usermail, user_yetki =:useryetki, user_picture =:userpicture, user_reg =:userreg, user_secret =:usersecret")){
            if (empty(trim($_POST['user_picture']))) {
                $user_picture = "https://mami.wtf/n0mcode/theme/dox/images/usern0m.png";
            }
            else{
                $user_picture = trim($_POST['user_picture']);
            }
            $user_name = htmlspecialchars(trim($_POST['user_name']));
            $user_pass = md5($_POST['user_pass']);
            $user_mail = htmlspecialchars(trim($_POST['user_mail']));
            $user_yetki = $_POST['user_yetki'];
            date_default_timezone_set('Europe/Istanbul');
            $user_reg = date('H:i d.m.Y');
            $user_secret = rand(10000000,90000000)*rand(10000000,90000000);
            $result = $query->execute(array( 
                'username' => $user_name,
                'userpass' => $user_pass,
                'usermail' => $user_mail,
                'useryetki' => $user_yetki,
                'userpicture' => $user_picture,
                'userreg' => $user_reg,
                'usersecret' => $user_secret
            )); 
            if($result){
                header('Location:../users?x=success');
            }
            else{
                header('Location:../users?x=error');
            }
        }else{
            header('Location:../users?x=error');
        }
    }else{
        header('Location:../users?x=error');
    }
}

if (isset($_POST['user_guncelle'])) {
    n0mDB_Connect();
    if (empty($_POST['user_pass'])) {
        if (strlen($user_name) < 50) {
            if($query = $db->prepare("UPDATE user SET user_name = :isim, user_mail = :mail, user_yetki = :yetki, user_picture = :resim, user_notes = :not WHERE user_secret = :secret")){
                $user_secret = $_POST['user_secret'];
                $user_name = htmlspecialchars(trim($_POST['user_name']));
                $user_mail = htmlspecialchars(trim($_POST['user_mail']));
                $user_yetki = $_POST['user_yetki'];
                $user_picture = htmlspecialchars(trim($_POST['user_picture']));
                $user_notes = htmlspecialchars(trim($_POST['user_notes']));
                $result = $query->execute(array( 
                    'isim' => $user_name,
                    'mail' => $user_mail,
                    'yetki'=> $user_yetki,
                    'resim'=> $user_picture,
                    'not'  => $user_notes,
                    'secret' => $user_secret
                )); 
                if($result){
                    header('Location:../users?x=success');
                }
                else{
                    header('Location:../users?x=error');
                }
            }else{
                header('Location:../users?x=error');
            }
        }else{
            header('Location:../users?x=error');
        }
    }
    else{
        if (strlen($user_name) < 50) {
            if($query = $db->prepare("UPDATE user SET user_name =:isim, user_pass =:sifre, user_mail =:mail, user_yetki =:yetki, user_picture =:resim, user_notes =:not WHERE user_secret =:secret")){
                $user_secret = $_POST['user_secret'];
                $user_name = htmlspecialchars(trim($_POST['user_name']));
                $user_pass = md5($_POST['user_pass']);
                $user_mail = htmlspecialchars(trim($_POST['user_mail']));
                $user_yetki = $_POST['user_yetki'];
                $user_picture = htmlspecialchars(trim($_POST['user_picture']));
                $user_notes = htmlspecialchars(trim($_POST['user_notes']));
                $result = $query->execute(array( 
                    'isim' => $user_name,
                    'sifre'=> $user_pass,
                    'mail' => $user_mail,
                    'yetki'=> $user_yetki,
                    'resim'=> $user_picture,
                    'not'  => $user_notes,
                    'secret' => $user_secret
                )); 
                if($result){
                    header('Location:../users?x=success');
                }
                else{
                    header('Location:../users?x=error');
                }
            }else{
                header('Location:../users?x=error');
            }
        }else{
            header('Location:../users?x=error');
        }
    }
}

if (isset($_POST['user_delete'])) {
    n0mDB_Connect();
    $secret=$_POST['secret'];

    if ($db->exec("DELETE FROM user WHERE user_secret='$secret'")) {
        header('Location:../users?x=success');
    }
    else{
        header('Location:../users?x=error');
    }
}

// if (isset($_POST['signup'])) {
//     n0mDB_Connect();
//     if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
//         $vericek = $db->query("SELECT * FROM recaptcha WHERE recaptcha = 1")->fetch(PDO::FETCH_ASSOC);
//         if ( $vericek ){ 
//             $secret = $vericek["recaptcha_secretkey"];
//         }
//         $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
//         $responseData = json_decode($verifyResponse);
//         if($responseData->success)
//         {
//             $user_name = htmlspecialchars(trim($_POST['user_name']));
//             if (strlen($user_name) < 50 && strlen($user_name) > 0) {
//                 if (strlen($user_mail) > 0) {
//                     $vericek = $db->query("SELECT * FROM user WHERE user_name = '$user_name'")->fetch(PDO::FETCH_ASSOC);
//                     if (!$vericek) {
//                         if($query = $db->prepare("INSERT INTO user SET user_name =:username, user_pass =:userpass, user_mail =:usermail, user_yetki =:useryetki, user_picture =:userpicture, user_reg =:userreg, user_secret =:usersecret")){
//                             if (empty(trim($_POST['user_picture']))) {
//                                 $user_picture = "https://mami.wtf/n0mcode/theme/dox/images/usern0m.png";
//                             }
//                             else{
//                                 $user_picture = htmlspecialchars(trim($_POST['user_picture']));
//                             }
//                             $user_pass = md5($_POST['user_pass']);
//                             $user_mail = htmlspecialchars(trim($_POST['user_mail']));
//                             date_default_timezone_set('Europe/Istanbul');
//                             $user_reg = date('H:i d.m.Y');
//                             $user_secret = rand(10000000,90000000)*rand(10000000,90000000);
//                             $result = $query->execute(array( 
//                                 'username' => $user_name,
//                                 'userpass' => $user_pass,
//                                 'usermail' => $user_mail,
//                                 'useryetki' => 'user',
//                                 'userpicture' => $user_picture,
//                                 'userreg' => $user_reg,
//                                 'usersecret' => $user_secret
//                             )); 
//                             if($result){
//                                 header('Location:../../login.php?x=success&q=success');
//                             }
//                             else{
//                                 header('Location:../../login.php?x=error&q=error');
//                             }
//                         }else{
//                             header('Location:../../login.php?x=error&q=error');
//                         }
//                     }else{
//                         header('Location:../../login.php?x=error&q=acm');
//                     }
//                 }else{
//                     header('Location:../../login.php?x=error&q=error');
//                 }
//             }else{
//                 header('Location:../../login.php?x=error&q=error');
//             }
//         }else{
//             header('Location:../../login.php?x=error&q=recaptcha');
//         }
//     }else{
//         header('Location:../../login.php?x=error&q=recaptcha');
//     }
// }
/* KULLANICI İŞLEMLERİ */

/* DUYURU İŞLEMLERİ */
if (isset($_POST['duyuru_ekle'])) {
    n0mDB_Connect();
    if($query = $db->prepare("INSERT INTO ann SET duyuru_ikon =:duyuruikon, duyuru_icerik =:duyuruicerik, duyuru_url =:duyuruurl")){
        $ikon = htmlspecialchars(trim($_POST['duyuru_ikon']));
        $icerik = htmlspecialchars(trim($_POST['duyuru_icerik']));
        $url = htmlspecialchars(trim($_POST['duyuru_url']));
        $result = $query->execute(array( 
            'duyuruikon' => $ikon,
            'duyuruicerik' => $icerik,
            'duyuruurl' => $url
        )); 
        if($result){
            header('Location:../announcements?x=success');
        }
        else{
            header('Location:../announcements?x=error');
        }
    }else{
        header('Location:../announcements?x=error');
    }
}

if (isset($_POST['duyuru_sil'])) {
    n0mDB_Connect();
    $id=$_POST['duyuru_id'];

    if ($db->exec("DELETE FROM ann WHERE duyuru_id='$id'")) {
        header('Location:../announcements?x=success');
    }
    else{
        header('Location:../announcements?x=error');
    }
}
/* DUYURU İŞLEMLERİ */

/* KOD İŞLEMLERİ */
if (isset($_POST['kod_guncelle'])) {
    n0mDB_Connect();
    if (strlen($_POST['code_icerik']) < 6500){
        if($query = $db->prepare("UPDATE code SET code_baslik =:baslik, code_icerik =:icerik, code_sahip =:sahip, code_public =:public WHERE code_id = :id")){
            $code_id = $_POST['code_id'];
            $code_baslik = htmlspecialchars(trim($_POST['code_baslik']));
            $code_icerik = htmlspecialchars(trim($_POST['code_icerik']));
            $code_sahip = htmlspecialchars(trim($_POST['code_sahip']));
            $code_public = $_POST['code_public'];
            $result = $query->execute(array(
                'baslik' => $code_baslik,
                'icerik' => $code_icerik,
                'sahip'  => $code_sahip,
                'public' => $code_public,
                'id'     => $code_id
            )); 
            if($result){
                header('Location:../code-database?x=success');
            }
            else{
                header('Location:../code-database?x=error');
            }
        }else{
            header('Location:../code-database?x=error');
        }
    }else{
        header('Location:../code-database?x=error');
    }
}

if (isset($_POST['kod_sil'])) {
    n0mDB_Connect();
    $id=$_POST['id'];

    if ($db->exec("DELETE FROM code WHERE code_id='$id'")) {
        header('Location:../code-database?x=success');
    }
    else{
        header('Location:../code-database?x=error');
    }
}
/* KOD İŞLEMLERİ */

/* LOG İŞLEMLERİ */
if (isset($_POST['allLog_delete'])) {
	n0mLogDB_Connect();
	if ($db->exec("TRUNCATE TABLE n0mlog")) {
		header('Location:../security?x=error');
	}
    else{
        header('Location:../security?x=success');
    }
}

if (isset($_POST['log_delete'])) {
    n0mLogDB_Connect();
    $id=$_POST['id'];

    if ($db->exec("DELETE FROM n0mlog WHERE log_id='$id'")) {
        header('Location:../security?x=success');
    }
    else{
        header('Location:../security?x=error');
    }
}
/* LOG İŞLEMLERİ */

?>