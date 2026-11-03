<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH."third_party/PhpOffice/PhpWord/Autoloader.php");

use PhpOffice\PhpWord\Autoloader;
Autoloader::register();

class Word {
  public $word;

  public function __construct() {
    $this->word = new \PhpOffice\PhpWord\PhpWord();
  }

}
?>
