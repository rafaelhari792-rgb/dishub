<header class="site-header" style="background-image: url('<?=MY_IMAGEURL.'img-bg-overlay2.png'?>') !important">
  <div class="section-overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-12 text-center">
        <h2 class="text-white"><?=$title?></h2>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item active"><?=$this->setting_org_name?></li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</header>
<section class="reviews-section section-padding">
  <div class="container">
    <div class="row justify-content-center">
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
              <span class="contact-info-small-title">Nomor Pengaduan</span>
              <a href="<?=GetSetting('SETTING_LINK_WHATSAPP')?>" class="site-footer-link" target="_blank"><?=GetSetting('SETTING_ORG_PHONE')?></a>
            </p>
          </div>
          <div class="contact-info d-flex align-items-center">
            <i class="custom-icon bi-envelope"></i>
            <p class="mb-0">
              <span class="contact-info-small-title">Email</span>
              <a href="mailto:<?=GetSetting('SETTING_ORG_MAIL')?>" class="site-footer-link"><?=GetSetting('SETTING_ORG_MAIL')?></a>
            </p>
          </div>
          <div class="contact-info d-flex align-items-center">
            <i class="custom-icon bi-facebook"></i>
            <p class="mb-0">
              <span class="contact-info-small-title">Facebook</span>
              <a href="<?=GetSetting('SETTING_LINK_FACEBOOK')?>" class="site-footer-link" target="_blank"><?=$this->setting_web_name.' '.GetSetting('SETTING_ORG_REGION')?></a>
            </p>
          </div>
          <div class="contact-info d-flex align-items-center">
            <i class="custom-icon bi-instagram"></i>
            <p class="mb-0">
              <span class="contact-info-small-title">Instagram</span>
              <a href="<?=GetSetting('SETTING_LINK_INSTAGRAM')?>" class="site-footer-link" target="_blank"><?=GetSetting('SETTING_LINK_INSTAGRAM_ACC')?></a>
            </p>
          </div>
          <div class="contact-info d-flex align-items-center">
            <i class="custom-icon bi-youtube"></i>
            <p class="mb-0">
              <span class="contact-info-small-title">YouTube</span>
              <a href="<?=GetSetting('SETTING_LINK_YOUTUBE')?>" class="site-footer-link" target="_blank"><?=$this->setting_web_name.' '.GetSetting('SETTING_ORG_REGION')?></a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
