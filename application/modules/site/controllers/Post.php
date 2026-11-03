<?php
class Post extends MY_Controller {
  function __construct() {
    parent::__construct();
    /*if(!IsLogin() || GetLoggedUser()[COL_ROLEID] != ROLEADMIN) {
        redirect('user/dashboard');
    }*/
    $this->load->model('mpost');
    ini_set('upload_max_filesize', '50M');
    ini_set('post_max_size', '100M');
  }

  function _base64ToImage($base64_string, $output_file) {
    $file = fopen($output_file, "wb");

    $data = explode(',', $base64_string);

    fwrite($file, base64_decode($data[1]));
    fclose($file);

    return $output_file;
  }

  function index($cat=null) {
    if(!IsLogin()) {
      redirect('user/dashboard');
    }

    $ruser = GetLoggedUser();

    $data['title'] = "Konten";
    if(!empty($cat)) {
      $rcat = $this->db
      ->where(COL_POSTCATEGORYID, $cat)
      ->get(TBL__POSTCATEGORIES)
      ->row_array();
      if(!empty($rcat)) {
        $data['catname'] = $rcat[COL_POSTCATEGORYNAME];
        $data['cat'] = $cat;
      }
    }
    $data['res'] = $this->mpost->getall($cat, null);
    $this->template->load('backend' , 'post/index', $data);
  }

  function add($cat=null) {
    if(!IsLogin()) {
      redirect('user/dashboard');
    }
    $user = GetLoggedUser();
    $data['title'] = "Konten";
    if(!empty($cat)) {
      $rcat = $this->db
      ->where(COL_POSTCATEGORYID, $cat)
      ->get(TBL__POSTCATEGORIES)
      ->row_array();
      if(!empty($rcat)) {
        $data['rcat'] = $rcat;
        $data['cat'] = $cat;
        $data['title'] = $rcat[COL_POSTCATEGORYNAME];
      }
    }
    $data['edit'] = FALSE;

    if(!empty($_POST)) {
      $config['upload_path'] = MY_UPLOADPATH;
      $config['allowed_types'] = "gif|jpg|jpeg|png|pdf|mp4|avi|mkv|wav|webm|flv|wmv|mov";
      $config['max_size']	= 1024000;
      $config['max_width']  = 10000;
      $config['max_height']  = 10000;
      $config['overwrite'] = FALSE;

      $this->load->library('upload',$config);

      $data['data'] = $_POST;
      $rules = $this->mpost->rules();
      $this->form_validation->set_rules($rules);
      if($this->form_validation->run()){
        $arrMedia = array();
        $arrTags = $this->input->post('PostMetaTags');
        $arrPostImages = $this->input->post('PostImages2');

        $arrAttachment = array();
        $datAttachment = array();
        $files = $_FILES;
        $cpt = !empty($_FILES)?count($_FILES['file']['name']):0;
        $arrPostImages = json_decode($arrPostImages);

        for($i=0; $i<$cpt; $i++)
        {
          if(!empty($files['file']['name'][$i]) && isset($arrPostImages[$i])) {
            $_FILES['file']['name']= $files['file']['name'][$i];
            $_FILES['file']['type']= $files['file']['type'][$i];
            $_FILES['file']['tmp_name']= $files['file']['tmp_name'][$i];
            $_FILES['file']['error']= $files['file']['error'][$i];
            $_FILES['file']['size']= $files['file']['size'][$i];

            $res = $this->upload->do_upload('file');
            if(!$res) {
              ShowJsonError($this->upload->display_errors());
              exit();
            }
            $upl = $this->upload->data();

            if(!empty($arrPostImages[$i])) {
              $img = $arrPostImages[$i];
              $arrMedia[] = array(
                COL_IMGPATH=>$upl['file_name'],
                COL_IMGDESC=>$img->ImgDesc,
                COL_IMGSHORTCODE=>$img->ImgShortcode,
                COL_ISHEADER=>$img->IsHeader=="true",
                COL_ISTHUMBNAIL=>$img->IsThumbnail=="true"
              );
            }
            //$arrAttachment[] = $upl['file_name'];
          }
        }

        /*if(!empty($arrPostImages)) {
          $arrPostImages = json_decode($arrPostImages);
          if(!empty($arrPostImages)) {
            $i=1;
            foreach($arrPostImages as $img) {
              $imgData = explode(',', $img->ImgPath);
              $imgData = base64_decode($imgData[1]);
              $imgFileName = slugify($this->input->post(COL_POSTTITLE)).'-'.$i.'.png';
              file_put_contents(MY_UPLOADPATH.$imgFileName, $imgData);

              $arrMedia[] = array(
                //COL_IMGPATH=>$img->ImgPath,
                COL_IMGPATH=>$imgFileName,
                COL_IMGDESC=>$img->ImgDesc,
                COL_IMGSHORTCODE=>$img->ImgShortcode,
                COL_ISHEADER=>$img->IsHeader=="true",
                COL_ISTHUMBNAIL=>$img->IsThumbnail=="true"
              );
              $i++;
            }
          }
        }*/

        $data = array(
          COL_POSTCATEGORYID => $this->input->post(COL_POSTCATEGORYID),
          COL_POSTDATE => date('Y-m-d'),
          COL_POSTTITLE => $this->input->post(COL_POSTTITLE),
          COL_POSTSLUG => slugify($this->input->post(COL_POSTTITLE)),
          COL_POSTCONTENT => $this->input->post(COL_POSTCONTENT),
          COL_POSTMETATAGS => !empty($arrTags)?implode(",", $arrTags):null,
          COL_ISSUSPEND => ($this->input->post(COL_ISSUSPEND) ? $this->input->post(COL_ISSUSPEND) : false),
          COL_ISRUNNINGTEXT => ($this->input->post(COL_ISRUNNINGTEXT) ? $this->input->post(COL_ISRUNNINGTEXT) : false),
          COL_CREATEDBY => $user[COL_USERNAME],
          COL_CREATEDON => date('Y-m-d H:i:s'),
          COL_UPDATEDBY => $user[COL_USERNAME],
          COL_UPDATEDON => date('Y-m-d H:i:s')
        );

        /*if($user[COL_ROLEID]!=ROLEADMIN) {
          $data[COL_POSTUNITID]=$user[COL_COMPANYID];
        }*/

        $this->db->trans_begin();
        try {
          $res = $this->db->insert(TBL__POSTS, $data);
          if(!$res) {
            throw new Exception('Gagal menginput konten.');
          }

          $id = $this->db->insert_id();
          if(!empty($arrMedia)){
            $id = $this->db->insert_id();
            for($i=0; $i<count($arrMedia); $i++) {
              $arrMedia[$i][COL_POSTID]=$id;
            }

            $res = $this->db->insert_batch(TBL__POSTIMAGES, $arrMedia);
            if(!$res) {
              throw new Exception('Gagal menginput konten.');
            }
          }
        } catch(Exception $ex) {
          $this->db->trans_rollback();
          ShowJsonError($ex->getMessage());
          exit();
        }

        $this->db->trans_commit();
        ShowJsonSuccess('Konten berhasil diinput.', array('redirect'=>site_url('site/post/index'.(!empty($cat)?'/'.$cat:''))));
        exit();
      }
      else {
        ShowJsonError(validation_errors());
        exit();
      }
    }
    else {
      $this->template->load('backend' , 'post/form', $data);
    }
  }

  function edit($id) {
      if(!IsLogin() || GetLoggedUser()[COL_ROLEID] != ROLEADMIN) {
          redirect('user/dashboard');
      }
      $user = GetLoggedUser();
      $data['title'] = "Konten";
      $data['edit'] = TRUE;
      $data['data'] = $edited = $this->db->join(TBL__POSTCATEGORIES,TBL__POSTCATEGORIES.'.'.COL_POSTCATEGORYID." = ".TBL__POSTS.".".COL_POSTCATEGORYID,"inner")->where(COL_POSTID, $id)->get(TBL__POSTS)->row_array();
      if(empty($edited)){
        show_404();
        return;
      }
      $data['cat'] = $edited[COL_POSTCATEGORYID];
      $data['title'] = $edited[COL_POSTCATEGORYNAME];
      $rcat = $this->db
      ->where(COL_POSTCATEGORYID, $edited[COL_POSTCATEGORYID])
      ->get(TBL__POSTCATEGORIES)
      ->row_array();
      if(!empty($rcat)) {
        $data['rcat'] = $rcat;
      }

      if(!empty($_POST)) {
        $config['upload_path'] = MY_UPLOADPATH;
        $config['allowed_types'] = "gif|jpg|jpeg|png|pdf|mp4|avi|mkv|wav|webm|flv|wmv|mov";
        $config['max_size']	= 512000;
        $config['max_width']  = 4000;
        $config['max_height']  = 4000;
        $config['overwrite'] = FALSE;

        $this->load->library('upload',$config);

        $data['data'] = $_POST;
        $rules = $this->mpost->rules();
        $this->form_validation->set_rules($rules);
        if($this->form_validation->run()){
          $arrMedia = array();
          $arrTags = $this->input->post('PostMetaTags');
          $arrPostImages = $this->input->post('PostImages2');
          $arrPostImagesExist = $this->input->post('fileExist');

          $arrAttachment = array();
          $datAttachment = array();
          $files = $_FILES;
          $cpt = !empty($_FILES)?count($_FILES['file']['name']):0;
          $arrPostImages = json_decode($arrPostImages);

          for($i=0; $i<$cpt; $i++)
          {
            if(is_array($arrPostImagesExist)) {
              if(!empty($files['file']['name'][$i]) && isset($arrPostImages[($i+count($arrPostImagesExist))])) {
                $_FILES['file']['name']= $files['file']['name'][$i];
                $_FILES['file']['type']= $files['file']['type'][$i];
                $_FILES['file']['tmp_name']= $files['file']['tmp_name'][$i];
                $_FILES['file']['error']= $files['file']['error'][$i];
                $_FILES['file']['size']= $files['file']['size'][$i];

                $this->upload->do_upload('file');
                $upl = $this->upload->data();

                if(!empty($arrPostImages[($i+count($arrPostImagesExist))])) {
                  $img = $arrPostImages[($i+count($arrPostImagesExist))];
                  $arrMedia[] = array(
                    COL_POSTID=>$id,
                    COL_IMGPATH=>$upl['file_name'],
                    COL_IMGDESC=>$img->ImgDesc,
                    COL_IMGSHORTCODE=>$img->ImgShortcode,
                    COL_ISHEADER=>$img->IsHeader=="true",
                    COL_ISTHUMBNAIL=>$img->IsThumbnail=="true"
                  );
                }
                //$arrAttachment[] = $upl['file_name'];
              }
            }
          }

          /*if(!empty($arrPostImages)) {
            $arrPostImages = json_decode($arrPostImages);
            if(!empty($arrPostImages)) {
              $i=1;
              foreach($arrPostImages as $img) {
                $imgData = explode(',', $img->ImgPath);
                $imgData = base64_decode($imgData[1]);
                $imgFileName = slugify($this->input->post(COL_POSTTITLE)).'-'.$i.'.png';
                file_put_contents(MY_UPLOADPATH.$imgFileName, $imgData);

                $arrMedia[] = array(
                  COL_POSTID=>$id,
                  //COL_IMGPATH=>$img->ImgPath,
                  COL_IMGPATH=>$imgFileName,
                  COL_IMGDESC=>$img->ImgDesc,
                  COL_IMGSHORTCODE=>$img->ImgShortcode,
                  COL_ISHEADER=>$img->IsHeader,
                  COL_ISTHUMBNAIL=>$img->IsThumbnail
                );
                $i++;
              }
            }
          } else {
            ShowJsonError('Media file empty.');
            exit();
          }

          if(empty($arrMedia)) {
            ShowJsonError(json_encode($arrPostImages));
            exit();
          }*/

          $data = array(
            COL_POSTCATEGORYID => $this->input->post(COL_POSTCATEGORYID),
            COL_POSTTITLE => $this->input->post(COL_POSTTITLE),
            COL_POSTSLUG => slugify($this->input->post(COL_POSTTITLE)),
            COL_POSTCONTENT => $this->input->post(COL_POSTCONTENT),
            COL_POSTMETATAGS => !empty($arrTags)?implode(",", $arrTags):null,
            COL_ISSUSPEND => ($this->input->post(COL_ISSUSPEND) ? $this->input->post(COL_ISSUSPEND) : false),
            COL_ISRUNNINGTEXT => ($this->input->post(COL_ISRUNNINGTEXT) ? $this->input->post(COL_ISRUNNINGTEXT) : false),
            COL_UPDATEDBY => $user[COL_USERNAME],
            COL_UPDATEDON => date('Y-m-d H:i:s')
          );

          $this->db->trans_begin();
          try {
            $res = $this->db->where(COL_POSTID, $id)->update(TBL__POSTS, $data);
            if(!$res) {
              throw new Exception('Gagal mengubah konten.');
            }

            $res = $this->db->where(COL_POSTID, $id)->where_not_in(COL_POSTIMAGEID, $arrPostImagesExist)->delete(TBL__POSTIMAGES);
            if(!$res) {
              throw new Exception('Gagal menginput konten.');
            }

            if(!empty($arrMedia)){
              $res = $this->db->insert_batch(TBL__POSTIMAGES, $arrMedia);
              if(!$res) {
                throw new Exception('Gagal menginput konten.');
              }
            }
          } catch(Exception $ex) {
            $this->db->trans_rollback();
            ShowJsonError($ex->getMessage());
            exit();
          }

          $this->db->trans_commit();
          ShowJsonSuccess('Konten berhasil diinput.', array('redirect'=>site_url('site/post/index/'.$data[COL_POSTCATEGORYID])));
          exit();
        }
        else {
          ShowJsonError(validation_errors());
          exit();
        }
      }
      else {
          $this->template->load('backend' , 'post/form', $data);
      }
  }

  function delete(){
      if(!IsLogin() || GetLoggedUser()[COL_ROLEID] != ROLEADMIN) {
          //redirect('site/user/dashboard');
      }
      $data = $this->input->post('cekbox');
      $deleted = 0;
      foreach ($data as $datum) {
        $this->db->delete(TBL__POSTS, array(COL_POSTID => $datum));
        $deleted++;

        $files = $this->db->delete(TBL__POSTIMAGES, array(COL_POSTID=>$datum));
      }
      if($deleted){
          ShowJsonSuccess($deleted." data dihapus");
      }else{
          ShowJsonError("Tidak ada dihapus");
      }
  }

  function activate($suspend=false) {
      if(!IsLogin() || GetLoggedUser()[COL_ROLEID] != ROLEADMIN) {
          redirect('site/user/dashboard');
      }

      if(!IsLogin()) {
          ShowJsonError('Silahkan login terlebih dahulu');
          return;
      }
      $loginuser = GetLoggedUser();
      if(!$loginuser || $loginuser[COL_ROLEID] != ROLEADMIN) {
          ShowJsonError('Anda tidak memiliki akses terhadap modul ini.');
          return;
      }
      $data = $this->input->post('cekbox');
      $deleted = 0;
      foreach ($data as $datum) {
          if($this->db->where(COL_POSTID, $datum)->update(TBL__POSTS, array(COL_ISSUSPEND=>$suspend))) {
              $deleted++;
          }
      }
      if($deleted){
          ShowJsonSuccess($deleted." data diubah");
      }else{
          ShowJsonError("Tidak ada data yang diubah");
      }
  }
}
 ?>
