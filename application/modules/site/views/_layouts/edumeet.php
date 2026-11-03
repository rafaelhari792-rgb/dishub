<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="TemplateMo">
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">

  <title><?=!empty($title) ? $this->setting_web_name.' - '.$title : $this->setting_web_name?></title>
  <link href="<?=base_url()?>assets/themes/edumeet//vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?=base_url()?>assets/themes/edumeet/assets/css/fontawesome.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/fonts/fontawesome-pro/web/css/all.min.css" />
  <link rel="stylesheet" href="<?=base_url()?>assets/themes/edumeet/assets/css/templatemo-edu-meeting.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/themes/edumeet/assets/css/owl.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/themes/edumeet/assets/css/lightbox.css">
  <link rel="icon" type="image/png" href=<?=MY_IMAGEURL.'favicon.ico'?>>
  <style>
  .background-header, .header-area {
    background-color: #34495E !important
  }
  .background-header .logo, .background-header .main-nav .nav li a {
    color: #fff !important
  }
  #courses {
    background-image: url('<?=MY_IMAGEURL.'img-bg-home1.png'?>');
    background-position: center center;
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-size: cover;
    padding: 140px 0px;
  }
  .services .item {
    background: #C69749 !important;
  }
  section.contact-us .right-info, section.contact-us #contact button {
    background-color: #C69749 !important;
  }
  section.contact-us .right-info ul li span {
    font-size: 14px !important
  }
  </style>
</head>
<body>
  <div class="sub-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-sm-8">
          <div class="left-content">
            <p><?=strtoupper(GetSetting('SETTING_ORG_REGION').' - '.GetSetting('SETTING_ORG_NAME'))?></p>
          </div>
        </div>
        <div class="col-lg-4 col-sm-4">
          <div class="right-icons">
            <ul>
              <li><a href="#"><i class="fab fa-instagram"></i></a></li>
              <li><a href="#"><i class="fab fa-facebook"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <header class="header-area header-sticky">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <nav class="main-nav">
                      <a href="<?=site_url()?>" class="logo">
                        <img src="<?=MY_IMAGEURL.'img-logo-header.png'?>" style="height: 80px !important" />
                      </a>
                      <!-- ***** Menu Start ***** -->
                      <ul class="nav">
                          <li><a href="<?=site_url()?>" class="active">BERANDA</a></li>
                          <li class="has-sub">
                              <a href="javascript:void(0)">PROFIL</a>
                              <ul class="sub-menu">
                                  <li><a href="#">Struktur Organisasi</a></li>
                                  <li><a href="#">Tupoksi</a></li>
                                  <li><a href="#">Maklumat Pelayanan</a></li>
                              </ul>
                          </li>
                          <li class="has-sub">
                              <a href="javascript:void(0)">PUBLIKASI</a>
                              <ul class="sub-menu">
                                  <li><a href="<?=site_url('site/home/post/1')?>">Berita</a></li>
                                  <li><a href="<?=site_url('site/home/post/2')?>">Galeri</a></li>
                                  <li><a href="<?=site_url('site/home/post/3')?>">Dokumen</a></li>
                              </ul>
                          </li>
                          <li><a href="#">KONTAK</a></li>
                      </ul>
                      <a class='menu-trigger'>
                          <span>Menu</span>
                      </a>
                  </nav>
              </div>
          </div>
      </div>
  </header>

  <?=$content?>

  <section class="contact-us" id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 align-self-center">
          <div class="row">
            <div class="col-lg-12">
              <form id="contact" action="" method="post">
                <div class="row">
                  <div class="col-lg-12">
                    <h2>HUBUNGI KAMI</h2>
                  </div>
                  <div class="col-lg-4">
                    <fieldset>
                      <input name="name" type="text" id="name" placeholder="NAMA LENGKAP" required="">
                    </fieldset>
                  </div>
                  <div class="col-lg-4">
                    <fieldset>
                    <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*" placeholder="EMAIL" required="">
                  </fieldset>
                  </div>
                  <div class="col-lg-4">
                    <fieldset>
                      <input name="subject" type="text" id="subject" placeholder="JUDUL" required="">
                    </fieldset>
                  </div>
                  <div class="col-lg-12">
                    <fieldset>
                      <textarea name="message" type="text" class="form-control" id="message" placeholder="KETERANGAN" required=""></textarea>
                    </fieldset>
                  </div>
                  <div class="col-lg-12">
                    <fieldset>
                      <button type="submit" id="form-submit" class="button">KIRIM</button>
                    </fieldset>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="right-info">
            <p class="mb-3">
              <img src="<?=MY_IMAGEURL.'img-logo-tebingtinggi.png'?>" style="width: auto; height: 60px !important;" />&nbsp;&nbsp;
              <img src="<?=MY_IMAGEURL.'img-logo-satpolpp.png'?>" style="width: auto; height: 60px !important;" />
            </p>
            <h6 class="text-white" style="font-weight: bold; margin-bottom: 20px !important">
              <?=strtoupper($this->setting_org_name.'<br />'.GetSetting('SETTING_ORG_REGION'))?>
            </h6>
            <ul>
              <li class="d-block">
                <h6>Alamat</h6>
                <span><?=$this->setting_org_address?></span>
              </li>
              <li class="d-block">
                <h6>No. Telp / Fax</h6>
                <span><?=$this->setting_org_phone?> / <?=$this->setting_org_fax?></span>
              </li>
              <li class="d-block">
                <h6>Email</h6>
                <span><?=$this->setting_org_mail?></span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="footer">
      <p>
        &copy <?=date('Y')?> <?=$this->setting_org_name?>.<br />
        Designed by <strong>Partopi Tao</strong>
      </p>
    </div>
  </section>
  <script src="<?=base_url()?>assets/themes/edumeet/vendor/jquery/jquery.min.js"></script>
  <script src="<?=base_url()?>assets/themes/edumeet/vendor/bootstrap/js/bootstrap.min.js"></script>

  <script src="<?=base_url()?>assets/themes/edumeet/assets/js/isotope.min.js"></script>
  <script src="<?=base_url()?>assets/themes/edumeet/assets/js/owl-carousel.js"></script>
  <script src="<?=base_url()?>assets/themes/edumeet/assets/js/lightbox.js"></script>
  <script src="<?=base_url()?>assets/themes/edumeet/assets/js/tabs.js"></script>
  <script src="<?=base_url()?>assets/themes/edumeet/assets/js/video.js"></script>
  <script src="<?=base_url()?>assets/themes/edumeet/assets/js/slick-slider.js"></script>
  <script src="<?=base_url()?>assets/themes/edumeet/assets/js/custom.js"></script>
  <script>
      //according to loftblog tut
      $('.nav li:first').addClass('active');

      var showSection = function showSection(section, isAnimate) {
        var
        direction = section.replace(/#/, ''),
        reqSection = $('.section').filter('[data-section="' + direction + '"]'),
        reqSectionPos = reqSection.offset().top - 0;

        if (isAnimate) {
          $('body, html').animate({
            scrollTop: reqSectionPos },
          800);
        } else {
          $('body, html').scrollTop(reqSectionPos);
        }

      };

      var checkSection = function checkSection() {
        $('.section').each(function () {
          var
          $this = $(this),
          topEdge = $this.offset().top - 80,
          bottomEdge = topEdge + $this.height(),
          wScroll = $(window).scrollTop();
          if (topEdge < wScroll && bottomEdge > wScroll) {
            var
            currentId = $this.data('section'),
            reqLink = $('a').filter('[href*=\\#' + currentId + ']');
            reqLink.closest('li').addClass('active').
            siblings().removeClass('active');
          }
        });
      };

      $('.main-menu, .responsive-menu, .scroll-to-section').on('click', 'a', function (e) {
        e.preventDefault();
        showSection($(this).attr('href'), true);
      });

      $(window).scroll(function () {
        checkSection();
      });
  </script>
</body>
</html>
