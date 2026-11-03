<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $this->setting_web_name ?> - Login</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url()?>assets/fonts/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/fonts/fontawesome-pro/web/css/all.min.css" />
    <!-- Ionicons -->
    <link href="<?=base_url()?>assets/fonts/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?=base_url()?>assets/themes/adminlte-new/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url()?>assets/themes/adminlte-new/dist/css/adminlte.min.css">
    <!-- jQuery -->
    <script src="<?=base_url()?>assets/themes/adminlte-new/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?=base_url()?>assets/themes/adminlte-new/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="<?=base_url()?>assets/js/jquery.particleground.js"></script>

    <link rel="stylesheet" href="<?=base_url()?>assets/themes/adminlte-new/plugins/toastr/toastr.min.css">
    <script src="<?=base_url()?>assets/themes/adminlte-new/plugins/toastr/toastr.min.js"></script>
    <style>
        .adsbox{
            background: none repeat scroll 0 0 #f5f5f5;
            border-radius: 10px;
            box-shadow: 0 0 5px 1px rgba(50, 50, 50, 0.2);
            margin: 20px auto 0;
            padding: 15px;
            border: 1px solid #caced3;
            height: 145px;
        }
    </style>
    <link rel="icon" type="image/png" href=<?=MY_IMAGEURL.$this->setting_web_logo?>>
</head>
<!-- Preloader Style -->
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
        background: url('<?=base_url()?>assets/media/preloader/<?=$this->setting_web_preloader?>') center no-repeat #fff;
    }
    html, body {
        width: 100%;
        height: 100%;
        overflow: hidden;
    }
    #particles {
        width: 100%;
        height: 100%;
        overflow: hidden;
    }
    #intro {
        position: absolute;
        left: 0;
        top: 50%;
        padding: 0 20px;
        width: 100%;
        #text-align: center;
    }
    #particles {
      background: url('<?=base_url()?>assets/media/image/img-bg-hero.png') bottom no-repeat #e9ecef;
    }
    #overlay {
      background: #ddd;
      opacity: 0.75;
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
    }
    .pg-canvas {
      position: relative;
      z-index: 1;
    }
    .login-box {
      position: relative;
      z-index: 100;
    }
</style>
<!-- /.preloader style -->

<!-- Preloader Script -->
<script>
    // Wait for window load
    $(window).load(function() {
        // Animate loader off screen
        $(".se-pre-con").fadeOut("slow");
    });
</script>
<!-- /.preloader script -->
<body class="hold-transition login-page">

<!-- preloader -->
<div class="se-pre-con"></div>
<!-- /.preloader -->
<div id="particles">
  <div id="overlay"></div>
  <div id="intro">
    <div class="login-box">
      <div class="card">
        <div class="card-body login-card-body" style="background: none">
          <div class="login-logo">
            <img class="user-image" src="<?=MY_IMAGEURL.$this->setting_web_logo?>" style="width: 60px" alt="Logo"><br />
            <h6 class="mt-2">
              <a href="<?=site_url()?>"><small class="font-weight-light">Content Management System</small><br />DISHUB KAB. BATU BARA</a>
            </h6>
          </div>
          <?= form_open(current_url(),array('id'=>'form-login')) ?>
          <p><small style="font-size: 10pt">Silakan login menggunakan akun anda.</small></p>
          <input type="hidden" name="act" value="GetToken" />
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="<?=COL_USERNAME?>" placeholder="Username" required>
            <div class="input-group-append">
              <div class="input-group-text"><span class="far fa-user"></span></div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="<?=COL_PASSWORD?>" placeholder="Kata Sandi" required>
            <div class="input-group-append">
              <div class="input-group-text"><span class="far fa-key"></span></div>
            </div>
          </div>
          <div class="footer">
            <a href="<?=site_url('site/home')?>" class="btn btn-outline-secondary"><i class="far fa-arrow-circle-left"></i>&nbsp;KEMBALI KE BERANDA</a>
            <button type="submit" class="btn btn-outline-primary" style="float: right;">MASUK&nbsp;<i class="far fa-arrow-circle-right"></i></button>
          </div>
          <?= form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="<?=base_url() ?>assets/js/jquery.blockUI.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/function.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.form.js"></script>
<script>
$(document).ready(function() {
    $('#particles').particleground({
      dotColor: '#396EB0',
      lineColor: '#396EB0'
    });
    $('#intro').css({
      'margin-top': -($('#particles').height() / 2)
    });

    $('#form-login').validate({
      submitHandler: function(form) {
        var btnSubmit = $('button[type=submit]', $(form));
        var txtSubmit = btnSubmit[0].innerHTML;
        btnSubmit.html('<i class="fad fa-circle-notch fa-spin"></i>');
        $(form).ajaxSubmit({
          dataType: 'json',
          type : 'post',
          success: function(res) {
            if(res.error != 0) {
              toastr.error(res.error);
            } else {
              toastr.success(res.success);
              btnSubmit.html('Masuk...');
              if(res.redirect) {
                setTimeout(function(){
                  location.href = res.redirect;
                }, 1000);
              } else {
                location.reload();
              }
            }
          },
          error: function() {
            toastr.error('SERVER ERROR');
          },
          complete: function() {
            btnSubmit.html(txtSubmit);
          }
        });

        return false;
      }
    });
});
</script>
</body>
</html>
