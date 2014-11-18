<?php
$con=mysqli_connect("localhost","robin","robin","exp");

if(mysqli_connect_errno())
		{
		echo "Failed to connect to Mysql ".mysqli_connect_error();
		}
		
$login=$_GET['login'];
$password=$_GET['password'];

if (!$query)
		{
			die('Error: ' . mysqli_error($con));
		}
echo "$login";

	
mysqli_close($con);
?>