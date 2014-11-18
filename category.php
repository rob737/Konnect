<?php session_start();
include 'connect.php';
include 'header.php';
$sql = "select cat_id,cat_name,cat_description from categories where
            cat_id ='".$_GET['id']."' ";
 
$result = mysql_query($sql);
 
if(!$result)
{
    echo '<h3>The category could not be displayed, please try again later.</h3>' . mysql_error();
}
else
{
    if(mysql_num_rows($result) == 0)
    {
        echo '<h3>This category does not exist.</h3>';
    }
    else
    {
        while($row = mysql_fetch_assoc($result))
        {
            echo '<h2>Topics in ' .$row['cat_name']. ' category</h2>';
        } 
		$sql = "select topic_id,topic_subject,topic_date,topic_cat from topics where topic_cat='".$_GET['id']."'"; 		
	   $result = mysql_query($sql);
         
        if(!$result)
        {
            echo '<h3>The topics could not be displayed, please try again later.</h3>';
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
                        <th>Topic</th>
                        <th>Created on</th>
                      </tr>'; 
                     
                while($row = mysql_fetch_assoc($result))
                {               
                    echo '<tr>';
                        echo '<td class="leftpart">';
                            echo '<h3><a href="topic.php?id='.$row['topic_id'].'">' .$row['topic_subject'].' </a><h3>';
                        echo '</td>';
                        echo '<td class="rightpart">';
                            echo date('d-m-Y', strtotime($row['topic_date']));
                        echo '</td>';
                    echo '</tr>';
                }
            }
        }
    }
}
 
include 'footer.php';
?>