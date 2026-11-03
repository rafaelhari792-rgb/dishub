<?php
class Setting extends MY_Controller
{
  public function __construct()
  {
      parent::__construct();
      if (!IsLogin()) {
          redirect('site/user/login');
      }
      if (GetLoggedUser()[COL_ROLEID]!=ROLEADMIN) {
          show_error('Anda tidak memiliki akses terhadap modul ini.');
          return;
      }
  }

  public function common() {
    $data['title'] = 'Pengaturan Umum';
    $this->template->load('backend' , 'setting/common', $data);
  }

  public function change() {
    $rsetting = $this->db->get(TBL__SETTINGS)->result_array();
    $rcontact = $this->db->get(TBL_MCONTACT)->result_array();
    $this->db->trans_begin();
    try {
      foreach($rsetting as $r) {
        if(isset($_POST[$r[COL_SETTINGLABEL]])) {
          $res = $this->db->where(COL_SETTINGLABEL, $r[COL_SETTINGLABEL])->update(TBL__SETTINGS, array(COL_SETTINGVALUE=>$_POST[$r[COL_SETTINGLABEL]]));
          if(!$res) {
            $err = $this->db->error();
            throw new Exception($err['message']);
          }
        }
      }
      foreach($rcontact as $r) {
        if(isset($_POST["CONTACTTEXT_".$r[COL_UNIQ]])) {
          $res = $this->db
          ->where(COL_UNIQ, $r[COL_UNIQ])
          ->update(TBL_MCONTACT, array(COL_CONTACTTEXT=>!empty($_POST["CONTACTTEXT_".$r[COL_UNIQ]])?$_POST["CONTACTTEXT_".$r[COL_UNIQ]]:null, COL_CONTACTURL=>!empty($_POST["CONTACTLINK_".$r[COL_UNIQ]])?$_POST["CONTACTLINK_".$r[COL_UNIQ]]:null));
          if(!$res) {
            $err = $this->db->error();
            throw new Exception($err['message']);
          }
        }
      }
      $this->db->trans_commit();
      ShowJsonSuccess('Perubahan pengaturan berhasil.');
      exit();
    } catch(Exception $ex) {
      $this->db->trans_rollback();
      ShowJsonError($ex->getMessage());
      exit();
    }
  }

  public function homepage($uniq='') {
    $data['title'] = 'Pengaturan Homepage';
    if(!empty($uniq)) {
      $config['upload_path'] = MY_UPLOADPATH;
      $config['allowed_types'] = "gif|jpg|jpeg|png|pdf";
      $config['overwrite'] = FALSE;
      $this->load->library('upload',$config);

      $filename = '';
      if(!empty($_FILES) && !empty($_FILES['ContentDesc2'])){
        if(!$this->upload->do_upload('ContentDesc2')) {
          show_error($this->upload->display_errors());
          exit();
        }
        $file = $this->upload->data();
        $filename = $file['file_name'];
      }
      $rec = array(
        COL_CONTENTDESC1=>isset($_POST[COL_CONTENTDESC1])?$_POST[COL_CONTENTDESC1]:null,
        COL_CONTENTDESC3=>isset($_POST[COL_CONTENTDESC3])?$_POST[COL_CONTENTDESC3]:null,
        COL_CONTENTDESC4=>isset($_POST[COL_CONTENTDESC4])?$_POST[COL_CONTENTDESC4]:null
      );
      if(!empty($filename)) {
        $rec[COL_CONTENTDESC2] = $filename;
      }
      $res = $this->db->where(COL_UNIQ, $uniq)->update(TBL__HOMEPAGE, $rec);
      redirect('site/setting/homepage');
    } else {
      $this->template->load('backend' , 'setting/homepage', $data);
    }
  }
}
