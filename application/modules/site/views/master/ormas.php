<?php
$rkategori = $this->db
->query('select OrgKategori from morganisasi group by OrgKategori order by OrgKategori asc')
->result_array();
?>
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
      <div class="col-sm-12">
        <div class="card card-default">
          <div class="card-header">
            <div class="card-tools text-center" style="float: none !important">
              <a href="<?=site_url('site/master/ormas-add')?>" type="button" class="btn btn-tool text-primary"><i class="fas fa-plus"></i>&nbsp;TAMBAH DATA</a>
              <button type="button" class="btn btn-tool btn-refresh-data"><i class="fas fa-sync-alt"></i>&nbsp;REFRESH</button>
            </div>
          </div>
          <div class="card-body">
            <form id="dataform" method="post" action="#">
              <table id="datalist" class="table table-bordered table-hover table-condensed">
                <thead>
                  <tr>
                    <th class="text-center" style="width: 10px">AKSI</th>
                    <th>NAMA</th>
                    <th>KATEGORI</th>
                    <th>PERIODE</th>
                    <th>NO. SK</th>
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
<div id="dom-filter-stat" class="d-none">
  <select class="form-control" name="filterStatus" style="width: 200px">
    <option value="">- SEMUA STATUS -</option>
    <option value="1">AKTIF</option>
    <option value="-1">NONAKTIF</option>
  </select>
</div>
<div id="dom-filter-kat" class="d-none">
  <select class="form-control" name="filterKategori" style="width: 400px">
    <option value="">- SEMUA KATEGORI -</option>
    <?php
    foreach($rkategori as $kat) {
      ?>
      <option value="<?=$kat[COL_ORGKATEGORI]?>"><?=$kat[COL_ORGKATEGORI]?></option>
      <?php
    }
    ?>
  </select>
</div>
<script type="text/javascript">
$(document).ready(function() {
  var dt = $('#datalist').dataTable({
    "autoWidth" : false,
    "processing": true,
    "serverSide": true,
    "ajax": {
      "url": "<?=site_url('site/master/ormas-load')?>",
      "type": 'POST',
      "data": function(data){
        data.filterStatus = $('[name=filterStatus]', $('.filtering1')).val();
        data.filterKategori = $('[name=filterKategori]', $('.filtering2')).val();
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
    "dom":"R<'row'<'col-sm-12 d-flex'f<'filtering1'><'filtering2'>>><'row'<'col-sm-12'tr>><'row'<'col-sm-4'l><'col-sm-4'i><'col-sm-4'p>><'clear'>",
    "order": [[ 1, "asc" ]],
    "columnDefs": [
      {"targets":[0], "className":'nowrap text-center'},
      {"targets":[2], "className":'nowrap'}
    ],
    "columns": [
      {"orderable": false,"width": "50px"},
      {"orderable": true},
      {"orderable": true},
      {"orderable": true},
      {"orderable": false}
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
    },
    "initComplete": function(settings, json) {
      $('input[type=search]', $('#datalist_filter')).removeClass('form-control-sm').attr('placeholder', 'Keyword');
    }
  });
  $("div.filtering1").html($('#dom-filter-stat').html()).addClass('d-inline-block ml-2');
  $("div.filtering2").html($('#dom-filter-kat').html()).addClass('d-inline-block ml-2');

  $('.btn-refresh-data').click(function() {
    dt.DataTable().ajax.reload();
  });
  $('input,select', $("div.filtering1")).change(function() {
    dt.DataTable().ajax.reload();
  });
  $('input,select', $("div.filtering2")).change(function() {
    dt.DataTable().ajax.reload();
  });
});
</script>
