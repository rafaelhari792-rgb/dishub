<style>
.hidden {
  display: none !important;
}
</style>
<div class="title-group mb-3">
  <h6 class="mb-4">
    <?=$title?>
  </h6>
</div>
<?php
$ruser = GetLoggedUser();
if(empty($certid)) {
  ?>
  <div class="row my-4">
    <div class="col-lg-12 col-12">
      <div class="custom-block custom-block-transations bg-white mb-0">
        <p class="mb-3" style="font-size: 11pt !important">Silakan pilih jenis izin berikut.</p>
        <form id="form-search" class="custom-form" action="#" method="get" role="form">
          <input class="form-control" name="search" type="text" placeholder="Cari" aria-label="Cari" />
        </form>
        <div style="max-height: 48vh; overflow: scroll !important">
          <?php
          foreach($mcert as $c) {
            $arrRemarks1 = !empty($c[COL_IZINREMARKS1])?explode(";",$c[COL_IZINREMARKS1]):array();
            ?>
            <div class="d-flex flex-wrap align-items-center pb-2 mb-3 border-bottom" data-group="izin" data-name="<?=strtolower($c[COL_IZINNAMA])?>">
              <div class="d-flex align-items-center">
                <div>
                  <p><?=$c[COL_IZINNAMA]?></p>
                  <small class="text-muted" style="font-style: italic; font-size: 8pt !important"><?=number_format(count($arrRemarks1))?> persyaratan</small>
                </div>
              </div>
              <div class="ms-auto">
                <a href="<?=site_url('site/request/add/'.$c[COL_UNIQ])?>" class="btn custom-btn custom-btn-bg-white">PILIH&nbsp;<i class="far fa-arrow-right"></i></a>
              </div>
            </div>
            <?php
          }
          ?>
        </div>
      </div>
    </div>
  </div>
  <?php
} else {
  $rcert = $this->db
  ->where(COL_UNIQ, $certid)
  ->get(TBL_MCERT)
  ->row_array();
  ?>
  <div class="row my-4">
    <div class="col-lg-12 col-12">
      <?php
      if(!empty($rcert)) {
        $arrRemarks1 = !empty($rcert[COL_IZINREMARKS1])?explode(";",$rcert[COL_IZINREMARKS1]):array();
        ?>
        <div class="custom-block custom-block-transations bg-white mb-0">
          <h5 class="mb-4"><?=$rcert[COL_IZINNAMA]?></h5>
          <p><strong>Persyaratan</strong></p>
          <?php
          if(!empty($arrRemarks1)) {
            ?>
            <ul>
              <?php
              foreach ($arrRemarks1 as $r) {
                ?>
                <li style="font-size: var(--menu-font-size) !important; color: var(--dark-color) !important;"><?=$r?></li>
                <?php
              }
              ?>
            </ul>
            <?php
          }
          ?>
          <?php
          if(!empty($rcert[COL_IZINREMARKS2])) {
            ?>
            <p><strong>Keterangan</strong></p>
            <div class="featured-box mt-3 mb-3" style="text-align: left; font-weight: normal"><?=$rcert[COL_IZINREMARKS2]?></div>
            <?php
          }
          ?>

          <p class="pt-3"><strong>Permohonan</strong></p>
          <form id="form-main" class="form-horizontal custom-form mt-4" action="<?=current_url()?>" method="post" role="form">
            <div class="form-group mb-3">
              <div class="row">
                <label class="col-md-3 col-12 pt-2 pb-2 control-label text-end">Nama Pemohon</label>
                <div class="col-md-6 col-12">
                  <input type="hidden" name="<?=COL_USERNAME?>" value="<?=$ruser[COL_USERNAME]?>" />
                  <input class="form-control mb-0" name="<?=COL_NAME?>" value="<?=$ruser[COL_NAME]?>" type="text" placeholder="Nama Pemohon" readonly />
                </div>
              </div>
            </div>
            <div class="form-group mb-3">
              <div class="row">
                <label class="col-md-3 col-12 pt-2 pb-2 control-label text-end">Email Pemohon</label>
                <div class="col-md-6 col-12">
                  <input class="form-control mb-0" name="<?=COL_EMAIL?>" value="<?=$ruser[COL_EMAIL]?>" type="text" placeholder="Email Pemohon" readonly />
                </div>
              </div>
            </div>
            <div class="form-group mb-3">
              <div class="row">
                <label class="col-md-3 col-12 pt-2 pb-2 control-label text-end">Lampiran</label>
                <div class="col-md-8 col-12">
                  <div class="input-group mb-0">
                    <input type="file" class="form-control mb-0" name="<?=COL_REQFILE1?>" style="background: #e9ecef" />
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group mb-4">
              <div class="row">
                <label class="col-md-3 col-12 pt-2 pb-2 control-label text-end">Catatan</label>
                <div class="col-md-8 col-12">
                  <textarea class="form-control mb-0" name="<?=COL_REQREMARKS?>" placeholder="Catatan"></textarea>
                </div>
              </div>
            </div>
            <div class="d-flex border-top pt-3">
              <button type="button" class="form-control me-3" onclick="(function(){location.href='<?=site_url('site/request/add')?>'})(); return false;"><i class="far fa-arrow-circle-left"></i>&nbsp;KEMBALI</button>
              <button type="submit" class="form-control ms-2">SUBMIT&nbsp;<i class="far fa-arrow-circle-right"></i></button>
            </div>
          </form>
        </div>
        <?php
      } else {
        ?>
        <div class="custom-block custom-block-transations bg-white mb-0">
          <h5 class="mb-4 text-center">Maaf, parameter anda tidak valid.</h5>
          <div class="border-top pt-4 mt-4 text-center">
            <a class="btn custom-btn" href="<?=site_url('site/request/add')?>"><i class="far fa-arrow-circle-left"></i>&nbsp;KEMBALI</a>
          </div>
        </div>
        <?php
      }
      ?>
    </div>
  </div>
  <?php
}
?>
<script type="text/javascript">
$(document).ready(function() {
  $('input[name=search]').on('keyup', function(){
    var val_ = $('input[name=search]').val();
    if(val_.length > 0) {
      $('div[data-group=izin]').addClass('hidden');
      $('div[data-name*="'+val_.toLowerCase()+'"]').removeClass('hidden');
    } else {
      $('div[data-group=izin]').removeClass('hidden');
    }

  });

  $('form#form-search').on('submit', function() {
    $('input[name=search]').trigger('keyup');
    return false;
  });

  $('#form-main').validate({
    ignore: "[type=file]",
    submitHandler: function(form) {
      var btnSubmit = $('button[type=submit]', $(form));
      var txtSubmit = btnSubmit[0].innerHTML;
      btnSubmit.html('<i class="far fa-circle-notch fa-spin"></i>');
      $(form).ajaxSubmit({
        dataType: 'json',
        type : 'post',
        success: function(res) {
          if(res.error != 0) {
            toastr.error(res.error);
          } else {
            toastr.success(res.success);
            if(res.redirect) {
              setTimeout(function(){
                location.href = res.redirect;
              }, 1000);
            } else {
              location.reload();
            }
          }
        },
        error: function() {
          toastr.error('SERVER ERROR');
        },
        complete: function() {
          btnSubmit.html(txtSubmit);
        }
      });

      return false;
    }
  });
});
</script>
