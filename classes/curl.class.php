<?php
class curl {
  public $URL;
  public $params;
  public $headers;

  public function __construct($url, $params = array(), $headers = array()) {
    $this->URL = $url;
    $this->params = $params;
    $this->headers = $headers;
    
  }
  
  public function get(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    if(isset($this->headers)) {
      curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
    }

    $output = curl_exec($ch);

    if($output === false) {
      echo "Error Number:".curl_errno($ch) ."<br>";
      echo "Error String:".curl_error($ch);
    }
    curl_close($ch);
    return $output;
  }
  public function post() {
    $postData = '';

    foreach($this->params as $k => $v) {
      $postData .= $k . '=' .$v. '&';
    }
    $postData = rtrim($postData, '&');

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $this->URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    if(isset($this->headers)) {
      curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
    } 
    curl_setopt($ch, CURLOPT_POST, count($postData));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

    $output = curl_exec($ch);

    curl_close($ch);
    return $output;
  }
}

?>
