<?php
class Master extends MY_Controller
{
  public function __construct()
  {
    parent::__construct();
    if(!IsLogin()) {
        redirect('site/user/login');
    }
    if(GetLoggedUser()[COL_ROLEID]!=ROLEADMIN) {
      show_error('Anda tidak memiliki akses terhadap modul ini.');
      exit();
    }
  }

  public function pegawai() {
    $data['title'] = "Pegawai";
    $data['res'] = $this->db
    ->order_by(COL_PEGNOURUT, 'asc')
    ->get(TBL_MPEGAWAI)
    ->result_array();
    $this->template->load('backend' , 'master/pegawai', $data);
  }

  public function pegawai_add() {
    if(!empty($_POST)) {
      $nmfile = null;
      if (!empty($_FILES['userfile']['name'])) {
        $config['upload_path'] = MY_UPLOADPATH.'pegawai/';
        $config['allowed_types'] = "jpg|jpeg|png|pdf|doc|docx|xls|xlsx";
        $config['max_size']	= 10240;
        $config['overwrite'] = FALSE;

        $this->load->library('upload',$config);
        $res = $this->upload->do_upload('userfile');
        if(!$res) {
          $err = $this->upload->display_errors('', '');
          ShowJsonError($err);
          exit();
        }
        $upl = $this->upload->data();
        $nmfile = $upl['file_name'];
      }

      $dat = array(
        COL_PEGNAMA=>$this->input->post(COL_PEGNAMA),
        COL_PEGNOURUT=>$this->input->post(COL_PEGNOURUT),
        COL_PEGNIP=>$this->input->post(COL_PEGNIP),
        COL_PEGJABATAN=>$this->input->post(COL_PEGJABATAN),
        COL_PEGKATEGORI=>$this->input->post(COL_PEGKATEGORI),
        COL_PEGISAKTIF=>$this->input->post(COL_PEGISAKTIF),
        COL_PEGIMGPATH=>$nmfile
      );
      $this->db->trans_begin();
      try {
        $res = $this->db->insert(TBL_MPEGAWAI, $dat);
        if(!$res) {
          $err = $this->db->error();
          throw new Exception('Error: '.$err['message']);
        }

        $this->db->trans_commit();
        ShowJsonSuccess('Berhasil menambah pegawai an. '.$dat[COL_PEGNAMA]);
        exit();
      } catch(Exception $ex) {
        $this->db->trans_rollback();
        ShowJsonError($ex->getMessage());
        return;
      }
    } else {
      $this->load->view('master/pegawai-form');
    }
  }

  public function pegawai_edit($id) {
    $rdata = $this->db->where(COL_UNIQ, $id)->get(TBL_MPEGAWAI)->row_array();
    if(empty($rdata)) {
      show_error('Parameter tidak valid.');
      exit();
    }

    if(!empty($_POST)) {
      $nmfile = $rdata[COL_PEGIMGPATH];
      if (!empty($_FILES['userfile']['name'])) {
        $config['upload_path'] = MY_UPLOADPATH.'pegawai/';
        $config['allowed_types'] = "jpg|jpeg|png|pdf|doc|docx|xls|xlsx";
        $config['max_size']	= 10240;
        $config['overwrite'] = FALSE;

        $this->load->library('upload',$config);
        $res = $this->upload->do_upload('userfile');
        if(!$res) {
          $err = $this->upload->display_errors('', '');
          ShowJsonError($err);
          exit();
        }
        $upl = $this->upload->data();
        $nmfile = $upl['file_name'];
      }

      $dat = array(
        COL_PEGNAMA=>$this->input->post(COL_PEGNAMA),
        COL_PEGNOURUT=>$this->input->post(COL_PEGNOURUT),
        COL_PEGNIP=>$this->input->post(COL_PEGNIP),
        COL_PEGJABATAN=>$this->input->post(COL_PEGJABATAN),
        COL_PEGKATEGORI=>$this->input->post(COL_PEGKATEGORI),
        COL_PEGISAKTIF=>$this->input->post(COL_PEGISAKTIF),
        COL_PEGIMGPATH=>$nmfile
      );
      $this->db->trans_begin();
      try {
        $res = $this->db->where(COL_UNIQ, $id)->update(TBL_MPEGAWAI, $dat);
        if(!$res) {
          $err = $this->db->error();
          throw new Exception('Error: '.$err['message']);
        }

        $this->db->trans_commit();
        ShowJsonSuccess('Berhasil memperbarui data pegawai an. '.$dat[COL_PEGNAMA]);
        exit();
      } catch(Exception $ex) {
        $this->db->trans_rollback();
        ShowJsonError($ex->getMessage());
        return;
      }
    } else {
      $data['data'] = $rdata;
      $this->load->view('master/pegawai-form', $data);
    }
  }

  public function pegawai_delete($id) {
    $rdata = $this->db->where(COL_UNIQ, $id)->get(TBL_MPEGAWAI)->row_array();
    if(empty($rdata)) {
      ShowJsonError('Parameter tidak valid.');
      exit();
    }

    $res = $this->db->where(COL_UNIQ, $id)->delete(TBL_MPEGAWAI);
    if(!$res) {
      ShowJsonError('Gagal menghapus data.');
      exit();
    }

    if(!empty($rdata[COL_PEGIMGPATH])&&file_exists(MY_UPLOADPATH.'pegawai/'.$rdata[COL_PEGIMGPATH])) {
      unlink(MY_UPLOADPATH.'pegawai/'.$rdata[COL_PEGIMGPATH]);
    }

    ShowJsonSuccess('Berhasil menghapus data pegawai an. '.$rdata[COL_PEGNAMA]);
    exit();
  }

  public function ormas() {
    $data['title'] = "Organisasi Kemasyarakatan";
    $this->template->load('backend' , 'master/ormas', $data);
  }

  public function ormas_load() {
    $start = $_POST['start'];
    $rowperpage = $_POST['length'];
    $filterStatus = !empty($_POST['filterStatus'])?$_POST['filterStatus']:null;
    $filterKategori = !empty($_POST['filterKategori'])?$_POST['filterKategori']:null;

    $ruser = GetLoggedUser();
    $orderdef = array(COL_ORGNAMA=>'asc');
    $orderables = array(null,COL_ORGNAMA,COL_ORGKATEGORI,COL_ORGALAMAT,COL_ORGPERIODEFROM);
    $cols = array(COL_ORGNAMA,COL_ORGKATEGORI,COL_ORGALAMAT,COL_ORGNOSK1,COL_ORGNOSK2);

    $queryAll = $this->db->get(TBL_MORGANISASI);

    $i = 0;
    foreach($cols as $item){
      if(!empty($_POST['search']['value'])){
        if($i===0) {
          $this->db->group_start();
          $this->db->like($item, $_POST['search']['value']);
        } else {
          $this->db->or_like($item, $_POST['search']['value']);
        }
        if(count($cols) - 1 == $i){
          $this->db->group_end();
        }
      }
      $i++;
    }

    if(!empty($filterStatus)) {
      if($filterStatus==1) {
        $this->db->where(COL_ORGPERIODETO." >= ", date('Y'));
      } else {
        $this->db->where(COL_ORGPERIODETO." < ", date('Y'));
      }
    }
    if(!empty($filterKategori)) {
      $this->db->where(COL_ORGKATEGORI, $filterKategori);
    }

    if(!empty($_POST['order'])){
      $order = $orderables[$_POST['order']['0']['column']];
      $this->db->order_by($order, $_POST['order']['0']['dir']);
    }else if(!empty($orderdef)){
      $order = $orderdef;
      $this->db->order_by(key($order), $order[key($order)]);
    }

    $q = $this->db->get_compiled_select(TBL_MORGANISASI, FALSE);
    $rec = $this->db->query($q." LIMIT $rowperpage OFFSET $start");
    $data = [];

    foreach($rec->result_array() as $r) {
      $htmlBtn = '';
      $htmlBtn .= '<a href="'.site_url('site/master/ormas-edit/'.$r[COL_UNIQ]).'" class="btn btn-xs btn-outline-primary btn-edit"><i class="fas fa-edit"></i></a>&nbsp;';
      $htmlBtn .= '<a href="'.site_url('site/master/ormas-delete/'.$r[COL_UNIQ]).'" class="btn btn-xs btn-outline-danger btn-action"><i class="fas fa-times-circle"></i></a>';

      $data[] = array(
        $htmlBtn,
        $r[COL_ORGNAMA],
        $r[COL_ORGKATEGORI],
        $r[COL_ORGPERIODEFROM].' - '.$r[COL_ORGPERIODETO],
        $r[COL_ORGNOSK1].' / '.$r[COL_ORGNOSK2]
      );
    }

    $result = array(
      "draw" => $_POST['draw'],
      "recordsFiltered" => $this->db->query($q)->num_rows(),
      "recordsTotal" => $queryAll->num_rows(),
      "data" => $data,
    );

    echo json_encode($result);
    exit();
  }

  public function ormas_add() {
    $ruser = GetLoggedUser();
    if(!empty($_POST)) {
      $dat = array(
        COL_ORGNAMA=>$this->input->post(COL_ORGNAMA),
        COL_ORGKATEGORI=>$this->input->post(COL_ORGKATEGORI),
        COL_ORGALAMAT=>$this->input->post(COL_ORGALAMAT),
        COL_ORGPERIODEFROM=>$this->input->post(COL_ORGPERIODEFROM),
        COL_ORGPERIODETO=>$this->input->post(COL_ORGPERIODETO),
        COL_ORGKETUA=>$this->input->post(COL_ORGKETUA),
        COL_ORGSEKRETARIS=>$this->input->post(COL_ORGSEKRETARIS),
        COL_ORGBENDAHARA=>$this->input->post(COL_ORGBENDAHARA),
      );

      $this->db->trans_begin();
      try {
        $res = $this->db->insert(TBL_MORGANISASI, $dat);
        if(!$res) {
          $err = $this->db->error();
          throw new Exception($err['message']);
        }
      } catch(Exception $ex) {
        $this->db->trans_rollback();
        ShowJsonError($ex->getMessage());
        exit();
      }

      $this->db->trans_commit();
      ShowJsonSuccess('Data berhasil ditambahkan.', array('redirect'=>site_url('site/master/ormas')));
      exit();
    } else {
      $data['title'] = 'Organisasi Kemasyarakatan';
      $this->template->load('backend' , 'master/ormas-form', $data);
    }
  }

  public function ormas_edit($id) {
    $rdata = $this->db->where(COL_UNIQ, $id)->get(TBL_MORGANISASI)->row_array();
    if(empty($rdata)) {
      show_error('Parameter tidak valid.');
      exit();
    }

    if(!empty($_POST)) {
      $dat = array(
        COL_ORGNAMA=>$this->input->post(COL_ORGNAMA),
        COL_ORGKATEGORI=>$this->input->post(COL_ORGKATEGORI),
        COL_ORGALAMAT=>$this->input->post(COL_ORGALAMAT),
        COL_ORGPERIODEFROM=>$this->input->post(COL_ORGPERIODEFROM),
        COL_ORGPERIODETO=>$this->input->post(COL_ORGPERIODETO),
        COL_ORGKETUA=>$this->input->post(COL_ORGKETUA),
        COL_ORGSEKRETARIS=>$this->input->post(COL_ORGSEKRETARIS),
        COL_ORGBENDAHARA=>$this->input->post(COL_ORGBENDAHARA),
        COL_ORGNOSK1=>$this->input->post(COL_ORGNOSK1),
        COL_ORGNOSK2=>$this->input->post(COL_ORGNOSK2),
      );
      $this->db->trans_begin();
      try {
        $res = $this->db->where(COL_UNIQ, $id)->update(TBL_MORGANISASI, $dat);
        if(!$res) {
          $err = $this->db->error();
          throw new Exception('Error: '.$err['message']);
        }

        $this->db->trans_commit();
        ShowJsonSuccess('Berhasil memperbarui data.', array('redirect'=>site_url('site/master/ormas')));
        exit();
      } catch(Exception $ex) {
        $this->db->trans_rollback();
        ShowJsonError($ex->getMessage());
        return;
      }
    } else {
      $data['title'] = 'Organisasi Kemasyarakatan';
      $data['data'] = $rdata;
      $this->template->load('backend' , 'master/ormas-form', $data);
    }
  }

  public function ormas_delete($id) {
    $rdata = $this->db->where(COL_UNIQ, $id)->get(TBL_MORGANISASI)->row_array();
    if(empty($rdata)) {
      ShowJsonError('Parameter tidak valid.');
      exit();
    }

    $res = $this->db->where(COL_UNIQ, $id)->delete(TBL_MORGANISASI);
    if(!$res) {
      ShowJsonError('Gagal menghapus data.');
      exit();
    }

    ShowJsonSuccess('Berhasil menghapus data.');
    exit();
  }
}
