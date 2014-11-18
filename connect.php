<?php
$server = 'localhost';
$username   = 'robin';
$password   = 'robin';
$database   = 'forum';
 
if(!mysql_connect($server, $username,  $password,$database))
{
    exit('Error: could not establish database connection');
}
if(!mysql_select_db($database))
{
    exit('Error: could not select the database');
}
$sql1="DELETE FROM posts where now()-post_date>2592000;";
		mysql_query($sql1);

?>