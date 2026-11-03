<?php
class Aduan extends MY_Controller {
  function __construct() {
    parent::__construct();
    if(!IsLogin()) {
      redirect('user/dashboard');
    }
  }

  public function index($stat) {
    $stat = strtolower($stat);
    $data['title'] = "Pengaduan";
    $data['stat'] = $stat;
    $this->template->load('backend' , 'aduan/index', $data);
  }

  public function index_load($stat='') {
    $ruser = GetLoggedUser();

    $start = $_POST['start'];
    $rowperpage = $_POST['length'];
    //$questStatus = !empty($_POST['filterStatus'])?$_POST['filterStatus']:null;
    //$dateFrom = !empty($_POST['dateFrom'])?$_POST['dateFrom']:date('Y-m-01');
    //$dateTo = !empty($_POST['dateTo'])?$_POST['dateTo']:date('Y-m-d');

    $orderdef = array(COL_CREATEDON=>'desc');
    $orderables = array(null,COL_CREATEDON,COL_UPDATEDON,COL_LAPORNAMA,COL_LAPORNIK,COL_LAPORKATEGORI);
    $cols = array(COL_LAPORNAMA,COL_LAPORNIK,COL_LAPORKATEGORI);

    if(!empty($stat)) {
      $this->db->where(COL_LAPORSTATUS,$stat);
    }

    $queryAll = $this->db->get(TBL_TLAPOR);

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
      if($_POST['order']==COL_CREATEDON) $this->db->order_by(TBL_TLAPOR.'.'.COL_CREATEDON, $_POST['order']['0']['dir']);
      else $this->db->order_by($orderables[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    }else if(!empty($orderdef)){
      $order = $orderdef;
      $this->db->order_by(key($order), $order[key($order)]);
    }

    if(!empty($stat)) {
      $this->db->where(COL_LAPORSTATUS,$stat);
    }

    $q = $this->db
    ->order_by(TBL_TLAPOR.'.'.COL_CREATEDON, 'desc')
    ->get_compiled_select(TBL_TLAPOR, FALSE);
    $rec = $this->db->query($q." LIMIT $rowperpage OFFSET $start");
    $data = [];

    foreach($rec->result_array() as $r) {
      $data[] = array(
        '<a href="'.site_url('site/aduan/detail/'.$r[COL_UNIQ]).'" class="btn btn-xs btn-outline-primary"><i class="fas fa-search"></i>&nbsp;LIHAT</a>',
        date('Y-m-d H:i', strtotime($r[COL_CREATEDON])),
        !empty($r[COL_UPDATEDON])?date('Y-m-d H:i', strtotime($r[COL_UPDATEDON])):'-',
        $r[COL_LAPORNAMA],
        $r[COL_LAPORNIK],
        $r[COL_LAPORKATEGORI],
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

  public function detail($id) {
    $ruser = GetLoggedUser();
    $data['title'] = "Rincian Pengaduan";
    $rdata = $this->db
    ->where(COL_UNIQ, $id)
    ->get(TBL_TLAPOR)
    ->row_array();

    if(empty($rdata)) {
      show_error('Parameter tidak valid!');
      exit();
    }

    $data['title'] = "Aduan No. ".str_pad($rdata[COL_UNIQ], 5, '0', STR_PAD_LEFT);
    $data['data'] = $rdata;

    if(!empty($_POST)) {
      $dat = array(
        COL_LAPORKETERANGAN=>$this->input->post(COL_LAPORKETERANGAN),
        COL_LAPORSTATUS=>$this->input->post(COL_LAPORSTATUS),
        COL_UPDATEDON=>date('Y-m-d H:i:s'),
        COL_UPDATEBY=>$ruser[COL_USERNAME]
      );
      $this->db->trans_begin();
      try {
        $res = $this->db->where(COL_UNIQ, $id)->update(TBL_TLAPOR, $dat);
        if(!$res) {
          throw new Exception('Mohon maaf, sedang terjadi kendala pada sistem kami. Silakan mencoba beberapa saat lagi.');
        }
      } catch(Exception $ex) {
        $this->db->trans_rollback();
        ShowJsonError($ex->getMessage());
        exit();
      }

      $this->db->trans_commit();
      ShowJsonSuccess('Laporan berhasil diperbarui.', array('redirect'=>site_url('site/aduan/index/'.strtolower($rdata[COL_LAPORSTATUS]))));
      exit();
    } else {
      $this->template->load('backend', 'aduan/detail', $data);
    }

  }
}
