<?php

    class userController extends controller {

      public function get() {
        if(isset($_GET['action'])){
          $get = $_GET;
          $action = $_GET['action'];
          $strategy = new actionstrategy($action, $get);
          $page_html = $strategy->runstrat();
          $this->html .= $page_html;
        } else {
          if(isset($_GET['errors'])) {
            if($_GET['form'] == 'edit') {
              $formtype = $_GET['form'];
              $errors = $_GET['errors'];
              $profile = new userprofileview;
              $profile_html = $profile->getHTML(true,$errors);
              $this->html .= $profile_html;
            } else {
              $formtype = $_GET['form'];
              $errors = $_GET['errors'];
              $form = new userformview;
              $form_html = $form->getHTML($errors, $formtype);
              $this->html .= $form_html;
            }
          } else{
            $formtype = $_GET['form'];
            $errors = '';
            $form = new userformview;
            $form_html = $form->getHTML($errors, $formtype);
            $this->html .= $form_html;
          }
        }
      }

      public function post() {
          if($_POST['form'] == 'sign_up'){
            if(strlen($_POST['user_name']) < 3){
          		$error[] = 'Username is too short.';
          	} else {
              $db = dbConn::getConnection();
          		$stmt = $db->prepare('SELECT username FROM members WHERE username = :username');
          		$stmt->execute(array(':username' => $_POST['user_name']));
          		$row = $stmt->fetch(PDO::FETCH_ASSOC);
          		if(!empty($row['username'])){
          			$error[] = 'Username provided is already in use.';
          		}
          	}

            if(strlen($_POST['password']) < 3){
          		$error[] = 'Password is too short.';
          	}

          	if(strlen($_POST['passwordConfirm']) < 3){
          		$error[] = 'Confirm password is too short.';
          	}

          	if($_POST['password'] != $_POST['passwordConfirm']){
          		$error[] = 'Passwords do not match.';
          	}

            if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
          	    $error[] = 'Please enter a valid email address';
          	} else {
              $db = dbConn::getConnection();
          		$stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
          		$stmt->execute(array(':email' => $_POST['email']));
          		$row = $stmt->fetch(PDO::FETCH_ASSOC);
          		if(!empty($row['email'])){
          			$error[] = 'Email provided is already in use.';
          		}
          	}
          } elseif($_POST['form'] == 'edit') {
            $oldusername = $_POST['oldusername'];
            $user = new userModel;
            $res = $user->get_user_info($oldusername);
            $oldemail = $res['email'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $bio = $_POST['bio'];
            $avtr_url = $res['avtr_url'];

            $check = false;
            while($check == false) {
              $db = dbConn::getConnection();
              $stmt = $db->prepare('SELECT username FROM members WHERE username = :username');
              $stmt->execute(array(':username' => $username));
              $row = $stmt->fetch(PDO::FETCH_ASSOC);
              if(!empty($row['username']) && $row['username'] !== $oldusername){
                $error[] = 'Username provided is already in use.';
                goto end;
              }
              $db = dbConn::getConnection();
          		$stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
          		$stmt->execute(array(':email' => $email));
          		$row = $stmt->fetch(PDO::FETCH_ASSOC);
          		if(!empty($row['email']) && $row['email'] !== $oldemail){
          			$error[] = 'Email provided is already in use.';
                goto end;
          		}
              $check = true;
            }
            define("UPLOAD_DIR", "/afs/cad.njit.edu/u/j/i/jic6/public_html/is218_final/img/");
            if (isset($_FILES["avatar"]["name"]) && $_FILES["avatar"]["tmp_name"] != ""){
            	$fileName = $_FILES["avatar"]["name"];
              $fileTmpLoc = $_FILES["avatar"]["tmp_name"];
            	$fileType = $_FILES["avatar"]["type"];
            	$fileSize = $_FILES["avatar"]["size"];
            	$fileErrorMsg = $_FILES["avatar"]["error"];
            	$kaboom = explode(".", $fileName);
            	$fileExt = end($kaboom);

            	$db_file_name = rand(100000000000,999999999999).".".$fileExt;
            	if($fileSize > 1048576) {
            		$error[] = "Your image file was larger than 1mb";
            		goto end;
            	} else if (!preg_match("/\.(gif|jpg|png)$/i", $fileName) ) {
            		$error[] = "Your image file was not jpg, gif or png type";
            		goto end;
            	} else if ($fileErrorMsg == 1) {
            		$error[] = "An unknown error occurred";
            		goto end;
            	}
              $avtr_url = "img/$db_file_name";
              $moveResult = move_uploaded_file($fileTmpLoc, UPLOAD_DIR . "/$db_file_name");
            	if ($moveResult != true) {
            		$error[] = "File upload failed";
            		goto end;
            	}
            }
            $user->update($oldusername, $first_name, $last_name, $username, $email, $bio, $avtr_url);
            end:
          }
          if(!isset($error)){
            try {
              if(isset($_POST['user_nameL']) && isset($_POST['passwordL'])){
                $user = new userModel;
                if($user->login($_POST['user_nameL'], $_POST['passwordL'])){
		              header('Location: index.php?controller=userController&action=profile');
                  exit;
                } else{
                  $error[] = 'Wrong username or password or your account has not been activated.';
                }

              } else {
                // Create user model
                $user = new userModel;
                //hash the password
                $hashedpassword = $user->password_hash($_POST['password']);
                //Run save function which emails activation email plus inserts user into database
                $user->save($_POST['first_name'], $_POST['last_name'], $_POST['user_name'], $hashedpassword, $_POST['email'], $activation);
              }
        		//else catch the exception and show the error.
        		} catch(Exception $e) {
        		    $error[] = $e->getMessage();
        		}
        	}

          if(isset($error)){
            echo '<script>console.log("before $errors");</script>';
            $err_url = 'index.php?controller=userController&errors=';
            $get_url = '&form=' . $_POST['form'];
            foreach($error as $error){
              $err_url .= $error;
					  }
            $fin_url = $err_url . $get_url;
            echo '<script>console.log("past $fin_url");</script>';
  					header("Location: $fin_url");
				  }


      }
      public function put() {}
      public function delete() {}


    }
?>
