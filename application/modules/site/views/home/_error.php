<!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?=$this->setting_web_name.' - Error 404'?></title>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/themes/error/assets/css/style.css" />
    <link href="<?=base_url()?>assets/themes/error/assets/images/favicon.png" rel="shortcut icon" type="image/x-icon" />
</head>

<body>
    <div class="container">
        <img class="ops" src="<?=base_url()?>assets/themes/error/assets/images/404.svg" />
        <br />
        <h3>Halaman yang Anda cari tidak ditemukan.
            <br /> Bisa jadi karena URL tersebut salah atau tidak tersedia.</h3>
        <br />
        <a class="buton" href="<?=site_url()?>">Halaman Utama</a>
    </div>
</body>

</html>
