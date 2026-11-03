<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark"><?= $title ?> <small class="font-weight-light text-sm"> Form</small></h1>
      </div>
    </div>
  </div>
</div>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <?php
        if ($this->input->get('error') == 1) {
            ?>
          <div class="callout callout-danger">
            <span class="text-danger"><i class="fad fa-ban"></i>&nbsp;&nbsp;Data gagal disimpan, silahkan coba kembali.</span>
          </div>
          <?php
        }
        if ($this->input->get('nomatch') == 1) {
            ?>
          <div class="callout callout-danger">
            <span class="text-danger"><i class="fad fa-key"></i>&nbsp;&nbsp;Password Lama tidak sesuai.</span>
          </div>
          <?php
        }
        if ($this->input->get('success') == 1) {
            ?>
          <div class="callout callout-success">
            <span class="text-success"><i class="fad fa-check"></i>&nbsp;&nbsp;Password berhasil diganti.</span>
          </div>
          <?php
        }
        if (validation_errors()) {
            ?>
          <div class="callout callout-danger">
            <span class="text-danger"><i class="fad fa-ban"></i>&nbsp;&nbsp;<?=validation_errors()?></span>
          </div>
          <?php
        }
        if (isset($err)) {
            ?>
          <div class="callout callout-danger">
            <span class="text-danger"><i class="fad fa-ban"></i>&nbsp;&nbsp;<?=$err['code'].' : '.$err['message']?></span>
          </div>
          <?php
        }
        if (!empty($upload_errors)) {
            ?>
          <div class="callout callout-danger">
            <span class="text-danger"><?=$upload_errors?></span>
          </div>
          <?php
        }
        ?>
      </div>
      <div class="clearfix"></div>
      <div class="col-sm-12">
        <?=form_open(current_url(),array('role'=>'form', 'class'=>'form-horizontal','id'=>'changepassword'))?>
        <div class="card card-primary">
            <div class="card-body">
                <div class="form-group row">
                  <label class="control-label col-sm-4">Password Lama</label>
                  <div class="col-sm-4">
                    <div class="input-group">
                        <input type="password" class="form-control" name="OldPassword" placeholder="Old Password" required>
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fad fa-key"></i>
                            </span>
                        </div>
                    </div>
                  </div>

                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-4">Password Baru</label>
                  <div class="col-sm-4">
                    <div class="input-group">
                        <input type="password" class="form-control" name="<?=COL_PASSWORD?>" placeholder="New Password" required>
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fad fa-key text-primary"></i>
                            </span>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-4">Konfirmasi</label>
                  <div class="col-sm-4">
                    <div class="input-group">
                        <input type="password" class="form-control" name="RepeatPassword" placeholder="Repeat Password" required>
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fad fa-key text-success"></i>
                            </span>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="card-footer text-center">
              <button type="submit" class="btn btn-primary">SIMPAN <i class="far fa-arrow-circle-right"></i></button>
            </div>
        </div>
        <?=form_close()?>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript">
    $("#deviceForm").validate({
        submitHandler : function(form){
            $(form).find('btn').attr('disabled',true);
            $(form).ajaxSubmit({
                dataType: 'json',
                type : 'post',
                success : function(data){
                    $(form).find('btn').attr('disabled',false);
                    if(data.error != 0){
                        $('.errorBox').show().find('.errorMsg').html(data.error);
                    }else{
                        window.location.href = data.redirect;
                    }
                },
                error : function(a,b,c){
                    alert('Response Error');
                }
            });
            return false;
        }
    });
</script>
