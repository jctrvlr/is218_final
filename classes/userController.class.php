<?php

    class userController extends controller {
      

      public function get() {
        $form = new userformview;
	$form_html = $form->getHTML();
        $this->html .= $form_html; 
	
      }
      public function post() {
        print_r($_POST);
	$user = new userModel;
	$user->setUsername($_POST['username']);
	$user->setPassword($_POST['password']);
	$user->save();
	header('Location: index.php');
      }
      public function put() {}
      public function delete() {}


    }
