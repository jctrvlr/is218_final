<?php

  class userprofileview {

     public function getHTML($edit=false, $errors) {
       if(isset($errors)){
         $errorhtml = '
                      <div id="errors" class="errors">
                        <p>'.$errors.'</p>
                      </div>
         ';
       } else {
         $errorhtml = '';
       }

       if($edit == true) {
         $username = $_SESSION['username'];
         $user = new userModel;
         $row = $user->get_user_info($username);
         $profile = '
              <div class="intro">
                <h2>Profile</h2>
                '.$errorhtml.'
              </div>
              <div class="profile">
                <!-- Replace with php database calls to specific users img/info -->
                <form id="edit" action="index.php?controller=userController&action=edit" method="post" enctype="multipart/form-data">
                  <img width="100px" height="100px" src="'.$row['avtr_url'].'">
                  <p><input type="file" name="avatar"></p>
                  <p>First Name: <input type="text" name="first_name" value="'.$row['first_name'].'"></p>
                  <p>Last Name: <input type="text" name="last_name" value="'.$row['last_name'].'"></p>
                  <p>Username: <input type="text" name="username" value="'.$username.'"></p>
                  <p>Email: <input type="email" name="email" value="'.$row['email'].'"></p>
                  <p>Bio: <input type="text" name="bio" value="'.$row['bio'].'"></p>
                  <input type="hidden" name="form" value="edit" />
                  <input type="hidden" name="oldusername" value="'.$username.'" />
                  <button type="submit">Finish editing</button>
                </form>

              </div>

              <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      	      <script src="js/plugins.js"></script>
              <script src="js/main.js"></script>

  	      ';
       } else {
         $username = $_SESSION['username'];
         $user = new userModel;
         $row = $user->get_user_info($username);
         $profile = '
              <div class="intro">
                <h2>Profile</h2>
                '.$errorhtml.'
              </div>
              <div class="profile">
                <!-- Replace with php database calls to specific users img/info -->
                <img width="100px" height="100px" src="'.$row['avtr_url'].'">
                <p>First Name: '.$row['first_name'].'</p>
                <p>Last Name: '.$row['last_name'].'</p>
                <p>Username: '.$username.'</p>
                <p>Email: '.$row['email'].'</p>
                <p> Bio: '.$row['bio'].'</p>
                <a href="index.php?controller=userController&action=edit">Edit Profile</a>

              </div>

              <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      	      <script src="js/plugins.js"></script>
              <script src="js/main.js"></script>

  	      ';
       }
        return $profile;
     }

  }
