<?php
$ruser = GetLoggedUser();
$txtStatus = '-';
if($data[COL_LAPORSTATUS]=='DITERIMA') $txtStatus = '<span class="badge badge-secondary">'.$data[COL_LAPORSTATUS].'</span>';
else if($data[COL_LAPORSTATUS]=='PROSES') $txtStatus = '<span class="badge badge-primary">'.$data[COL_LAPORSTATUS].'</span>';
else if($data[COL_LAPORSTATUS]=='SELESAI') $txtStatus = '<span class="badge badge-success">'.$data[COL_LAPORSTATUS].'</span>';
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h3 class="m-0 text-dark font-weight-light"><?=strtoupper($title)?></h3>
      </div>
      <div class="col-sm-6 float-sm-right">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?=site_url()?>">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?=site_url('site/aduan/index/'.strtolower($data[COL_LAPORSTATUS]))?>">Aduan</a></li>
          <li class="breadcrumb-item active"><?=str_pad($data[COL_UNIQ], 5, '0', STR_PAD_LEFT)?></li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <div class="card card-default">
          <div class="card-header">
            <h4 class="card-title font-weight-bold">Rincian</h4>
          </div>
          <div class="card-body p-0">
            <table class="table table-striped">
              <tr>
                <td style="vertical-align: top; width: 200px; white-space: nowrap">Status</td>
                <td style="vertical-align: top; width: 10px; white-space: nowrap">:</td>
                <td><?=$txtStatus?></td>
              </tr>
              <tr>
                <td style="vertical-align: top; width: 200px; white-space: nowrap">Kategori</td>
                <td style="vertical-align: top; width: 10px; white-space: nowrap">:</td>
                <td class="font-weight-bold"><?=$data[COL_LAPORKATEGORI]?></td>
              </tr>
              <tr>
                <td style="vertical-align: top; width: 200px; white-space: nowrap">Waktu Input</td>
                <td style="vertical-align: top; width: 10px; white-space: nowrap">:</td>
                <td class="font-weight-bold"><?=date('Y-m-d H:i', strtotime($data[COL_CREATEDON]))?></td>
              </tr>
              <tr>
                <td style="vertical-align: top; width: 200px; white-space: nowrap">Nama</td>
                <td style="vertical-align: top; width: 10px; white-space: nowrap">:</td>
                <td class="font-weight-bold"><?=$data[COL_LAPORNAMA]?></td>
              </tr>
              <tr>
                <td style="vertical-align: top; width: 200px; white-space: nowrap">Nama</td>
                <td style="vertical-align: top; width: 10px; white-space: nowrap">:</td>
                <td class="font-weight-bold"><?=$data[COL_LAPORNIK]?></td>
              </tr>
              <tr>
                <td style="vertical-align: top; width: 200px; white-space: nowrap">No. Telp / HP</td>
                <td style="vertical-align: top; width: 10px; white-space: nowrap">:</td>
                <td class="font-weight-bold"><?=$data[COL_LAPORHP]?></td>
              </tr>
              <tr>
                <td style="vertical-align: top; width: 200px; white-space: nowrap">Email</td>
                <td style="vertical-align: top; width: 10px; white-space: nowrap">:</td>
                <td class="font-weight-bold"><?=$data[COL_LAPOREMAIL]?></td>
              </tr>
              <tr>
                <td colspan="3">
                  <strong>Isi Pengaduan:</strong>
                  <p class="font-italic"><?=$data[COL_LAPORISI]?></p>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card card-default">
          <div class="card-header">
            <h4 class="card-title font-weight-bold">Tindak Lanjut</h4>
          </div>
          <div class="card-body">
            <form id="form-status" class="form-horizontal" action="<?=current_url()?>" method="post">
              <div class="form-group">
                <label>UBAH STATUS</label>
                <select class="form-control" name="<?=COL_LAPORSTATUS?>">
                  <option value="DITERIMA" <?=$data[COL_LAPORSTATUS]=='DITERIMA'?'selected':''?>>DITERIMA</option>
                  <option value="PROSES" <?=$data[COL_LAPORSTATUS]=='PROSES'?'selected':''?>>PROSES</option>
                  <option value="SELESAI" <?=$data[COL_LAPORSTATUS]=='SELESAI'?'selected':''?>>SELESAI</option>
                </select>
              </div>
              <div class="form-group">
                <label>CATATAN</label>
                <textarea class="form-control" rows="4" name="<?=COL_LAPORKETERANGAN?>" placeholder="Catatan / uraian tindak lanjut pengaduan.."><?=!empty($data[COL_LAPORKETERANGAN])?$data[COL_LAPORKETERANGAN]:''?></textarea>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-block btn-primary"><i class="far fa-check-circle"></i> SUBMIT</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript">
$(document).ready(function(){
  $('#form-status').validate({
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
              }, 1000);
            }
          }
        },
        error: function(data) {
          toastr.error('Mohon maaf, sedang terjadi kendala pada sistem. Silakan mencoba beberapa saat lagi.');
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
});
</script>
