<?php

    class homepageController extends controller {


      public function get() {
        $user = new userModel;
        if($user->is_logged_in()) {
          $userhpage = new userhomepageview;
          $hpage_html = $userhpage ->getHTML();
          $this->html .= $hpage_html;
        } else {
          $reghpage = new reghomepageview;
          $hpage_html = $reghpage->getHTML();
          $this->html .= $hpage_html;
	        session_start();
        }
      }
      public function post() {}
      public function put() {}
      public function delete() {}


    }
