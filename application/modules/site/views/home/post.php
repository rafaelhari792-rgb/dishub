<header class="site-header" style="background-image: url('<?=MY_IMAGEURL.'img-bg-overlay2.png'?>') !important">
  <div class="section-overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-12 text-center">
        <h2 class="text-white"><?=$rcat[COL_POSTCATEGORYNAME]?></h2>
        <?php
        if(!empty($rcat[COL_POSTCATEGORYLABEL])) {
          ?>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
              <li class="breadcrumb-item active" aria-current="page"><?=strtoupper($rcat[COL_POSTCATEGORYLABEL])?></li>
            </ol>
          </nav>
          <?php
        }
        ?>
      </div>
    </div>
  </div>
</header>
<section class="job-section section-padding" style="background: var(--section-bg-color)">
  <div class="container">
    <div class="row align-items-center">
      <?php
      if($rcat[COL_ISDOCUMENTONLY]) {
        ?>
        <div class="col-12 mb-4 p-4 bg-white">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>No.</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>#</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no=1;
              foreach($data as $b) {
                $img = $this->db->where(COL_POSTID, $b[COL_POSTID])->get(TBL__POSTIMAGES)->row_array();
                $tag = array();
                if(!empty($b[COL_POSTMETATAGS])) {
                  $tag = explode(",",$b[COL_POSTMETATAGS]);
                }
                ?>
                <tr>
                  <td style="width: 10px; white-space: nowrap; text-align: right"><?=$no?></td>
                  <td><?=$b[COL_POSTTITLE]?></td>
                  <td><?=$b[COL_POSTMETATAGS]?></td>
                  <td style="width: 10px; white-space: nowrap; text-align: center">
                    <a href="<?=site_url('site/home/page/'.$b[COL_POSTSLUG])?>"><i class="far fa-search"></i> Lihat</a>
                  </td>
                </tr>
                <?php
                $no++;
              }
              ?>
            </tbody>
          </table>
        </div>

        <?php
      } else {
        ?>
        <?php
        if($rcat[COL_POSTCATEGORYNAME] != 'SKM') {
          ?>
          <div class="col-lg-6 col-12 mb-4">
            <h4>Artikel / Berita Terkini</h4>
            <p>Berita terkini seputar kegiatan <?=$this->setting_org_name?>.</p>
          </div>
          <div class="clearfix"></div>
          <?php
        }
        ?>
        <?php
        foreach($data as $b) {
          $strippedcontent = strip_tags($b[COL_POSTCONTENT]);
          $img = $this->db->where(COL_ISTHUMBNAIL,1)->where(COL_POSTID, $b[COL_POSTID])->get(TBL__POSTIMAGES)->row_array();
          $tags = explode(",",$b[COL_POSTMETATAGS]);
          ?>
          <div class="col-lg-4 col-md-6 col-12">
            <div class="job-thumb job-thumb-box bg-white">
              <div
              class="job-image-box-wrap"
              style="
                height: 250px;
                width: 100%;
                background-image: url('<?=!empty($img)?MY_UPLOADURL.$img[COL_IMGPATH]:MY_IMAGEURL.'no-image.png'?>');
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center;
              ">
                <div class="job-image-box-wrap-info d-flex align-items-center">
                  <?php
                  if(!empty($tags)) {
                    ?>
                    <p class="mb-0">
                      <?php
                      $ct = 0;
                      foreach($tags as $t) {
                        if($ct>2) break;
                        ?>
                        <span class="badge badge-level"><?=(strlen($t) > 10 ? substr(strtoupper($t), 0, 10) . "..." : strtoupper($t))?></span>
                        <?php
                        $ct++;
                      }
                      ?>
                    </p>
                    <?php
                  }
                  ?>
                </div>
              </div>
              <div class="job-body" style="min-height: 320px; max-height: 320px">
                <h5 class="job-title">
                  <a href="<?=site_url('site/home/page/'.$b[COL_POSTSLUG])?>" class="job-title-link"><?=strlen($b[COL_POSTTITLE]) > 60 ? substr($b[COL_POSTTITLE], 0, 60) . "..." : $b[COL_POSTTITLE] ?></a>
                </h5>
                <div class="d-flex align-items-center">
                  <p class="job-location"><i class="custom-icon far fa-user-circle"></i>&nbsp;&nbsp;<?=$b[COL_NAME]?></p>
                  <p class="job-date"><i class="custom-icon far fa-calendar"></i>&nbsp;&nbsp;<?=date('d-m-Y', strtotime($b[COL_POSTDATE]))?></p>
                </div>
                <div class="border-top pt-3">
                  <p class="job-price"><?=strlen($strippedcontent) > 150 ? substr($strippedcontent, 0, 150) . "..." : $strippedcontent ?></p>
                </div>
              </div>
            </div>
          </div>
          <?php
        }
      }
      ?>
    </div>
  </div>
</section>
