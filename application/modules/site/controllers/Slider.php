<?php
class Slider extends MY_Controller {
  function __construct() {
    parent::__construct();
    if(!IsLogin() || GetLoggedUser()[COL_ROLEID] != ROLEADMIN) {
        redirect('user/dashboard');
    }
    ini_set('upload_max_filesize', '50M');
    ini_set('post_max_size', '50M');
  }

  public function index() {
      $data['title'] = "Slider / Banner";

      $carouselDir =  scandir(MY_IMAGEPATH.'slide/');
      $carouselArr = array();
      foreach (scandir(MY_IMAGEPATH.'slide/') as $file) {
        if(strpos(mime_content_type(MY_IMAGEPATH.'slide/'.$file), 'image') !== false) {
          $carouselArr[] = array(
            'file' => $file,
            'date' => filemtime(MY_IMAGEPATH.'slide/'. $file)
          );
        }
      }

      $data['res'] = $carouselArr;
      $this->template->load('backend' , 'slider/index', $data);
  }

  public function add() {
    $config['upload_path'] = MY_IMAGEPATH.'slide/';
    $config['allowed_types'] = "gif|jpg|jpeg|png";
    $config['max_size']	= 512000;
    $config['max_width']  = 4000;
    $config['max_height']  = 4000;
    $config['overwrite'] = FALSE;
    $this->load->library('upload',$config);

    if($this->upload->do_upload('userfile')){
      redirect('site/slider/index');
    } else {
      echo $this->upload->display_errors();
    }
  }

  public function delete()
  {
    $data = $this->input->post('cekbox');
    $deleted = 0;
    foreach ($data as $datum) {
        if(file_exists(MY_IMAGEPATH.'slide/'.$datum)) {
          unlink(MY_IMAGEPATH.'slide/'.$datum);
          $deleted++;
        }
    }
    if ($deleted) {
        ShowJsonSuccess($deleted." data dihapus");
    } else {
        ShowJsonError("Tidak ada dihapus");
    }
  }
}
 ?>
