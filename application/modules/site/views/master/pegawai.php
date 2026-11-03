<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h3 class="m-0 text-dark font-weight-light"><?=strtoupper($title)?></h3>
      </div>
      <div class="col-sm-6 text-right">
        <p class="mb-0">
          <?=anchor('site/master/pegawai-add','<i class="far fa-plus-circle"></i> TAMBAH DATA',array('class'=>'btn btn-primary btn-sm btn-add'))?>
        </p>
      </div>
    </div>
  </div>
</div>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card card-default">
          <div class="card-body p-0">
            <table class="table table-striped projects">
              <thead>
                <tr>
                  <th style="width: 10px; white-space: nowrap">#</th>
                  <th style="width: 10px; white-space: nowrap">No</th>
                  <th>Nama / NIP</th>
                  <th>Jabatan</th>
                  <th style="width: 100px; white-space: nowrap">Kategori</th>
                  <th style="width: 100px; white-space: nowrap">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if(empty($res)) {
                  ?>
                  <tr>
                    <td colspan="6" class="font-italic text-center">Belum ada data tersedia.</td>
                  </tr>
                  <?php
                }
                foreach($res as $r) {
                  ?>
                  <tr>
                    <td style="width: 10px; white-space: nowrap"><a href="<?=site_url('site/master/pegawai-edit/'.$r[COL_UNIQ])?>" class="btn btn-outline-primary btn-sm btn-edit"><i class="far fa-search"></i></a>&nbsp;<a href="<?=site_url('site/master/pegawai-delete/'.$r[COL_UNIQ])?>" class="btn btn-primary btn-sm btn-delete"><i class="far fa-times-circle"></i></a></td>
                    <td class="text-right" style="width: 10px; white-space: nowrap"><?=$r[COL_PEGNOURUT]?></td>
                    <td>
                      <div class="row d-flex align-items-center">
                        <div style="height: 2.5rem; width: 2.5rem; background-image: url('<?=!empty($r[COL_PEGIMGPATH])&&file_exists(MY_UPLOADPATH.'pegawai/'.$r[COL_PEGIMGPATH])?MY_UPLOADURL.'pegawai/'.$r[COL_PEGIMGPATH]:MY_IMAGEURL.'user.jpg'?>'); background-size: cover; border-radius: 50%"></div>
                        <div class="pl-3">
                          <p class="mb-0" style="line-height: 1 !important"><strong><?=$r[COL_PEGNAMA]?></strong><br /><small>NIP. <?=!empty($r[COL_PEGNIP])?$r[COL_PEGNIP]:'-'?></small></p>
                        </div>
                      </div>
                    </td>
                    <td><?=$r[COL_PEGJABATAN]?></td>
                    <td style="width: 100px; white-space: nowrap"><?=$r[COL_PEGKATEGORI]?></td>
                    <td class="text-center" style="width: 100px; white-space: nowrap"><span class="badge badge-<?=$r[COL_PEGISAKTIF]==1?'success':'danger'?>"><?=$r[COL_PEGISAKTIF]==1?'AKTIF':'INAKTIF'?></span></td>
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
  </div>
</section>
<div class="modal fade" id="modal-form" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="modal-title">Form Pegawai</span>
      </div>
      <div class="modal-body"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="far fa-times-circle"></i>&nbsp;BATAL</button>
        <button type="submit" class="btn btn-sm btn-primary"><i class="far fa-check-circle"></i>&nbsp;SIMPAN</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
  $('button[type=submit]', $('#modal-form')).click(function(){
    var dis = $(this);
    dis.html("Loading...").attr("disabled", true);
    $('form', $('#modal-form')).ajaxSubmit({
      dataType: 'json',
      success : function(data){
        if(data.error==0) {
          location.reload();
        } else {
          toastr.error(data.error);
        }
      },
      complete: function(data) {
        dis.html('<i class="far fa-check-circle"></i>&nbsp;SIMPAN').attr("disabled", false);
      }
    });
  });
  $('.btn-add, .btn-edit').click(function() {
    var href = $(this).attr('href');
    var modal = $('#modal-form');

    $('.modal-body', modal).html('<p class="text-center">MEMUAT...</p>');
    modal.modal('show');
    $('.modal-body', modal).load(href, function(){

    });
    return false;
  });
  $('.btn-delete').click(function() {
    var url = $(this).attr('href');
    if(confirm('Apakah anda yakin?')) {
      $.get(url, function(res) {
        if(res.error != 0) {
          toastr.error(res.error);
        } else {
          toastr.success(res.success);
          location.reload();
        }
      }, "json").done(function() {

      }).fail(function() {
        toastr.error('Maaf, telah terjadi kesalahan pada sistem. Silakan coba beberapa saat lagi.');
      });
    }
    return false;
  });
});
</script>
