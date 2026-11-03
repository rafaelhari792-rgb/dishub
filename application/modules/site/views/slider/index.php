<?php $data = array();
$i = 0;
foreach ($res as $d) {
    $res[$i] = array(
        '<input type="checkbox" class="cekbox" name="cekbox[]" value="' . $d['file'] . '" />',
        anchor(MY_IMAGEURL.'slide/'.$d['file'],$d['file'],array('target'=>'_blank')),
        date('Y-m-d H:i', $d['date'])
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
                <h1 class="m-0 text-dark"><?= $title ?> <small class="font-weight-light">Data</small></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?=site_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
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
              <p>
                  <?=anchor('site/slider/delete','<i class="far fa-trash"></i> Hapus',array('class'=>'cekboxaction btn btn-danger btn-sm','data-confirm'=>'Apa anda yakin?'))?>
              </p>
              <div class="card card-default">
                <div class="card-header">
                  <?=form_open_multipart(site_url('site/slider/add'), array('role'=>'form','id'=>'main-form','class'=>'form-horizontal'))?>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fad fa-image"></i></span>
                    </div>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="userfile" accept="image/*">
                      <label class="custom-file-label" for="userfile">Pilih File</label>
                    </div>
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-danger"><i class="fad fa-upload"></i>&nbsp;&nbsp;Upload</button>
                    </div>
                  </div>
                  <?=form_close()?>
                </div>
                  <div class="card-body">
                      <form id="dataform" method="post" action="#">
                          <table id="datalist" class="table table-bordered table-hover">

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
        var dataTable = $('#datalist').dataTable({
          "autoWidth":false,
          //"sDom": "Rlfrtip",
          "aaData": <?=$data?>,
          //"bJQueryUI": true,
          //"aaSorting" : [[5,'desc']],
          "scrollY" : '40vh',
          "scrollX": "120%",
          //"iDisplayLength": 100,
          //"aLengthMenu": [[100, 1000, 5000, -1], [100, 1000, 5000, "Semua"]],
          //"dom":"R<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>",
          //"buttons": ['copyHtml5','excelHtml5','csvHtml5','pdfHtml5'],
          "order": [[ 2, "desc" ]],
          "aoColumns": [
              {"sTitle": "<input type=\"checkbox\" id=\"cekbox\" class=\"\" />","width":"10px","bSortable":false},
              {"sTitle": "File"},
              {"sTitle": "Tanggal"}
          ]
        });
        $('#cekbox').click(function(){
            if($(this).is(':checked')){
                $('.cekbox').prop('checked',true);
                console.log('clicked');
            }else{
                $('.cekbox').prop('checked',false);
            }
        });

        $('input[type=file]').on('change',function(){
          var fileName = $(this).val();
          $(this).next('.custom-file-label').html(fileName);
        });
    });
</script>
