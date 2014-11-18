<?php session_start();
include 'connect.php';
include 'header.php';

if(isset($_SESSION['signed_in']) && isset($_SESSION['user_name']) && $_SESSION['user_name'] == "robin")
	   {
	
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    
	echo '<form method="post" action="">
        <h3>Category name:</h3> <input type="text" name="cat_name" /><br>
        <h3>Category description:</h3> <textarea name="cat_description" /></textarea><br>
        <input type="submit" value="Add category" />
     </form>';
}
else
{
    $sql = "INSERT INTO categories(cat_name, cat_description)
       VALUES('".$_POST['cat_name']."',
             '".$_POST['cat_description']."');";
	
	$result = mysql_query($sql);
    if(!$result)
    {
      echo 'Error' . mysql_error();
		echo'<a href="create_cat.php">RETURN</a><br>';
	}
    else
    {
        echo 'New category successfully added.';
		echo'<a href="create_cat.php">RETURN</a><br>';
	
	}
}
		}
	else
	{
	echo '<h3>Sorry, you have to be <a href="signin.php">signed in as admin</a> to create a category.</h3>';
	}

?>
<?php
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    echo '.'; 
}
else
{
    if(!$_SESSION['signed_in'])
    {
        echo '<h3>You must be signed in to post a reply.</h3>';
    }
    else
    {
        $sql = "INSERT INTO 
                    posts(post_content,
                          post_date,
                          post_topic,
                          post_by) 
                VALUES ('" . $_POST['reply-content'] . "',
                        NOW(),
                        " . mysql_real_escape_string($_GET['id']) . ",
                        " . $_SESSION['user_id'] . ")";
                         
        $result = mysql_query($sql);
                         
        if(!$result)
        {
            echo 'Your reply has not been saved, please try again later.';
        }
        else
        {
            echo '<h3>Your reply has been saved, check out <a href="topic.php?id=' . htmlentities($_GET['id']) . '">the topic</a>.</h3>';
        }
    }
}
 
include 'footer.php';
?>
