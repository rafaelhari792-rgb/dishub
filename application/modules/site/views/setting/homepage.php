<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h3 class="m-0 text-dark font-weight-light">PENGATURAN <small class="font-weight-light text-sm">Homepage</small></h3>
      </div>
    </div>
  </div>
</div>
<?php
$rhome1 = $this->db->where(COL_CONTENTID, 'TxtWelcome1')->get(TBL__HOMEPAGE)->row_array();
$rhome2 = $this->db->where(COL_CONTENTID, 'TxtWelcome2')->get(TBL__HOMEPAGE)->row_array();
$rprofile = $this->db->where(COL_CONTENTID, 'Profil')->get(TBL__HOMEPAGE)->result_array();
$rprofile1 = $this->db->where(COL_CONTENTID, 'TxtPopup1')->get(TBL__HOMEPAGE)->result_array();
$rprofile2 = $this->db->where(COL_CONTENTID, 'TxtPopup2')->get(TBL__HOMEPAGE)->result_array();
$rslider = $this->db->where(COL_CONTENTID, 'Carousel')->get(TBL__HOMEPAGE)->result_array();
$rnum = $this->db->where(COL_CONTENTID, 'NumProfile')->get(TBL__HOMEPAGE)->result_array();

$rmedia1 = $this->db->where(COL_CONTENTID, 'Media1')->get(TBL__HOMEPAGE)->result_array();
$rmedia2 = $this->db->where(COL_CONTENTID, 'Media2')->get(TBL__HOMEPAGE)->result_array();
?>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <?php
        if(!empty($rslider)) {
          ?>
          <div class="card card-outline card-navy collapsed-card">
            <div class="card-header">
              <h4 class="card-title">CAROUSEL / SLIDE</h4>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <?php
              foreach($rslider as $r) {
                ?>
                <?=form_open_multipart(site_url('site/setting/homepage/'.$r[COL_UNIQ]), array('role'=>'form','id'=>'form-main','class'=>'form-horizontal'))?>
                <div class="form-group">
                  <div class="row">
                    <label class="control-label col-sm-2"><?=$r[COL_CONTENTTITLE]?></label>
                    <div class="col-sm-4">
                      <div class="custom-file">
                        <input name="ContentDesc2" class="custom-file-input" type="file" accept="image/*" />
                        <label class="custom-file-label" for="file">PILIH FILE</label>
                      </div>
                      <?php
                      if(!empty($r[COL_CONTENTDESC2]) && file_exists(MY_UPLOADPATH.$r[COL_CONTENTDESC2])) {
                        ?>
                        <p class="mt-2 mb-0 font-italic text-sm"><a href="<?=MY_UPLOADURL.$r[COL_CONTENTDESC2]?>" target="_blank"><i class="far fa-link"></i>&nbsp;LIHAT GAMBAR</a></p>
                        <?php
                      }
                      ?>
                    </div>
                    <div class="col-sm-6">
                      <button type="submit" class="btn btn-primary">SIMPAN&nbsp;<i class="far fa-arrow-circle-right"></i></button>
                    </div>
                  </div>
                </div>
                <?=form_close()?>
                <?php
              }
              ?>
            </div>
          </div>
          <?php
        }
        ?>
        <?php
        if(!empty($rhome1)) {
          ?>
          <div class="card card-outline card-navy collapsed-card">
            <div class="card-header">
              <h4 class="card-title">INTRO 1</h4>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <?=form_open_multipart(site_url('site/setting/homepage/'.$rhome1[COL_UNIQ]), array('role'=>'form','id'=>'form-main','class'=>'form-horizontal'))?>
              <div class="form-group">
                <label>Teks</label>
                <textarea class="form-control ckeditor" rows="3" name="ContentDesc1"><?=$rhome1[COL_CONTENTDESC1]?></textarea>
              </div>
              <div class="form-group mb-0">
                <div class="row">
                  <div class="col-sm-6">
                    <label>Gambar <span class="text-sm text-muted font-weight-normal">(pilih file jika ingin diubah)</span></label>
                    <div class="custom-file">
                      <input name="ContentDesc2" class="custom-file-input" type="file" accept="image/*" />
                      <label class="custom-file-label" for="file">PILIH FILE</label>
                    </div>
                    <?php
                    if(!empty($rhome1[COL_CONTENTDESC2]) && file_exists(MY_UPLOADPATH.$rhome1[COL_CONTENTDESC2])) {
                      ?>
                      <p class="mt-2 mb-0 font-italic text-sm"><a href="<?=MY_UPLOADURL.$rhome1[COL_CONTENTDESC2]?>" target="_blank"><i class="far fa-link"></i>&nbsp;LIHAT GAMBAR</a></p>
                      <?php
                    }
                    ?>
                  </div>
                </div>
              </div>
              <?=form_close()?>
            </div>
            <div class="card-footer">
              <button type="button" class="btn btn-primary btn-submit">SIMPAN&nbsp;<i class="far fa-arrow-circle-right"></i></button>
            </div>
          </div>
          <?php
        }
        ?>
        <?php
        if(!empty($rhome2)) {
          ?>
          <div class="card card-outline card-navy collapsed-card">
            <div class="card-header">
              <h4 class="card-title">INTRO 2</h4>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <?=form_open_multipart(site_url('site/setting/homepage/'.$rhome2[COL_UNIQ]), array('role'=>'form','id'=>'form-main','class'=>'form-horizontal'))?>
              <div class="form-group">
                <label>Teks</label>
                <textarea class="form-control ckeditor" rows="3" name="ContentDesc1"><?=$rhome2[COL_CONTENTDESC1]?></textarea>
              </div>
              <div class="form-group mb-0">
                <div class="row">
                  <div class="col-sm-6">
                    <label>Gambar <span class="text-sm text-muted font-weight-normal">(pilih file jika ingin diubah)</span></label>
                    <div class="custom-file">
                      <input name="ContentDesc2" class="custom-file-input" type="file" accept="image/*" />
                      <label class="custom-file-label" for="file">PILIH FILE</label>
                    </div>
                    <?php
                    if(!empty($rhome2[COL_CONTENTDESC2]) && file_exists(MY_UPLOADPATH.$rhome2[COL_CONTENTDESC2])) {
                      ?>
                      <p class="mt-2 mb-0 font-italic text-sm"><a href="<?=MY_UPLOADURL.$rhome2[COL_CONTENTDESC2]?>" target="_blank"><i class="far fa-link"></i>&nbsp;LIHAT GAMBAR</a></p>
                      <?php
                    }
                    ?>
                  </div>
                </div>
              </div>
              <?=form_close()?>
            </div>
            <div class="card-footer">
              <button type="button" class="btn btn-primary btn-submit">SIMPAN&nbsp;<i class="far fa-arrow-circle-right"></i></button>
            </div>
          </div>
          <?php
        }
        ?>
        <?php
        if(!empty($rmedia1)) {
          ?>
          <div class="card card-outline card-navy collapsed-card">
            <div class="card-header">
              <h4 class="card-title">PROFIL PIMPINAN</h4>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <?php
              foreach($rmedia1 as $r) {
                ?>
                <?=form_open_multipart(site_url('site/setting/homepage/'.$r[COL_UNIQ]), array('role'=>'form','id'=>'form-main','class'=>'form-horizontal'))?>
                <div class="form-group">
                  <div class="row">
                    <label class="control-label col-sm-2"><?=$r[COL_CONTENTTITLE]?></label>
                    <div class="col-sm-3">
                      <div class="custom-file">
                        <input name="ContentDesc2" class="custom-file-input" type="file" accept="image/*" />
                        <label class="custom-file-label" for="file">PILIH FILE</label>
                      </div>
                      <?php
                      if(!empty($r[COL_CONTENTDESC2]) && file_exists(MY_UPLOADPATH.$r[COL_CONTENTDESC2])) {
                        ?>
                        <p class="mt-2 mb-0 font-italic text-sm"><a href="<?=MY_UPLOADURL.$r[COL_CONTENTDESC2]?>" target="_blank"><i class="far fa-link"></i>&nbsp;LIHAT GAMBAR</a></p>
                        <?php
                      }
                      ?>
                    </div>
                    <div class="col-sm-3">
                      <input name="ContentDesc1" type="text" class="form-control" placeholder="Nama" value="<?=!empty($r[COL_CONTENTDESC1])?$r[COL_CONTENTDESC1]:''?>" />
                    </div>
                    <div class="col-sm-3">
                      <input name="ContentDesc3" type="text" class="form-control" placeholder="Jabatan" value="<?=!empty($r[COL_CONTENTDESC3])?$r[COL_CONTENTDESC3]:''?>" />
                    </div>
                    <div class="col-sm-1">
                      <button type="submit" class="btn btn-primary">SIMPAN&nbsp;<i class="far fa-arrow-circle-right"></i></button>
                    </div>
                  </div>
                </div>
                <?=form_close()?>
                <?php
              }
              ?>
            </div>
          </div>
          <?php
        }
        ?>
        <?php
        if(!empty($rmedia2)) {
          ?>
          <div class="card card-outline card-navy collapsed-card">
            <div class="card-header">
              <h4 class="card-title">PROFIL VIDEO</h4>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <?php
              foreach($rmedia2 as $r) {
                ?>
                <?=form_open_multipart(site_url('site/setting/homepage/'.$r[COL_UNIQ]), array('role'=>'form','id'=>'form-main','class'=>'form-horizontal'))?>
                <div class="form-group">
                  <div class="row">
                    <label class="control-label col-sm-2"><?=$r[COL_CONTENTTITLE]?></label>
                    <div class="col-sm-3">
                      <div class="custom-file">
                        <input name="ContentDesc2" class="custom-file-input" type="file" accept="image/*" />
                        <label class="custom-file-label" for="file">THUMBNAIL</label>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <input name="ContentDesc3" type="text" class="form-control" placeholder="URL (YouTube)" value="<?=!empty($r[COL_CONTENTDESC3])?$r[COL_CONTENTDESC3]:''?>" />
                    </div>
                    <div class="col-sm-3">
                      <button type="submit" class="btn btn-primary">SIMPAN&nbsp;<i class="far fa-arrow-circle-right"></i></button>
                      <?php
                      if(!empty($r[COL_CONTENTDESC2]) && file_exists(MY_UPLOADPATH.$r[COL_CONTENTDESC2])) {
                        ?>
                        <a class="btn btn-outline-success" href="<?=MY_UPLOADURL.$r[COL_CONTENTDESC2]?>" target="_blank"><i class="far fa-link"></i>&nbsp;LIHAT DOKUMEN</a>
                        <?php
                      }
                      ?>
                    </div>

                  </div>
                </div>
                <?=form_close()?>
                <?php
              }
              ?>
            </div>
          </div>
          <?php
        }
        ?>
        <?php
        if(!empty($rprofile1)) {
          ?>
          <div class="card card-outline card-navy collapsed-card">
            <div class="card-header">
              <h4 class="card-title">PENGUMUMAN</h4>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <?php
              foreach($rprofile1 as $r) {
                ?>
                <?=form_open_multipart(site_url('site/setting/homepage/'.$r[COL_UNIQ]), array('role'=>'form','id'=>'form-main','class'=>'form-horizontal'))?>
                <div class="form-group">
                  <div class="row">
                    <label class="control-label col-sm-2"><?=$r[COL_CONTENTTITLE]?></label>
                    <div class="col-sm-4">
                      <div class="custom-file">
                        <input name="ContentDesc2" class="custom-file-input" type="file" accept="image/*,application/pdf" />
                        <label class="custom-file-label" for="file">PILIH FILE</label>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <button type="submit" class="btn btn-primary">SIMPAN&nbsp;<i class="far fa-arrow-circle-right"></i></button>
                      <?php
                      if(!empty($r[COL_CONTENTDESC2]) && file_exists(MY_UPLOADPATH.$r[COL_CONTENTDESC2])) {
                        ?>
                        <a class="btn btn-outline-success" href="<?=MY_UPLOADURL.$r[COL_CONTENTDESC2]?>" target="_blank"><i class="far fa-link"></i>&nbsp;LIHAT DOKUMEN</a>
                        <?php
                      }
                      ?>
                    </div>

                  </div>
                </div>
                <?=form_close()?>
                <?php
              }
              ?>
            </div>
          </div>
          <?php
        }
        ?>
        <?php
        if(!empty($rnum)) {
          ?>
          <div class="card card-outline card-navy collapsed-card">
            <div class="card-header">
              <h4 class="card-title">DATA</h4>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <?php
              foreach($rnum as $r) {
                ?>
                <?=form_open_multipart(site_url('site/setting/homepage/'.$r[COL_UNIQ]), array('role'=>'form','id'=>'form-main','class'=>'form-horizontal'))?>
                <div class="form-group">
                  <div class="row">
                    <label class="control-label col-sm-2"><?=$r[COL_CONTENTTITLE]?></label>
                    <div class="col-sm-3">
                      <input name="ContentDesc1" type="text" class="form-control" placeholder="Judul" value="<?=isset($r[COL_CONTENTDESC1])?$r[COL_CONTENTDESC1]:''?>" />
                    </div>
                    <div class="col-sm-2">
                      <input name="ContentDesc3" type="text" class="form-control" placeholder="Nilai" value="<?=isset($r[COL_CONTENTDESC3])?$r[COL_CONTENTDESC3]:''?>" />
                    </div>
                    <div class="col-sm-2">
                      <input name="ContentDesc4" type="text" class="form-control" placeholder="Satuan" value="<?=isset($r[COL_CONTENTDESC4])?$r[COL_CONTENTDESC4]:''?>" />
                    </div>
                    <div class="col-sm-2">
                      <button type="submit" class="btn btn-primary">SIMPAN&nbsp;<i class="far fa-arrow-circle-right"></i></button>
                    </div>
                  </div>
                </div>
                <?=form_close()?>
                <?php
              }
              ?>
            </div>
          </div>
          <?php
        }
        ?>
        <?php
        if(!empty($rprofile2)) {
          foreach($rprofile2 as $r) {
            ?>
            <div class="card card-outline card-navy collapsed-card">
              <div class="card-header">
                <h4 class="card-title">PROFIL - <strong><?=$r[COL_CONTENTTITLE]?></strong></h4>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                </div>
              </div>
              <div class="card-body">
                <?=form_open_multipart(site_url('site/setting/homepage/'.$r[COL_UNIQ]), array('role'=>'form','id'=>'form-main','class'=>'form-horizontal'))?>
                <div class="form-group">
                  <label>Teks</label>
                  <textarea class="form-control ckeditor" rows="3" name="ContentDesc1"><?=$r[COL_CONTENTDESC1]?></textarea>
                </div>
                <?=form_close()?>
              </div>
              <div class="card-footer">
                <button type="button" class="btn btn-primary btn-submit">SIMPAN&nbsp;<i class="far fa-arrow-circle-right"></i></button>
              </div>
            </div>
            <?php
          }
          ?>
          <?php
        }
        ?>

        <?php
        foreach($rprofile as $r) {
          ?>
          <div class="card card-outline card-navy collapsed-card">
            <div class="card-header">
              <h4 class="card-title">PROFIL - <strong><?=$r[COL_CONTENTTITLE]?></strong></h4>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <?=form_open_multipart(site_url('site/setting/homepage/'.$r[COL_UNIQ]), array('role'=>'form','id'=>'form-main','class'=>'form-horizontal'))?>
              <?php
              if($r[COL_CONTENTTYPE]=='TEXT') {
                ?>
                <div class="form-group">
                  <label>Teks</label>
                  <textarea class="form-control ckeditor" rows="3" name="ContentDesc1"><?=$r[COL_CONTENTDESC1]?></textarea>
                </div>
                <?php
              } else if($r[COL_CONTENTTYPE]=='IMG' || $r[COL_CONTENTTYPE]=='PDF') {
                ?>
                <div class="form-group">
                  <label>Upload</label>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="input-group">
                        <div class="custom-file">
                          <input name="ContentDesc2" class="custom-file-input" type="file" accept="image/*,application/pdf" />
                          <label class="custom-file-label" for="file">PILIH FILE</label>
                        </div>
                        <?php
                        if(!empty($r[COL_CONTENTDESC2]) && file_exists(MY_UPLOADPATH.$r[COL_CONTENTDESC2])) {
                          ?>
                          <span class="input-group-append">
                            <a class="btn btn-outline-success" href="<?=MY_UPLOADURL.$r[COL_CONTENTDESC2]?>" target="_blank"><i class="far fa-link"></i>&nbsp;LIHAT FILE</a>
                          </span>
                          <?php
                        }
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Keterangan</label>
                  <textarea class="form-control ckeditor" rows="3" name="ContentDesc1"><?=$r[COL_CONTENTDESC1]?></textarea>
                </div>
                <?php
              }
              ?>

              <?=form_close()?>
            </div>
            <div class="card-footer">
              <button type="button" class="btn btn-primary btn-submit">SIMPAN&nbsp;<i class="far fa-arrow-circle-right"></i></button>
            </div>
          </div>
          <?php
        }
        ?>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript">
$(document).ready(function() {
  bsCustomFileInput.init();
  CKEDITOR.replaceClass = 'ckeditor';

  $('.btn-submit').click(function() {
    var dis = $(this);
    var form = $('form', dis.closest('.card'));
    if (form) {
      form.submit();
    }
  });
});
</script>
