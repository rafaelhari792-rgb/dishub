<?php
$numStatToday = $this->db->where('DATE_FORMAT(Timestamp, "%Y-%m-%d")=', date('Y-m-d'))->count_all_results(TBL__LOGS);
$numStatMonthly = $this->db->where('DATE_FORMAT(Timestamp, "%Y-%m")=', date('Y-m'))->count_all_results(TBL__LOGS);
$numStatTotal = $this->db->count_all_results(TBL__LOGS);
$orgKategori = $this->db
->query('select OrgKategori from morganisasi group by OrgKategori order by OrgKategori asc')
->result_array();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="<?=isset($ogdesc)?$ogdesc:trim(preg_replace('/\s+/', ' ', $this->setting_web_desc))?>">
  <meta name="author" content="Partopi Tao">
  <meta name="keyword" content="dishub, perhubungan, batu bara, dinas perhubungan, partopi tao">
  <meta property="og:title" content="<?=isset($ogtitle)?$ogtitle:$this->setting_web_name?>" />
	<meta property="og:type" content="article" />
	<meta property="og:url" content="<?=base_url()?>" />
	<meta property="og:image" content="<?=isset($ogimg)?$ogimg:MY_IMAGEURL.'logo.png'?>" />
  <meta property="og:description" content="<?=isset($ogdesc)?$ogdesc:$this->setting_web_desc?>" />
  <!--<meta property="og:image:width" content="50" />
  <meta property="og:image:height" content="50" />-->
  <title><?=!empty($title) ? $this->setting_web_name.' - '.$title : $this->setting_web_name?></title>
  <!-- CSS FILES -->
  <link href="<?=base_url()?>assets/themes/gotto/css/fonts.css" rel="stylesheet">
  <link href="<?=base_url()?>assets/themes/gotto/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=base_url()?>assets/themes/gotto/css/bootstrap-icons.css" rel="stylesheet">
  <link href="<?=base_url()?>assets/themes/gotto/css/owl.carousel.min.css" rel="stylesheet">
  <link href="<?=base_url()?>assets/themes/gotto/css/owl.theme.default.min.css" rel="stylesheet">
  <link href="<?=base_url()?>assets/themes/gotto/css/tooplate-gotto-job.css" rel="stylesheet">
  <link rel="stylesheet" href="<?=base_url()?>assets/fonts/fontawesome-pro/web/css/all.min.css" />
  <link rel="shortcut icon" href="<?=MY_IMAGEURL.'favicon.png'?>" type="image/x-icon" />
  <script src="<?=base_url()?>assets/themes/gotto/js/jquery.min.js"></script>
  <script src="<?=base_url()?>assets/themes/gotto/js/bootstrap.min.js"></script>
  <script src="<?=base_url()?>assets/themes/gotto/js/owl.carousel.min.js"></script>

  <!-- Toastr -->
  <link rel="stylesheet" href="<?=base_url()?>assets/themes/adminlte-new/plugins/toastr/toastr.min.css">
  <script src="<?=base_url()?>assets/themes/adminlte-new/plugins/toastr/toastr.min.js"></script>
  <style>
  .se-pre-con {
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background: url('<?=base_url()?>assets/media/preloader/<?=$this->setting_web_preloader?>') center no-repeat #fff;
  }
  #bg-video {
    min-width: 100%;
    min-height: 100vh;
    max-width: 100%;
    max-height: 100vh;
    object-fit: cover;
    z-index: -1;
  }
  .hero-section {
    padding-top: 15vh;
    padding-bottom: 20vh;
  }
  @media screen and (max-width: 480px) {
    .hero-section {
      padding-top: 5vh;
      padding-bottom: 5vh;
    }
    .hero-section-text {
      padding-left: 5px;
      padding-right: 5px;
    }
  }
  .badge {
    margin: 0 !important;
  }
  .owl-item {
    padding: 15px;
  }
  .google-map {
    filter: none !important;
  }
  /*.navbar-expand-lg .navbar-nav .nav-link {
    font-weight: 400 !important;
  }*/
  .logo-slogan {
    font-size: 14px !important;
  }
  .owl-carousel .owl-item .item-hero {
    min-height: 200px !important;
  }
  .owl-carousel .owl-item {
    /*max-width: 100% !important;*/
  }
  @media screen and (min-width: 992px) {
    .owl-carousel .owl-item .item-hero {
      height: 360px !important;
    }
  }

  .text-white p {
    color: #fff !important;
  }
  </style>
</head>
<body id="top">
  <div class="se-pre-con"></div>
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="<?=site_url()?>">
        <img src="<?=MY_IMAGEURL.$this->setting_web_logo?>" class="img-fluid logo-image">
        <div class="d-flex flex-column">
          <strong class="logo-text"><?=$this->setting_web_name?></strong>
          <small class="logo-slogan"><?=GetSetting('SETTING_ORG_REGION')?></small>
        </div>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav align-items-center ms-lg-5">
          <li class="nav-item"><a class="nav-link" href="<?=site_url()?>">Beranda</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Profil</a>
            <ul class="dropdown-menu dropdown-menu-light">
              <li><a class="dropdown-item" href="<?=site_url('site/home/page/struktur-organisasi')?>">Struktur Organisasi</a></li>
              <li><a class="dropdown-item" href="<?=site_url('site/home/page/tupoksi')?>">Tupoksi</a></li>
              <li><a class="dropdown-item" href="<?=site_url('site/home/page/pegawai')?>">Pegawai</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Publikasi</a>
            <ul class="dropdown-menu dropdown-menu-light">
              <li><a class="dropdown-item" href="<?=site_url('site/home/post/2')?>">Berita</a></li>
              <li><a class="dropdown-item" href="<?=site_url('site/home/post/3')?>">Galeri</a></li>
              <li><a class="dropdown-item" href="<?=site_url('site/home/post/4')?>">Produk Hukum</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Dokumen Publik</a>
            <ul class="dropdown-menu dropdown-menu-light">
              <li><a class="dropdown-item" href="<?=site_url('site/home/page/standar-pelayanan')?>">Standar Pelayanan</a></li>
              <li><a class="dropdown-item" href="<?=site_url('site/home/page/skm')?>">Survei Kepuasan Masyarakat</a></li>
              <li><a class="dropdown-item" href="<?=site_url('site/home/page/sakip')?>">SAKIP</a></li>
            </ul>
          </li>
          <!--<li class="nav-item"><a class="nav-link" href="#">Partai Politik</a></li>-->
          <?php
          if(!empty($orgKategori)) {
            ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Ormas</a>
              <ul class="dropdown-menu dropdown-menu-light">
                <?php
                foreach($orgKategori as $kat) {
                  $slug = str_replace(" ","-",$kat[COL_ORGKATEGORI]);
                  ?>
                  <li><a class="dropdown-item" href="<?=site_url('site/home/page/ormas').'?kat='.strtolower($slug)?>"><?=$kat[COL_ORGKATEGORI]?></a></li>
                  <?php
                }
                ?>
              </ul>
            </li>
            <?php
          }
          ?>
          <!--<li class="nav-item ms-lg-auto">
            <a class="nav-link custom-btn btn" href="<?=site_url('site/user/login')?>">Login&nbsp;<i class="far fa-sign-in-alt"></i></a>
          </li>-->
        </ul>
      </div>
    </div>
  </nav>
  <main>
    <?=$content?>
  </main>
  <footer class="site-footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 col-md-5 col-12 mb-3" style="padding-right: 20px">
          <div class="d-flex align-items-start mb-4">
            <div class="d-flex flex-column">
              <strong class="logo-text"><?=$this->setting_web_name?></strong>
              <small class="logo-slogan"><?=GetSetting('SETTING_ORG_REGION')?></small>
              <p class="mb-0 small">
                <a href="https://goo.gl/maps/HQjK69rWwryNcvLd9" target="_blank" class="site-footer-link"><?=$this->setting_org_address?></a>
              </p>
              <!--<p class="mb-0 small">
                <a href="mailto:<?=$this->setting_org_mail?>" target="_blank" class="site-footer-link"><?=$this->setting_org_mail?></a>
              </p>
              <p class="mb-0 small">
                <a href="<?=GetSetting('SETTING_LINK_WHATSAPP')?>" target="_blank" class="site-footer-link"><?=$this->setting_org_phone?></a>
              </p>-->
              <p class="mt-4">
                <img src="<?=MY_IMAGEURL.'img-logo-dishub.png'?>" style="height: 40px" />&nbsp;
                <img src="<?=MY_IMAGEURL.'img-berakhlak.png'?>" style="height: 40px" />&nbsp;
                <img src="<?=MY_IMAGEURL.'img-bangga-melayani-bangsa.png'?>" style="height: 40px" />
              </p>
            </div>
          </div>

        </div>
        <div class="col-lg-3 col-md-3 col-12 ms-lg-auto">
          <h6 class="site-footer-title">Link Terkait</h6>
          <ul class="footer-menu">
            <li class="footer-menu-item"><a href="https://batubarakab.go.id/" class="footer-menu-link">Website Pemkab Batu Bara</a></li>
          </ul>
        </div>
        <div class="col-lg-4 col-md-4 col-12 mt-3 mt-lg-0">
          <h6 class="site-footer-title">Statistik Pengunjung</h6>
          <div class="newsletter-form">
            <p class="mb-0"><small>HARI INI</small><strong style="float: right !important; font-size: .875em;"><?=number_format($numStatToday)?></strong></p>
            <p class="mb-0"><small>BULAN INI</small><strong style="float: right !important; font-size: .875em;"><?=number_format($numStatMonthly)?></strong></p>
            <p class="mb-0"><small>TOTAL</small><strong style="float: right !important; font-size: .875em;"><?=number_format($numStatTotal)?></strong></p>
          </div>
        </div>
      </div>
    </div>
    <div class="site-footer-bottom">
      <div class="container">
        <div class="row">
          <div class="col-12 d-flex align-items-center">
            <p class="copyright-text">Copyright &copy; <?=$this->setting_org_name?> - Designed by <a rel="sponsored" href="https://www.linkedin.com/in/yoelrolas/" target="_blank" style="color: var(--custom-btn-bg-color)">Partopi Tao</a></p>
          </div>
          <a class="back-top-icon bi-arrow-up smoothscroll d-flex justify-content-center align-items-center" href="#top"></a>
        </div>
      </div>
    </div>
  </footer>

  <!-- JAVASCRIPT FILES -->
  <script src="<?=base_url()?>assets/themes/gotto/js/counter.js"></script>
  <script src="<?=base_url()?>assets/themes/gotto/js/custom.js"></script>
  <script type="text/javascript">
  $(window).load(function() {
      // Animate loader off screen
      $(".se-pre-con").fadeOut("slow");
  });
  </script>
</body>
</html>
