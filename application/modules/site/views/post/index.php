<?php $data = array();
$i = 0;
foreach ($res as $d) {
  $numLogs = $this->db->where(COL_URL, site_url('site/home/page/'.$d[COL_POSTSLUG]))->count_all_results(TBL__LOGS);
  $res[$i] = array(
    '<input type="checkbox" class="cekbox" name="cekbox[]" value="' . $d[COL_POSTID] . '" />',
    //$d[COL_POSTCATEGORYNAME],
    $d[COL_ISSUSPEND] ? '<small class="badge pull-left badge-danger">UNPUBLISHED</small>' : '<small class="badge pull-left badge-success">PUBLISHED</small>',
    date('Y-m-d', strtotime($d[COL_POSTDATE])),
    anchor('site/post/edit/'.$d[COL_POSTID],$d[COL_POSTTITLE]),
    number_format($numLogs),
    '<a href="'.site_url('site/home/page/'.$d[COL_POSTSLUG]).'" target="_blank" class="btn btn-primary btn-xs"><i class="far fa-external-link"></i></a>',

  );
  $i++;
}
$data = json_encode($res);
$user = GetLoggedUser();
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h3 class="m-0 text-dark font-weight-light"><?=strtoupper($title)?>&nbsp;<small class="font-weight-light text-sm"><?=$catname?></small></h3>
      </div>
      <div class="col-sm-6 text-right">
        <p class="mb-0">
          <?=anchor('site/post/delete','<i class="far fa-trash"></i> HAPUS',array('class'=>'cekboxaction btn btn-danger btn-sm','confirm'=>'Apa anda yakin?'))?>
          <?=anchor('site/post/add'.(!empty($cat)?'/'.$cat:''),'<i class="far fa-plus"></i> TAMBAH',array('class'=>'btn btn-primary btn-sm'))?>
          <?php if($user[COL_ROLEID] == ROLEADMIN) { ?>
              <?=anchor('site/post/activate','<i class="far fa-check"></i> AKTIFKAN',array('class'=>'cekboxaction btn btn-success btn-sm','confirm'=>'Apa anda yakin?'))?>
              <?=anchor('site/post/activate/1','<i class="far fa-warning"></i> SUSPEND',array('class'=>'cekboxaction btn btn-secondary btn-sm','confirm'=>'Apa anda yakin?'))?>
          <?php } ?>
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
          <div class="card-body">
            <form id="dataform" method="post" action="#">
                <table id="datalist" class="table table-bordered table-hover"></table>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript">
$(document).ready(function() {
    var dataTable = $('#datalist').dataTable({
      "autoWidth":false,
      //"sDom": "Rlfrtip",
      "aaData": <?=$data?>,
      //"bJQueryUI": true,
      //"aaSorting" : [[5,'desc']],
      "scrollY" : '48vh',
      "iDisplayLength": 100,
      "aLengthMenu": [[100, 1000, 5000, -1], [100, 1000, 5000, "Semua"]],
      "order": [[ 2, "desc" ]],
      "columnDefs": [
        {"targets":[0,1,2], "className":'nowrap'},
        {"targets":[2,4], "className":'nowrap dt-body-right'}
      ],
      "aoColumns": [
          {"sTitle": "<input type=\"checkbox\" id=\"cekbox\" class=\"\" />","width":"10px","bSortable":false},
          //{"sTitle": "KATEGORI"},
          {"sTitle": "STATUS","sWidth":"10px","bSortable":false},
          {"sTitle": "TANGGAL","sWidth":"10px"},
          {"sTitle": "JUDUL"},
          {"sTitle": "JLH. VIEW","sWidth":"10px","bSortable":false},
          {"sTitle": "#","sWidth":"10px","bSortable":false}
      ]
    });
    $('#cekbox').click(function(){
        if($(this).is(':checked')){
            $('.cekbox').prop('checked',true);
        }else{
            $('.cekbox').prop('checked',false);
        }
    });
});
</script>
