<?php
$ruser = GetLoggedUser();
$displayname = $ruser ? $ruser[COL_NAME] : "Guest";
$displaypicture = MY_IMAGEURL.'user.jpg';
if($ruser) {
  $displaypicture = $ruser[COL_IMGFILE] ? MY_UPLOADURL.$ruser[COL_IMGFILE] : MY_IMAGEURL.'user.jpg';
}

$rrequest = $this->db
->select('trequest.*, mcert.IzinNama')
->join(TBL_MCERT,TBL_MCERT.'.'.COL_UNIQ." = ".TBL_TREQUEST.".".COL_IZINID,"inner")
->where(COL_USERNAME, $ruser[COL_USERNAME])
->where(COL_REQSTATUS, 'SELESAI')
->where(COL_REQFILE3." != ", 'NULL')
->order_by(COL_CREATEDON, 'desc')
->get(TBL_TREQUEST)
->result_array();
?>
<div class="title-group mb-3">
  <h4 class="h4 mb-0">Dashboard</h4>
  <small class="text-muted">Selamat datang, <?=$ruser[COL_NAME]?></small>
</div>
<div class="row my-4">
  <div class="col-lg-6 col-12">
    <div class="custom-block custom-block-profile-front custom-block-profile text-center">
      <div class="custom-block-profile-image-wrap mb-4">
        <img src="<?=$displaypicture?>" class="custom-block-profile-image img-fluid" alt="">
        <!--<a href="setting.html" class="bi-pencil-square custom-block-edit-icon"></a>-->
      </div>
      <p class="d-flex flex-wrap mb-2" style="text-align: left !important">
        <strong>Nama</strong>
        <span><?=$ruser[COL_NAME]?></span>
      </p>
      <p class="d-flex flex-wrap mb-2" style="text-align: left !important">
        <strong>Email</strong>
        <span><?=$ruser[COL_EMAIL]?></span>
      </p>
      <p class="d-flex flex-wrap mb-2" style="text-align: left !important">
        <strong>No. Identitas</strong>
        <span><?=$ruser[COL_IDENTITYNO]?></span>
      </p>
      <p class="d-flex flex-wrap mb-2" style="text-align: left !important">
        <strong>Kontak</strong>
        <span><?=$ruser[COL_PHONENO]?></span>
      </p>
      <div class="mt-4 text-center">
        <a class="btn custom-btn" href="<?=site_url('site/user/profile')?>"><i class="far fa-user-edit"></i>&nbsp;EDIT</a>
      </div>
    </div>
  </div>
  <div class="col-lg-6 col-12">
    <div class="custom-block custom-block-transations bg-white">
      <h6 class="mb-4">Izin Terbit</h6>
      <?php
      if(!empty($rrequest)) {
        foreach ($rrequest as $r) {
          ?>
          <div class="d-flex flex-wrap align-items-center mb-4 border-bottom pb-3">
            <div class="d-flex align-items-center">
              <div>
                <p><?=$r[COL_IZINNAMA]?></p>
                <a href="<?=MY_UPLOADURL.'request/'.$r[COL_REQFILE3]?>" class="text-success" style="font-size: .75rem !important" target="_blank"><i class="far fa-download"></i>&nbsp;DOWNLOAD</a>
              </div>
            </div>
            <div class="ms-auto">
              <small><?=date('Y/m/d', strtotime($r[COL_CREATEDON]))?></small>
              <!--<strong class="d-block text-success"><span class="me-1">-</span> INFO</strong>-->
            </div>
          </div>
          <?php
        }
      } else {
        ?>
        <div class="d-flex flex-wrap align-items-center mb-4 border-bottom pb-3">
          <p style="font-style: italic">Belum ada data tersedia.</p>
        </div>
        <?php
      }
      ?>
    </div>
  </div>
</div>
