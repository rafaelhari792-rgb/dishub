<?php
$ruser = GetLoggedUser();
$txtStatus = '-';
if($res[COL_REQSTATUS]=='DITERIMA') $txtStatus = '<span class="badge badge-secondary">'.$res[COL_REQSTATUS].'</span>';
else if($res[COL_REQSTATUS]=='PROSES') $txtStatus = '<span class="badge badge-primary">'.$res[COL_REQSTATUS].'</span>';
else if($res[COL_REQSTATUS]=='SELESAI') $txtStatus = '<span class="badge badge-success">'.$res[COL_REQSTATUS].'</span>';

$rlog = $this->db
->where(COL_REQID, $res[COL_UNIQ])
->order_by(COL_CREATEDON, 'desc')
->get(TBL_TREQUEST_LOG)
->result_array();
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
          <li class="breadcrumb-item"><a href="<?=site_url('site/request/index/'.strtolower($res[COL_REQSTATUS]))?>">Permohonan</a></li>
          <li class="breadcrumb-item active"><?=str_pad($res[COL_UNIQ], 5, '0', STR_PAD_LEFT)?></li>
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
                <td style="vertical-align: top; width: 200px; white-space: nowrap">Jenis Izin</td>
                <td style="vertical-align: top; width: 10px; white-space: nowrap">:</td>
                <td class="font-weight-bold"><?=$res[COL_IZINNAMA]?></td>
              </tr>
              <tr>
                <td style="vertical-align: top; width: 200px; white-space: nowrap">Waktu Input</td>
                <td style="vertical-align: top; width: 10px; white-space: nowrap">:</td>
                <td class="font-weight-bold"><?=date('Y-m-d H:i', strtotime($res[COL_CREATEDON]))?></td>
              </tr>
              <tr>
                <td style="vertical-align: top; width: 200px; white-space: nowrap">Nama</td>
                <td style="vertical-align: top; width: 10px; white-space: nowrap">:</td>
                <td class="font-weight-bold"><?=$res[COL_NAME]?></td>
              </tr>
              <tr>
                <td style="vertical-align: top; width: 200px; white-space: nowrap">Email</td>
                <td style="vertical-align: top; width: 10px; white-space: nowrap">:</td>
                <td class="font-weight-bold"><?=$res[COL_EMAIL]?></td>
              </tr>
              <tr>
                <td style="vertical-align: top; width: 200px; white-space: nowrap">No. Identitas</td>
                <td style="vertical-align: top; width: 10px; white-space: nowrap">:</td>
                <td class="font-weight-bold"><?=$res[COL_IDENTITYNO]?></td>
              </tr>
              <tr>
                <td style="vertical-align: top; width: 200px; white-space: nowrap">No. Kontak / HP</td>
                <td style="vertical-align: top; width: 10px; white-space: nowrap">:</td>
                <td class="font-weight-bold"><?=$res[COL_PHONENO]?></td>
              </tr>
              <?php
              if((!empty($res[COL_REQFILE1]) && file_exists(MY_UPLOADPATH.'request/'.$res[COL_REQFILE1])) || (!empty($res[COL_REQFILE3]) && file_exists(MY_UPLOADPATH.'request/'.$res[COL_REQFILE3]))) {
                ?>
                <tr>
                  <td style="vertical-align: top; width: 200px; white-space: nowrap">Lampiran</td>
                  <td style="vertical-align: top; width: 10px; white-space: nowrap">:</td>
                  <td class="font-weight-bold">
                    <?php
                    if(!empty($res[COL_REQFILE1]) && file_exists(MY_UPLOADPATH.'request/'.$res[COL_REQFILE1])) {
                      ?>
                      <a href="<?=MY_UPLOADURL.'request/'.$res[COL_REQFILE1]?>" target="_blank" class="btn btn-xs btn-outline-primary"><i class="far fa-download"></i>&nbsp;DOWNLOAD</a>
                      <?php
                    }
                    ?>
                    <?php
                    if(!empty($res[COL_REQFILE3]) && file_exists(MY_UPLOADPATH.'request/'.$res[COL_REQFILE3])) {
                      ?>
                      <a href="<?=MY_UPLOADURL.'request/'.$res[COL_REQFILE3]?>" target="_blank" class="btn btn-xs btn-outline-success"><i class="far fa-download"></i>&nbsp;DOWNLOAD</a>
                      <?php
                    }
                    ?>
                  </td>
                </tr>
                <?php
              }
              ?>
              <?php
              if(!empty($res[COL_REQREMARKS])) {
                ?>
                <tr>
                  <td colspan="3">
                    <strong>Catatan:</strong>
                    <p class="font-italic"><?=$res[COL_REQREMARKS]?></p>
                  </td>
                </tr>
                <?php
              }
              ?>
            </table>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card card-outline card-primary">
          <div class="card-header">
            <h4 class="card-title font-weight-bold">Riwayat</h4>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-bordered mb-0">
                <thead>
                  <tr>
                    <th scope="col">Waktu</th>
                    <th scope="col">Status</th>
                    <th scope="col">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if(!empty($rlog)) {
                    foreach($rlog as $r) {
                      $_ket = '-';
                      $_bg = 'secondary';

                      if(!empty($r[COL_REQREMARKS])) {
                        $_ket = $r[COL_REQREMARKS];
                      }

                      if($r[COL_REQSTATUS]=='PROSES') $_bg = 'primary';
                      else if($r[COL_REQSTATUS]=='SELESAI') $_bg = 'success';
                      ?>
                      <tr>
                        <td scope="col"><?=date('Y/m/d H:i', strtotime($r[COL_CREATEDON]))?></td>
                        <td scope="col">
                          <span class="badge bg-<?=$_bg?>"><?=$r[COL_REQSTATUS]?></span>
                        </td>
                        <td scope="col"><?=$_ket?></td>
                      </tr>
                      <?php
                    }
                  } else {
                    ?>
                    <tr>
                      <td colspan="3" style="font-style: italic; text-align: center">Belum ada data ditemukan.</td>
                    </tr>
                    <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="card card-outline card-primary">
          <div class="card-header">
            <h4 class="card-title font-weight-bold">Tindak Lanjut</h4>
          </div>
          <div class="card-body">
            <form id="form-status" class="form-horizontal" action="<?=current_url()?>" method="post">
              <div class="form-group">
                <label>UBAH STATUS</label>
                <select class="form-control" name="<?=COL_REQSTATUS?>">
                  <option value="DITERIMA" <?=$res[COL_REQSTATUS]=='DITERIMA'?'selected':''?>>DITERIMA</option>
                  <option value="PROSES" <?=$res[COL_REQSTATUS]=='PROSES'?'selected':''?>>PROSES</option>
                  <option value="SELESAI" <?=$res[COL_REQSTATUS]=='SELESAI'?'selected':''?>>SELESAI</option>
                </select>
              </div>
              <div class="form-group">
                <label>CATATAN</label>
                <textarea class="form-control" rows="4" name="<?=COL_REQREMARKS?>" placeholder="Catatan / uraian tindak lanjut permohonan.."></textarea>
              </div>
              <div class="form-group mb-4">
                <label>LAMPIRAN</label>
                <input type="file" class="d-block" name="<?=COL_REQFILE3?>" />
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
