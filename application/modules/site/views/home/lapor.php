<?php
$rpengaduan = $this->db
->where_in(COL_LAPORSTATUS, array('PROSES', 'SELESAI'))
->order_by(COL_UPDATEDON, 'desc')
->get(TBL_TLAPOR)
->result_array();
?>
<style>
.custom-form .form-control, .custom-form .input-group {
  border-radius: var(--border-radius-small);
}
</style>
<section class="section-padding d-flex justify-content-center align-items-center">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-12">
        <form class="custom-form hero-form" id="form-lapor" action="<?=current_url()?>" method="post" role="form">
          <h3 class="text-white mb-0">Pengaduan</h3>
          <p class="text-white">
            <small style="font-style: italic">Silakan isi formulir dibawah ini</small>
          </p>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
              <div class="input-group">
                  <span class="input-group-text"><i class="bi-person custom-icon"></i></span>
                  <input type="text" name="<?=COL_LAPORNAMA?>" class="form-control" placeholder="Nama Lengkap" required />
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
              <div class="input-group">
                  <span class="input-group-text"><i class="bi-person custom-icon"></i></span>
                  <input type="text" name="<?=COL_LAPORNIK?>" class="form-control" placeholder="NIK" required />
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
              <div class="input-group">
                  <span class="input-group-text"><i class="bi-phone custom-icon"></i></span>
                  <input type="text" name="<?=COL_LAPORHP?>" class="form-control" placeholder="Nomor Telepon / HP" required />
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
              <div class="input-group">
                  <span class="input-group-text"><i class="bi-envelope custom-icon"></i></span>
                  <input type="text" name="<?=COL_LAPOREMAIL?>" class="form-control" placeholder="Alamat Email" required />
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-12">
              <div class="input-group">
                <select class="form-select form-control" name="<?=COL_LAPORKATEGORI?>" required="required">
                  <option value="""">Kategori Pengaduan</option>
                  <option value="Kesesuaian Waktu Proses Layanan">Kesesuaian Waktu Proses Layanan</option>
                  <option value="Kualitas Hasil Output Pengaduan">Kualitas Hasil Output Pengaduan</option>
                  <option value="Kualitas Pelayanan OSS">Kualitas Pelayanan OSS</option>
                  <option value="Pelanggaran Kode Etik">Pelanggaran Kode Etik</option>
                  <option value="Prosedur Pelayanan Perizinan">Prosedur Pelayanan Perizinan</option>
                  <option value="Lainnya">Lainnya</option>
                </select>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-12">
              <div class="form-group">
                <textarea class="form-control" name="<?=COL_LAPORISI?>" placeholder="Isi Pengaduan" required="required"></textarea>
              </div>
            </div>
            <div class="col-lg-12 col-12 mt-3">
              <button type="submit" class="form-control">Kirim Pengaduan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<section class="reviews-section section-padding">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-12">
        <h4 class="text-center mb-5">Daftar Pengaduan</h4>
        <div class="owl-carousel owl-theme reviews-carousel">
          <?php
          foreach($rpengaduan as $r) {
            $txtStatus = '-';
            if($r[COL_LAPORSTATUS]=='DITERIMA') $txtStatus = '<span class="badge badge-secondary">'.$r[COL_LAPORSTATUS].'</span>';
            else if($r[COL_LAPORSTATUS]=='PROSES') $txtStatus = '<span class="badge badge-primary">'.$r[COL_LAPORSTATUS].'</span>';
            else if($r[COL_LAPORSTATUS]=='SELESAI') $txtStatus = '<span class="badge badge-success">'.$r[COL_LAPORSTATUS].'</span>';
            ?>
            <div class="reviews-thumb">
              <div class="reviews-info d-flex align-items-center">
                <img src="<?=MY_IMAGEURL.'user.jpg'?>" class="avatar-image img-fluid" alt="">
                <div class="d-flex align-items-center justify-content-between flex-wrap w-100 ms-3">
                  <p class="mb-0">
                    <strong><?=$r[COL_LAPORNAMA]?></strong>
                    <small><?=date('d-m-Y H:i', strtotime($r[COL_CREATEDON]))?></small>
                  </p>
                  <div class="reviews-icons"><?=$txtStatus?></div>
                </div>
              </div>
              <div class="reviews-body" style="padding: 10px 40px 30px 70px">
                <p class="reviews-title"><?=$r[COL_LAPORISI]?></p>
                <?php
                if(!empty($r[COL_LAPORKETERANGAN])) {
                  ?>
                  <strong>Tindak Lanjut :</strong>
                  <p style="font-style: italic"><?=$r[COL_LAPORKETERANGAN]?></p>
                  <?php
                }
                ?>
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
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.form.js"></script>
<script type="text/javascript">
$('#form-lapor').validate({
  ignore: "[type=file]",
  submitHandler: function(form) {
    var btnSubmit = $('button[type=submit]', form);
    var txtSubmit = btnSubmit.html();
    btnSubmit.html('<i class="far fa-circle-notch fa-spin"></i>');
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
            }, 3000);
          }
        }
      },
      error: function(data) {
        toastr.error('Mohon maaf, sedang terjadi kendala pada sistem kami. Silakan mencoba beberapa saat lagi.');
        btnSubmit.attr('disabled', false);
      },
      complete: function() {
        btnSubmit.html(txtSubmit);
        //btnSubmit.attr('disabled', false);
      }
    });
    return false;
  }
});
</script>
