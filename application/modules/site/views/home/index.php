<?php
$rfaqs = $this->db->order_by(COL_TIMESTAMP,'desc')->get(TBL__FAQS)->result_array();
$rcontact = $this->db->get(TBL_MCONTACT)->result_array();

$rprofile1 = $this->db->where(COL_CONTENTID, 'TxtPopup1')->where(COL_CONTENTDESC2." != ", null)->get(TBL__HOMEPAGE)->result_array();
$rprofile2 = $this->db->where(COL_CONTENTTITLE, 'Sambutan')->where(COL_CONTENTDESC1." != ", null)->get(TBL__HOMEPAGE)->row_array();
$rslider = $this->db->where(COL_CONTENTID, 'Carousel')->get(TBL__HOMEPAGE)->result_array();
$rnum = $this->db->where(COL_CONTENTID, 'NumProfile')->where(COL_CONTENTDESC2." != ", null)->get(TBL__HOMEPAGE)->result_array();
$rmedia1 = $this->db->where(COL_CONTENTID, 'Media1')->where(COL_CONTENTDESC2." != ", null)->get(TBL__HOMEPAGE)->result_array();
$rmedia2 = $this->db->where(COL_CONTENTID, 'Media2')->where(COL_CONTENTDESC2." != ", null)->get(TBL__HOMEPAGE)->result_array();
?>
<section class="hero-section d-flex justify-content-center align-items-center" style="background-image: url('<?=MY_IMAGEURL.'img-bg-hero.png'?>')">
  <div class="section-overlay" style="opacity: 0.50 !important"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-12 mb-5 mb-lg-0">
        <div class="hero-section-text mt-5">
          <!--<h6 class="text-white">Selamat Datang</h6>-->
          <h3 class="hero-title text-white mt-4 mb-4"><?=nl2br($this->setting_web_desc)?></h3>
        </div>
      </div>
      <?php
      if(!empty($rslider)) {
        ?>
        <div class="col-lg-6 col-12">
          <div class="owl-carousel owl-theme carousel-hero">
            <?php
            foreach ($rslider as $r) {
              if(file_exists(MY_UPLOADPATH.$r[COL_CONTENTDESC2])) {
                ?>
                <div class="item item-hero" style="background-image: url('<?=MY_UPLOADURL.$r[COL_CONTENTDESC2]?>'); background-size: cover; background-position: center; border-radius: 2%"></div>
                <?php
              }
            }
            ?>
          </div>
        </div>
        <?php
      }
      ?>

    </div>
  </div>
</section>
<section class="about-section section-padding">
  <div class="container">
    <div class="row">
      <?php
      if(!empty($rmedia1) && isset($rmedia1[1])) {
        ?>
        <div class="col-lg-4 col-12">
          <div class="about-image-wrap custom-border-radius-start">
            <img src="<?=MY_UPLOADURL.$rmedia1[1][COL_CONTENTDESC2]?>" class="about-image custom-border-radius-start img-fluid" alt="">
            <?php
            if(!empty($rmedia1[1][COL_CONTENTDESC1])) {
              ?>
              <div class="about-info" style="border-top: 15px solid var(--custom-btn-bg-color) !important; border-radius: 15px !important; padding: 15px !important">
                <h6 class="text-white mb-0 me-2" style="font-size: 12pt"><?=$rmedia1[1][COL_CONTENTDESC1]?></h6>
                <p class="text-white mb-0" style="font-size: 12pt"><?=$rmedia1[1][COL_CONTENTDESC3]?></p>
              </div>
              <?php
            }
            ?>
          </div>
        </div>
        <?php
      }
      ?>
      <div class="col-lg-8 col-12" style="min-height: 440px !important">
        <div class="custom-text-block custom-border-radius-end text-white">
          <h2 class="text-white mb-3">Sambutan</h2>
          <?=!empty($rprofile2)?$rprofile2[COL_CONTENTDESC1]:'-'?>
        </div>
      </div>
  </div>
</div>
</section>
<?php
if(!empty($rnum)) {
  ?>
  <section class="cta-section mt-5" style="background-image: url('<?=MY_IMAGEURL.'img-bg-overlay2.png'?>') !important">
    <div class="section-overlay" style="background: var(--border-color) !important"></div>
    <div class="container">
      <div class="row justify-content-center align-items-center">
        <?php
        foreach($rnum as $r) {
          if(!empty($r[COL_CONTENTDESC1])) {
            ?>
            <div class="col-lg-2 col-md-2 col-6">
              <div class="categories-block">
                <a href="#" class="d-flex flex-column justify-content-center align-items-center h-100">
                  <h3 class="text-white mb-0"><i class="far fa-analytics"></i></h3>
                  <p class="categories-block-title fw-bold mb-0"><?=$r[COL_CONTENTDESC3].' '.$r[COL_CONTENTDESC4]?></p>
                  <small class="categories-block-title"><?=$r[COL_CONTENTDESC1]?></small>
                </a>
              </div>
            </div>
            <?php
          }
        }
        ?>

      </div>
    </div>
  </section>
  <?php
}
?>

<section class="job-section recent-jobs-section section-padding">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 col-12 mb-4">
        <h4>Artikel / Berita Terkini</h4>
        <p>Berita terkini seputar kegiatan <?=$this->setting_org_name?>.</p>
      </div>
      <div class="clearfix"></div>
      <?php
      foreach($berita as $b) {
        $strippedcontent = strip_tags($b[COL_POSTCONTENT]);
        $tags = explode(",",$b[COL_POSTMETATAGS]);
        $img = $this->db->where(COL_ISTHUMBNAIL,1)->where(COL_POSTID, $b[COL_POSTID])->get(TBL__POSTIMAGES)->row_array();
        ?>
        <div class="col-lg-4 col-md-6 col-12">
          <div class="job-thumb job-thumb-box">
            <div
            class="job-image-box-wrap div-thumbnail"
            data-thumbnail="<?=!empty($img)?MY_UPLOADURL.$img[COL_IMGPATH]:MY_IMAGEURL.'img-bg-post.png'?>"
            style="
              height: 250px;
              width: 100%;
              background-image: url('<?=MY_IMAGEURL.'img-bg-post.png'?>');
              background-size: cover;
              background-repeat: no-repeat;
              background-position: center;
            ">
              <div class="job-image-box-wrap-info d-flex align-items-center">
                <?php
                if(!empty($tags)) {
                  ?>
                  <p class="mb-0">
                    <?php
                    $ct = 0;
                    foreach($tags as $t) {
                      if($ct>2) break;
                      ?>
                      <span class="badge badge-level"><?=(strlen($t) > 10 ? substr(strtoupper($t), 0, 10) . "..." : strtoupper($t))?></span>
                      <?php
                      $ct++;
                    }
                    ?>
                  </p>
                  <?php
                }
                ?>
              </div>
            </div>
            <div class="job-body" style="min-height: 320px; max-height: 320px">
              <h5 class="job-title">
                <a href="<?=site_url('site/home/page/'.$b[COL_POSTSLUG])?>" class="job-title-link"><?=strlen($b[COL_POSTTITLE]) > 60 ? substr($b[COL_POSTTITLE], 0, 60) . "..." : $b[COL_POSTTITLE] ?></a>
              </h5>
              <div class="d-flex align-items-center">
                <p class="job-location"><i class="custom-icon far fa-user-circle"></i>&nbsp;&nbsp;<?=$b[COL_NAME]?></p>
                <p class="job-date"><i class="custom-icon far fa-calendar"></i>&nbsp;&nbsp;<?=date('d-m-Y', strtotime($b[COL_POSTDATE]))?></p>
              </div>
              <div class="border-top pt-3">
                <p class="job-price"><?=strlen($strippedcontent) > 150 ? substr($strippedcontent, 0, 150) . "..." : $strippedcontent ?></p>
              </div>
            </div>
          </div>
        </div>
        <?php
      }
      ?>
      <div class="col-lg-12 col-12 recent-jobs-bottom d-flex ms-auto my-4">
        <a href="<?=site_url('site/home/post/2')?>" class="custom-btn btn ms-lg-auto" style="font-size: 14pt; padding: 15px 25px">Lihat Selengkapnya <i class="far fa-arrow-right"></i></a>
      </div>
    </div>
  </div>
</section>
<section class="reviews-section section-padding">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-12 col-12">
        <h2 class="text-center mb-5">Kontak</h2>
      </div>
      <div class="col-lg-6 col-12 mb-lg-5 mb-3">
        <?=GetSetting('SETTING_LINK_GOOGLEMAP')?>
      </div>
      <div class="col-lg-5 col-12 mb-3 mx-auto">
        <div class="reviews-thumb" style="padding: 20px !important">
          <div class="contact-info d-flex align-items-center mb-3">
            <i class="custom-icon bi-building"></i>
            <p class="mb-0">
              <span class="contact-info-small-title">Alamat</span>
              <?=GetSetting('SETTING_ORG_ADDRESS')?>
            </p>
          </div>
          <div class="contact-info d-flex align-items-center">
            <i class="custom-icon bi-whatsapp"></i>
            <p class="mb-0">
              <span class="contact-info-small-title">No. Telepon / Pengaduan</span>
              <a href="tel:<?=GetSetting('SETTING_LINK_WHATSAPP')?>" class="site-footer-link" target="_blank"><?=GetSetting('SETTING_ORG_PHONE')?></a>
            </p>
          </div>
          <div class="contact-info d-flex align-items-center">
            <i class="custom-icon bi-envelope"></i>
            <p class="mb-0">
              <span class="contact-info-small-title">Email</span>
              <a href="mailto:<?=GetSetting('SETTING_ORG_MAIL')?>" class="site-footer-link"><?=GetSetting('SETTING_ORG_MAIL')?></a>
            </p>
          </div>
          <?php
          foreach($rcontact as $r) {
            if(empty($r[COL_CONTACTTEXT])) continue;
            ?>
            <div class="contact-info d-flex align-items-center">
              <i class="custom-icon <?=$r[COL_CONTACTICON]?>"></i>
              <p class="mb-0">
                <span class="contact-info-small-title"><?=$r[COL_CONTACTLABEL]?></span>
                <a href="<?=$r[COL_CONTACTURL]?>" class="site-footer-link" target="_blank"><?=$r[COL_CONTACTTEXT]?></a>
              </p>
            </div>
            <?php
          }
          ?>

        </div>
      </div>
    </div>
  </div>
</section>
<div class="modal fade" id="modalPopup" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pengumuman</h5>
      </div>
      <div class="modal-body p-0">
        <?php
        if(!empty($rprofile1) && file_exists(MY_UPLOADPATH.$rprofile1[0][COL_CONTENTDESC2])) {
          ?>
          <img src="<?=MY_UPLOADURL.$rprofile1[0][COL_CONTENTDESC2]?>" style="width: 100%" />
          <?php
        }
        ?>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$('.carousel-hero').owlCarousel({
  loop:true,
  margin:10,
  /*nav:true,*/
  items: 1
});
$(window).load(function(){
  var elthumb = $('.div-thumbnail');

  for(var i=0; i<=elthumb.length; i++) {
    var thumb = $(elthumb[i]).data('thumbnail');
    $(elthumb[i]).css("background-image", "url('"+thumb+"')");
  }

  <?php
  if(!empty($rprofile1)) {
    ?>
    $('#modalPopup').modal('show');
    <?php
  }
  ?>
});
</script>
