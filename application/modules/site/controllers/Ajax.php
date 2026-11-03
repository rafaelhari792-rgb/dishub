<?php
class Ajax extends MY_Controller {

  public function __construct()
  {
      parent::__construct();
      setlocale (LC_TIME, 'id_ID');
  }

  function now() {
    //echo date('D, d M Y H:i:s');

    $dt = json_encode(array(
      'Day'=>date('D'),
      'Date'=>date('d'),
      'Month'=>date('M'),
      'Year'=>date('Y'),
      'Hour'=>date('H'),
      'Minute'=>date('i'),
      'Second'=>date('s')
    ));
    echo $dt;
  }

  public function popup_galeri($id) {
    $res = array(
      'title'=>'GALERI',
      'body'=>'<p class="p-2">DATA TIDAK DITEMUKAN</p>'
    );
    $rdata = $this->db
    ->select('_postimages.*, _posts.PostTitle')
    ->join(TBL__POSTS,TBL__POSTS.'.'.COL_POSTID." = ".TBL__POSTIMAGES.".".COL_POSTID,"inner")
    ->where(COL_POSTIMAGEID, $id)
    ->get(TBL__POSTIMAGES)
    ->row_array();
    if(!empty($rdata)) {
      $res['title'] = $rdata[COL_POSTTITLE];
      $res['body'] = '<img src="'.MY_UPLOADURL.$rdata[COL_IMGPATH].'" style="width: 100%" />';
    }

    echo json_encode($res);
    exit();
  }
}
