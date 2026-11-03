<?php
$kat = '';
if(!empty($this->input->get('kat'))) {
  $kat = strtoupper(str_replace("-"," ",$this->input->get('kat')));
  $this->db->where(COL_ORGKATEGORI,$kat);
}
$res = $this->db
->order_by(COL_ORGNAMA, 'asc')
->get(TBL_MORGANISASI)
->result_array();
?>
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
        <h4 class="mb-0">DAFTAR <?=!empty($kat)?$kat:'Organisasi Kemasyarakatan'?></h4>
        <p class="mb-0"><?=$this->setting_org_name?> <br /><small style="font-style: italic">Total = <strong><?=number_format(count($res))?></strong></small></p>
      </div>
      <div class="col-12 mb-2">
        <div class="reviews-thumb" style="padding: 20px !important">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Alamat</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if(empty($res)) {
                ?>
                <tr>
                  <td colspan="2" class="font-italic text-center">Belum ada data tersedia.</td>
                </tr>
                <?php
              }
              foreach($res as $r) {
                ?>
                <tr>
                  <td style="vertical-align: middle; padding: 0.75rem !important"><?=$r[COL_ORGNAMA]?></td>
                  <td style="vertical-align: middle; padding: 0.75rem !important"><?=$r[COL_ORGALAMAT]?></td>
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
