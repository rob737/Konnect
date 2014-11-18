<?php session_start();
include 'connect.php';
include 'header.php'; 
error_reporting (E_ALL ^ E_NOTICE);
$sql="select topic_id,topic_subject from topics where topic_id='".$_GET['id']."'";
$result=mysql_query($sql);
if(!$result)
{
    echo 'The category could not be displayed, please try again later.' . mysql_error();
}
else
{
    if(mysql_num_rows($result) == 0)
    {
        echo 'This category does not exist.';
    }
else
    {
        while($row = mysql_fetch_assoc($result))
        {
			 echo '<h2>' .$row['topic_subject']. '</h2>';
        } 
	$sql="select post_topic,post_content,post_date,post_by,user_id,user_name 
			from posts left join users
			on post_by=user_id where post_topic='".$_GET['id']."'";
	$result=mysql_query($sql);
	if(!$result)
        {
            echo 'The topics could not be displayed, please try again later.';
        }
        else
        {
            if(mysql_num_rows($result) == 0)
            {
                echo '<h3>There are no topics in this category yet.</h3>';
            }
        else
            {
                echo '<table border="1">
                      <tr>
                        <th></th>
                        <th></th>
                      </tr>'; 
            while($row = mysql_fetch_assoc($result))
                {               
                    echo '<tr>';
                        echo '<td class="leftpart">';
                            echo '<h3><a href="reply.php?id='.$row['post_topic'].'"> '.$row['user_name'].' </a><h3>';
                        echo date('d-m-Y', strtotime($row['post_date']));
						echo '</td>';
                        echo '<td class="rightpart">';
                          echo'<h3>'.$row['post_content'].'</h3>';  
                        echo '</td>';
                    echo '</tr>';
                }
         	}
		}
	}
}	