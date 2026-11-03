<?php
class Request extends MY_Controller {
  function __construct() {
    parent::__construct();
    if(!IsLogin()) {
      redirect('user/dashboard');
    }
  }

  public function index($stat="") {
    $ruser = GetLoggedUser();
    $stat = strtolower($stat);
    $data['title'] = "Permohonan Izin";
    $data['stat'] = $stat;
    if($ruser[COL_ROLEID]==ROLEADMIN) {
      $this->template->load('backend' , 'request/index', $data);
    } else {
      $data['res'] = $this->db
      ->select('trequest.*, mcert.IzinNama')
      ->join(TBL_MCERT,TBL_MCERT.'.'.COL_UNIQ." = ".TBL_TREQUEST.".".COL_IZINID,"inner")
      ->where(COL_USERNAME, $ruser[COL_USERNAME])
      ->order_by(TBL_TREQUEST.".".COL_CREATEDON, 'desc')
      ->get(TBL_TREQUEST)
      ->result_array();
      $this->template->load('finance' , 'request/list', $data);
    }
  }

  public function index_load($stat='') {
    $ruser = GetLoggedUser();

    $start = $_POST['start'];
    $rowperpage = $_POST['length'];
    //$questStatus = !empty($_POST['filterStatus'])?$_POST['filterStatus']:null;
    //$dateFrom = !empty($_POST['dateFrom'])?$_POST['dateFrom']:date('Y-m-01');
    //$dateTo = !empty($_POST['dateTo'])?$_POST['dateTo']:date('Y-m-d');

    $orderdef = array(COL_CREATEDON=>'desc');
    $orderables = array(null,COL_CREATEDON,COL_UPDATEDON,COL_NAME,COL_IDENTITYNO,COL_IZINNAMA);
    $cols = array(COL_NAME,COL_IDENTITYNO,COL_IZINNAMA);

    if(!empty($stat)) {
      $this->db->where(COL_REQSTATUS,$stat);
    }

    $queryAll = $this->db->get(TBL_TREQUEST);

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

    if(!empty($_POST['order'])){
      if($_POST['order']==COL_CREATEDON) $this->db->order_by(TBL_TREQUEST.'.'.COL_CREATEDON, $_POST['order']['0']['dir']);
      else $this->db->order_by($orderables[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    }else if(!empty($orderdef)){
      $order = $orderdef;
      $this->db->order_by(key($order), $order[key($order)]);
    }

    if(!empty($stat)) {
      $this->db->where(COL_REQSTATUS,$stat);
    }

    $q = $this->db
    ->select('trequest.*, _userinformation.Name, _userinformation.IdentityNo, mcert.IzinNama')
    ->join(TBL_MCERT,TBL_MCERT.'.'.COL_UNIQ." = ".TBL_TREQUEST.".".COL_IZINID,"inner")
    ->join(TBL__USERINFORMATION,TBL__USERINFORMATION.'.'.COL_USERNAME." = ".TBL_TREQUEST.".".COL_USERNAME,"inner")
    ->order_by(TBL_TREQUEST.'.'.COL_CREATEDON, 'desc')
    ->get_compiled_select(TBL_TREQUEST, FALSE);
    $rec = $this->db->query($q." LIMIT $rowperpage OFFSET $start");
    $data = [];

    foreach($rec->result_array() as $r) {
      $data[] = array(
        '<a href="'.site_url('site/request/detail/'.$r[COL_UNIQ]).'" class="btn btn-xs btn-outline-primary"><i class="fas fa-search"></i>&nbsp;LIHAT</a>',
        date('Y-m-d H:i', strtotime($r[COL_CREATEDON])),
        !empty($r[COL_UPDATEDON])?date('Y-m-d H:i', strtotime($r[COL_UPDATEDON])):'-',
        $r[COL_NAME],
        $r[COL_IDENTITYNO],
        $r[COL_IZINNAMA],
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

  public function add($certid="") {
    $ruser = GetLoggedUser();
    $data['certid'] = $certid;
    $data['title'] = "Permohonan Izin";
    $data['mcert'] = $this->db->order_by(COL_IZINNAMA, 'asc')->get(TBL_MCERT)->result_array();

    if(!empty($_POST)) {
      $config['upload_path'] = MY_UPLOADPATH.'request/';
      $config['allowed_types'] = "jpg|jpeg|png|pdf";
      $config['max_size']	= 102400;
      $config['overwrite'] = FALSE;

      $fileAttachment = '';
      $this->load->library('upload',$config);
      if(!empty($_FILES) && !empty($_FILES[COL_REQFILE1]['name'])) {
        $res = $this->upload->do_upload(COL_REQFILE1);
        if(!$res) {
          $err = $this->upload->display_errors('', '');
          ShowJsonError($err);
          exit();
        }
        $upl = $this->upload->data();
        $fileAttachment = $upl['file_name'];
      }

      if(empty($certid)) {
        ShowJsonError('Parameter tidak valid!');
        exit();
      }

      $dat = array(
        COL_USERNAME=>$this->input->post(COL_USERNAME),
        COL_IZINID=>$certid,
        COL_REQREMARKS=>$this->input->post(COL_REQREMARKS),
        COL_REQSTATUS=>'DITERIMA',
        COL_REQFILE1=>!empty($fileAttachment)?$fileAttachment:null,
        COL_CREATEDBY=>$ruser[COL_USERNAME],
        COL_CREATEDON=>date('Y-m-d H:i:s')
      );

      $this->db->trans_begin();
      try {
        $res = $this->db->insert(TBL_TREQUEST, $dat);
        if(!$res) {
          $err = $this->db->error();
          throw new Exception($err['message']);
        }

        $reqID = $this->db->insert_id();
        $res = $this->db->insert(TBL_TREQUEST_LOG, array(
          COL_REQID=>$reqID,
          COL_REQSTATUS=>'DITERIMA',
          COL_CREATEDBY=>$ruser[COL_USERNAME],
          COL_CREATEDON=>date('Y-m-d H:i:s')
        ));
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
      ShowJsonSuccess('Permohonan anda telah diinput. Mengalihkan...', array('redirect'=>site_url('site/request/index')));
    } else {
      $this->template->load('finance' , 'request/add', $data);
    }
  }

  public function detail($id) {
    $ruser = GetLoggedUser();
    $data['title'] = 'Detil Permohonan Izin';
    $data['res'] = $res = $rdata = $this->db
    ->select('trequest.*, mcert.IzinNama,_userinformation.Name,_userinformation.Email,_userinformation.PhoneNo,_userinformation.IdentityNo')
    ->join(TBL__USERINFORMATION,TBL__USERINFORMATION.'.'.COL_USERNAME." = ".TBL_TREQUEST.".".COL_USERNAME,"inner")
    ->join(TBL_MCERT,TBL_MCERT.'.'.COL_UNIQ." = ".TBL_TREQUEST.".".COL_IZINID,"inner")
    ->where(TBL_TREQUEST.".".COL_UNIQ, $id)
    ->get(TBL_TREQUEST)
    ->row_array();

    if(empty($res)) {
      show_error('Parameter tidak valid!');
      exit();
    }
    if($ruser[COL_ROLEID]==ROLEPUBLIC && $ruser[COL_USERNAME]!=$res[COL_USERNAME]) {
      show_error('Parameter tidak valid!');
      exit();
    }

    if(!empty($_POST)) {
      $config['upload_path'] = MY_UPLOADPATH.'request/';
      $config['allowed_types'] = "jpg|jpeg|png|pdf";
      $config['max_size']	= 102400;
      $config['overwrite'] = FALSE;

      if($ruser[COL_ROLEID]!=ROLEADMIN) {
        show_error('Maaf, anda tidak memiliki akses!');
        exit();
      }

      $fileAttachment = '';
      $this->load->library('upload',$config);
      if(!empty($_FILES) && !empty($_FILES[COL_REQFILE3]['name'])) {
        $res = $this->upload->do_upload(COL_REQFILE3);
        if(!$res) {
          $err = $this->upload->display_errors('', '');
          ShowJsonError($err);
          exit();
        }
        $upl = $this->upload->data();
        $fileAttachment = $upl['file_name'];
      }

      $dat = array(
        COL_REQID=>$id,
        COL_REQREMARKS=>$this->input->post(COL_REQREMARKS),
        COL_REQSTATUS=>$this->input->post(COL_REQSTATUS),
        COL_CREATEDON=>date('Y-m-d H:i:s'),
        COL_CREATEDBY=>$ruser[COL_USERNAME]
      );

      $dat2 = array(
        COL_REQSTATUS=>$this->input->post(COL_REQSTATUS),
        COL_UPDATEDON=>date('Y-m-d H:i:s'),
        COL_UPDATEDBY=>$ruser[COL_USERNAME]
      );
      if(!empty($fileAttachment)) {
        $dat2[COL_REQFILE3] = $fileAttachment;
      }

      $this->db->trans_begin();
      try {
        $res = $this->db->insert(TBL_TREQUEST_LOG, $dat);
        if(!$res) {
          throw new Exception('Mohon maaf, sedang terjadi kendala pada sistem kami. Silakan mencoba beberapa saat lagi.');
        }

        $res = $this->db->where(COL_UNIQ, $id)->update(TBL_TREQUEST, $dat2);
        if(!$res) {
          throw new Exception('Mohon maaf, sedang terjadi kendala pada sistem kami. Silakan mencoba beberapa saat lagi.');
        }
      } catch(Exception $ex) {
        $this->db->trans_rollback();
        ShowJsonError($ex->getMessage());
        exit();
      }

      $this->db->trans_commit();
      ShowJsonSuccess('Permohonan berhasil diperbarui.', array('redirect'=>site_url('site/request/index/'.strtolower($rdata[COL_REQSTATUS]))));
      exit();
    }

    if($ruser[COL_ROLEID]==ROLEPUBLIC) {
      $this->template->load('finance' , 'request/detail', $data);
    } else {
      $this->template->load('backend' , 'request/form', $data);
    }

  }
}
