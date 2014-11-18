<?php session_start();
include 'final.php';
if(isset($_SESSION['signed_in']))
  {
	unset($_SESSION['signed_in']);
	unset($_SESSION['user_id']);    
	unset($_SESSION['user_name']);
	unset($_SESSION['user_level']);
  echo'<h1>SUCCESFULLY LOGGED OUT</h1>';
  }
  else
  echo'<h1>YOU ARE NOT SIGNED IN</h1><br>';
  echo'<h2><a href="signin.php">SIGN IN </a></h2>';
  ?>
   	