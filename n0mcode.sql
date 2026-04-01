-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: sql308.epizy.com
-- Üretim Zamanı: 29 Eyl 2020, 03:41:13
-- Sunucu sürümü: 5.6.48-88.0
-- PHP Sürümü: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `epiz_25237070_n0mn0mDB`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ann`
--

CREATE TABLE `ann` (
  `duyuru_id` int(11) NOT NULL,
  `duyuru_ikon` varchar(30) COLLATE utf8_turkish_ci DEFAULT NULL,
  `duyuru_icerik` varchar(70) COLLATE utf8_turkish_ci NOT NULL,
  `duyuru_url` varchar(300) COLLATE utf8_turkish_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `ann`
--

INSERT INTO `ann` (`duyuru_id`, `duyuru_ikon`, `duyuru_icerik`, `duyuru_url`) VALUES
(35, 'ft-unlock', 'Test duyuru', 'testing123'),
(34, 'ft-heart', 'Blog Sitemiz', 'https://kodfaresi.xyz');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `code`
--

CREATE TABLE `code` (
  `code_id` int(11) NOT NULL,
  `code_baslik` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `code_icerik` varchar(6500) COLLATE utf8_turkish_ci NOT NULL,
  `code_tarih` varchar(16) COLLATE utf8_turkish_ci NOT NULL,
  `code_sahip` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `code_public` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `code`
--

INSERT INTO `code` (`code_id`, `code_baslik`, `code_icerik`, `code_tarih`, `code_sahip`, `code_public`) VALUES
(4, 'Action Script 3 - Tuşa basınca resmi hareket ettirmek', 'import flash.events.KeyboardEvent;\r\n\r\nstage.addEventListener(KeyboardEvent.KEY_DOWN, tusabas);\r\nfunction tusabas(event:KeyboardEvent):void{\r\n	var tus = event.keyCode;\r\n	if (tus == 37){\r\n		admin.x -= 10;\r\n	}\r\n	if (tus == 38){\r\n		admin.y -= 10;\r\n	}\r\n	if (tus == 39){\r\n		admin.x += 10;\r\n	}\r\n	if (tus == 40){\r\n		admin.y += 10;\r\n	}\r\n}', '18:40 07.03.2020', 'admin', 1),
(5, 'Action Script 3 - 2 kişilik yarış oyunu', 'import flash.events.Event;\r\nimport flash.events.KeyboardEvent;\r\nimport flash.text.TextField;\r\nimport flash.text.TextFormat;\r\n\r\nvar player1 = oyuncu1;\r\nvar player2 = oyuncu2;\r\nvar bitis = kale;\r\nvar kazanan: TextField;\r\nvar o1p = TextField;\r\nvar o2p: TextField;\r\nvar bicim: TextFormat;\r\nvar he;\r\n\r\nstage.addEventListener(KeyboardEvent.KEY_DOWN, game);\r\n\r\nbicim = new TextFormat();\r\nbicim.color = 0x00bb00;\r\nbicim.size = 20;\r\nbicim.font = &quot;Verdana&quot;;\r\n\r\nkazanan = new TextField();\r\nkazanan.defaultTextFormat = bicim;\r\nkazanan.text = &quot;oyun başladı&quot;;\r\nkazanan.x = 150;\r\nkazanan.width = 400;\r\naddChild(kazanan);\r\n\r\no2p = new TextField();\r\no2p.defaultTextFormat = bicim;\r\no2p.text = &quot;0&quot;;\r\no2p.x = 400;\r\no2p.width = 20;\r\naddChild(o2p);\r\n\r\no1p = new TextField();\r\no1p.defaultTextFormat = bicim;\r\no1p.text = &quot;0&quot;;\r\no1p.x = 100;\r\no1p.width = 20;\r\naddChild(o1p);\r\n\r\nfunction game(eo: KeyboardEvent) {\r\n	if (eo.keyCode == 39) {\r\n		player1.x += 20;\r\n		if (player1.hitTestObject(bitis)) {\r\n			he = int(o1p.text);\r\n			he += 1;\r\n			o1p.text = he.toString();\r\n			//stage.removeEventListener(KeyboardEvent.KEY_DOWN, game);\r\n			restart();\r\n		}\r\n	}\r\n	if (eo.keyCode == 37) {\r\n		player2.x += 20;\r\n		if (player2.hitTestObject(bitis)) {\r\n			he = int(o2p.text);\r\n			he += 1;\r\n			o2p.text = he.toString();\r\n			//stage.removeEventListener(KeyboardEvent.KEY_DOWN, game);\r\n			restart();\r\n		}\r\n	}\r\n}\r\n\r\nfunction restart(): void {\r\n	player1.x = 20;\r\n	player2.x = 20;\r\n}', '18:42 07.03.2020', 'admin', 1),
(73, 'Android Studio - Sensor Uygulaması', 'package com.example.myapplication;\r\n\r\nimport androidx.appcompat.app.AppCompatActivity;\r\n\r\nimport android.content.Context;\r\nimport android.hardware.Sensor;\r\nimport android.hardware.SensorEvent;\r\nimport android.hardware.SensorEventListener;\r\nimport android.hardware.SensorManager;\r\nimport android.os.Bundle;\r\nimport android.widget.TextView;\r\n\r\npublic class MainActivity extends AppCompatActivity  implements SensorEventListener {\r\n              \r\n   Sensor IvmeOlcer;\r\n   SensorManager Senman;\r\n   TextView DegerMetni;\r\n   @Override\r\n   protected void onCreate(Bundle savedInstanceState) {\r\n       super.onCreate(savedInstanceState);\r\n       setContentView(R.layout.activity_main);\r\n       Senman=(SensorManager)getSystemService(Context.SENSOR_SERVICE);\r\n       IvmeOlcer=Senman.getDefaultSensor(Sensor.TYPE_ACCELEROMETER);\r\n       Senman.registerListener(this,IvmeOlcer,SensorManager.SENSOR_DELAY_NORMAL);\r\n       DegerMetni=findViewById(R.id.ivmeTextView);\r\n   }\r\n\r\n   @Override\r\n   public void onSensorChanged(SensorEvent olay) {\r\n       if (olay.sensor.getType()==Sensor.TYPE_ACCELEROMETER)\r\n       {\r\n           float[] degerler=olay.values;\r\n           float x=degerler[0];\r\n           float y=degerler[1];\r\n           float z=degerler[2];\r\n          \r\n           DegerMetni.setText(&quot;x=&quot;+x+&quot;\r\ny&quot;+y+&quot;\r\nz&quot;+z);\r\n          \r\n          \r\n       }\r\n   }\r\n\r\n   @Override\r\n   public void onAccuracyChanged(Sensor sensor, int accuracy) {\r\n\r\n   }\r\n}\r\n\r\n', '14:40 10.03.2020', 'yguzelkus', 0),
(74, 'Android Studio - Sensör Uygulaması', '//importlar\r\nimport androidx.appcompat.app.AppCompatActivity;\r\nimport android.content.Context;\r\nimport android.hardware.Sensor;\r\nimport android.hardware.SensorEvent;\r\nimport android.hardware.SensorEventListener;\r\nimport android.hardware.SensorManager;\r\nimport android.os.Bundle;\r\nimport android.widget.TextView;\r\n\r\npublic class MainActivity extends AppCompatActivity  implements SensorEventListener {\r\n  \r\n   Sensor IvmeOlcer;\r\n   SensorManager Senman;\r\n   TextView DegerMetni;\r\n   @Override\r\n   protected void onCreate(Bundle savedInstanceState) {\r\n       super.onCreate(savedInstanceState);\r\n       setContentView(R.layout.activity_main);\r\n       Senman=(SensorManager)getSystemService(Context.SENSOR_SERVICE);\r\n       IvmeOlcer=Senman.getDefaultSensor(Sensor.TYPE_ACCELEROMETER);\r\n       Senman.registerListener(this,IvmeOlcer,SensorManager.SENSOR_DELAY_NORMAL);\r\n       DegerMetni=findViewById(R.id.ivmeTextView);\r\n   }\r\n\r\n   @Override\r\n   public void onSensorChanged(SensorEvent olay) {\r\n       if (olay.sensor.getType()==Sensor.TYPE_ACCELEROMETER)\r\n       {\r\n           float[] degerler=olay.values;\r\n           float x=degerler[0];\r\n           float y=degerler[1];\r\n           float z=degerler[2];\r\n          \r\n           DegerMetni.setText(&quot;x=&quot;+x+&quot;y=&quot;+y+&quot;z=&quot;+z);   \r\n       }\r\n   }\r\n\r\n   @Override\r\n   public void onAccuracyChanged(Sensor sensor, int accuracy) {\r\n\r\n   }\r\n}', '15:01 10.03.2020', 'admin', 1),
(111, 'Javascript ile zamana göre ziyaretçi karşılama mesajı verme örneği', '/* 11-U */\r\n\r\nKarsilama.js:\r\n\r\nvar Tarih = new Date(); //Tarihi bilgisini ‘Tarih’ isimli değişkene atadık.\r\nvar Saat = Tarih.getHours(); //Daha sonra ‘Tarih’ değişkenindeki saat bilgisini ‘Saat’ isimli değişkenime atadık.\r\nif ( Saat &gt; 6 &amp;&amp; Saat &lt;=10) //saat 6 ila 10 arasında ise\r\n{\r\n    document.write(&quot;Günaydın!&quot;);\r\n}\r\nelse if (Saat &gt; 11 &amp;&amp; Saat &lt;=16) //saat 11 ila 16 arasında ise\r\n{\r\n    document.write(&quot;Tünaydın!&quot;);\r\n}\r\nelse if (Saat  &gt; 17 &amp;&amp; Saat &lt;=22) //saat 17 ila 22 arasında ise\r\n{\r\n    document.write(&quot;İyi akşamlar!&quot;);\r\n}\r\nelse //saat bunlardan farklı ise\r\n{\r\n    document.write(&quot;İyi geceler!&quot;);\r\n}\r\n\r\nSayfam.html:\r\n\r\n&lt;html&gt;\r\n &lt;body&gt;\r\n  &lt;p&gt;Sayın ziyaretçi, &lt;script src=&quot;Karsilama.js&quot; type=&quot;text/javascript&quot;&gt;&lt;/script&gt;&lt;/p&gt; &lt;!--javascript dosyamızı burada çağırıyoruz--&gt;\r\n &lt;/body&gt;\r\n&lt;/html&gt;', '01:02 26.03.2020', 'admin', 1),
(115, 'PHP PDO | Veritabanı bağlantısı', '&lt;?php\r\ntry {\r\n	$db = new PDO(&quot;mysql:host=localhost;dbname=veritabanıadı;charset=utf8;&quot;, &quot;kullanıcıadı&quot;, &quot;şifre&quot;);\r\n	echo &quot;bağlantı başarılı&quot;;\r\n} catch (PDOException $error) {\r\n	echo &quot;bağlantı başarısız: $error&quot;;\r\n}\r\n?&gt;', '15:02 29.04.2020', 'admin', 1),
(113, 'CSS | RGB box animasyonu', '.box {\r\n  animation: boxrgb 6s infinite;\r\n  background-color: #1a1a1a;\r\n}\r\n\r\n@keyframes boxrgb {\r\n  0%   {box-shadow: 0px 0px 15px red;color: red;}\r\n  20%  {box-shadow: 0px 0px 15px yellow;color: yellow;}\r\n  40%  {box-shadow: 0px 0px 15px purple;color: purple;}\r\n  60%  {box-shadow: 0px 0px 15px blue;color: blue;}\r\n  80%  {box-shadow: 0px 0px 15px green;color: green;}\r\n  100% {box-shadow: 0px 0px 15px red;color: red;}\r\n}', '21:03 04.04.2020', 'admin', 1),
(114, 'CSS | RGB text animasyonu', '.text {\r\n  animation: rgb 6s infinite;\r\n}\r\n\r\n@keyframes rgb {\r\n  0%   {text-shadow: 0px 0px 15px red;color: red;}\r\n  20%  {text-shadow: 0px 0px 15px yellow;color: yellow;}\r\n  40%  {text-shadow: 0px 0px 15px purple;color: purple;}\r\n  60%  {text-shadow: 0px 0px 15px blue;color: blue;}\r\n  80%  {text-shadow: 0px 0px 15px green;color: green;}\r\n  100% {text-shadow: 0px 0px 15px red;color: red;}\r\n}', '21:03 04.04.2020', 'admin', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hcaptcha`
--

CREATE TABLE `hcaptcha` (
  `hcaptcha` int(1) NOT NULL,
  `hcaptcha_sitekey` varchar(50) NOT NULL,
  `hcaptcha_secretkey` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `hcaptcha`
--

INSERT INTO `hcaptcha` (`hcaptcha`, `hcaptcha_sitekey`, `hcaptcha_secretkey`) VALUES
(1, '111', '111');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `setting`
--

CREATE TABLE `setting` (
  `n0m_setting` int(1) NOT NULL,
  `n0m_userreg` int(1) NOT NULL,
  `n0m_guard` int(1) NOT NULL,
  `n0m_maintenance` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `setting`
--

INSERT INTO `setting` (`n0m_setting`, `n0m_userreg`, `n0m_guard`, `n0m_maintenance`) VALUES
(1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `user_pass` varchar(70) COLLATE utf8_turkish_ci NOT NULL,
  `user_mail` varchar(65) COLLATE utf8_turkish_ci NOT NULL,
  `user_yetki` varchar(5) COLLATE utf8_turkish_ci NOT NULL,
  `user_picture` varchar(400) COLLATE utf8_turkish_ci DEFAULT NULL,
  `user_reg` varchar(16) COLLATE utf8_turkish_ci NOT NULL,
  `user_notes` varchar(1000) COLLATE utf8_turkish_ci DEFAULT NULL,
  `user_secret` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_pass`, `user_mail`, `user_yetki`, `user_picture`, `user_reg`, `user_notes`, `user_secret`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@example.com', 'admin', '', 'root', 'R6w[M]uhammet', 6834233929117984),
(42, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user@example.com', 'user', 'http://localhost:10019/theme/dox/images/usern0m.png', '18:38 07.03.2020', '', 953645274698142);
--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ann`
--
ALTER TABLE `ann`
  ADD PRIMARY KEY (`duyuru_id`);

--
-- Tablo için indeksler `code`
--
ALTER TABLE `code`
  ADD PRIMARY KEY (`code_id`);

--
-- Tablo için indeksler `hcaptcha`
--
ALTER TABLE `hcaptcha`
  ADD PRIMARY KEY (`hcaptcha`);

--
-- Tablo için indeksler `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`n0m_setting`);

--
-- Tablo için indeksler `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `ann`
--
ALTER TABLE `ann`
  MODIFY `duyuru_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Tablo için AUTO_INCREMENT değeri `code`
--
ALTER TABLE `code`
  MODIFY `code_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- Tablo için AUTO_INCREMENT değeri `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE `n0mlog` (
  `log_id` int(11) NOT NULL,
  `log_status` tinyint(1) NOT NULL,
  `log_hcaptcha` tinyint(1) NOT NULL,
  `log_ip` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `log_uname` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `log_pass` varchar(70) COLLATE utf8_turkish_ci NOT NULL,
  `log_web` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `log_time` varchar(16) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

ALTER TABLE `n0mlog`
  ADD PRIMARY KEY (`log_id`);


ALTER TABLE `n0mlog`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
COMMIT;