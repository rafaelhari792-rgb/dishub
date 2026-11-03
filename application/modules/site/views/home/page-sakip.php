<style>
.contact-info:nth-of-type(even) {
  border-radius: var(--border-radius-medium) !important;
}
.contact-info-small-title {
  margin-bottom: 1rem !important
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
            <li class="breadcrumb-item active">Sistem Akuntabilitas Kinerja Instansi Pemerintah</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</header>
<section class="reviews-section section-padding">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <p>Belum ada data tersedia.</p>
      </div>
      <!--<div class="col-lg-5 col-12 mb-3">
        <div class="reviews-thumb" style="padding: 20px !important">
          <h6 class="text-center">Pemerintah Kota Tebing Tinggi<br /><label data-name="rpjmd-mulai">-</label> s.d <label data-name="rpjmd-akhir">-</label></h6>
          <div class="contact-info d-flex align-items-center mb-3">
            <p class="mb-0">
              <span class="contact-info-small-title">Kepala Daerah</span>
              <label data-name="rpjmd-kepala">-</label>
            </p>
          </div>
          <div class="contact-info d-flex align-items-center mb-3">
            <p class="mb-0">
              <span class="contact-info-small-title">Visi</span>
              <label data-name="rpjmd-visi">-</label>
            </p>
          </div>
          <div class="contact-info d-flex align-items-center mb-3">
            <p class="mb-0">
              <span class="contact-info-small-title">IKU</span>
              <label data-name="rpjmd-misi">-</label>
            </p>
          </div>
        </div>
      </div>
      <div class="col-lg-7 col-12 mb-3">
        <div class="reviews-thumb" style="padding: 20px !important">
          <h6 class="text-center">Rencana Strategis<br /><?=$this->setting_web_name?></h6>
          <div class="contact-info d-flex align-items-center mb-3">
            <p class="mb-0">
              <span class="contact-info-small-title">Tujuan</span>
              <label data-name="renstra-tujuan">-</label>
            </p>
          </div>
          <div class="contact-info d-flex align-items-center mb-3">
            <p class="mb-0">
              <span class="contact-info-small-title">Sasaran</span>
              <label data-name="renstra-sasaran">-</label>
            </p>
          </div>
          <div class="contact-info d-flex align-items-center mb-3">
            <p class="mb-0">
              <span class="contact-info-small-title">DPA</span>
              <label data-name="renstra-dpa">-</label>
            </p>
          </div>
          <div class="contact-info d-flex align-items-center mb-3">
            <p class="mb-0">
              <span class="contact-info-small-title">Program</span>
              <label data-name="renstra-program">-</label>
            </p>
          </div>
        </div>
      </div>-->
    </div>
  </div>
</section>
<!--<script type="text/javascript">
$(document).ready(function(){
  $.ajax({
    type: "POST",
    url: 'https://sitalakbajakun.tebingtinggikota.go.id/sakipv2/api/sakip-summary-skpd',
    data: {AuthKey: '16e3af85ce33fce1b022c1ba37fe8cd8', 'Tahun': <?=date('Y')?>},
    dataType: 'json',
    success: function(data, status, xhr){
      console.log(data);
      if(data.error) {
        alert(data.error);
        return false;
      }

      if(data.Rpjmd) {
        var htmlMisi = '';
        $('label[data-name=rpjmd-mulai]').html(data.Rpjmd.PeriodeMulai);
        $('label[data-name=rpjmd-akhir]').html(data.Rpjmd.PeriodeAkhir);
        $('label[data-name=rpjmd-kepala]').html(data.Rpjmd.KepalaDaerah1);
        $('label[data-name=rpjmd-visi]').html(data.Rpjmd.Visi);
        if(data.Rpjmd.Misi) {
          htmlMisi += '<ol style="padding-left: 1.25rem; font-size: 11pt">';
          for(var i=0; i<data.Rpjmd.Misi.length; i++) {
            //console.log(data.Rpjmd.Misi[i].IKU.length);
            if(data.Rpjmd.Misi[i].IKU.length > 0) {
              for(var n=0; n<data.Rpjmd.Misi[i].IKU.length; n++) {
                htmlMisi += '<li>'+data.Rpjmd.Misi[i].IKU[n].Uraian.toUpperCase()+'</li>';
              }
            }
          }
          htmlMisi += '</ol>';
          $('label[data-name=rpjmd-misi]').html(htmlMisi);
        }
      }

      if(data.Tujuan) {
        var htmlTujuan = '';
        if(data.Tujuan.length == 1) {
          htmlTujuan = data.Tujuan[0].Uraian;
        } else {
          htmlTujuan += '<ol style="padding-left: 1.25rem; font-size: 12pt">';
          for(var i=0; i<data.Tujuan.length; i++) {
            htmlMisi += '<li>'+data.Tujuan[i].Uraian.toUpperCase()+'</li>';
          }
          htmlTujuan += '</ol>';
        }
        $('label[data-name=renstra-tujuan]').html(htmlTujuan);
      }

      if(data.Sasaran) {
        var htmlSasaran = '';
        if(data.Sasaran.length == 1) {
          htmlSasaran = data.Sasaran[0].Uraian;
        } else {
          htmlSasaran += '<ol style="padding-left: 1.25rem; font-size: 12pt">';
          for(var i=0; i<data.Sasaran.length; i++) {
            htmlSasaran += '<li>'+data.Sasaran[i].Uraian.toUpperCase()+'</li>';
            if(data.Sasaran[i].Indikator) {
              htmlSasaran += '<ul style="padding-left: 1.25rem">';
              for(var n=0; n<data.Sasaran[i].Indikator.length; n++) {
                htmlSasaran += '<li style="font-size: 9pt">'+data.Sasaran[i].Indikator[n].Uraian+' ('+data.Sasaran[i].Indikator[n].Target+' '+data.Sasaran[i].Indikator[n].Satuan+')</li>';
              }
              htmlSasaran += '</ul>';
            }
          }
          htmlSasaran += '</ol>';
        }
        $('label[data-name=renstra-sasaran]').html(htmlSasaran);
      }

      if(data.DPA) {
        $('label[data-name=renstra-dpa]').html(data.DPA.Uraian);
      }

      if(data.Program) {
        htmlProgram = '<ul style="padding-left: 1.25rem;">';
        for(var i=0; i<data.Program.length; i++) {
          htmlProgram += '<li style="font-size: 12pt">'+data.Program[i].Uraian.toUpperCase()+'</li>';
        }
        htmlProgram += '</ul>';
        $('label[data-name=renstra-program]').html(htmlProgram);
      }
    },
    error: function(xhr, error){
      alert('API Server sitalakbajakun.tebingtinggikota.go.id mengalami gangguan / error. Silakan coba beberapa saat lagi.')
    },
  });
});
</script>-->
