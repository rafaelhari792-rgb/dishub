<?php
$rpegawai = $this->db
->where(COL_PEGISAKTIF, 1)
->order_by(COL_PEGNOURUT, 'asc')
->order_by(COL_PEGNAMA, 'asc')
->get(TBL_MPEGAWAI)
->result_array();
?>
<style>
td .d-sm-block {
  display: none !important;
}

@media screen and (max-width: 480px) {
  td p {
    font-size: 9pt !important;
  }
  th.d-sm-none,td.d-sm-none {
    display: none !important;
  }
  td .d-sm-block {
    display: block !important;
  }
}
</style>
<header class="site-header" style="background-image: url('<?=MY_IMAGEURL.'img-bg-overlay2.png'?>') !important">
  <div class="section-overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-12 text-center">
        <h2 class="text-white"><?=strtoupper($title)?></h2>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item active"><?=$this->setting_org_name?></li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</header>
<section class="reviews-section section-padding">
  <div class="container">
    <div class="row">
      <div class="col-12 mb-4">
        <h4 class="mb-0">Daftar Pegawai</h4>
        <p class="mb-0"><?=$this->setting_org_name?> <br /><small style="font-style: italic">Total Pegawai = <strong><?=number_format(count($rpegawai))?></strong> Orang</small></p>
      </div>
      <div class="col-12 mb-2">
        <div class="reviews-thumb" style="padding: 20px !important">
          <table class="table table-striped" style="width: 100% !important; overflow: scroll">
            <thead>
              <tr>
                <th>Nama / NIP</th>
                <th class="d-none d-sm-table-cell">Jabatan</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if(empty($rpegawai)) {
                ?>
                <tr>
                  <td colspan="2" class="font-italic text-center">Belum ada data tersedia.</td>
                </tr>
                <?php
              }
              foreach($rpegawai as $r) {
                ?>
                <tr>
                  <td style="vertical-align: middle; padding: 0.75rem !important">
                    <div class="row d-flex align-items-center ml-0 mr-0" style="flex-wrap: nowrap !important; margin: 0 !important; padding-left: 1.5rem">
                      <div style="height: 4rem; width: 4rem; background-image: url('<?=!empty($r[COL_PEGIMGPATH])&&file_exists(MY_UPLOADPATH.'pegawai/'.$r[COL_PEGIMGPATH])?MY_UPLOADURL.'pegawai/'.$r[COL_PEGIMGPATH]:MY_IMAGEURL.'user.jpg'?>'); background-size: cover; border-radius: 50%"></div>
                      <div style="max-width: 56vw; padding-left: 2rem !important">
                        <p class="mb-0" style="line-height: 1 !important">
                          <strong><?=$r[COL_PEGNAMA]?></strong>
                          <?=!empty($r[COL_PEGNIP])&&$r[COL_PEGNIP]!='-'?'<br />'.'<small>NIP. '.$r[COL_PEGNIP].'</small>':''?>
                        </p>
                        <p class="mb-0 mt-1 d-sm-block" style="line-height: 1 !important"><?=$r[COL_PEGJABATAN]?></p>
                      </div>
                    </div>
                  </td>
                  <td class="d-none d-sm-table-cell" style="vertical-align: middle; padding: 0.75rem !important"><?=$r[COL_PEGJABATAN]?></td>
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
</section>
