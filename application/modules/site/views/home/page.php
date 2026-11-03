<?php
$rheader = $this->db
->where(COL_ISHEADER, 1)
->where(COL_POSTID, $data[COL_POSTID])
->get(TBL__POSTIMAGES)
->result_array();

$postContent = $data[COL_POSTCONTENT];
$rimg = $this->db
->where(COL_ISHEADER.' != ', 1)
->where(COL_POSTID, $data[COL_POSTID])
->get(TBL__POSTIMAGES)
->result_array();
foreach($rimg as $img) {
  if(!empty($img[COL_IMGSHORTCODE])) {
    $postContent = str_replace($img[COL_IMGSHORTCODE], '<img src="'.MY_UPLOADURL.$img[COL_IMGPATH].'" style="max-width: 100%" /><span style="margin-top: 10px !important; font-size: 10px; font-style:italic; line-height: 1.5 !important">'.$img[COL_IMGDESC].'</span>', $postContent);
  }
}

$arrTags = array();
if(!empty($data[COL_POSTMETATAGS])) {
  $arrTags = explode(",", $data[COL_POSTMETATAGS]);
}

$txtShareWA = 'Jangan lewatkan update berita dan informasi terbaru dari '.$this->setting_web_name.' | '.urlencode(current_url());

$rlainnya = $this->mpost->search(9,"",2,null,$data[COL_POSTID]);
?>
<style>
.meeting-single-item .down-content p {
  margin-bottom: 10px !important
}
</style>
<header class="site-header" style="background-image: url('<?=MY_IMAGEURL.'img-bg-hero.png'?>') !important">
  <div class="section-overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-12 text-center">
        <h2 class="text-white"><?=$data[COL_POSTCATEGORYID]!=5?$data[COL_POSTCATEGORYNAME]:$data[COL_POSTTITLE]?></h2>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="<?=site_url()?>">Beranda</a></li>
            <li class="breadcrumb-item"><a href="<?=site_url('site/home/post/'.$data[COL_POSTCATEGORYID])?>"><?=$data[COL_POSTCATEGORYNAME]?></a></li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</header>
<section class="job-section section-padding pb-0">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-10 col-md-10 mb-3">
        <h4 class="job-title mb-0"><?=$data[COL_POSTTITLE]?></h4>
        <div class="job-thumb job-thumb-detail">
          <div class="job-thumb job-thumb-detail">
            <div class="d-flex flex-wrap align-items-center border-bottom pt-lg-3 pt-2 pb-3 mb-4">
              <p class="job-location mb-0"><i class="custom-icon me-1 far fa-calendar"></i> <?=date('d-m-Y', strtotime($data[COL_POSTDATE]))?></p>
              <p class="job-price mb-0"><i class="custom-icon me-1 far fa-user"></i> <?=$data[COL_NAME]?></p>
            </div>
          </div>
          <?php
          if($data[COL_POSTCATEGORYNAME]!='SKM') {
            ?>
            <div class="row mb-2 p-1 justify-content-center">
              <?php
              foreach($rheader as $f) {
                if(strpos(mime_content_type(MY_UPLOADPATH.$f[COL_IMGPATH]), 'image') !== false) {
                  ?>
                  <div class="col-12 col-sm-6 col-md-6 d-flex align-items-stretch p-2">
                    <div href="<?=MY_UPLOADURL.$f[COL_IMGPATH]?>"
                    data-toggle="lightbox"
                    data-title="<?=$data[COL_POSTTITLE]?>"
                    data-gallery="gallery"
                    style="background: url('<?=MY_UPLOADURL.$f[COL_IMGPATH]?>');
                    background-size: cover;
                    background-repeat: no-repeat;
                    background-position: center;
                    width: 100%;
                    min-height: 300px;
                    max-height: 600px;
                    cursor: pointer;">
                    </div>
                  </div>
                  <?php
                } else {
                  ?>
                  <div class="col-12 col-sm-12 col-md-12 mb-3 d-flex align-items-stretch">
                    <!--<embed src="<?=MY_UPLOADURL.$f[COL_IMGPATH]?>" width="100%" height="600" />-->
                    <object data="<?=MY_UPLOADURL.$f[COL_IMGPATH]?>" type="application/pdf" width="100%" height="600">
                      <p>Maaf, sepertinya terjadi kendala pada perangkat / browser anda.
                      Silakan <a target="_blank" href="<?=MY_UPLOADURL.$f[COL_IMGPATH]?>">UNDUH</a> dokumen.</p>
                    </object>
                  </div>
                  <?php
                }
                ?>
              <?php
              }
              ?>
            </div>
            <?=$postContent?>
            <?php
          } else {
            ?>
            <div class="row mb-2 p-1">
              <div class="col-lg-6 col-12 mt-5 mt-lg-0">
                <?=$data[COL_POSTCONTENT]?>
              </div>
              <?php
              if(!empty($rheader)) {
                ?>
                <div class="col-lg-6 col-12 mt-5 mt-lg-0">
                  <div class="job-thumb job-thumb-detail-box bg-white shadow-lg" style="height: 80vh !important; background-image: url('<?=MY_UPLOADURL.$rheader[0][COL_IMGPATH]?>') !important; background-size: cover">
                  </div>
                </div>
                <?php
              }
              ?>

            </div>
            <?php
          }
          ?>
          <div class="d-flex justify-content-center flex-wrap mt-5 border-top pt-4">
            <div class="job-detail-share d-flex align-items-center">
              <p class="mb-0 me-lg-4 me-3">Bagikan:</p>
              <a href="https://www.facebook.com/sharer/sharer.php?u=<?=current_url()?>" class="bi-facebook"></a>
              <a href="whatsapp://send?text=<?=$txtShareWA?>" data-action="share/whatsapp/share" class="bi-whatsapp mx-3"></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="reviews-section section-padding">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-12">
        <h4 class="text-center mb-5">Berita / Artikel Lainnya</h4>
        <div class="owl-carousel owl-theme">
          <?php
          foreach($rlainnya as $b) {
            $strippedcontent = strip_tags($b[COL_POSTCONTENT]);
            $tags = explode(",",$b[COL_POSTMETATAGS]);
            $img = $this->db->where(COL_ISTHUMBNAIL,1)->where(COL_POSTID, $b[COL_POSTID])->get(TBL__POSTIMAGES)->row_array();
            ?>
            <div class="col-12">
              <div class="job-thumb job-thumb-box bg-white">
                <div
                class="job-image-box-wrap"
                style="
                  height: 250px;
                  width: 100%;
                  background-image: url('<?=!empty($img)?MY_UPLOADURL.$img[COL_IMGPATH]:MY_IMAGEURL.'no-image.png'?>');
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
        </div>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript">
$('.owl-carousel').owlCarousel({
  loop:true,
  margin:10,
  /*nav:true,*/
  items: 3,
  responsive : {
    0: {
      items : 1,
    },
    480: {
      items : 2,
    },
    768: {
      items : 3,
    }
  }
});
</script>
