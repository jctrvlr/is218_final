<?php

  class userModel extends model {
    private $username;
    private $password;

    private function get_user_hash($username){
		  try {
        //Get database
        $db = dbConn::getConnection();
			  $stmt = $db->prepare('SELECT password, username, memberID, avtr_url, bio FROM members WHERE username = :username AND activation="Yes" ');
        $stmt->execute(array('username' => $username));
		  	return $stmt->fetch();
		  } catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		  }
	  }

    public function get_user_info($username){
		  try {
        //Get database
        $db = dbConn::getConnection();
			  $stmt = $db->prepare('SELECT first_name, last_name, memberID, avtr_url, bio, email FROM members WHERE username = :username AND activation="Yes" ');
        $stmt->execute(array('username' => $username));
		  	return $stmt->fetch();
		  } catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		  }
	  }

    public function password_hash($password){
      if(defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH){
        $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
        return crypt($password, $salt);
      }
    }

    private function password_verify($password, $hash){
      return crypt($password, $hash) == $hash;
    }

  	public function login($username,$password){
  		$row = $this->get_user_hash($username);
  		if($this->password_verify($password,$row['password']) == 1){
  		    $_SESSION['loggedin'] = true;
  		    $_SESSION['username'] = $row['username'];
  		    return true;
  		}
  	}

    public function logout(){
      session_destroy();
    }

    public function is_logged_in(){
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        return true;
      }
    }

    public function setUsername($username) {
      $this->username = $username;
    }
    public function getUsername() {
      return $this->username;
    }
    public function setPassword($password) {
      $this->password = $password;
    }
    public function getPassword() {
      return $this->password;
    }

    public function save($first_name, $last_name, $username, $password, $email, $activation) {
      //create the activasion code
      $activation = md5(uniqid(rand(),true));
      try {
        //Get database
        $db = dbConn::getConnection();
        //insert into database with a prepared statement
        $stmt = $db->prepare('INSERT INTO members (first_name,last_name,username,password,email,activation) VALUES (:first, :last, :username, :password, :email, :active)');
        $stmt->execute(array(
          ':first' => $first_name,
          ':last' => $last_name,
          ':username' => $username ,
          ':password' => $password,
          ':email' => $email,
          ':active' => $activation
        ));
        $id = $db->lastInsertId('memberID');
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

        //redirect to index page
        header('Location: index.php?controller=userController&action=joined');
        exit;
    } catch(PDOException $e) {
        echo '<script>console.log("'.$e->getMessage().'");</script>';
		    $error[] = $e->getMessage();
		}

  }
  public function update($oldusername, $first_name, $last_name, $username, $email, $bio, $avtr_url) {
    try {
      //Get database
      $db = dbConn::getConnection();
      //insert into database with a prepared statement
      $stmt = $db->prepare('UPDATE members SET first_name=:first, last_name=:last, username=:username, email=:email, bio=:bio, avtr_url=:avtr_url WHERE username=:old');
      $stmt->execute(array(
        ':first' => $first_name,
        ':last' => $last_name,
        ':username' => $username,
        ':email' => $email,
        ':bio' => $bio,
        ':avtr_url' => $avtr_url,
        ':old' => $oldusername
      ));
      $_SESSION['username'] = $username;

      //redirect to index page
      header('Location: index.php?controller=userController&action=profile');
      exit;
  } catch(PDOException $e) {
      echo '<script>console.log("'.$e->getMessage().'");</script>';
      $error[] = $e->getMessage();
  }

}
}
?>
