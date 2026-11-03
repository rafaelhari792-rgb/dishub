
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title><?=!empty($title) ? $this->setting_web_name.' - '.$title : $this->setting_web_name?></title>

    <!-- Font Awesome Icons -->
    <!--<link rel="stylesheet" href="<?=base_url()?>assets/themes/adminlte-new/plugins/fontawesome-free/css/all.min.css">-->
    <link rel="stylesheet" href="<?=base_url()?>assets/fonts/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/fonts/fontawesome-pro/web/css/all.min.css" />

    <!-- Ionicons -->
    <link href="<?=base_url()?>assets/fonts/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url()?>assets/themes/adminlte-new/dist/css/adminlte.min.css">

    <!-- JQUERY -->
    <script src="<?=base_url()?>assets/themes/adminlte-new/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="<?=base_url()?>assets/themes/adminlte-new/plugins/modernizr/modernizr.js"></script>

    <!-- Upload file -->
    <!--<link href="<?=base_url()?>assets/css/uploadfile.css" rel="stylesheet" type="text/css" />-->

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?=base_url()?>assets/themes/adminlte-new/plugins/iCheck/all.css">

    <!-- Select 2 -->
    <link rel="stylesheet" href="<?=base_url()?>assets/themes/adminlte-new/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/themes/adminlte-new/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="<?=base_url()?>assets/datatable/media/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/themes/adminlte-new/plugins/datatables-bs4/css/dataTables.bootstrap4.css">

    <script type="text/javascript" src="<?=base_url()?>assets/datatable/media/js/jquery.dataTables.min.js?ver=1"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/datatable/media/js/dataTables.bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/themes/adminlte-new/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>


    <!-- datatable reorder _ buttons ext + resp + print -->
    <!--<script type="text/javascript" src="<?=base_url()?>assets/datatable/media/js/ColReorderWithResize.js"></script>-->
    <script type="text/javascript" src="<?=base_url()?>assets/datatable/ext/buttons/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/datatable/ext/buttons/buttons.bootstrap.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/datatable/ext/buttons/buttons.print.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/datatable/ext/buttons/buttons.print.min.js"></script>
    <link href="<?=base_url()?>assets/datatable/ext/buttons/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>assets/datatable/ext/responsive/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?=base_url()?>assets/datatable/ext/jszip/jszip.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/datatable/ext/pdfmake/build/pdfmake.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/datatable/ext/pdfmake/build/vfs_fonts.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/datatable/ext/responsive/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/datatable/ext/buttons/buttons.html5.min.js"></script>

    <!-- daterange picker -->
    <script src="<?=base_url()?>assets/js/moment.js"></script>
    <link rel="stylesheet" href="<?=base_url()?>assets/themes/adminlte-new/plugins/daterangepicker/daterangepicker.css">

    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="<?=base_url()?>assets/themes/adminlte-new/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">

    <!-- WYSIHTML5 -->
    <link rel="stylesheet" href="<?=base_url()?>assets/themes/adminlte-new/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- Toastr -->
    <link rel="stylesheet" href="<?=base_url()?>assets/themes/adminlte-new/plugins/toastr/toastr.min.css">
    <script src="<?=base_url()?>assets/themes/adminlte-new/plugins/toastr/toastr.min.js"></script>

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?=base_url()?>assets/themes/adminlte-new/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

    <!-- Custom CSS -->
    <!--<link href="<?=base_url()?>assets/css/my.css" rel="stylesheet" type="text/css" />-->

    <link rel="icon" type="image/png" href=<?=MY_IMAGEURL.$this->setting_web_logo?>>

    <style>
        .no-js #loader { display: none;  }
        .js #loader { display: block; position: absolute; left: 100px; top: 0; }
        .se-pre-con {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url(<?=base_url()?>assets/media/preloader/<?=$this->setting_web_preloader?>) center no-repeat #fff;
        }

        @media (max-width: 767px) {
            .sidebar-toggle {
                font-size: 3vw !important;
            }
        }

        .form-group .control-label {
            text-align: right;
            line-height: 2;
        }
        .nowrap {
          white-space: nowrap;
        }
        .va-middle {
          vertical-align: middle !important;
        }
        .border-0 td {
          border: 0!important;
        }
        td.dt-body-right {
          text-align: right !important;
        }
        .custom-file-label {
          overflow-x: hidden;
          white-space: nowrap;
          text-overflow: ellipsis;
          padding-right: 75px;
        }
    </style>
    <script>
        // Wait for window load
        function startTime() {
          /*$.get('<?=site_url('site/ajax/now')?>', function(data) {
            var res = JSON.parse(data);
            $('#datetime').html(res.Day.toUpperCase()+', '+res.Date+' '+res.Month.toUpperCase()+' '+res.Year+' <span class="text-danger">'+res.Hour+':'+res.Minute+':'+res.Second+'</span>');
          });*/
          var today = new Date();
          $('#datetime').html(moment(today).format('DD')+' '+moment(today).format('MMMM').toUpperCase().substr(0, 3)+' '+moment(today).format('Y')+' <span class="text-navy">'+moment(today).format('hh')+':'+moment(today).format('mm')+':'+moment(today).format('ss')+'</span>');
          var t = setTimeout(startTime, 1000);
        }
        $(document).ready(function() {
          startTime();
        });
        $(window).load(function() {
            // Animate loader off screen
            $(".se-pre-con").fadeOut("slow");
        });
    </script>
</head>
<body class="sidebar-mini sidebar-collapse layout-fixed">
<div class="se-pre-con"></div>
<div class="wrapper">
    <?php
    $ruser = GetLoggedUser();
    $displayname = $ruser ? $ruser[COL_NAME] : "Guest";
    $displaypicture = MY_IMAGEURL.'user.jpg';
    if($ruser) {
        $displaypicture = $ruser[COL_IMGFILE] ? MY_UPLOADURL.$ruser[COL_IMGFILE] : MY_IMAGEURL.'user.jpg';
    }
    $rpostcategory = $this->db
    ->order_by(COL_POSTCATEGORYID)
    ->get(TBL__POSTCATEGORIES)
    ->result_array();
    ?>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i>&nbsp;CMS&nbsp;<span class="d-none d-sm-inline"><strong><?=$this->setting_web_name?></strong></span></a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><span id="datetime"></span></li>
        <!--<li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <img src="<?=$displaypicture?>" class="user-image img-circle elevation-2" alt="Profile">&nbsp;
                <span class="d-none d-md-inline"><?=$displayname?></span>
            </a>
        </li>-->
      </ul>
    </nav>
    <aside class="main-sidebar sidebar-light-navy elevation-2">
      <a href="<?=site_url()?>" class="brand-link bg-white d-flex justify-content-center">
        <img src="<?=MY_IMAGEURL.$this->setting_web_logo?>" alt="Logo" class="brand-image">
      </a>
      <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="align-items: center !important">
          <div class="image">
            <img src="<?=$displaypicture?>" class="img-circle elevation-1" alt="<?=$displayname?>">
          </div>
          <div class="info pt-0 pb-0" style="line-height: 1.25 !important">
            <small style="font-size: 8pt !important">SELAMAT DATANG</small><br />
            <a href="<?=site_url('site/user/profile')?>" class="d-block font-weight-bold"><?=strtoupper($displayname)?></a>
          </div>
        </div>
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="<?=site_url('site/user/dashboard')?>" class="nav-link">
                <i class="nav-icon fa fa-home"></i>&nbsp;<p>DASHBOARD</p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-circle"></i>&nbsp;<p>PENGATURAN <i class="fa fa-angle-left right"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?=site_url('site/setting/common')?>" class="nav-link">
                    <i class="fa fa-angle-right nav-icon"></i>&nbsp;<p>UMUM</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?=site_url('site/setting/homepage')?>" class="nav-link">
                    <i class="fa fa-angle-right nav-icon"></i>&nbsp;<p>HOMEPAGE</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-circle"></i>&nbsp;<p>MASTER DATA <i class="fa fa-angle-left right"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?=site_url('site/user/index')?>" class="nav-link">
                    <i class="fa fa-angle-right nav-icon"></i>&nbsp;<p>PENGGUNA</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?=site_url('site/master/pegawai')?>" class="nav-link">
                    <i class="fa fa-angle-right nav-icon"></i>&nbsp;<p>PEGAWAI</p>
                  </a>
                </li>
                <!--<li class="nav-item">
                  <a href="<?=site_url('site/master/ormas')?>" class="nav-link">
                    <i class="fa fa-angle-right nav-icon"></i>&nbsp;<p>ORG. KEMASYARAKATAN</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?=site_url('site/master/parpol')?>" class="nav-link">
                    <i class="fa fa-angle-right nav-icon"></i>&nbsp;<p>PARTAI POLITIK</p>
                  </a>
                </li>-->
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-circle"></i>&nbsp;<p>KONTEN <i class="fa fa-angle-left right"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <?php
                foreach ($rpostcategory as $cat) {
                  ?>
                  <li class="nav-item">
                    <a href="<?=site_url('site/post/index/'.$cat[COL_POSTCATEGORYID])?>" class="nav-link">
                      <i class="fa fa-angle-right nav-icon"></i>&nbsp;<p><?=strtoupper($cat[COL_POSTCATEGORYNAME])?></p>
                    </a>
                  </li>
                  <?php
                }
                ?>
              </ul>
            </li>



            <li class="nav-item">
              <a href="<?=site_url('user/changepassword')?>" class="nav-link">
                <i class="nav-icon far fa-key"></i>&nbsp;<p>UBAH PASSWORD</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?=site_url('user/logout')?>" class="nav-link">
                <i class="nav-icon fa fa-sign-out"></i>&nbsp;<p>LOGOUT</p>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="background: #EEEEEE !important">
      <?=$content?>
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            <b>Version</b> <?=$this->setting_web_version?>
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; <?=date("Y")?> <?=$this->setting_web_name?></strong>. Strongly developed by <b>Partopi Tao</b>.
    </footer>
    </div>
    <!-- ./wrapper -->

    <!-- Modals -->
    <div class="modal fade" id="confirmDialog" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-close"></i></span>
                    </button>

                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="far fa-times-circle"></i> BATAL</button>
                    <button type="button" class="btn btn-primary btn-ok">LANJUT <i class="far fa-arrow-circle-right"></i></button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade modal-danger" id="alertDialog" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Alert!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-close"></i></span>
                    </button>

                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade modal-default" id="promptDialog" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-close"></i></span></button>
                    <h4 class="modal-title">Prompt</h4>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary btn-flat btn-ok">OK</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.Modals -->

    </body>
    <!-- Bootstrap -->
    <script src="<?=base_url()?>assets/themes/adminlte-new/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?=base_url()?>assets/themes/adminlte-new/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?=base_url()?>assets/themes/adminlte-new/dist/js/adminlte.js"></script>

    <!-- jQuery Mapael -->
    <script src="<?=base_url()?>assets/themes/adminlte-new/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="<?=base_url()?>assets/themes/adminlte-new/plugins/raphael/raphael.min.js"></script>
    <script src="<?=base_url()?>assets/themes/adminlte-new/plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="<?=base_url()?>assets/themes/adminlte-new/plugins/jquery-mapael/maps/world_countries.min.js"></script>
    <!-- ChartJS -->
    <script src="<?=base_url()?>assets/themes/adminlte-new/plugins/chart.js.old/Chart.min.js"></script>

    <!-- FastClick -->
    <script src="<?=base_url()?>assets/themes/adminlte-new/plugins/fastclick/fastclick.js"></script>
    <!-- Sparkline -->
    <script src="<?=base_url()?>assets/themes/adminlte-new/plugins/sparklines/sparkline.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?=base_url()?>assets/themes/adminlte-new/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="<?=base_url()?>assets/themes/adminlte-new/plugins/iCheck/icheck.min.js"></script>
    <!-- Select 2 -->
    <script src="<?=base_url()?>assets/themes/adminlte-new/plugins/select2/js/select2.full.min.js"></script>
    <!-- Bootstrap select -->
    <script src="<?=base_url()?>assets/js/bootstrap-select.js"></script>
    <!-- Upload file -->
    <!--<script src="<?=base_url()?>assets/js/jquery.uploadfile.min.js"></script>-->

    <!-- Block UI -->
    <script type="text/javascript" src="<?=base_url() ?>assets/js/jquery.blockUI.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/function.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/jquery.form.js"></script>

    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?=base_url()?>assets/themes/adminlte-new/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

    <!-- CK Editor -->
    <script src="<?=base_url()?>assets/js/ckeditor/ckeditor.js"></script>

    <!-- date-range-picker -->
    <script src="<?=base_url()?>assets/js/moment.js"></script>
    <script src="<?=base_url()?>assets/themes/adminlte-new/plugins/daterangepicker/daterangepicker.js"></script>

    <!-- bootstrap color picker -->
    <script src="<?=base_url()?>assets/themes/adminlte-new/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>

    <!-- JSPDF -->
    <script src="<?=base_url()?>assets/js/jspdf/jspdf.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/jspdf/libs/png_support/zlib.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/jspdf/libs/png_support/png.js"></script>
    <script src="<?=base_url()?>assets/js/jspdf/plugins/from_html.js"></script>
    <script src="<?=base_url()?>assets/js/jspdf/plugins/addimage.js"></script>
    <script src="<?=base_url()?>assets/js/jspdf/plugins/png_support.js"></script>
    <script src="<?=base_url()?>assets/js/jspdf/plugins/split_text_to_size.js"></script>
    <script src="<?=base_url()?>assets/js/jspdf/plugins/standard_fonts_metrics.js"></script>
    <script src="<?=base_url()?>assets/js/jspdf/plugins/filesaver.js"></script>

    <!-- HTML2CANVAS -->
    <script src="<?=base_url()?>assets/js/html2canvas.js"></script>

    <script type="text/javascript" src="<?=base_url()?>assets/js/jquery.number.js"></script>

    <!-- InputMask -->
    <script src="<?=base_url()?>assets/themes/adminlte-new/plugins/inputmask/jquery.inputmask.bundle.js"></script>

    <script src="<?=base_url()?>assets/themes/adminlte-new/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

    <script src="<?=base_url()?>assets/js/sweetalert.min.js"></script>

    <script>
        Date.prototype.setISO8601 = function (string) {
            var regexp = "([0-9]{4})(-([0-9]{2})(-([0-9]{2})" +
                "(T([0-9]{2}):([0-9]{2})(:([0-9]{2})(\.([0-9]+))?)?" +
                "(Z|(([-+])([0-9]{2}):([0-9]{2})))?)?)?)?";
            var d = string.match(new RegExp(regexp));

            var offset = 0;
            var date = new Date(d[1], 0, 1);

            if (d[3]) { date.setMonth(d[3] - 1); }
            if (d[5]) { date.setDate(d[5]); }
            if (d[7]) { date.setHours(d[7]); }
            if (d[8]) { date.setMinutes(d[8]); }
            if (d[10]) { date.setSeconds(d[10]); }
            if (d[12]) { date.setMilliseconds(Number("0." + d[12]) * 1000); }
            if (d[14]) {
                offset = (Number(d[16]) * 60) + Number(d[17]);
                offset *= ((d[15] == '-') ? 1 : -1);
            }

            offset -= date.getTimezoneOffset();
            time = (Number(date) + (offset * 60 * 1000));
            this.setTime(Number(time));
        };

        function DuaDigit(x){
            x = x.toString();
            var len = x.length;
            if(len < 2){
                return "0"+x;
            }else{
                return x;
            }
        }

        var mymodal;
        function UseModal(){
            var modalcontent = '<div class="modal fade" id="generalModal" tabindex="-1" role="dialog" aria-hidden="true">'+
                '<div class="modal-dialog modal-lg">'+
                '<div class="modal-content">'+
                '<div class="modal-header">'+
                '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'+
                '<h4 class="modal-title" id="myModalLabel">Modal title</h4>'+
                '</div>'+
                '<div class="modal-body">'+
                '</div>'+
                '<div class="modal-footer">'+
                '<button type="button" class="btn btn-default modalCancel" data-dismiss="modal">Cancel</button>'+
                '<button type="button" class="btn btn-primary modalOK">OK</button>'+
                '</div>'+
                '</div>'+
                '</div>';
            if(!$('#generalModal').length){
                $(modalcontent).appendTo('body');
                mymodal = $('#generalModal');
            }
        }

        function LoadModal(url,data,cb){
            mymodal.find('.modal-body').empty().load(url,data,cb);
        }

        function ModalTitle(title){
            mymodal.find('#myModalLabel').empty().text(title);
        }

        function CloseModal(){
            mymodal.modal('hide');
        }

        function timeConverter(UNIX_timestamp){
            var a = new Date(UNIX_timestamp*1000);
            var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
            var year = a.getFullYear();
            var month = months[a.getMonth()];
            var date = a.getDate();
            var hour = a.getHours();
            var min = a.getMinutes();
            var sec = a.getSeconds();
            var time = DuaDigit(date)+' '+month+' '+year+' '+DuaDigit(hour)+':'+DuaDigit(min)+':'+DuaDigit(sec);
            return time;
        }

        $(document).ready(function(){
            $('[data-mask]').inputmask();
            $('.ui').button();
            $('a[href="<?=current_url()?>"]').addClass('active');
            $('.dropdown-menu textarea,.dropdown-menu input, .dropdown-menu label').click(function(e) {
                e.stopPropagation();
            });
            $(document).on('keypress','.angka',function(e){
                if((e.which <= 57 && e.which >= 48) || (e.keyCode >= 37 && e.keyCode <= 40) || e.keyCode==9 || e.which==43 || e.which==44 || e.which==45 || e.which==46 || e.keyCode==8){
                    return true;
                }else{
                    return false;
                }
            });
            $(document).on('blur','.uang',function(){
                $(this).val(desimal($(this).val(),0));
            }).on('focus','.uang',function(){
                $(this).val(toNum($(this).val()));
            });
            $(".uang").trigger("blur");

            var confirmDialog = $("#confirmDialog");
            var alertDialog = $("#alertDialog");
            confirmDialog.on("hidden.bs.modal", function(){
                $(".modal-body", confirmDialog).html("");
                $("button", confirmDialog).unbind();
            });
            alertDialog.on("hidden.bs.modal", function(){
                $(".modal-body", alertDialog).html("");
                $("button", alertDialog).unbind();
            });

            if($('.cekboxaction').length){
                $('.cekboxaction').click(function(){
                    var a = $(this);
                    var confirmDialog = $("#confirmDialog");
                    var alertDialog = $("#alertDialog");

                    confirmDialog.on("hidden.bs.modal", function(){
                        $(".modal-body", confirmDialog).html("");
                    });
                    alertDialog.on("hidden.bs.modal", function(){
                        $(".modal-body", alertDialog).html("");
                    });

                    if($('.cekbox:checked').length < 1){
                        $(".modal-body", alertDialog).html("Belum ada data dipilih.");
                        alertDialog.modal("show");
                        //alert('Tidak ada data dipilih');
                        return false;
                    }

                    $(".modal-body", confirmDialog).html((a.data('confirm')||"Apakah anda yakin?"));
                    confirmDialog.modal("show");
                    $(".btn-ok", confirmDialog).click(function() {
                      var thisBtn = $(this);
                        thisBtn.html("Loading...").attr("disabled", true);
                        $('#dataform').ajaxSubmit({
                            dataType: 'json',
                            url : a.attr('href'),
                            success : function(data){
                                if(data.error==0){
                                    //alert(data.success);
                                    toastr.success(data.success);
                                    window.location.reload();
                                }else{
                                    //alert(data.error);
                                    //$(".modal-body", alertDialog).html(data.error);
                                    //alertDialog.modal("show");
                                    toastr.error(data.error);
                                }
                            },
                            complete: function(){
                                thisBtn.html("OK").attr("disabled", false);
                                confirmDialog.modal("hide");
                            }
                        });
                    });
                    /*var yakin = confirm("Apa anda yakin?");
                    if(yakin){
                        $('#dataform').ajaxSubmit({
                            dataType: 'json',
                            url : a.attr('href'),
                            success : function(data){
                                if(data.error==0){
                                    //alert(data.success);
                                    window.location.reload();
                                }else{
                                    alert(data.error);
                                }
                            }
                        });
                    }*/
                    return false;
                });
            }
            if($('.cekboxtarget').length){
                $('.cekboxtarget').click(function(){
                    var a = $(this);
                    var confirmDialog = $("#confirmDialog");
                    var alertDialog = $("#alertDialog");

                    if($('.cekbox:checked').length < 1){
                        $(".modal-body", alertDialog).html("Tidak ada data dipilih");
                        alertDialog.modal("show");
                        //alert('Tidak ada data dipilih');
                        return false;
                    }

                    $(".modal-body", confirmDialog).html(a.attr("confirm").replace("{count}", $('.cekbox:checked').length));
                    confirmDialog.modal("show");
                    $(".btn-ok", confirmDialog).click(function() {
                        $('#dataform').attr("action", a.attr('href')).attr("target", "_blank").submit();
                        confirmDialog.modal("hide");
                    });
                    return false;
                });
            }

            $('a[href="<?=current_url()?>"]').addClass('active');
            $('a[href="<?=current_url()?>"]').closest('li.has-treeview').addClass('menu-open').children('.nav-link').addClass('active');
            //$('li.treeview.active').find('ul').eq(0).show();
            //$('li.treeview.active').find('.fa-angle-left').removeClass('fa-angle-left').addClass('fa-angle-down');

            $(".editor").wysihtml5();
            $("select").not('.no-select2, .custom-select').select2({ width: 'resolve', theme: 'bootstrap4' });
            //$("select").selectpicker();
            $('.datepicker').daterangepicker({
              singleDatePicker: true,
              showDropdowns: true,
              maxYear: parseInt(moment().add(10, 'year').format('YYYY'),10),
              locale: {
                  format: 'Y-MM-DD'
              }
            });
            $('.datepicker').on('show.daterangepicker', function(ev, picker) {
              console.log("calendar is here");
            });

            /*$(".alert").fadeTo(2000, 500).slideUp(500, function(){
                $(".alert").slideUp(500);
            });*/
            $( ".alert-dismissible" ).fadeOut(3000, function() {
                // Animation complete.
            });
            //iCheck for checkbox and radio inputs
            /*$('input[type="checkbox"], input[type="radio"]').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });*/
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });

            $('.colorpick').colorpicker();
            $('.colorpick').on('colorpickerChange', function(event) {
                $('.colorpick .fa-square').css('color', event.color.toString());
            });

            $(".money").number(true, 2, '.', ',');
            $(".uang").number(true, 0, '.', ',');

            /*$.ajaxSetup({
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('HTTP_X_REQUESTED_WITH', 'xmlhttprequest');
                }
            });*/
        });
    </script>

    </html>
