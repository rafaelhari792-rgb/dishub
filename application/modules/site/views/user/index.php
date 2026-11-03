<style>
#datalist_filter {
  text-align: left !important;
  display: inline-block !important;
}
#datalist_filter label {
  font-weight: 700;
}
</style>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h3 class="m-0 text-dark font-weight-light"><?=strtoupper($title)?></h3>
      </div>
      <div class="col-sm-6 float-sm-right">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?=site_url()?>">Dashboard</a></li>
          <li class="breadcrumb-item active"><?=$title?></li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card card-default">
          <div class="card-header">
            <div class="card-tools text-center" style="float: none !important">
              <a href="<?=site_url('site/user/add')?>" type="button" class="btn btn-tool btn-add-data text-primary"><i class="fas fa-plus"></i>&nbsp;TAMBAH</a>
              <button type="button" class="btn btn-tool btn-refresh-data"><i class="fas fa-sync-alt"></i>&nbsp;REFRESH</button>
            </div>
          </div>
          <div class="card-body">
            <form id="dataform" method="post" action="#">
              <table id="datalist" class="table table-bordered table-hover table-condensed">
                <thead>
                  <tr>
                    <th class="text-center" style="width: 10px">AKSI</th>
                    <th>USERNAME / EMAIL</th>
                    <th>NAMA</th>
                    <th>NO. TELP</th>
                    <th>STATUS</th>
                    <th>WAKTU DAFTAR</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="modal fade" id="modal-user" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="modal-title">PENGGUNA</span>
      </div>
      <div class="modal-body"></div>
    </div>
  </div>
</div>
<div id="dom-filter" class="d-none">
  <select class="form-control" name="filterStatus" style="width: 200px">
    <option value="">- SEMUA -</option>
    <option value="1">AKTIF</option>
    <option value="-1">NONAKTIF</option>
  </select>
</div>
<script type="text/javascript">
$(document).ready(function() {
  var dt = $('#datalist').dataTable({
    "autoWidth" : false,
    "processing": true,
    "serverSide": true,
    "ajax": {
      "url": "<?=site_url('site/user/index-load')?>",
      "type": 'POST',
      "data": function(data){
        data.filterStatus = $('[name=filterStatus]', $('.filtering')).val();
       }
    },
    "scrollY" : '40vh',
    "scrollX": "200%",
    "iDisplayLength": 100,
    "oLanguage": {
      "sSearch": "FILTER "
    },
    //"aLengthMenu": [[100, 1000, 5000, -1], [100, 1000, 5000, "Semua"]],
    //"dom":"R<'row'<'col-sm-8 filtering'><'col-sm-4 text-right'f<'clear'>B>><'row'<'col-sm-12'tr>><'row'<'col-sm-4'l><'col-sm-4'i><'col-sm-4'p>><'clear'>",
    "dom":"R<'row'<'col-sm-12 d-flex'f<'filtering'>>><'row'<'col-sm-12'tr>><'row'<'col-sm-4'l><'col-sm-4'i><'col-sm-4'p>><'clear'>",
    "order": [[ 1, "asc" ]],
    "columnDefs": [
      {"targets":[0,4], "className":'nowrap text-center'},
      {"targets":[5], "className":'nowrap dt-body-right'}
    ],
    "columns": [
      {"orderable": false,"width": "50px"},
      {"orderable": true},
      {"orderable": true},
      {"orderable": false},
      {"orderable": false,"width": "10px"},
      {"orderable": true,"width": "10px"}
    ],
    "createdRow": function(row, data, dataIndex) {
      $('.btn-action', $(row)).click(function() {
        var url = $(this).attr('href');
        if(confirm('Apakah anda yakin?')) {
          $.get(url, function(res) {
            if(res.error != 0) {
              toastr.error(res.error);
            } else {
              toastr.success(res.success);
            }
          }, "json").done(function() {
            dt.DataTable().ajax.reload();
          }).fail(function() {
            toastr.error('SERVER ERROR');
          });
        }
        return false;
      });
      $('.btn-edit', $(row)).click(function() {
        var url = $(this).attr('href');
        var modal = $('#modal-user');

        $('.modal-body', modal).html('<p class="text-center">MEMUAT...</p>');
        modal.modal('show');
        $('.modal-body', modal).load(url, function(){

        });
        return false;
      });
      $('[data-toggle="tooltip"]', $(row)).tooltip();
    },
    "initComplete": function(settings, json) {
      $('input[type=search]', $('#datalist_filter')).removeClass('form-control-sm').attr('placeholder', 'Keyword');
    }
  });
  $("div.filtering").html($('#dom-filter').html()).addClass('d-inline-block ml-2');

  $('.btn-refresh-data').click(function() {
    dt.DataTable().ajax.reload();
  });
  $('input,select', $("div.filtering")).change(function() {
    dt.DataTable().ajax.reload();
  });

  $('.btn-add-data').click(function() {
    var href = $(this).attr('href');
    var modal = $('#modal-user');

    $('.modal-body', modal).html('<p class="text-center">MEMUAT...</p>');
    modal.modal('show');
    $('.modal-body', modal).load(href, function(){

    });
    return false;
  });
});
</script>
