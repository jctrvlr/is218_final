<?php

  class userformview {

     public function getHTML($errors='', $form='sign_in') {
       if(isset($errors)){
         $errorhtml = '
                      <div id="errors" class="errors">
                        <p>'.$errors.'</p>
                      </div>
         ';
       } else {
         $errorhtml = '';
       }

       $form_signin = '
          <h1>User Login Form</h1>
          '.$errorhtml.'
          <div id="sign_in" class="form">
            <form id="signin" action="index.php?controller=userController" method="post">
              <h2> Sign in!</h2>
              <input type="text" name="user_nameL" placeholder="Enter your username">
              <input type="password" name="passwordL" placeholder="Enter your password">
              <input type="hidden" name="form" value="sign_in" />
              <span>Dont have an account? Make one <span id="sign_swap" onclick="new_user()">here</a></span>
              <button type="submit">Sign in</button>
            </form>
          </div>
          <div id="sign_up" class="form hidden">
            <form id="reg" action="index.php?controller=userController" method="post">
              <h2>Sign up today!</h2>
              <input type="text" name="first_name" placeholder="Enter your first name"/>
              <input type="text" name="last_name" placeholder="Enter your last name"/>
              <input type="text" name="user_name" placeholder="Enter a username"/>
              <input type="email" name="email" placeholder="Enter your email"/>
              <input type="password" name="password" placeholder="Enter a password" />
              <input type="password" name="passwordConfirm" placeholder="Re-enter password" />
              <input type="hidden" name="form" value="sign_up" />
              <span><input type="checkbox" name="terms"> I have read and agree to the <b><a href="### CHANGE TO TERMS LINK ###">terms</a></b>
                of service</span>
              <span>Already have an account? Click <span id="sign_swap" onclick="signup()">here</span></span>
              <button type="submit">Sign Up</button>
            </form>
          </div>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
          <script src="js/plugins.js"></script>
          <script src="js/main.js"></script>
       ';

       $form_signup = '
           <h1>User Login Form</h1>
           '.$errorhtml.'
           <div id="sign_in" class="form hidden">
             <form id="signin" action="index.php?controller=userController" method="post">
               <h2> Sign in!</h2>
               <input type="text" name="user_nameL" placeholder="Enter your username">
               <input type="password" name="passwordL" placeholder="Enter your password">
               <input type="hidden" name="form" value="sign_in" />
               <span>Dont have an account? Make one <span id="sign_swap" onclick="new_user()">here</a></span>
               <button type="submit">Sign in</button>
             </form>
           </div>
           <div id="sign_up" class="form">
             <form id="reg" action="index.php?controller=userController" method="post">
               <h2>Sign up today!</h2>
               <input type="text" name="first_name" placeholder="Enter your first name"/>
               <input type="text" name="last_name" placeholder="Enter your last name"/>
               <input type="text" name="user_name" placeholder="Enter a username"/>
               <input type="email" name="email" placeholder="Enter your email"/>
               <input type="password" name="password" placeholder="Enter a password" />
               <input type="password" name="passwordConfirm" placeholder="Re-enter password" />
               <span><input type="checkbox" name="terms"> I have read and agree to the <b><a href="### CHANGE TO TERMS LINK ###">terms</a></b>
                 of service</span>
               <input type="hidden" name="form" value="sign_up" />
               <span>Already have an account? Click <span id="sign_swap" onclick="signup()">here</span></span>
               <button type="submit">Sign Up</button>
             </form>
           </div>
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
           <script src="js/plugins.js"></script>
           <script src="js/main.js"></script>
       ';

       if($form == 'sign_in'){
         $form = $form_signin;
       } elseif($form == 'sign_up'){
         $form = $form_signup;
       } else{
         $form = $form_signin;
       }
       return $form;
    }

}
