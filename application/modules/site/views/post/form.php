<?php
$arrMedia = array();
$arrMedia2 = array();
$files_ = array();
if(!empty($data[COL_POSTID])) {
  $files_ = $this->db->where(COL_POSTID, $data[COL_POSTID])->get(TBL__POSTIMAGES)->result_array();
  foreach($files_ as $f) {
    $fPath = MY_UPLOADPATH.$f[COL_IMGPATH];
    if(file_exists($fPath)) {
      $fType = pathinfo($fPath, PATHINFO_EXTENSION);
      $fData = file_get_contents($fPath);
      $fBase64 = 'data:image/'. $fType.';base64,'. base64_encode($fData);

      $arrMedia[] = array(
        'Uniq'=>$f[COL_POSTIMAGEID],
        'ImgURL'=>MY_UPLOADURL.$f[COL_IMGPATH],
        'ImgPath'=>$fBase64,
        'ImgDesc'=>$f[COL_IMGDESC],
        'IsThumbnail'=>$f[COL_ISTHUMBNAIL]==1?1:null,
        'IsHeader'=>$f[COL_ISHEADER]==1?1:null,
        'ImgShortcode'=>$f[COL_IMGSHORTCODE]
      );
      $arrMedia2[] = array(
        'Uniq'=>$f[COL_POSTIMAGEID],
        'ImgURL'=>MY_UPLOADURL.$f[COL_IMGPATH],
        'ImgDesc'=>$f[COL_IMGDESC],
        'IsThumbnail'=>$f[COL_ISTHUMBNAIL]==1?1:null,
        'IsHeader'=>$f[COL_ISHEADER]==1?1:null,
        'ImgShortcode'=>$f[COL_IMGSHORTCODE]
      );
    }

  }
}
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark"><?= $title ?> <small class="font-weight-light text-sm"> Form</small></h1>
      </div>
    </div>
  </div>
</div>
<section class="content">
  <div class="container-fluid">
    <?=form_open_multipart(current_url(), array('role'=>'form','id'=>'form-main','class'=>'form-horizontal'))?>
    <div class="row">
      <div class="col-sm-12">
        <div class="card card-outline card-default">
          <div class="card-header">
            <a href="<?=site_url('site/post/index'.(!empty($cat)?'/'.$cat:''))?>" class="btn btn-secondary btn-sm"><i class="far fa-arrow-circle-left"></i>&nbsp;KEMBALI</a>&nbsp;
            <button type="submit" class="btn btn-primary btn-sm"><i class="far fa-check-circle"></i>&nbsp;SIMPAN</button>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group row">
                  <label class="control-label col-sm-2">Judul</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="<?=COL_POSTTITLE?>" value="<?=!empty($data[COL_POSTTITLE]) ? $data[COL_POSTTITLE] : ''?>" placeholder="Judul Konten" required />
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-2">Kata Kunci</label>
                  <div class="col-sm-8">
                    <select name="<?=COL_POSTMETATAGS?>[]" class="form-control no-select2" multiple>
                      <?php
                      if(!empty($data[COL_POSTMETATAGS])) {
                        $arrTags = explode(",", $data[COL_POSTMETATAGS]);
                        foreach($arrTags as $t) {
                          echo '<option value="'.$t.'" selected="selected">'.$t.'</option>';
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <?php
                if(empty($cat)) {
                  ?>
                  <div class="form-group row">
                    <label class="control-label col-sm-2">Kategori</label>
                    <div class="col-sm-8">
                      <select name="<?=COL_POSTCATEGORYID?>" class="form-control" required>
                        <?=GetCombobox("SELECT * FROM _postcategories ORDER BY PostCategoryID", COL_POSTCATEGORYID, COL_POSTCATEGORYNAME, (!empty($data[COL_POSTCATEGORYID]) ? $data[COL_POSTCATEGORYID] : null))?>
                      </select>
                    </div>
                  </div>
                  <?php
                } else {
                  ?>
                  <input type="hidden" name="<?=COL_POSTCATEGORYID?>" value="<?=$cat?>" />
                  <?php
                }
                ?>
                <div class="form-group row">
                    <label class="control-label col-sm-2">Media</label>
                    <input type="hidden" name="PostImages" value='<?=json_encode($arrMedia)?>' disabled />
                    <input type="hidden" name="PostImages2" value='<?=json_encode($arrMedia2)?>' />
                    <div class="col-sm-8">
                      <div class="row">
                        <div class="col-sm-12">
                          <!--<p>
                            <button type="button" id="btn-add-media" class="btn btn-primary btn-sm"><i class="far fa-plus-circle"></i>&nbsp;TAMBAH</button>
                          </p>-->
                          <div class="col-sm-12 p-2" style="border: 1px solid #dedede; border-radius: .25rem">
                            <div id="div-preview" class="row p-2">
                              <div class="d-none preview-blueprint ml-2" style="width: 150px;height: 100px; border: 1px solid #dedede; flex-direction: column">
                                <div class="row m-1">
                                  <div class="col-sm-12 p-0 div-info">
                                  </div>
                                </div>
                                <div class="row m-1 mt-auto">
                                  <div class="col-sm-12 p-0">
                                    <button type="button" class="btn btn-xs btn-danger btn-block btn-del-media"><i class="far fa-times-circle"></i></button>
                                  </div>
                                </div>
                              </div>
                              <button type="button" id="btn-add-media" class="btn btn-app btn-lg m-0 ml-2" style="height: 100px; font-size: 14px">
                                <i class="fas fa-plus-circle"></i>TAMBAH
                              </button>
                            </div>
                          </div>
                          <p class="text-sm text-muted font-italic"><strong>Catatan:</strong> media yang diunggah berupa gambar / foto dengan ukuran maks. 5MB.</p>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
        if(!empty($rcat) && $rcat[COL_ISSHOWEDITOR]) {
          ?>
          <div class="card card-outline card-default">
            <div class="card-body p-0">
              <div class="form-group mb-0">
                <textarea id="content_editor" class="form-control" rows="4" placeholder="Post Content" name="<?=COL_POSTCONTENT?>"><?=!empty($data[COL_POSTCONTENT]) ? $data[COL_POSTCONTENT] : ''?></textarea>
              </div>
            </div>
          </div>
          <?php
        }
        ?>
      </div>
    </div>
    <?php
    foreach($files_ as $f) {
      ?>
      <input type="hidden" name="fileExist[]" value="<?=$f[COL_POSTIMAGEID]?>" />
      <?php
    }
    ?>
    <?=form_close()?>
  </div>
</section>
<div class="modal fade" id="modalMedia" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">UNGGAH MEDIA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fas fa-close"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>FILE</label>
          <div class="custom-file">
            <input name="FileMedia" class="custom-file-input" type="file" onchange="previewFile()" accept="image/*,application/pdf">
            <label class="custom-file-label" for="file">PILIH FILE</label>
          </div>
        </div>
        <div class="form-group">
          <label>CAPTION</label>
          <input type="text" name="ImgDesc" class="form-control" placeholder="Masukkan caption / keterangan" />
        </div>
        <div class="form-group mt-2 mb-2">
          <label>OPSI</label>
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="IsThumbnail" name="IsThumbnail" checked="">
                  <label class="form-check-label" for="IsThumbnail">Thumbnail</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="IsHeader" name="IsHeader" checked="">
                  <label class="form-check-label" for="IsHeader">Header</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="IsShortcode" name="IsShortcode">
                  <label class="form-check-label" for="IsShortcode">Shortcodes</label>
                </div>
                <div>
                  <input type="text" name="ImgShortcode" class="form-control" placeholder="Masukkan shortcode" />
                </div>
              </div>
            </div>
          </div>
        </div>
        <p class="d-none">
          <img class="preview text-center" src="" style="max-width: 100%; display: none" alt="Preview">
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="far fa-times-circle"></i>&nbsp;TUTUP</button>
        <button type="button" class="btn btn-primary" id="btn-add-media"><i class="far fa-plus-circle"></i>&nbsp;TAMBAH</button>
      </div>
    </div>
  </div>
</div>
<script>
function previewFile() {
  const preview = $('.preview');
  const file = $("[name=FileMedia]").prop('files')[0];
  const reader = new FileReader();

  reader.addEventListener("load", function () {
    preview.attr('src', reader.result);
    preview.show();
  }, false);

  if (file) {
    reader.readAsDataURL(file);
  }
}

function addPostImages(obj, obj2) {
  var arrPostImages = $('[name=PostImages]').val();
  var arrPostImages2 = $('[name=PostImages2]').val();
  if(arrPostImages) {
    arrPostImages = JSON.parse(arrPostImages);
    arrPostImages2 = JSON.parse(arrPostImages2);
  } else {
    arrPostImages = [];
    arrPostImages2 = [];
  }
  arrPostImages.push(obj);
  arrPostImages2.push(obj2);
  $('[name=PostImages]').val(JSON.stringify(arrPostImages)).trigger('change');
  $('[name=PostImages2]').val(JSON.stringify(arrPostImages2)).trigger('change');
}

$(document).ready(function() {
    bsCustomFileInput.init();

  var modalMedia = $('#modalMedia');
  modalMedia.on('hidden.bs.modal', function (e) {
    $('img.preview', modalMedia).hide();
    $('img.preview', modalMedia).attr('src', '');
    $('[name=IsThumbnail]', modalMedia).prop('checked', true).trigger('change');
    $('[name=IsHeader]', modalMedia).prop('checked', true).trigger('change');
    $('[name=IsShortcode]', modalMedia).prop('checked', false).trigger('change');
    $("[name=FileMedia]", modalMedia).val('').trigger('change');
    $("[name=FileMedia]", modalMedia).next('label').html('PILIH FILE');
    $('[name=ImgDesc]', modalMedia).val('');
  });

  $("[name=PostTitle]").change(function() {
      var title = $(this).val().toLowerCase();
      var slug = title.replace(/\s/g, "-");
      $("[name=PostSlug]").val(slug);
  }).trigger("change");

  $("[name^=PostMetaTags]").select2({
    tags: true,
    width: 'resolve',
    theme: 'bootstrap4',
    placeholder: "Input beberapa kata kunci"
  });

  $("#btn-add-media").click(function(){
    modalMedia.modal('show');
  });

  $('[name=IsShortcode]', modalMedia).change(function(){
    if($(this).is(':checked')) {
      $("[name=ImgShortcode]", modalMedia).show();
    } else {
      $("[name=ImgShortcode]", modalMedia).hide();
    }
  }).trigger('change');

  <?php
  if(!empty($rcat) && $rcat[COL_ISSHOWEDITOR]) {
    ?>
    CKEDITOR.config.height = 400;
    CKEDITOR.replace("content_editor");
    <?php
  }
  ?>

  $('#btn-add-media', modalMedia).click(function() {
    var objMedia = {};
    var mediaFile = $('img.preview', modalMedia).attr('src');
    var mediaDesc = $('[name=ImgDesc]', modalMedia).val();
    var mediaIsThumbnail = $('[name=IsThumbnail]', modalMedia).is(':checked');
    var mediaIsHeader = $('[name=IsHeader]', modalMedia).is(':checked');
    var mediaIsShortcode = $('[name=IsShortcode]', modalMedia).is(':checked');
    var mediaShortcode = $('[name=ImgShortcode]', modalMedia).val();
    var uniq_ = moment().format('YYYYMMDDHHmmss');

    objMedia = {
      Uniq: uniq_,
      ImgPath: mediaFile,
      ImgDesc: mediaDesc,
      IsThumbnail: mediaIsThumbnail,
      IsHeader: mediaIsHeader,
      ImgShortcode:''
    };
    objMedia2 = {
      Uniq: uniq_,
      ImgDesc: mediaDesc,
      IsThumbnail: mediaIsThumbnail,
      IsHeader: mediaIsHeader,
      ImgShortcode:''
    };

    if(mediaIsShortcode) {
      if(!mediaShortcode) {
        toastr.error('Silakan isi SHORTCODE terlebih dahulu!');
        return false;
      }
      objMedia.ImgShortcode = mediaShortcode;
      objMedia2.ImgShortcode = mediaShortcode;
    }

    addPostImages(objMedia, objMedia2);
    console.log(objMedia2);
    $('#form-main').append($("input[name=FileMedia][type=file]", modalMedia).clone().removeClass('custom-file-input').attr('name','file[]').removeAttr('onchange'));
    modalMedia.modal('hide');

  });

  $('[name=PostImages]').change(function() {
    var arrPostImages = $('[name=PostImages]').val();
    if(arrPostImages) {
      arrPostImages = JSON.parse(arrPostImages);
    } else {
      arrPostImages = [];
    }

    if(arrPostImages) {
      $('.preview', $('#div-preview')).remove();
      for(var i=0; i<arrPostImages.length; i++) {
        var imgEl = $('.preview-blueprint', $('#div-preview')).clone();
        imgEl.removeClass('preview-blueprint').removeClass('d-none').addClass('d-flex').addClass('preview');
        if(arrPostImages[i].ImgURL) {
          imgEl.css('background-image', "url('"+arrPostImages[i].ImgURL+"')");
        } else {
          imgEl.css('background-image', "url('"+arrPostImages[i].ImgPath+"')");
        }
        imgEl.css('background-size', 'cover');

        $('button.btn-del-media', imgEl).data('uniq', arrPostImages[i].Uniq);
        $('button.btn-del-media', imgEl).click(function(){
          var uniq = $(this).data('uniq');
          var arrImg_ = $('[name=PostImages]').val();
          var arrImg2_ = $('[name=PostImages2]').val();
          if(arrImg_) {
            arrImg_ = JSON.parse(arrImg_);
            arrImg2_ = JSON.parse(arrImg2_);
          }
          else {
            arrImg_ = [];
            arrImg2_ = [];
          }

          arrImg_ = arrImg_.filter(function(obj) {
            return obj.Uniq != uniq;
          });
          arrImg2_ = arrImg2_.filter(function(obj) {
            return obj.Uniq != uniq;
          });

          $('[name=PostImages]').val(JSON.stringify(arrImg_)).trigger('change');
          $('[name=PostImages2]').val(JSON.stringify(arrImg2_)).trigger('change');
          $('[name^=fileExist][value='+uniq+']', $('#form-main')).remove();
        });

        if(arrPostImages[i].IsThumbnail) {
          $('.div-info', imgEl).append('<small class="badge badge-primary mr-1">T</small>');
        }
        if(arrPostImages[i].IsHeader) {
          $('.div-info', imgEl).append('<small class="badge badge-info mr-1">H</small>');
        }

        if(i==0) {
          $('#div-preview').prepend(imgEl);
        } else {
          $("#div-preview > div.preview:nth-child("+i+")").after(imgEl);
        }
      }
    }
  }).trigger('change');

  $('button.btn-del-media').click(function(){
    var uniq = $(this).data('uniq');
    var arrImg_ = $('[name=PostImages]').val();
    var arrImg2_ = $('[name=PostImages2]').val();
    if(arrImg_) {
      arrImg_ = JSON.parse(arrImg_);
      arrImg2_ = JSON.parse(arrImg2_);
    }
    else {
      arrImg_ = [];
      arrImg2_ = [];
    }

    arrImg_ = arrImg_.filter(function(obj) {
      return obj.Uniq != uniq;
    });
    arrImg2_ = arrImg2_.filter(function(obj) {
      return obj.Uniq != uniq;
    });

    $('[name=PostImages]').val(JSON.stringify(arrImg_)).trigger('change');
    $('[name=PostImages2]').val(JSON.stringify(arrImg2_)).trigger('change');
    $('[name^=fileExist][value='+uniq+']', $('#form-main')).remove();
  });

  $('#form-main').validate({
    ignore: "[type=file]",
    submitHandler: function(form) {
      var btnSubmit = $('button[type=submit]', form);
      var txtSubmit = btnSubmit.html();
      btnSubmit.html('<i class="fad fa-circle-notch fa-spin"></i>');
      btnSubmit.attr('disabled', true);

      $(form).ajaxSubmit({
        dataType: 'json',
        type : 'post',
        success: function(res) {
          console.log(res);
          if(res.error != 0) {
            toastr.error(res.error);
          } else {
            toastr.success(res.success);
            if(res.redirect) {
              location.href = res.redirect;
            } else {
              setTimeout(function(){
                //location.reload();
              }, 1000);
            }
          }
        },
        error: function(data) {
          console.log(data)
          toastr.error('SERVER ERROR');
        },
        complete: function() {
          btnSubmit.html(txtSubmit);
          btnSubmit.attr('disabled', false);
        }
      });
      return false;
    }
  });
});
</script>
