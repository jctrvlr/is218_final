<?php
class CSV {
  public $file_in;
  public $file_out;
  public $data;
  public $exception;

  public function __construct($file_in='', $file_out='', $data='') {
    if(is_file($file_in)) {
      $this->openFile($file_in);
      return $this->data;
      echo $this->exception;
    }
    elseif($file_out != '' && $data != '') {
      $this->writeFile($file_out, $data); 
      echo $this->exception;
    }
  }
  
  public function openFile($file_in) {
    try{
      if(($handle = fopen($file_in, 'r')) !== FALSE) {
        $data = fgetcsv($handle, 1000, ',');
	$this->data = $data;
      }
      fclose($handle);
    }
    catch(Exception $e) {
      $this->exception = 'Caught Exception: ' . $e->getMessage() . "n";
    }
  }

  public function writeFile($file_out, $data) {
    try{
      $fp = fopen($file_out, 'w');
      foreach($data as $fields) {
        fputcsv($fp, $fields);
      }
      fclose($fp);
    }
    catch(Exception $e) {
      $this->exception = 'Caught exception: ' . $e->getMessage() . "n";
    }
  }

}

?>
