<?php session_start();
include 'connect.php';
include 'header.php';
echo '<h1>REPLY</h1>'; 
echo'<form method="POST" action="reply.php?id='.$_GET['id'].'">
    <textarea name="reply-content"></textarea>
    <input type="submit" value="Submit reply" />
</form>';

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
                        ". $_GET['id'] .",
                        " . $_SESSION['user_id'] . ")";
                         
        $result = mysql_query($sql);
                         
        if(!$result)
        {
            echo '<h3>Your reply has not been saved, please try again later.</h3>';
        }
        else
        {
            echo '<h3>Your reply has been saved, check out <a href="topic.php?id=' . htmlentities($_GET['id']) . '">the topic</a>.</h3>';
        }
    }
}
 
include 'footer.php';
?>