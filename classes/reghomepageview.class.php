<?php

  class reghomepageview {

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
       $usermessage = '';
       $homepage = '
           <div class="intro">
            <h2>Home</h2>
            '.$errorhtml.'
           </div>
           <div class="homepage">
             <h3>Welcome to our homepage!</h3>
             '.$usermessage.'
             <p>To make the most of this website register <a href="index.php?controller=userController&form=sign_up">here</a>!</p>
             <p> More things will be available to you as the development of the site continues!</p>

           </div>

           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      	   <script src="js/plugins.js"></script>
           <script src="js/main.js"></script>

  	      ';
        return $homepage;
     }
  }
