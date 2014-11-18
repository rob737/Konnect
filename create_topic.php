<?php session_start();
include 'connect.php';
include 'header.php';
echo '<h2>Create a topic</h2>';

if (getenv('PHP_DEBUG')=='1')
{
    error_reporting( E_ERROR | E_USER_ERROR );
    ini_set( 'display_errors', true );
}
else
{
    error_reporting( E_ERROR | E_USER_ERROR );
    ini_set( 'display_errors', false );
}
if($_SESSION['signed_in']==false)
{
    echo '<h3>Sorry, you have to be <a href="signin.php">signed in</a> to create a topic.</h3>';
}
else
{
    if($_SERVER['REQUEST_METHOD'] != 'POST')
    {   
        $sql = "SELECT
                    cat_id,
                    cat_name,
                    cat_description
                FROM
                    categories";
         
        $result = mysql_query($sql);
         
        if(!$result)
        {
            echo 'Error while selecting from database. Please try again later.';
        }
        else
        {
            if(mysql_num_rows($result) == 0)
            {
                if($_SESSION['user_level'] == 1)
                {
                    echo 'You have not created categories yet.';
                }
                else
                {
                    echo 'Before you can post a topic, you must wait for an admin to create some categories.';
                }
            }
            else
            {
         
                echo '<form method="post" action="">
                    <h3>Subject:</h3> <input type="text" name="topic_subject" />
                    <h3>Category:</h3>'; 
                 
                echo '<select name="topic_cat">';
                    while($row = mysql_fetch_assoc($result))
                    {
                        echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
                    }
                echo '</select>'; 
                     
                echo '<h3>Message: <textarea name="post_content" /></textarea></h3>
                    <input type="submit" value="Create topic" />
                 </form>';
            }
        }
    }
    else
    {
        $query  = "BEGIN WORK;";
        $result = mysql_query($query);
         
        if(!$result)
        {
            echo 'An error occured while creating your topic. Please try again later.';
        }
        else
        {
     
            $sql = "INSERT INTO 
                        topics(topic_subject,
                               topic_date,
                               topic_cat,
                               topic_by)
                   VALUES('" .$_POST['topic_subject']. "',
                               NOW(),
                               " .$_POST['topic_cat']. ",
                               " . $_SESSION['user_id'] . "
                               )";
                      
            $result = mysql_query($sql);
            if(!$result)
            {
                echo 'An error occured while inserting your data. Please try again later.' . mysql_error();
                $sql = "ROLLBACK;";
                $result = mysql_query($sql);
            }
            else
            {
                $topicid = mysql_insert_id();
                 
                $sql = "INSERT INTO
                            posts(post_content,
                                  post_date,
                                  post_topic,
                                  post_by)
                        VALUES
                            ('" .$_POST['post_content']. "',
                                  NOW(),
                                  " . $topicid . ",
                                  " . $_SESSION['user_id'] . "
                            )";
                $result = mysql_query($sql);
                 
                if(!$result)
                {
                    echo 'An error occured while inserting your post. Please try again later.' . mysql_error();
                    $sql = "ROLLBACK;";
                    $result = mysql_query($sql);
                }
                else
                {
                    $sql = "COMMIT;";
                    $result = mysql_query($sql);
                     
                    echo '<h3>You have successfully created <a href="create_topic.php?id="'. $topicid . '">your new topic</a>.</h3>';
                }
            }
        }
    }
}
 

 include 'footer.php';
?>