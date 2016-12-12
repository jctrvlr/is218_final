<?php

  class userhomepageview {

     public function getHTML($errors) {
       if(isset($errors)){
         $errorhtml = '
                      <div id="errors" class="errors">
                        <p>'.$errors.'</p>
                      </div>
         ';
       } else {
         $errorhtml = '';
       }


       $username = $_SESSION['username'];
       $user = new userModel;
       $row = $user->get_user_info($username);
       $usermessage = '';
       if($row['bio'] == '' && $row['avtr_url'] == 'img/default_avatar.png'){
         $usermessage = '<div class="alert>Go to your profile to add a profile picture, and write a bio so people know more about you!</div>';
       } elseif($row['bio'] == '') {
         $usermessage = '<div class="alert">Go to your profile to add to your bio so people know more about you!</div>';
       }
       $homepage = '
           <div class="intro">
            <h2>Home</h2>
            '.$errorhtml.'
           </div>
           <div class="homepage">
             <h3>Welcome '.$row['first_name'].' to our homepage!</h3>
             '.$usermessage.'
             <p>More things will be available to you as the development of the site continues!</p>

           </div>

           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      	   <script src="js/plugins.js"></script>
           <script src="js/main.js"></script>

  	      ';
        return $homepage;
     }

  }
