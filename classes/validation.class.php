<?php
class validate {
  public function valEmail($fieldname) {
    $email = filter_var($_POST[$fieldname], FILTER_SANITIZE_EMAIL);
    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
  public function valURL($fieldname) {
    $url = filter_var($_POST[$fieldname], FILTER_SANITIZE_URL);
    // Adds http to beginning of URL if its not there
    //if($parts = parse_url($url)) {
      //if(!isset($parts["scheme"])) {
        //$url = "http://$url";
      //}
    //}
    if (filter_var($url, FILTER_VALIDATE_URL)) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
  
}

?>