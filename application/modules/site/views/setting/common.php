<?php
$ruser = GetLoggedUser();
$rcontact = $this->db->get(TBL_MCONTACT)->result_array();
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h3 class="m-0 text-dark font-weight-light">PENGATURAN <small class="font-weight-light text-sm">Umum</small></h3>
      </div>
    </div>
  </div>
</div>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <div class="card card-outline card-navy">
          <div class="card-header">
            <h5 class="card-title">WEBSITE & PROFIL ORGANISASI</h5>
          </div>
          <?=form_open_multipart(site_url('site/setting/change'), array('role'=>'form','id'=>'form-setting-web','class'=>'form-horizontal'))?>
          <div class="card-body">
            <div class="form-group">
              <div class="row">
                <div class="col-sm-8">
                  <label>Judul Website</label>
                  <input type="text" class="form-control" name="SETTING_WEB_NAME" value="<?=GetSetting('SETTING_WEB_NAME')?>" required <?=$ruser[COL_ROLEID]==ROLEADMIN?'':'disabled'?> />
                </div>
                <div class="col-sm-4">
                  <label>Versi</label>
                  <input type="text" class="form-control" name="SETTING_WEB_VERSION" value="<?=GetSetting('SETTING_WEB_VERSION')?>" required <?=$ruser[COL_ROLEID]==ROLEADMIN?'':'disabled'?> />
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Deskripsi / Sub Judul</label>
              <textarea class="form-control" name="SETTING_WEB_DESC" required <?=$ruser[COL_ROLEID]==ROLEADMIN?'':'disabled'?>><?=GetSetting('SETTING_WEB_DESC')?></textarea>
            </div>
            <div class="form-group">
              <label>Nama Organisasi</label>
              <input type="text" class="form-control" name="SETTING_ORG_NAME" value="<?=GetSetting('SETTING_ORG_NAME')?>" required <?=$ruser[COL_ROLEID]==ROLEADMIN?'':'disabled'?> />
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <textarea class="form-control" name="SETTING_ORG_ADDRESS" required  <?=$ruser[COL_ROLEID]==ROLEADMIN?'':'disabled'?>><?=GetSetting('SETTING_ORG_ADDRESS')?></textarea>
            </div>
            <div class="form-group">
              <label class="d-flex justify-content-between">Google Maps <small class="font-italic"><a href="https://tutorial.idwebhost.com/cara-mendapatkan-kode-embed-google-maps/" target="_blank"><i class="far fa-info-circle"></i> Panduan Kode Embed Google Maps</a></small></label>
              <textarea class="form-control" name="SETTING_LINK_GOOGLEMAP" rows="4" required  <?=$ruser[COL_ROLEID]==ROLEADMIN?'':'disabled'?>><?=GetSetting('SETTING_LINK_GOOGLEMAP')?></textarea>
            </div>
          </div>
          <?php
          if($ruser[COL_ROLEID]==ROLEADMIN) {
            ?>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary pull-right">SIMPAN&nbsp;<i class="far fa-arrow-circle-right"></i></button>
            </div>
            <?php
          }
          ?>
          <?=form_close()?>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card card-outline card-navy">
          <div class="card-header">
            <h5 class="card-title">KONTAK & SOSIAL MEDIA</h5>
          </div>
          <?=form_open_multipart(site_url('site/setting/change'), array('role'=>'form','id'=>'form-setting-contact','class'=>'form-horizontal'))?>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Telepon</label>
                  <input type="text" class="form-control" name="SETTING_ORG_PHONE" value="<?=GetSetting('SETTING_ORG_PHONE')?>" required <?=$ruser[COL_ROLEID]==ROLEADMIN?'':'disabled'?> placeholder="Telepon" />
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Fax</label>
                  <input type="text" class="form-control" name="SETTING_ORG_FAX" value="<?=GetSetting('SETTING_ORG_FAX')?>" required <?=$ruser[COL_ROLEID]==ROLEADMIN?'':'disabled'?> placeholder="Fax" />
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Email</label>
                  <input type="text" class="form-control" name="SETTING_ORG_MAIL" value="<?=GetSetting('SETTING_ORG_MAIL')?>" required <?=$ruser[COL_ROLEID]==ROLEADMIN?'':'disabled'?> placeholder="Email" />
                </div>
              </div>
              <?php
              foreach($rcontact as $r) {
                ?>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label><?=$r[COL_CONTACTLABEL]?></label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="CONTACTTEXT_<?=$r[COL_UNIQ]?>" value="<?=$r[COL_CONTACTTEXT]?>" <?=$ruser[COL_ROLEID]==ROLEADMIN?'':'disabled'?> placeholder="<?=$r[COL_CONTACTLABEL]?>" />
                      <input type="hidden" name="CONTACTLINK_<?=$r[COL_UNIQ]?>" value="<?=$r[COL_CONTACTURL]?>" />
                      <span class="input-group-append">
                        <button type="button" class="btn btn-outline-primary btn-link" data-target="CONTACTLINK_<?=$r[COL_UNIQ]?>"><i class="far fa-link"></i></button>
                      </span>
                    </div>
                  </div>
                </div>
                <?php
              }
              ?>
            </div>
          </div>
          <?php
          if($ruser[COL_ROLEID]==ROLEADMIN) {
            ?>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary pull-right">SIMPAN&nbsp;<i class="far fa-arrow-circle-right"></i></button>
            </div>
            <?php
          }
          ?>
          <?=form_close()?>
        </div>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript">
$(document).ready(function(){
  $('#form-setting-web').validate({
    submitHandler: function(form) {
      var btnSubmit = $('button[type=submit]', form);
      var txtSubmit = btnSubmit.innerHTML;
      btnSubmit.html('<i class="fad fa-circle-notch fa-spin"></i>');
      btnSubmit.attr('disabled', true);

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

  $('#form-setting-contact').validate({
    submitHandler: function(form) {
      var btnSubmit = $('button[type=submit]', form);
      var txtSubmit = btnSubmit.innerHTML;
      btnSubmit.html('<i class="fad fa-circle-notch fa-spin"></i>');
      btnSubmit.attr('disabled', true);

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

  $('.btn-link').click(function(){
    var target = $(this).data('target');
    var currval = $('[name='+target+']').val();
    swal({
      closeOnClickOutside: true,
      buttons: ['BATAL','SUBMIT'],
      text: 'LINK / URL',
      content: {
        element: "input",
        attributes: {
          placeholder: 'URL',
          type: "text",
          value: currval
        }
      },
    }).then(function(input){
      if(input) {
        $('[name='+target+']').val(input);
      }
    });

    return false;
  });
});
</script>
