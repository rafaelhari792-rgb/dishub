<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 font-weight-light"><?= $title ?> <small class="font-weight-light text-sm"> Form</small></h1>
      </div>
    </div>
  </div>
</div>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <div class="card card-outline card-danger">
          <?=form_open_multipart(current_url(), array('role'=>'form','id'=>'form-main','class'=>'form-horizontal'))?>
          <div class="card-header">
            <h5 class="card-title">Informasi Umum</h5>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label>Nama Organisasi</label>
              <input type="text" class="form-control" name="<?=COL_ORGNAMA?>" value="<?=!empty($data[COL_ORGNAMA]) ? $data[COL_ORGNAMA] : ''?>" required />
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-12 col-lg-4">
                  <label>Nama Ketua</label>
                  <input type="text" class="form-control" name="<?=COL_ORGKETUA?>" value="<?=!empty($data[COL_ORGKETUA]) ? $data[COL_ORGKETUA] : ''?>" required />
                </div>
                <div class="col-12 col-lg-4">
                  <label>Nama Sekretaris</label>
                  <input type="text" class="form-control" name="<?=COL_ORGSEKRETARIS?>" value="<?=!empty($data[COL_ORGSEKRETARIS]) ? $data[COL_ORGSEKRETARIS] : ''?>" required />
                </div>
                <div class="col-12 col-lg-4">
                  <label>Nama Bendahara</label>
                  <input type="text" class="form-control" name="<?=COL_ORGBENDAHARA?>" value="<?=!empty($data[COL_ORGBENDAHARA]) ? $data[COL_ORGBENDAHARA] : ''?>" required />
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-12 col-lg-4">
                  <label>Kategori</label>
                  <select class="form-control" name="<?=COL_ORGKATEGORI?>" style="width: 100%" required>
                    <?php
                    $opts = getEnumOrmasKategori();
                    foreach($opts as $opt) {
                      ?>
                      <option value="<?=$opt?>" <?=!empty($data)&&$data[COL_ORGKATEGORI]==$opt?'selected':''?>><?=$opt?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
                <div class="col-12 col-lg-8">
                  <label>Periode Kepengurusan</label>
                  <div class="row">
                    <div class="col-12 col-lg-6">
                      <input type="number" class="form-control" name="<?=COL_ORGPERIODEFROM?>" value="<?=!empty($data[COL_ORGPERIODEFROM]) ? $data[COL_ORGPERIODEFROM] : ''?>" placeholder="Mulai" required />
                    </div>
                    <div class="col-12 col-lg-6">
                      <input type="number" class="form-control" name="<?=COL_ORGPERIODETO?>" value="<?=!empty($data[COL_ORGPERIODETO]) ? $data[COL_ORGPERIODETO] : ''?>" placeholder="Berakhir" required />
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>No. SK Kementerian (Pusat)</label>
              <input type="text" class="form-control" name="<?=COL_ORGNOSK1?>" value="<?=!empty($data[COL_ORGNOSK1]) ? $data[COL_ORGNOSK1] : ''?>" required />
            </div>
            <div class="form-group">
              <label>No. SK Pemerintah Daerah</label>
              <input type="text" class="form-control" name="<?=COL_ORGNOSK2?>" value="<?=!empty($data[COL_ORGNOSK2]) ? $data[COL_ORGNOSK2] : ''?>" required />
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <textarea class="form-control" name="<?=COL_ORGALAMAT?>" ><?=!empty($data[COL_ORGALAMAT]) ? $data[COL_ORGALAMAT] : ''?></textarea>
            </div>
          </div>
          <div class="card-footer text-right">
            <a href="<?=site_url('site/master/ormas')?>" class="btn btn-secondary btn-sm"><i class="far fa-arrow-circle-left"></i>&nbsp;KEMBALI</a>&nbsp;
            <button type="submit" class="btn btn-primary btn-sm"><i class="far fa-check-circle"></i>&nbsp;SIMPAN</button>
          </div>
          <?=form_close()?>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card card-outline card-danger">
          <div class="card-header">
            <h5 class="card-title">Dokumen Lampiran</h5>
          </div>
          <div class="card-body">
            <p class="text-muted font-italic mb-0">Dokumen SK, AD / ART, Foto, dan lain-lain</p>
          </div>
        </div>
        <div class="card card-outline card-danger">
          <div class="card-header">
            <h5 class="card-title">Riwayat</h5>
          </div>
          <div class="card-body">
            <p class="text-muted font-italic mb-0">Riwayat perubahan data</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript">
$(document).ready(function() {
  $('#form-main').validate({
    ignore: "[type=file]",
    submitHandler: function(form) {
      var btnSubmit = $('button[type=submit]', form);
      var txtSubmit = btnSubmit.html();
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
            if(res.redirect) {
              location.href = res.redirect;
            } else {
              setTimeout(function(){
                location.reload();
              }, 1000);
            }
          }
        },
        error: function(data) {
          toastr.error('Maaf, telah terjadi kesalahan pada sistem. Silakan coba beberapa saat lagi.');
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
