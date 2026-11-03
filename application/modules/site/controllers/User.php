<?php
class User extends MY_Controller {
  function __construct() {
      parent::__construct();
      //$this->load->library('encrypt');
      $this->load->model('muser');
      if(IsLogin() && GetLoggedUser()[COL_ROLEID] != ROLEADMIN) {
        //redirect('site/home');
      }
  }

  function index() {
    $data['title'] = "Daftar Pengguna";
    $this->template->load('backend', 'user/index', $data);
  }

  public function index_load() {
    $start = $_POST['start'];
    $rowperpage = $_POST['length'];
    $userStatus = !empty($_POST['filterStatus'])?$_POST['filterStatus']:null;

    $ruser = GetLoggedUser();
    $orderdef = array(COL_REGDATE=>'desc');
    $orderables = array(null,COL_USERNAME,COL_NAME,null,null,COL_REGDATE);
    $cols = array(COL_USERNAME, COL_NAME, COL_PHONENO);

    $queryAll = $this->db
    //->where(COL_ROLEID, ROLEUSER)
    ->get(TBL__USERS);

    $i = 0;
    foreach($cols as $item){
      if($item == COL_USERNAME) {
        $item = TBL__USERS.".".COL_USERNAME;
      }
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

    /*if(!empty($dateFrom)) {
      $this->db->where(TBL_TSTOCKDISTRIBUTION.'.'.COL_DATEDISTRIBUTION.' >= ', $dateFrom);
    }
    if(!empty($dateTo)) {
      $this->db->where(TBL_TSTOCKDISTRIBUTION.'.'.COL_DATEDISTRIBUTION.' <= ', $dateTo);
    }*/

    if(!empty($userStatus)) {
      if($userStatus==1) {
        $this->db->where(COL_ISSUSPEND, 0);
      } else {
        $this->db->where(COL_ISSUSPEND, 1);
      }
    }

    if(!empty($_POST['order'])){
      $order = $orderables[$_POST['order']['0']['column']];
      if($order == COL_USERNAME) {
        $order = TBL__USERS.".".COL_USERNAME;
      }
      $this->db->order_by($order, $_POST['order']['0']['dir']);
    }else if(!empty($orderdef)){
      $order = $orderdef;
      $this->db->order_by(key($order), $order[key($order)]);
    }

    $q = $this->db
    ->select('*, _users.Uniq as ID')
    ->join(TBL__USERINFORMATION,TBL__USERINFORMATION.'.'.COL_USERNAME." = ".TBL__USERS.".".COL_USERNAME,"inner")
    //->where(COL_ROLEID, ROLEUSER)
    ->get_compiled_select(TBL__USERS, FALSE);
    $rec = $this->db->query($q." LIMIT $rowperpage OFFSET $start");
    $data = [];

    foreach($rec->result_array() as $r) {
      $htmlBtn = '';
      $htmlBtn .= '<a href="'.site_url('site/user/edit/'.$r['ID']).'" class="btn btn-xs btn-outline-primary btn-edit"><i class="fas fa-edit"></i>&nbsp;UBAH</a>&nbsp;';
      if($r[COL_ISSUSPEND]==0) {
        $htmlBtn .= '<a href="'.site_url('site/user/activation/'.$r['ID'].'/0').'" class="btn btn-xs btn-outline-danger btn-action"><i class="fas fa-times-circle"></i>&nbsp;SUSPEND</a>';
      } else {
        $htmlBtn .= '<a href="'.site_url('site/user/activation/'.$r['ID'].'/1').'" class="btn btn-xs btn-outline-success btn-action"><i class="fas fa-check-circle"></i>&nbsp;AKTIFKAN</a>';
      }

      $data[] = array(
        $htmlBtn,
        $r[COL_USERNAME],
        $r[COL_NAME],
        $r[COL_PHONENO],
        ($r[COL_ISSUSPEND]==0?'<i class="far fa-check-circle text-success"></i>':'<i class="far fa-times-circle text-danger"></i>'),
        date('Y-m-d', strtotime($r[COL_REGDATE]))
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
  public function add() {
    if(!IsLogin()) {
      redirect('site/user/login');
    }

    $ruser = GetLoggedUser();
    if(!empty($_POST)) {
      if($ruser[COL_ROLEID] != ROLEADMIN) {
        ShowJsonError('ANDA TIDAK MEMILIKI HAK AKSES.');
        exit();
      }
      $rexist = $this->db
      ->where(COL_USERNAME, $this->input->post(COL_EMAIL))
      ->get(TBL__USERS)
      ->row_array();
      if(!empty($rexist)) {
        ShowJsonError('Maaf, alamat email <strong>'.$rexist[COL_EMAIL].'</strong> telah terdaftar.');
        exit();
      }

      $data1 = array(
        COL_NAME=>$this->input->post(COL_NAME),
        COL_USERNAME=>$this->input->post(COL_EMAIL),
        COL_EMAIL=>$this->input->post(COL_EMAIL),
        COL_PHONENO=>$this->input->post(COL_PHONENO),
        COL_IDENTITYNO=>$this->input->post(COL_IDENTITYNO),
        COL_REGDATE=>date('Y-m-d')
      );
      $data2 = array(
        COL_USERNAME=>$this->input->post(COL_EMAIL),
        COL_PASSWORD=>md5($this->input->post(COL_PASSWORD)),
        COL_ROLEID=>$this->input->post(COL_ROLEID),
      );

      $this->db->trans_begin();
      try {
        $res = $this->db->insert(TBL__USERS, $data2);
        if(!$res) {
          $err = $this->db->error();
          throw new Exception($err['message']);
        }
        $res = $this->db->insert(TBL__USERINFORMATION, $data1);
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
      ShowJsonSuccess('BERHASIL!');
      exit();
    } else {
      if($ruser[COL_ROLEID] != ROLEADMIN) {
        show_error('ANDA TIDAK MEMILIKI HAK AKSES.');
        exit();
      }
      $this->load->view('site/user/form');
    }
  }

  public function edit($id) {
    if(!IsLogin()) {
      redirect('site/user/login');
    }

    $ruser = GetLoggedUser();

    $data['data'] = $rdata = $this->db
    ->join(TBL__USERINFORMATION,TBL__USERINFORMATION.'.'.COL_USERNAME." = ".TBL__USERS.".".COL_USERNAME,"inner")
    ->where(TBL__USERS.".".COL_UNIQ, $id)
    ->get(TBL__USERS)
    ->row_array();

    if(empty($data)) {
      ShowJsonError('PARAMETER TIDAK VALID');
      exit();
    }

    if(!empty($_POST)) {
      if($ruser[COL_ROLEID] != ROLEADMIN) {
        ShowJsonError('ANDA TIDAK MEMILIKI HAK AKSES.');
        exit();
      }

      $data1 = array(
        COL_NAME=>$this->input->post(COL_NAME),
        COL_PHONENO=>$this->input->post(COL_PHONENO),
        COL_IDENTITYNO=>$this->input->post(COL_IDENTITYNO)
      );
      $data2 = array(
        COL_ROLEID=>$this->input->post(COL_ROLEID),
      );
      $_pwd = $this->input->post(COL_PASSWORD);
      if(!empty($_pwd)) {
        $data2[COL_PASSWORD] = md5($this->input->post(COL_PASSWORD));
      }

      $this->db->trans_begin();
      try {
        $res = $this->db->where(COL_UNIQ, $id)->update(TBL__USERS, $data2);
        if(!$res) {
          $err = $this->db->error();
          throw new Exception($err['message']);
        }
        $res = $this->db->where(COL_UNIQ, $id)->update(TBL__USERINFORMATION, $data1);
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
      ShowJsonSuccess('BERHASIL!');
      exit();
    } else {
      if($ruser[COL_ROLEID] != ROLEADMIN) {
        show_error('ANDA TIDAK MEMILIKI HAK AKSES.');
        exit();
      }

      $this->load->view('site/user/form', $data);
    }
  }

  public function activation($id, $stat=0) {
    $res = $this->db->where(COL_UNIQ, $id)->update(TBL__USERS, array(COL_ISSUSPEND=>$stat==0?1:0));
    if(!$res) {
      $err = $this->db->error();
      ShowJsonError($err['message']);
      exit();
    }

    ShowJsonSuccess('BERHASIL!');
    exit();
  }

  function Login(){
    if(IsLogin()) {
      redirect('site/user/dashboard');
    }
    if(!empty($_POST)) {
      $this->form_validation->set_rules(array(
        array(
          'field' => 'UserName',
          'label' => 'UserName',
          'rules' => 'required'
        ),
        array(
          'field' => 'Password',
          'label' => 'Password',
          'rules' => 'required'
        )
      ));
      if($this->form_validation->run()) {
        $username = $this->input->post(COL_USERNAME);
        $password = $this->input->post(COL_PASSWORD);

        $ruser = $this->db
        ->join(TBL__USERINFORMATION,TBL__USERINFORMATION.'.'.COL_USERNAME." = ".TBL__USERS.".".COL_USERNAME,"inner")
        ->join(TBL__ROLES,TBL__ROLES.'.'.COL_ROLEID." = ".TBL__USERS.".".COL_ROLEID,"inner")
        ->where(TBL__USERS.".".COL_USERNAME,$username)
        ->where(COL_PASSWORD,md5($password))
        ->get(TBL__USERS)
        ->row_array();

        if(empty($ruser)) {
          ShowJsonError('Maaf, username / password yang anda masukkan tidak valid. Silakan coba kembali.');
          exit();
        }
        if($ruser[COL_ROLEID]!=ROLEADMIN) {
          /*if($ruser[COL_ISEMAILVERIFIED]!=1) {
            ShowJsonError('Maaf, email anda belum terverifikasi. Silakan hubungi administrator.');
            exit();
          }*/

          if($ruser[COL_ISSUSPEND]==1) {
            ShowJsonError('Maaf, akun anda untuk sementara di SUSPEND. Silakan hubungi administrator.');
            exit();
          }
        }

        /*
        $this->db->where(COL_USERNAME, $username);
        $this->db->update(TBL__USERS, array(COL_LASTLOGIN=>date('Y-m-d H:i:s'), COL_LASTLOGINIP=>$this->input->ip_address()));
        */

        SetLoginSession($ruser);
        ShowJsonSuccess('Selamat datang kembali, <strong>'.$ruser[COL_NAME].'</strong>!', array('redirect'=>site_url('site/user/dashboard')));
        exit();

      } else {
        ShowJsonError('Maaf, username / password yang anda masukkan tidak valid. Silakan coba kembali.');
        exit();
      }
    } else {
      $this->load->view('site/user/login');
    }
  }

  function Logout(){
      UnsetLoginSession();
      redirect(site_url());
  }
  function Dashboard() {
    if(!IsLogin()) {
      redirect('site/user/login');
    }

    $ruser = GetLoggedUser();

    if (!empty($_POST)) {
      $data['data'] = $_POST;
      SetSetting(SETTING_ORG_NAME, $this->input->post(SETTING_ORG_NAME));
      SetSetting(SETTING_ORG_ADDRESS, $this->input->post(SETTING_ORG_ADDRESS));
      SetSetting(SETTING_ORG_PHONE, $this->input->post(SETTING_ORG_PHONE));
      SetSetting(SETTING_ORG_FAX, $this->input->post(SETTING_ORG_FAX));
      SetSetting(SETTING_ORG_MAIL, $this->input->post(SETTING_ORG_MAIL));
      SetSetting(SETTING_WEB_NAME, $this->input->post(SETTING_WEB_NAME));
      SetSetting(SETTING_WEB_DESC, $this->input->post(SETTING_WEB_DESC));
      SetSetting(SETTING_WEB_DISQUS_URL, $this->input->post(SETTING_WEB_DISQUS_URL));
      SetSetting(SETTING_WEB_API_FOOTERLINK, $this->input->post(SETTING_WEB_API_FOOTERLINK));
      SetSetting(SETTING_WEB_LOGO, $this->input->post(SETTING_WEB_LOGO));
      SetSetting(SETTING_WEB_SKIN_CLASS, $this->input->post(SETTING_WEB_SKIN_CLASS));
      SetSetting(SETTING_WEB_PRELOADER, $this->input->post(SETTING_WEB_PRELOADER));
      SetSetting(SETTING_WEB_VERSION, $this->input->post(SETTING_WEB_VERSION));
      redirect(current_url());
    }

    $data['title'] = 'Dashboard';

    if($ruser[COL_ROLEID]!=ROLEPUBLIC) {
      $this->template->load('backend', 'site/user/dashboard', $data);
    } else {
      $this->template->load('finance', 'site/user/dashboard-public', $data);
    }
  }
  function ChangePassword() {
      if(!IsLogin()) {
          redirect('site/user/login');
      }
      $user = GetLoggedUser();
      $data['title'] = 'Ubah Password';
      $rules = array(
          array(
              'field' => 'OldPassword',
              'label' => 'Old Password',
              'rules' => 'required'
          ),
          array(
              'field' => COL_PASSWORD,
              'label' => COL_PASSWORD,
              'rules' => 'required'
          ),
          array(
              'field' => 'RepeatPassword',
              'label' => 'Repeat Password',
              'rules' => 'required|matches[Password]'
          )
      );
      $this->form_validation->set_rules($rules);

      if($this->form_validation->run()){
          $rcheck = $this->db->where(COL_USERNAME, $user[COL_USERNAME])->get(TBL__USERS)->row_array();
          if(!$rcheck) {
              redirect(site_url('site/user/changepassword'));
          }
          if($rcheck[COL_PASSWORD] != md5($this->input->post("OldPassword"))) {
              redirect(site_url('site/user/changepassword')."?nomatch=1");
          }
          $upd = $this->db->where(COL_USERNAME, $user[COL_USERNAME])->update(TBL__USERS, array(COL_PASSWORD=>md5($this->input->post(COL_PASSWORD))));
          if($upd) redirect(site_url('site/user/changepassword')."?success=1");
          else redirect(site_url('site/user/changepassword')."?error=1");
      }
      else {
        $this->template->load('backend', 'user/changepassword', $data);
      }
  }

  function delete() {
    if(!IsLogin()) {
        ShowJsonError('Silahkan login terlebih dahulu');
        return;
    }
    $loginuser = GetLoggedUser();
    if(!$loginuser || $loginuser[COL_ROLEID] != ROLEADMIN) {
        ShowJsonError('Anda tidak memiliki akses terhadap modul ini.');
        return;
    }
    $this->load->model('muser');
    $data = $this->input->post('cekbox');
    $deleted = 0;
    foreach ($data as $datum) {
        if($this->muser->delete($datum)) {
            $deleted++;
        }
    }
    if($deleted){
        ShowJsonSuccess($deleted." data dihapus");
    }else{
        ShowJsonError("Tidak ada data dihapus");
    }
  }

  public function daftar() {
    if(!empty($_POST)) {
      $this->form_validation->set_rules(array(
        array(
          'field' => 'Password',
          'label' => 'Password',
          'rules' => 'required|min_length[5]',
          'errors' => array('min_length' => 'Password minimal terdiri dari 5 karakter.')
        ),
        array(
          'field' => 'ConfirmPassword',
          'label' => 'Repeat ConfirmPassword',
          'rules' => 'required|matches[Password]',
          'errors' => array('matches' => 'Kolom Konfirmasi Password wajib sama dengan Password Baru.')
        )
      ));

      $rexist = $this->db
      ->where(COL_USERNAME, $this->input->post(COL_EMAIL))
      ->get(TBL__USERS)
      ->row_array();
      if(!empty($rexist)) {
        ShowJsonError('Maaf, alamat email <strong>'.$rexist[COL_EMAIL].'</strong> telah terdaftar. Silakan daftar menggunakan email yang belum pernah terdaftar sebelumnya.');
        exit();
      }

      if(!$this->form_validation->run()) {
        $err = htmlspecialchars_decode(strip_tags(validation_errors()));
        ShowJsonError($err);
        return false;
      }

      $data1 = array(
        COL_NAME=>$this->input->post(COL_NAME),
        COL_USERNAME=>$this->input->post(COL_EMAIL),
        COL_EMAIL=>$this->input->post(COL_EMAIL),
        COL_PHONENO=>$this->input->post(COL_PHONENO),
        COL_IDENTITYNO=>$this->input->post(COL_IDENTITYNO),
        COL_REGDATE=>date('Y-m-d')
      );
      $data2 = array(
        COL_USERNAME=>$this->input->post(COL_EMAIL),
        COL_PASSWORD=>md5($this->input->post(COL_PASSWORD)),
        COL_ROLEID=>ROLEPUBLIC,
      );

      $this->db->trans_begin();
      try {
        $res = $this->db->insert(TBL__USERS, $data2);
        if(!$res) {
          $err = $this->db->error();
          throw new Exception($err['message']);
        }
        $res = $this->db->insert(TBL__USERINFORMATION, $data1);
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
      ShowJsonSuccess('Pendaftaran berhasil. Silakan login menggunakan akun yang sudah terdaftar.', array('redirect'=>site_url('site/user/login')));
      exit();
    } else {
      $this->load->view('site/user/register');
    }
  }

  public function profile() {
    $ruser = GetLoggedUser();
    $data['title'] = 'Profil';
    if(!IsLogin()) {
      redirect('site/user/login');
    }

    if(!empty($_POST)) {
      $data = array(
        COL_NAME=>$this->input->post(COL_NAME),
        COL_IDENTITYNO=>$this->input->post(COL_IDENTITYNO),
        COL_PHONENO=>$this->input->post(COL_PHONENO)
      );
      $res = $this->db->where(COL_USERNAME, $ruser[COL_USERNAME])->update(TBL__USERINFORMATION, $data);
      if(!$res) {
        $err = $this->db->error();
        ShowJsonError($err['message']);
        exit();
      }

      $_pwd = $this->input->post(COL_PASSWORD);
      if(!empty($_pwd)) {
        if($this->input->post(COL_PASSWORD) != $this->input->post('ConfirmPassword')) {
          ShowJsonError('Maaf, kolom Ulangi Password belum tepat.');
          exit();
        }

        $res = $this->db->where(COL_USERNAME, $ruser[COL_USERNAME])->update(TBL__USERS, array(COL_PASSWORD=>md5($this->input->post(COL_PASSWORD))));
        if(!$res) {
          $err = $this->db->error();
          ShowJsonError($err['message']);
          exit();
        }
      }

      $ruser = $this->db
      ->join(TBL__USERINFORMATION,TBL__USERINFORMATION.'.'.COL_USERNAME." = ".TBL__USERS.".".COL_USERNAME,"inner")
      ->join(TBL__ROLES,TBL__ROLES.'.'.COL_ROLEID." = ".TBL__USERS.".".COL_ROLEID,"inner")
      ->where(TBL__USERS.".".COL_USERNAME,$ruser[COL_USERNAME])
      ->get(TBL__USERS)
      ->row_array();
      if(!empty($ruser)) {
        SetLoginSession($ruser);
      }
      ShowJsonSuccess('Pembaruan profil berhasil. Mengalihkan...');
      exit();
    } else {
      if($ruser[COL_ROLEID]==ROLEPUBLIC) {
        $this->template->load('finance' , 'user/profile', $data);
      }
    }
  }
}
 ?>
