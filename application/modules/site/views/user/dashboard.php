<?php
$ruser = GetLoggedUser();
$numBerita = $this->db->where(COL_ISSUSPEND, 0)->where(COL_POSTCATEGORYID, 2)->count_all_results(TBL__POSTS);
$numPegawai = $this->db->where(COL_PEGISAKTIF, 1)->count_all_results(TBL_MPEGAWAI);
$numOrmas = $this->db->count_all_results(TBL_MORGANISASI);
 ?>
 <style>
 th {
   border-right-width: 1px !important;
 }
 .table thead tr:first-child td {
   border-bottom: none !important;
}
 </style>
 <div class="content-header">
   <div class="container-fluid">
     <div class="row mb-2">
       <div class="col-sm-6">
         <h3 class="m-0 text-dark font-weight-light"><?=strtoupper($title)?></h3>
       </div>
     </div>
   </div>
 </div>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-6">
        <div class="small-box bg-navy">
          <div class="inner">
            <h3><?=number_format($numBerita)?></h3>
            <p>Berita</p>
          </div>
          <div class="icon"><i class="far fa-newspaper"></i></div>
          <a href="<?=site_url('site/post/index/2')?>" class="small-box-footer">LIHAT RINCIAN <i class="far fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-gray">
          <div class="inner">
            <h3><?=number_format($numPegawai)?></h3>
            <p>Pegawai</p>
          </div>
          <div class="icon"><i class="far fa-user-tie"></i></div>
          <a href="<?=site_url('site/master/pegawai')?>" class="small-box-footer">LIHAT RINCIAN <i class="far fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!--<div class="col-lg-3 col-6">
        <div class="small-box bg-navy">
          <div class="inner">
            <h3><?=number_format($numOrmas)?></h3>
            <p>Org. Kemasyarakatan</p>
          </div>
          <div class="icon"><i class="far fa-users"></i></div>
          <a href="<?=site_url('site/master/ormas')?>" class="small-box-footer">LIHAT RINCIAN <i class="far fa-arrow-circle-right"></i></a>
        </div>
      </div>-->
      <!--<div class="col-lg-3 col-6">
        <div class="small-box bg-gray">
          <div class="inner">
            <h3>-</h3>
            <p>Partai Politik</p>
          </div>
          <div class="icon"><i class="far fa-flag"></i></div>
          <a href="<?=site_url('site/master/parpol')?>" class="small-box-footer">LIHAT RINCIAN <i class="far fa-arrow-circle-right"></i></a>
        </div>
      </div>-->
    </div>
  </div>
</section>
