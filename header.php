
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="nl" lang="nl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>KONNECT</title>
    <link rel="stylesheet" href="style.css" type="text/css">
<style>
.home {
	width:100px;
	height:100px;
	background:red;
	-webkit-transition:width 4s; 
	transition:width 4s;
	}
.home:hover
{
width:550px;
}

h1 {color:black;
	font-size:80pt;
	}

</style>
</head>
<body>
<div class="home">
<h1>KONNECT</h1>
 </div>   
	<br>
	<div id="wrapper">
    <div id="menu">
        <a class="item" href="home.php">Home</a> 
        <a class="item" href="create_topic.php">Create a topic</a> 
        <a class="item" href="create_cat.php">Create a category</a>
         
 <?php
   echo '<div id="userbar">';
    if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'])
    {
        echo 'Hello &nbsp' .$_SESSION['user_name']. '&nbsp &nbsp <a href="signout.php">Sign out</a>';
    }
    else
    {
        echo '<a href="signin.php">Sign in</a> or <a href="signup.php">create an account</a>.';
    }
echo '</div>';
?>
     </body>
</html>	 
		