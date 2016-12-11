<?php
class mail {
  public function registration($id, $activation, $first_name, $email){
    //send email
    $to = $email;
    $subject = "Registration Confirmation";
    $body = "<p>Thank you for registering at John's site.</p>
    <p>To activate your account, please click on this link: <a href='".DIR."/index.php?controller=userController&action=activation&x=$id&y=$activation'>".DIR."/index.php?controller=userController&action=activation&x=$id&y=$activation</a></p>
    <p>Regards Site Admin</p>";

    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    // Additional headers
    $headers .= "To: $first_name<$email>" . "\r\n";
    $headers .= "From: No reply <jic6@njit.edu>" . "\r\n";

    //Mail it
    mail($to, $subject, $body, $headers);
  }

}

?>
