<?php
$ruser = GetLoggedUser();

 ?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark"><?=$title?></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?=site_url()?>">Home</a></li>
          <li class="breadcrumb-item active"><?=$title?></li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div id="card-data" class="card card-outline card-danger">
          <div class="card-header">
            <h2 class="card-title">Data COVID-19</h2>
            <div class="card-tools">
              <a href="<?=site_url('site/data/covid19-add')?>" class="btn btn-tool btn-add-data text-success"><i class="fas fa-plus"></i></a>
              <a href="<?=site_url('site/data/covid19-delete')?>" class="btn btn-tool cekboxaction text-danger" data-confirm="Yakin ingin menghapus?"><i class="fas fa-times"></i></a>
              <button type="button" class="btn btn-tool btn-refresh-data"><i class="fas fa-sync-alt"></i></button>
            </div>
          </div>
          <div class="card-body">
            <form id="dataform" method="post" action="#">
                <table id="datalist" class="table table-bordered table-hover" style="white-space: nowrap;">
                  <thead>
                    <tr>
                      <th rowspan="2">#</th>
                      <th rowspan="2">Tanggal</th>
                      <th rowspan="2">Oleh</th>
                      <th colspan="2">OTG</th>
                      <th colspan="2">ODP</th>
                      <th colspan="2">PDP</th>
                      <th colspan="2">Suspect</th>
                    </tr>
                    <tr>
                      <th>Dalam Pantauan</th>
                      <th>Selesai</th>
                      <th>Dalam Pantauan</th>
                      <th>Selesai</th>
                      <th>Dalam Pengawasan</th>
                      <th>Sehat</th>
                      <th>Meninggal Dunia</th>
                      <th>Sembuh</th>
                    </tr>
                  </thead>
                </table>
            </form>
          </div>
          <div class="overlay dark" style="display: none">
            <i class="fad fa-2x fa-sync-alt fa-spin"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="modal fade" id="modal-editor" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title font-weight-light">Data</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="far fa-sm fa-close"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-editor" method="post" action="#">
          <!--<div class="form-group row">
              <label class="control-label col-sm-2">Tanggal</label>
              <div class="col-sm-5">
                <input type="text" class="form-control datepicker" name="<?=COL_TANGGAL?>" required />
              </div>
          </div>-->
          <div class="form-group row">
              <label class="control-label col-sm-2 mt-4">OTG</label>
              <div class="col-sm-5">
                <p class="help-block mb-0 font-italic text-warning">Dalam Pantauan</p>
                <input type="text" class="form-control text-right uang" name="<?=COL_JLH_OTG_PANTAU?>" required />

              </div>
              <div class="col-sm-5">
                <p class="help-block mb-0 font-italic text-success">Selesai Pantauan</p>
                <input type="text" class="form-control text-right uang" name="<?=COL_JLH_OTG_SELESAI?>" required />
              </div>
          </div>
          <div class="form-group row">
              <label class="control-label col-sm-2 mt-4">ODP</label>
              <div class="col-sm-5">
                <p class="help-block mb-0 font-italic text-warning">Dalam Pantauan</p>
                <input type="text" class="form-control text-right uang" name="<?=COL_JLH_ODP_PANTAU?>" required />

              </div>
              <div class="col-sm-5">
                <p class="help-block mb-0 font-italic text-success">Selesai Pantauan</p>
                <input type="text" class="form-control text-right uang" name="<?=COL_JLH_ODP_SELESAI?>" required />
              </div>
          </div>

          <div class="form-group row">
              <label class="control-label col-sm-2 mt-4">PDP</label>
              <div class="col-sm-5">
                <p class="help-block mb-0 font-italic text-warning">Dalam Pengawasan</p>
                <input type="text" class="form-control text-right uang" name="<?=COL_JLH_PDP_PANTAU?>" required />

              </div>
              <div class="col-sm-5">
                <p class="help-block mb-0 font-italic text-success">Sehat</p>
                <input type="text" class="form-control text-right uang" name="<?=COL_JLH_PDP_SEHAT?>" required />
              </div>
          </div>
          <div class="form-group row">
              <label class="control-label col-sm-2 mt-4">Suspect</label>
              <div class="col-sm-5">
                <p class="help-block mb-0 font-italic text-danger">Meninggal Dunia</p>
                <input type="text" class="form-control text-right uang" name="<?=COL_JLH_SUSPECT_PASSED?>" required />

              </div>
              <div class="col-sm-5">
                <p class="help-block mb-0 font-italic text-success">Sembuh</p>
                <input type="text" class="form-control text-right uang" name="<?=COL_JLH_SUSPECT_RECOVERED?>" required />
              </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary btn-ok">Submit</button>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
  var dataTable = $('#datalist').dataTable({
    "autoWidth" : false,
    "processing": true,
    "serverSide": true,
    "ajax": {
      url : "<?=site_url('site/data/covid19-load')?>",
      type : 'POST'
    },
    "scrollY" : '40vh',
    "scrollX": "200%",
    "iDisplayLength": 100,
    "aLengthMenu": [[100, 1000, 5000, -1], [100, 1000, 5000, "Semua"]],
    "dom":"R<'row'<'col-sm-8'l><'col-sm-4'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>",
    "buttons": ['copyHtml5','excelHtml5','csvHtml5','pdfHtml5'],
    "order": [[ 1, "desc" ]],
    "columnDefs": [{"targets":[3,4,5,6,7,8,9,10], "className":'text-center'}],
    "columns": [
      {"orderable": false},
      null,
      {"orderable": false},
      {"orderable": false},
      {"orderable": false},
      {"orderable": false},
      {"orderable": false},
      {"orderable": false},
      {"orderable": false},
      {"orderable": false},
      {"orderable": false},
    ]
    /*"aoColumns": [
        {"sTitle": "#","width":"10px","bSortable":false},
        {"sTitle": "Tanggal"},
        {"sTitle": "Dalam Pantauan"},
        {"sTitle": "Selesai Pantauan"},
        {"sTitle": "Tanggal"},
        {"sTitle": "Tanggal"},
        {"sTitle": "Tanggal"},
        {"sTitle": "Tanggal"},
        {"sTitle": "Tanggal"},
        {"sTitle": "Tanggal"},
        {"sTitle": "Oleh"},
    ]*/
  });
  $('#cekbox').click(function(){
      if($(this).is(':checked')){
          $('.cekbox').prop('checked',true);
      }else{
          $('.cekbox').prop('checked',false);
      }
  });

  $('.btn-refresh-data', $('#card-data')).unbind().click(function() {
    $('#datalist').DataTable().ajax.reload();
  })/*.trigger('click')*/;

  $('.btn-add-data').click(function(){
    var a = $(this);
    var editor = $("#modal-editor");

    editor.modal("show");
    $(".btn-ok", editor).unbind('click').click(function() {
      var dis = $(this);
      dis.html("Loading...").attr("disabled", true);
      $('#form-editor').ajaxSubmit({
        dataType: 'json',
        url : a.attr('href'),
        success : function(data){
          if(data.error==0){
            toastr.success(data.success);
          }else{
            toastr.error(data.error);
          }
        },
        error: function(e) {
          toastr.error('Server Error.');
        },
        complete: function() {
          dis.html('Submit').attr("disabled", false);
          editor.modal("hide");
          $('#datalist').DataTable().ajax.reload();
        }
      });
    });
    return false;
  });
});
</script>
