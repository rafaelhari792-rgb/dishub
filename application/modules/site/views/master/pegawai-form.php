<form id="form-main" method="post" enctype="multipart/form-data" action="<?=current_url()?>">
  <div class="row">
    <div class="col-sm-12">
      <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" class="form-control" name="<?=COL_PEGNAMA?>" value="<?=!empty($data)?$data[COL_PEGNAMA]:''?>" placeholder="Nama Lengkap" required />
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        <label>No. Urut</label>
        <input type="text" class="form-control" name="<?=COL_PEGNOURUT?>" value="<?=!empty($data)?$data[COL_PEGNOURUT]:''?>" placeholder="No. Urut" required />
      </div>
    </div>
    <div class="col-sm-8">
      <div class="form-group">
        <label>NIP</label>
        <input type="text" class="form-control" name="<?=COL_PEGNIP?>" value="<?=!empty($data)?$data[COL_PEGNIP]:''?>" placeholder="Nomor Induk Pegawai" required />
      </div>
    </div>
    <div class="col-sm-12">
      <div class="form-group">
        <label>Jabatan</label>
        <input type="text" class="form-control" name="<?=COL_PEGJABATAN?>" value="<?=!empty($data)?$data[COL_PEGJABATAN]:''?>" placeholder="Jabatan" required />
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label>Kategori</label>
        <select class="form-control" name="<?=COL_PEGKATEGORI?>" style="width: 100%" required>
          <option value="ASN" <?=!empty($data)&&$data[COL_PEGKATEGORI]=='ASN'?'selected':''?>>ASN</option>
          <option value="NON ASN" <?=!empty($data)&&$data[COL_PEGKATEGORI]=='NON ASN'?'selected':''?>>NON ASN</option>
        </select>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label>Status</label>
        <select class="form-control" name="<?=COL_PEGISAKTIF?>" style="width: 100%" required>
          <option value="1" <?=!empty($data)&&$data[COL_PEGISAKTIF]==1?'selected':''?>>AKTIF</option>
          <option value="0" <?=!empty($data)&&$data[COL_PEGISAKTIF]==0?'selected':''?>>INAKTIF</option>
        </select>
      </div>
    </div>
  </div>
  <div class="row mt-3">
    <div class="col-sm-4 d-flex justify-content-center align-items-center">
      <div style="height: 5rem; width: 5rem; background-image: url('<?=!empty($data)&&!empty($data[COL_PEGIMGPATH])&&file_exists(MY_UPLOADPATH.'pegawai/'.$data[COL_PEGIMGPATH])?MY_UPLOADURL.'pegawai/'.$data[COL_PEGIMGPATH]:MY_IMAGEURL.'user.jpg'?>'); background-size: cover; border-radius: 50%; border: 2px solid #adb5bd"></div>
    </div>
    <div class="col-sm-8">
      <label>Avatar / Foto Profil</label>
      <div class="input-group">
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="userfile" accept="image/*">
          <label class="custom-file-label" for="userfile">Unggah Foto</label>
        </div>
      </div>
      <small class="text-muted font-italic">Ukuran maks. 2MB</small>
    </div>
  </div>
</form>
