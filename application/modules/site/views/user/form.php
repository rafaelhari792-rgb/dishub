<form id="form-user" action="<?=current_url()?>" method="post">
  <div class="form-group">
    <div class="row">
      <div class="col-sm-6">
        <label>Nama Lengkap</label>
        <input type="text" name="<?=COL_NAME?>" class="form-control" value="<?=!empty($data)?$data[COL_NAME]:''?>" required />
      </div>
      <div class="col-sm-6">
        <label>Username / Email</label>
        <input type="text" name="<?=COL_EMAIL?>" class="form-control" value="<?=!empty($data)?$data[COL_EMAIL]:''?>" required />
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="row">
      <div class="col-sm-6">
        <label>No. Identitas</label>
        <input type="text" name="<?=COL_IDENTITYNO?>" class="form-control" value="<?=!empty($data)?$data[COL_IDENTITYNO]:''?>" required />
      </div>
      <div class="col-sm-6">
        <label>No. Telp / HP</label>
        <input type="text" name="<?=COL_PHONENO?>" class="form-control" value="<?=!empty($data)?$data[COL_PHONENO]:''?>" required />
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="row">
      <div class="col-sm-6">
        <label>Kategori</label>
        <select name="<?=COL_ROLEID?>" class="form-control" style="width: 100% !important" required>
          <option value="<?=ROLEPUBLIC?>" <?=!empty($data)&&$data[COL_ROLEID]==ROLEPUBLIC?'selected':''?>>Publik</option>
          <option value="<?=ROLEADMIN?>" <?=!empty($data)&&$data[COL_ROLEID]==ROLEADMIN?'selected':''?>>Administrator</option>
        </select>
      </div>
      <div class="col-sm-6">
        <label>Password</label>
        <input type="password" name="<?=COL_PASSWORD?>" class="form-control" />
        <?=!empty($data)?'<small id="info-password" class="text-muted font-italic">Diisi hanya jika ingin mengubah password</small>':''?>
      </div>
    </div>
  </div>
  <div class="form-group text-right mt-3">
    <button type="button" class="btn btn-sm btn-outline-danger" data-dismiss="modal"><i class="far fa-times-circle"></i>&nbsp;BATAL</button>
    <button type="submit" class="btn btn-sm btn-outline-success"><i class="far fa-arrow-circle-right"></i>&nbsp;LANJUT</button>
  </div>
</form>
<script type="text/javascript">
$(document).ready(function() {
  $("select", $('#form-user')).not('.no-select2, .custom-select').select2({ width: 'resolve', theme: 'bootstrap4' });
  $('#form-user').validate({
    submitHandler: function(form) {
      var modal = $(form).closest('modal');
      if(modal) {
        var btnSubmit = $('button[type=submit]', modal);
        var txtSubmit = btnSubmit.innerHTML;
        btnSubmit.html('<i class="fad fa-circle-notch fa-spin"></i>');
        btnSubmit.attr('disabled', true);
      }

      $(form).ajaxSubmit({
        dataType: 'json',
        type : 'post',
        success: function(res) {
          if(res.error != 0) {
            toastr.error(res.error);
          } else {
            toastr.success(res.success);
            setTimeout(function(){
              location.reload();
            }, 1000);
          }
        },
        error: function() {
          toastr.error('SERVER ERROR');
        },
        complete: function() {
          btnSubmit.html(txtSubmit);
          btnSubmit.attr('disabled', false);
        }
      });
      return false;
    }
  });
});
</script>
