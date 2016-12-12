<?php

    abstract class controller {

      protected $html;

      public function get() {}
      public function post() {}
      public function put() {}
      public function delete() {}
      public function __construct() {
        $header = '<!doctype html>
                  <html class="no-js" lang="">
                      <head>
                          <meta charset="utf-8">
                          <meta http-equiv="x-ua-compatible" content="ie=edge">
                          <title>IS 218 - John Cummings</title>
                          <meta name="description" content="">
                          <meta name="viewport" content="width=device-width, initial-scale=1">

                          <link rel="apple-touch-icon" href="apple-touch-icon.png">
                          <!-- Place favicon.ico in the root directory -->
                          <link rel="stylesheet" href="css/normalize.css">
                          <link rel="stylesheet" href="css/main.css">
                          <script src="js/vendor/modernizr-2.8.3.min.js"></script>
                      </head>
                      <body>
                          <!--[if lte IE 9]>
                              <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
                          <![endif]-->

                          <!-- Add your site or application content here -->
                          <div class="nav">
                  		<ul>
                  			<li><a href="index.php">Home</a></li>
                  			<li style="float: right;" ><a href="index.php?controller=userController">Login/New User</a></li>
                  		</ul>
                  	</div>';
        if($_SESSION['loggedin'] == true){
          $header = '<!doctype html>
                      <html class="no-js" lang="">
                          <head>
                              <meta charset="utf-8">
                              <meta http-equiv="x-ua-compatible" content="ie=edge">
                              <title>IS 218 - John Cummings</title>
                              <meta name="description" content="">
                              <meta name="viewport" content="width=device-width, initial-scale=1">

                              <link rel="apple-touch-icon" href="apple-touch-icon.png">
                              <!-- Place favicon.ico in the root directory -->
                              <link rel="stylesheet" href="css/normalize.css">
                              <link rel="stylesheet" href="css/main.css">
                              <script src="js/vendor/modernizr-2.8.3.min.js"></script>
                          </head>
                          <body>
                              <!--[if lte IE 9]>
                                  <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
                              <![endif]-->

                              <!-- Add your site or application content here -->
                              <div class="nav">
                      		<ul>
                      			<li><a href="index.php">Home</a></li>
                      			<li style="float: right;" ><a href="index.php?controller=userController&action=logout">Logout</a></li>
                      			<li style="float: right;" ><a href="index.php?controller=userController&action=profile">Profile</a></li>
                            <li style="float: right;" ><a href="index.php?controller=userController&action=usertable">List of Users</a></li>
                      		</ul>
                      	</div>';
        }
      	$this->html .= $header;
      }
      public function getHTML() {
        return $this->html;
      }

    }
