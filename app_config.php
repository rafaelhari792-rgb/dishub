<?php
$dbpconnect = TRUE;

//MY_CONSTANT
define('MY_BASEURL', 'http://localhost/bb-dishub/');
define('MY_DBHOST', 'localhost');
define('MY_DBHOST2', 'localhost');
define('MY_DBUSER', 'root');
define('MY_DBUSER2', 'root');
define('MY_DBPASS', '');
define('MY_DBPASS2', '');
define('MY_DBNAME', 'bb_dishub');
define('MY_DBNAME2', 'bb_dishub');
define('MY_DBPCONNECT', $dbpconnect);
define('MY_ASSETPATH', './assets');
define('MY_ASSETURL', MY_BASEURL.'/assets');
define('MY_IMAGEPATH', './assets/media/image/');
define('MY_IMAGEURL', MY_ASSETURL.'/media/image/');
define('MY_UPLOADPATH', './assets/media/uploads/');
define('MY_UPLOADURL', MY_ASSETURL.'/media/uploads/');
define('MY_NOIMAGEURL', MY_ASSETURL.'/media/image/no-image.png');
define('MY_NODATAURL', MY_ASSETURL.'/media/image/no-data.png');
define('SYSTEMUSERNAME', 'admin');

define('FRONTENDURL', MY_ASSETURL.'/frontend');
define('FRONTENDPATH', './assets/frontend');
define('FRONTENDVIEWPATH', FRONTENDPATH.'/view');

define("URL_SUFFIX", ".jsp");

define("UPLOAD_ALLOWEDTYPES", "gif|jpg|jpeg|png|doc|docx|txt|pdf");

define('CONS_PTKP_PLUS', 63000000);
define('CONS_PTKP_MUL', 4000000);
define('PPH_5', 50000000);
define('GLOBAL_KD_PROV', 12);
define('GLOBAL_KD_KAB', 16);
