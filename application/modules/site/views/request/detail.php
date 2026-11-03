<?php
$rlog = $this->db
->where(COL_REQID, $res[COL_UNIQ])
->order_by(COL_CREATEDON, 'desc')
->get(TBL_TREQUEST_LOG)
->result_array();
?>
<div class="title-group mb-3">
  <h6 class="mb-4">
    <?=$title?>
    <a href="<?=site_url('site/request/index')?>" class="btn custom-btn custom-btn-bg-white" style="float: right"><i class="far fa-arrow-circle-left"></i>&nbsp;KEMBALI</a>
  </h6>
</div>
<div class="row my-4">
  <div class="col-lg-5 col-12">
    <div class="custom-block custom-block-transations bg-white mb-0">
      <h6 class="mb-4" style="font-weight: var(--font-weight-light)"><?=$res[COL_IZINNAMA]?></h6>
      <div class="d-flex flex-wrap align-items-center mb-4">
        <div class="d-flex align-items-center">
          <div><p>Pemohon</p></div>
        </div>
        <div class="ms-auto">
          <small><?=$res[COL_NAME]?></small>
        </div>
      </div>
      <div class="d-flex flex-wrap align-items-center mb-4">
        <div class="d-flex align-items-center">
          <div><p>Email</p></div>
        </div>
        <div class="ms-auto">
          <small><?=$res[COL_EMAIL]?></small>
        </div>
      </div>
      <div class="d-flex flex-wrap align-items-center mb-4">
        <div class="d-flex align-items-center">
          <div><p>Status</p></div>
        </div>
        <div class="ms-auto">
          <small>
            <?php
            $_bg = 'secondary';
            if($res[COL_REQSTATUS]=='PROSES') $_bg = 'primary';
            else if($res[COL_REQSTATUS]=='SELESAI') $_bg = 'success';
            ?>
            <span class="badge text-bg-<?=$_bg?>"><?=$res[COL_REQSTATUS]?></span>
          </small>
        </div>
      </div>
      <div class="d-flex flex-wrap align-items-center mb-4">
        <div class="d-flex align-items-center">
          <div><p>Dibuat Pada</p></div>
        </div>
        <div class="ms-auto">
          <small><?=date('Y/m/d H:i',strtotime($res[COL_CREATEDON]))?></small>
        </div>
      </div>
      <div class="mb-4 pt-3 border-top">
        <p>Catatan</p>
        <p>
          <small><?=$res[COL_REQREMARKS]?></small>
        </p>
      </div>
      <?php
      if(!empty($res[COL_REQFILE3]) && file_exists(MY_UPLOADPATH.'request/'.$res[COL_REQFILE3])) {
        ?>
        <div class="border-top pt-4 mt-4 text-center border-top">
          <a class="btn custom-btn" href="<?=MY_UPLOADURL.'request/'.$res[COL_REQFILE3]?>" target="_blank"><i class="far fa-download"></i> DOWNLOAD</a>
        </div>
        <?php
      }
      ?>
    </div>
  </div>
  <div class="col-lg-7 col-12">
    <div class="custom-block custom-block-transations bg-white mb-0">
      <h6 class="mb-4" style="font-weight: var(--font-weight-light)">Riwayat</h6>
      <div class="table-responsive">
        <table class="table account-table">
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
                    <span class="badge text-bg-<?=$_bg?>"><?=$r[COL_REQSTATUS]?></span>
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
</div>
