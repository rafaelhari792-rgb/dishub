<?php
$rprofile = $this->db
->where(COL_CONTENTID, 'Profil')
->where(COL_CONTENTTITLE, ucwords(str_replace("-"," ",$slug)))
->get(TBL__HOMEPAGE)
->row_array();
if(empty($rprofile)) {
  redirect(site_url());
}
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
        <h2 class="text-white"><?=$rprofile[COL_CONTENTTITLE]?></h2>
      </div>
    </div>
  </div>
</header>
<section class="reviews-section section-padding">
  <div class="container">
    <div class="row">
      <div class="col-12 mb-4">
        <h4 class="mb-0"><?=$rprofile[COL_CONTENTTITLE]?></h4>
        <p class="mb-0"><?=$this->setting_org_name?></p>
      </div>
      <div class="col-12 mb-2">
        <div class="reviews-thumb" style="padding: 20px !important">
          <?php
          if(!empty($rprofile[COL_CONTENTDESC1])) {
            ?>
            <p><?=$rprofile[COL_CONTENTDESC1]?></p>
            <?php
          }
          ?>
          <img src="<?=MY_UPLOADURL.$rprofile[COL_CONTENTDESC2]?>" width="100%" />
        </div>
      </div>
    </div>
  </div>
</section>
