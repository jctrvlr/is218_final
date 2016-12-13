<?php
  class actionstrategy {
    private $strategy = NULL;
    private $get = [];

    public function __construct($action, $get) {
      $this->get = $get;
      switch($action) {
        case "profile":
          $this->strategy = $this->profile();
          break;
        case "usertable":
          $this->strategy = $this->usertable();
          break;
        case "edit":
          $this->strategy = $this->edit();
          break;
        case "logout":
          $this->strategy = $this->logout();
          break;
        case "activation":
          $this->strategy = $this->activation();
          break;
        case "active":
          $this->strategy = $this->active();
          break;
        case "joined":
          $this->strategy = $this->joined();
          break;
      }
    }

    public function runstrat(){
      return $this->strategy;
    }

    public function joined(){
      $message = 'Check your email to activate your account!';
      $formtype = '';
      $form = new userformview;
      $form_html = $form->getHTML($message, $formtype);
      return $form_html;
    }

    public function profile(){
      $user = new userModel;
      if($user->is_logged_in()){
        $profile = new userprofileview;
        $profile_html = $profile->getHTML();
        return $profile_html;
      } else {
        $error = 'You are not logged in.';
        header('Location: index.php?controller=userController&errors='.$error);
      }
    }
    public function usertable(){
      $table = new usertableview;
      $table_html = $table->getHTML();
      return $table_html;
    }
    public function edit(){
      $user = new userModel;
      if($user->is_logged_in()){
        $profile = new userprofileview;
        $profile_html = $profile->getHTML(true);
        return $profile_html;
      } else {
        $error = 'You are not logged in.';
        header('Location: index.php?controller=userController&errors='.$error);
      }
    }
    public function logout(){
      $user = new userModel;
      $user->logout();
      header('Location: index.php');
    }
    public function activation($get){
      //collect values from the url
      $memberID = trim($_GET['x']);
      $activat= trim($_GET['y']);
      echo $activat;

      //if id is number and the active token is not empty carry on
      if(is_numeric($memberID) && !empty($activat)){
        //update users record set the active column to Yes where the memberID and active value match the ones provided in the array
        $db = dbConn::getConnection();
        $stmt = $db->prepare("UPDATE members SET activation = 'Yes' WHERE memberID = :memberID AND activation = :active");
        $stmt->execute(array(
          ':memberID' => $memberID,
          ':active' => $activat
        ));
        //if the row was updated redirect the user
        if($stmt->rowCount() == 1){
          //redirect to login page
          header('Location: index.php?controller=userController&action=active');
          exit;
        } else {
          $error =  "Your account could not be activated.";
          header('Location: index.php?controller=userController&errors='.$error);
        }
      }
    }
    public function active(){
      $message = 'Your account has been activated please log in with your credentials!';
      $formtype = $_GET['form'];
      $form = new userformview;
      $form_html = $form->getHTML($message, $formtype);
      return $form_html;
    }
  }
 ?>
