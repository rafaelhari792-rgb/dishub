<div class="row my-4">
  <div class="col-lg-12 col-12">
    <div class="custom-block bg-white">
      <h6 class="mb-4">
        <?=$title?>
        <a href="<?=site_url('site/request/add')?>" class="btn custom-btn custom-btn-bg-white" style="float: right !important;"><i class="fas fa-plus"></i> Buat Permohonan</a>
      </h6>
      <div class="table-responsive mt-5">
        <table class="table account-table">
          <thead>
            <tr>
              <th scope="col">Tanggal</th>
              <th scope="col">Jenis Izin</th>
              <th scope="col">Status</th>
              <th scope="col">Keterangan</th>
              <th scope="col" style="width: 10px; white-space: nowrap">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if(!empty($res)) {
              foreach($res as $r) {
                $_ket = '-';
                $_bg = 'secondary';
                $rlog = $this->db
                ->where(COL_REQID, $r[COL_UNIQ])
                ->order_by(COL_CREATEDON, 'desc')
                ->get(TBL_TREQUEST_LOG)
                ->row_array();

                if(!empty($rlog) && !empty($rlog[COL_REQREMARKS])) {
                  $_ket = strlen($rlog[COL_REQREMARKS]) > 35 ? substr($rlog[COL_REQREMARKS], 0, 35) . "..." : $rlog[COL_REQREMARKS];
                }

                if($r[COL_REQSTATUS]=='PROSES') $_bg = 'primary';
                else if($r[COL_REQSTATUS]=='SELESAI') $_bg = 'success';
                ?>
                <tr>
                  <td scope="col"><?=date('Y/m/d', strtotime($r[COL_CREATEDON]))?></td>
                  <td scope="col"><?=$r[COL_IZINNAMA]?></td>
                  <td scope="col">
                    <span class="badge text-bg-<?=$_bg?>"><?=$r[COL_REQSTATUS]?></span>
                  </td>
                  <td scope="col"><?=$_ket?></td>
                  <td scope="col" style="width: 10px; white-space: nowrap">
                    <a href="<?=site_url('site/request/detail/'.$r[COL_UNIQ])?>" class="btn btn-sm btn-primary" style="font-size: 8pt"><i class="fas fa-search"></i> DETIL</a>&nbsp;
                    <a href="<?=!empty($r[COL_REQFILE3])&&file_exists(MY_UPLOADPATH.'request/'.$r[COL_REQFILE3])?MY_UPLOADURL.'request/'.$r[COL_REQFILE3]:'#'?>" target="_blank" class="btn btn-sm btn-success <?=empty($r[COL_REQFILE3])?'disabled':''?>" style="font-size: 8pt"><i class="fas fa-download"></i> DOWNLOAD</a>
                  </td>
                </tr>
                <?php
              }
            } else {
              ?>
              <tr>
                <td colspan="5" style="font-style: italic; text-align: center">Belum ada data ditemukan.</td>
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
