<?php session_start(); 

include 'connect.php';
include 'header.php';
echo '<h3>Sign in</h3>';
 
if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
{
    echo '<h3>You are already signed in, you can <a href="signout.php">sign out</a> if you want.</h3>';
	}
else
{
    if($_SERVER['REQUEST_METHOD'] != 'POST')
    {
        echo '<form method="post" action="">
            <h3>Username:</h3> <input type="text" name="user_name" /><br>
            <h3>Password:</h3> <input type="password" name="user_pass"><br>
            <input type="submit" value="Sign in" />
         </form>';
    }
    else
    {
        $errors = array(); 
      $pattern='[a-z A-Z 0-9 _ ]';
	  $subject=$_POST['user_name'];	
        if(!isset($_POST['user_name']) && preg_match($pattern,$subject) )
        {
            $errors[] = '<h3>The username field must not be empty.</h3>';
        }
         
        if(!isset($_POST['user_pass']))
        {
            $errors[] = '<h3>The password field must not be empty.</h3>';
        }
         
        if(!empty($errors)) 
        {
            echo '<h3>a couple of fields are not filled in correctly..</h3>';
            echo '<ul>';
            foreach($errors as $key => $value) 
            {
                echo '<li>' . $value . '</li>'; 
            }
            echo '</ul>';
        echo '<a href="signin.php">RETURN</a>';
		}
        else
        {
            $sql = "SELECT 
                        user_id,
                        user_name,
                        user_level
                    FROM
                        users
                    WHERE
                        user_name = '" .$_POST['user_name']. "'
                    AND
                        user_pass = '" .$_POST['user_pass']. "'";
                         
            $result = mysql_query($sql);
            if(!$result)
            {
            
                echo '<h3>Something went wrong while signing in. Please try again later.</h3>';
            	echo '<a href="signin.php">RETURN</a>';
			}
            else
            {
                if(mysql_num_rows($result) == 0)
                {
                    echo '<h3>You have supplied a wrong user/password combination. Please try again.</h3>';
					echo '<a href="signin.php">RETURN</a>';
				}
                else
                {
                    $_SESSION['signed_in'] = true;
                     
                    while($row = mysql_fetch_assoc($result))
                    {
                        $_SESSION['user_id']    = $row['user_id'];
                        $_SESSION['user_name']  = $row['user_name'];
                        $_SESSION['user_level'] = $row['user_level'];
                    }
                     
                    echo '<h3>Welcome, ' . $_SESSION['user_name'] . '. <a href="home.php">Proceed to the forum overview</a>.</h3>';
                }
            }
        }
    }
}
 
include 'footer.php';
?>