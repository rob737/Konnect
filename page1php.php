<?php






$con=mysqli_connect("localhost","robin","robin","exp");

if(mysqli_connect_errno())
		{
		echo "Failed to connect to Mysql ".mysqli_connect_error();
		}
		
$login=$_GET['login'];
$name=$_GET['name'];
$password=$_GET['password'];
$email=$_GET['email'];

$sql="INSERT INTO tab VALUES('"+$login+"','"+$name+"','"+$password+"','"+$email+"');";

$query=mysqli_query($con,$sql);

if (!$query)
		{
			die('Error: ' . mysqli_error($con));
		}
echo "1 record added";

	
mysqli_close($con);
?>