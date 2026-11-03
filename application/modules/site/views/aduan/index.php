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
              <button type="button" class="btn btn-tool btn-refresh-data"><i class="fas fa-sync-alt"></i>&nbsp;REFRESH</button>
            </div>
          </div>
          <div class="card-body">
            <form id="dataform" method="post" action="#">
              <table id="datalist" class="table table-bordered">
                <thead>
                  <tr>
                    <th class="text-center" style="width: 10px">#</th>
                    <th>WAKTU INPUT</th>
                    <th>UPDATE TERAKHIR</th>
                    <th>NAMA</th>
                    <th>NIK</th>
                    <th>KATEGORI</th>
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
<script type="text/javascript">
$(document).ready(function() {
  var dt = $('#datalist').dataTable({
    "autoWidth" : false,
    "processing": true,
    "serverSide": true,
    "ajax": {
      "url": "<?=site_url('site/aduan/index-load'.(!empty($stat)?'/'.$stat:''))?>",
      "type": 'POST',
      "data": function(data){
        /*var dateFrom = $('[name=filterDateFrom]', $('.filtering')).val();
        var dateTo = $('[name=filterDateTo]', $('.filtering')).val();
        var idPuskesmas = $('[name=filterIdPuskesmas]', $('.filtering')).val();

        data.dateFrom = dateFrom;
        data.dateTo = dateTo;
        data.idPuskesmas = idPuskesmas;*/
        //data.filterStatus = $('[name=filterStatus]', $('.filtering')).val();
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
    "order": [[ 1, "desc" ]],
    "columnDefs": [
      {"targets":[0], "className":'nowrap text-center'},
      {"targets":[1,2], "className":'nowrap dt-body-right'}
    ],
    "columns": [
      {"orderable": false,"width": "50px"},
      {"orderable": true,"width": "50px"},
      {"orderable": true},
      {"orderable": true},
      {"orderable": true},
      {"orderable": true}
    ],
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

  $('#modal-form').on('hidden.bs.modal', function (e) {
    $('input, textarea', $('#modal-form')).val('');
    $('.label-info', $('#modal-form')).empty();
  })
});
</script>
