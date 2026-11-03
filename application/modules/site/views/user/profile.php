<?php
$ruser = GetLoggedUser();
?>
<div class="title-group mb-3">
  <h6 class="mb-4">
    <?=$title?>
  </h6>
  <div class="row my-4">
    <div class="col-lg-8 col-12">
      <div class="custom-block bg-white">
        <form id="form-main" class="form-horizontal custom-form" action="<?=current_url()?>" method="post" role="form">
          <div class="form-group mb-3">
            <div class="row">
              <label class="col-md-4 col-12 pt-2 pb-2 control-label text-end">Nama</label>
              <div class="col-md-8 col-12">
                <input class="form-control mb-0" name="<?=COL_NAME?>" value="<?=$ruser[COL_NAME]?>" type="text" placeholder="Nama" />
              </div>
            </div>
          </div>
          <div class="form-group mb-3">
            <div class="row">
              <label class="col-md-4 col-12 pt-2 pb-2 control-label text-end">Email</label>
              <div class="col-md-8 col-12">
                <input class="form-control mb-0" name="<?=COL_EMAIL?>" value="<?=$ruser[COL_EMAIL]?>" type="text" placeholder="Email Pemohon" readonly />
              </div>
            </div>
          </div>
          <div class="form-group mb-3">
            <div class="row">
              <label class="col-md-4 col-12 pt-2 pb-2 control-label text-end">No. Identitas</label>
              <div class="col-md-8 col-12">
                <input class="form-control mb-0" name="<?=COL_IDENTITYNO?>" value="<?=$ruser[COL_IDENTITYNO]?>" type="text" placeholder="NIK" />
              </div>
            </div>
          </div>
          <div class="form-group mb-3">
            <div class="row">
              <label class="col-md-4 col-12 pt-2 pb-2 control-label text-end">No. Kontak / HP</label>
              <div class="col-md-8 col-12">
                <input class="form-control mb-0" name="<?=COL_PHONENO?>" value="<?=$ruser[COL_PHONENO]?>" type="text" placeholder="No. Kontak / HP" />
              </div>
            </div>
          </div>
          <div class="form-group mb-3">
            <div class="row">
              <label class="col-md-4 col-12 pt-2 pb-2 control-label text-end">Password</label>
              <div class="col-md-8 col-12">
                <input class="form-control mb-0" name="<?=COL_PASSWORD?>" type="password" placeholder="Password" />
              </div>
            </div>
          </div>
          <div class="form-group mb-3">
            <div class="row">
              <label class="col-md-4 col-12 pt-2 pb-2 control-label text-end">Ulangi Password</label>
              <div class="col-md-8 col-12">
                <input class="form-control mb-0" name="ConfirmPassword" type="password" placeholder="Ulangi Password" />
              </div>
            </div>
          </div>
          <div class="d-flex border-top pt-3">
            <button type="button" class="form-control me-3" onclick="(function(){location.href='<?=site_url('site/request/add')?>'})(); return false;"><i class="far fa-arrow-circle-left"></i>&nbsp;KEMBALI</button>
            <button type="submit" class="form-control ms-2">SUBMIT&nbsp;<i class="far fa-arrow-circle-right"></i></button>
          </div>
        </form>
      </div>
    </div>
    <div class="col-lg-4 col-12">
      <div class="custom-block custom-block-contact">
        <p><strong>Catatan :</strong></p>
        <p class="mb-4"><small style="text-transform: none !important; font-style: italic">Kolom <strong>Password</strong> dan <strong>Ulangi Password</strong> hanya diisi jika anda ingin mengubah password anda.</small></p>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
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
              setTimeout(function(){
                location.reload();
              }, 3000);

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
