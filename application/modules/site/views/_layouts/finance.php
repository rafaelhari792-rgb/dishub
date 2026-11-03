<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Partopi Tao">
  <title><?=!empty($title) ? $this->setting_web_name.' - '.$title : $this->setting_web_name?></title>

  <!--<link rel="preconnect" href="https://fonts.googleapis.com">-->
  <!--<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>-->
  <!--<link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@300;400;700&display=swap" rel="stylesheet">-->
  <link href="<?=base_url()?>assets/themes/finance/css/fonts.css" rel="stylesheet">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?=base_url()?>assets/fonts/css/font-awesome.min.css" />
  <link rel="stylesheet" href="<?=base_url()?>assets/fonts/fontawesome-pro/web/css/all.min.css" />

  <link href="<?=base_url()?>assets/themes/finance/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=base_url()?>assets/themes/finance/css/bootstrap-icons.css" rel="stylesheet">
  <link href="<?=base_url()?>assets/themes/finance/css/apexcharts.css" rel="stylesheet">
  <link href="<?=base_url()?>assets/themes/finance/css/tooplate-mini-finance.css" rel="stylesheet">

  <link rel="shortcut icon" href="<?=MY_IMAGEURL.'favicon.png'?>" type="image/x-icon" />

  <script src="<?=base_url()?>assets/themes/finance/js/jquery.min.js"></script>
  <script src="<?=base_url()?>assets/themes/finance/js/bootstrap.bundle.min.js"></script>
  <script src="<?=base_url()?>assets/themes/finance/js/apexcharts.min.js"></script>
  <script src="<?=base_url()?>assets/themes/finance/js/custom.js"></script>

  <script type="text/javascript" src="<?=base_url()?>assets/js/jquery.validate.min.js"></script>
  <script type="text/javascript" src="<?=base_url()?>assets/js/function.js"></script>
  <script type="text/javascript" src="<?=base_url()?>assets/js/jquery.form.js"></script>

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
  @media (max-width: 767px) {
    label.control-label {
      text-align: left !important;
      margin-bottom: .25rem !important
    }
    .form-control {
      margin-bottom: .25rem !important
    }
  }

  .custom-btn {
    background: var(--custom-btn-bg-hover-color);
    border: none;
    color: var(--white-color);
  }
  .custom-btn:hover {
    background: var(--custom-btn-bg-color);
    border-color: transparent;
  }
  </style>
</head>
<?php
$ruser = GetLoggedUser();
$displayname = $ruser ? $ruser[COL_NAME] : "Guest";
$displaypicture = MY_IMAGEURL.'user.jpg';
if($ruser) {
  $displaypicture = $ruser[COL_IMGFILE] ? MY_UPLOADURL.$ruser[COL_IMGFILE] : MY_IMAGEURL.'user.jpg';
}
?>
<body>
  <div class="se-pre-con"></div>
  <header class="navbar sticky-top flex-md-nowrap">
    <div class="col-md-3 col-lg-3 me-0 px-3 fs-6">
      <a href="<?=site_url()?>" class="navbar-brand">
        <img src="<?=MY_IMAGEURL.$this->setting_web_logo?>" alt="Logo" class="brand-image" style="float: none !important; max-height: 40px !important">&nbsp;
        <?=$this->setting_web_name?>
      </a>
    </div>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!--<form class="custom-form header-form ms-lg-3 ms-md-3 me-lg-auto me-md-auto order-2 order-lg-0 order-md-0" action="#" method="get" role="form">
      <input class="form-control" name="search" type="text" placeholder="Search" aria-label="Search">
    </form>-->
    <div class="navbar-nav me-lg-2">
      <div class="nav-item text-nowrap d-flex align-items-center">
        <!--<div class="dropdown ps-3">
          <a class="nav-link dropdown-toggle text-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="navbarLightDropdownMenuLink">
            <i class="bi-bell"></i>
            <span class="position-absolute start-100 translate-middle p-1 bg-danger border border-light rounded-circle"><span class="visually-hidden">Pemberitahuan</span></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-lg-end notifications-block-wrap bg-white shadow" aria-labelledby="navbarLightDropdownMenuLink">
            <small>Pemberitahuan</small>
            <li class="notifications-block pb-2 mb-2">
              <a class="dropdown-item d-flex  align-items-center" href="#">
                <div class="notifications-icon-wrap bg-success">
                  <i class="notifications-icon bi-check-circle-fill"></i>
                </div>
                <div>
                  <span>Your account has been created successfuly.</span>
                  <p>12 days ago</p>
                </div>
              </a>
            </li>
          </ul>
        </div>-->
        <div class="dropdown px-3">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="<?=$displaypicture?>" class="profile-image img-fluid" alt="">
          </a>
          <ul class="dropdown-menu bg-white shadow">
            <li>
              <div class="dropdown-menu-profile-thumb d-flex">
                <img src="<?=$displaypicture?>" class="profile-image img-fluid me-3" alt="">
                <div class="d-flex flex-column">
                  <small><?=$ruser[COL_NAME]?></small>
                  <a href="#"><?=$ruser[COL_ROLENAME]?></a>
                </div>
              </div>
            </li>
            <li class="border-top mt-3 pt-2 mx-4">
              <a class="dropdown-item ms-0 me-0" href="<?=site_url('site/user/logout')?>">
                <i class="bi-box-arrow-left me-2"></i>&nbsp;Logout
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </header>
  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-3 d-md-block sidebar collapse">
        <div class="position-sticky py-4 px-3 sidebar-sticky">
          <ul class="nav flex-column h-100">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="<?=site_url('site/user/dashboard')?>">
                <i class="far fa-home me-2"></i>&nbsp;Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=site_url('site/user/profile')?>">
                <i class="far fa-user me-2"></i>&nbsp;Profil
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=site_url('site/request/index')?>">
                <i class="far fa-archive me-2"></i>&nbsp;Permohonan Izin
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=site_url('site/user/logout')?>">
                <i class="far fa-power-off me-2"></i>&nbsp;Logout
              </a>
            </li>
            <li class="nav-item border-top mt-auto pt-2">
              <p class="copyright-text">Copyright &copy; <?=date('Y')?> <?=$this->setting_web_name?>. By: <a rel="sponsored" href="https://www.linkedin.com/in/yoelrolas/" target="_blank">Partopi Tao</a></p>
            </li>
          </ul>
        </div>
      </nav>
      <main class="main-wrapper col-md-9 ms-sm-auto py-4 col-lg-9 px-md-4 border-start">
        <?=$content?>
        <!--<footer class="site-footer">
          <div class="container">
            <div class="row">
              <div class="col-lg-12 col-12">
                  <p class="copyright-text">Copyright &copy; <?=$this->setting_web_name?> - Design: <a rel="sponsored" href="https://www.linkedin.com/in/yoelrolas/" target="_blank">Partopi Tao</a></p>
              </div>
            </div>
          </div>
        </footer>-->
      </main>
    </div>
  </div>
  <script type="text/javascript">
  $(window).load(function() {
      // Animate loader off screen
      $(".se-pre-con").fadeOut("slow");
  });
  $(document).ready(function() {
    $('a[href="<?=current_url()?>"]').addClass('active');
  });
  </script>
</body>
</html>
