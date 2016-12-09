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
        <title>IT117 - John Cummings</title>
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
			<li style="float: right;" ><a href="login.php">Login/New User</a></li>
			<li style="float: right;" ><a href="logout.php">Logout</a></li>
			<!-- TODO: Make PHP if statement to display profile instead of logout
			     depending whether php session is active/valid or not  -->
			<li style="float: right;" ><a href="profile.php">Profile</a></li>
									     
		</ul>
	</div>';
      	$this->html .= $header;
      }
      public function getHTML() {
        return $this->html;
      }

    }
