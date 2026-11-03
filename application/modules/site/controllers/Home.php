<?php
class Home extends MY_Controller {

  public function index() {
    $data['title'] = 'Dinas Perhubungan Kab. Batu Bara';

    $this->load->model('mpost');

    $data['berita'] = $this->mpost->search(9,"",2);
    $data['galeri'] = $this->mpost->search(10,"",3);
		//$this->template->set('title', 'Home');
		//$this->template->load('frontend-mediplus' , 'home/index', $data);
    $this->template->load('gotto' , 'home/index', $data);
    //$this->load->view('home/index');
  }

  public function index_temp() {
    $data['title'] = 'Beranda';
		$this->template->load('frontend-mediplus' , 'home/index_temp', $data);
  }

  public function page($slug) {
    $data['title'] = 'Page';

    if(file_exists(APPPATH.'modules/site/views/home/page-'.$slug.'.php')) {
      $data['title'] = ucwords($slug);
      $data['slug'] = $slug;
      $this->template->load('gotto', 'home/page-'.$slug, $data);
    } else {
      $this->load->model('mpost');
      $this->db->join(TBL__POSTCATEGORIES,TBL__POSTCATEGORIES.'.'.COL_POSTCATEGORYID." = ".TBL__POSTS.".".COL_POSTCATEGORYID,"inner");
      $this->db->join(TBL__USERINFORMATION,TBL__USERINFORMATION.'.'.COL_USERNAME." = ".TBL__POSTS.".".COL_CREATEDBY,"inner");
      $this->db->where("(".TBL__POSTS.".".COL_POSTSLUG." = '".$slug."' OR ".TBL__POSTS.".".COL_POSTID." = '".$slug."')");
      $rpost = $this->db->get(TBL__POSTS)->row_array();
      if(!$rpost) {
          show_404('site/home/_error');
          return false;
      }

      $this->db->where(COL_POSTID, $rpost[COL_POSTID]);
      $this->db->set(COL_TOTALVIEW, COL_TOTALVIEW."+1", FALSE);
      $this->db->update(TBL__POSTS);

      $data['title'] = $rpost[COL_POSTCATEGORYID]!=5?$rpost[COL_POSTCATEGORYNAME]:$rpost[COL_POSTTITLE];//$rpost[COL_POSTCATEGORYNAME];//strlen($rpost[COL_POSTTITLE]) > 50 ? substr($rpost[COL_POSTTITLE], 0, 50) . "..." : $rpost[COL_POSTTITLE];
      $data['data'] = $rpost;
      $data['berita'] = $this->mpost->search(5,"",1);

      $rheader = $this->db
      ->where(COL_ISTHUMBNAIL, 1)
      ->where(COL_POSTID, $rpost[COL_POSTID])
      ->get(TBL__POSTIMAGES)
      ->row_array();
      if(!empty($rheader)) {
        $data['ogimg'] = MY_UPLOADURL.$rheader[COL_IMGPATH];
      }
      $strippedcontent = strip_tags($rpost[COL_POSTCONTENT]);
      $data['ogdesc'] = strlen($strippedcontent) > 150 ? substr($strippedcontent, 0, 150) . "..." : $strippedcontent;
      $data['ogtitle'] = $rpost[COL_POSTTITLE].' - '.$this->setting_web_name;

      $this->template->load('gotto' , 'home/page', $data);
    }
  }

  public function _404() {
    $data['title'] = 'Error';
    if(IsLogin()) {
      $this->template->load('backend' , 'home/_error', $data);
    } else {
      $this->template->load('gotto' , 'home/_error', $data);
    }
  }

  public function post_old($cat) {
    $data['title'] = 'Tautan';
    $start = !empty($_GET['start'])&&$_GET['start']>0?$_GET['start']:0;

    if(!empty($_GET['dateFrom'])) $this->db->where(TBL__POSTS.".".COL_CREATEDON." >= ", $_GET['dateFrom']);
    if(!empty($_GET['dateTo'])) $this->db->where(TBL__POSTS.".".COL_CREATEDON." <= ", $_GET['dateTo']);
    if(!empty($_GET['keyword'])) {
      $this->db->group_start();
      $this->db->like(TBL__POSTS.".".COL_POSTCONTENT, $_GET['keyword']);
      $this->db->or_like(TBL__POSTS.".".COL_POSTTITLE, $_GET['keyword']);
      $this->db->group_end();
    }

    $q = $this->db
    ->join(TBL__POSTCATEGORIES,TBL__POSTCATEGORIES.'.'.COL_POSTCATEGORYID." = ".TBL__POSTS.".".COL_POSTCATEGORYID,"inner")
    ->join(TBL__USERINFORMATION,TBL__USERINFORMATION.'.'.COL_USERNAME." = ".TBL__POSTS.".".COL_CREATEDBY,"inner")
    ->where(TBL__POSTS.".".COL_POSTCATEGORYID, $cat)
    ->order_by(TBL__POSTS.".".COL_CREATEDON, 'desc')
    ->get_compiled_select(TBL__POSTS, TRUE);

    $data['res'] = $rpost = $this->db->query($q." LIMIT 10 OFFSET $start")->result_array();
    $data['count'] = $this->db->query($q)->num_rows();
    $data['start'] = $start;

    if(!empty($rpost)) {
      $data['title'] = $rpost[0][COL_POSTCATEGORYNAME];
    }

    $data['data'] = $rpost;
    $this->template->load('frontend' , 'home/post', $data);
  }

  public function post($cat=null) {
    $data['title'] = 'Tautan';
    $start = !empty($_GET['start'])&&$_GET['start']>0?$_GET['start']:0;
    $rcat = $this->db
    ->where(COL_POSTCATEGORYID, $cat)
    ->get(TBL__POSTCATEGORIES)
    ->row_array();
    if(empty($rcat)) {
      show_404();
      return false;
    }

    if(!empty($_GET['dateFrom'])) $this->db->where(TBL__POSTS.".".COL_CREATEDON." >= ", $_GET['dateFrom']);
    if(!empty($_GET['dateTo'])) $this->db->where(TBL__POSTS.".".COL_CREATEDON." <= ", $_GET['dateTo']);
    if(!empty($_GET['keyword'])) {
      $this->db->group_start();
      $this->db->like(TBL__POSTS.".".COL_POSTCONTENT, $_GET['keyword']);
      $this->db->or_like(TBL__POSTS.".".COL_POSTTITLE, $_GET['keyword']);
      $this->db->group_end();
    }

    $q = $this->db
    ->join(TBL__POSTCATEGORIES,TBL__POSTCATEGORIES.'.'.COL_POSTCATEGORYID." = ".TBL__POSTS.".".COL_POSTCATEGORYID,"inner")
    ->join(TBL__USERINFORMATION,TBL__USERINFORMATION.'.'.COL_USERNAME." = ".TBL__POSTS.".".COL_CREATEDBY,"inner")
    ->where(TBL__POSTS.".".COL_POSTCATEGORYID, $cat)
    ->order_by(TBL__POSTS.".".COL_CREATEDON, 'desc')
    ->get_compiled_select(TBL__POSTS, TRUE);

    $data['res'] = $rpost = $this->db->query($q.(!empty($start)?" LIMIT 9 OFFSET $start":""))->result_array();
    $data['count'] = $this->db->query($q)->num_rows();
    $data['start'] = $start;

    if(!empty($rcat)) {
      $data['title'] = $rcat[COL_POSTCATEGORYNAME];
    }

    $data['data'] = $rpost;
    $data['rcat'] = $rcat;
    $this->template->load('gotto' , 'home/post', $data);
  }

  public function lapor() {
    $data['title'] = 'Pengaduan';
    if(!empty($_POST)) {
      $dat = array(
        COL_LAPORNAMA=>$this->input->post(COL_LAPORNAMA),
        COL_LAPORNIK=>$this->input->post(COL_LAPORNIK),
        COL_LAPORHP=>$this->input->post(COL_LAPORHP),
        COL_LAPOREMAIL=>$this->input->post(COL_LAPOREMAIL),
        COL_LAPORISI=>$this->input->post(COL_LAPORISI),
        COL_LAPORKATEGORI=>$this->input->post(COL_LAPORKATEGORI),
        COL_CREATEDON=>date('Y-m-d H:i:s')
      );
      $this->db->trans_begin();
      try {
        $res = $this->db->insert(TBL_TLAPOR, $dat);
        if(!$res) {
          throw new Exception('Mohon maaf, sedang terjadi kendala pada sistem kami. Silakan mencoba beberapa saat lagi.');
        }
      } catch(Exception $ex) {
        $this->db->trans_rollback();
        ShowJsonError($ex->getMessage());
        exit();
      }

      $this->db->trans_commit();
      ShowJsonSuccess('Laporan anda telah diterima. Kami akan segera menindaklanjuti laporan yang anda kirimkan. Terimakasih atas partisipasi anda!');
      exit();
    } else {
      $this->template->load('gotto' , 'home/lapor', $data);
    }

  }

  public function tracking() {
    $data['title'] = 'Tracking';
    $this->load->model('mpost');

    if(!empty($_POST)) {
      $data = json_decode(file_get_contents(GetSetting('SETTING_API_SICANTIK')),true);
      ShowJsonSuccess($data);
    } else {
      $this->template->load('gotto' , 'home/tracking', $data);
    }
  }

  public function izin() {
    $this->load->model('mpost');

    $data['title'] = 'Formulir Perizinan';
    $data['res'] = $this->mpost->search(0,"",2,null,null,COL_POSTTITLE);

    $this->template->load('gotto' , 'home/izin', $data);
  }

  public function contact() {
    $data['title'] = 'Kontak';
    $this->template->load('gotto' , 'home/contact', $data);
  }
}
 ?>
