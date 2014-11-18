<?php session_start();
include 'connect.php';
include 'header.php';
 
echo '<h3>Sign up</h3><br>';
 
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    echo '<form method="post" action=" ">
        <h3>Username:</h3><input type="text" name="user_name" /><br>
        <h3>Room No:</h3><input type="text" name="room" /><br>
		<h3>Password:</h3><input type="password" name="user_pass"><br>
        <h3>Confirm Password:</h3><input type="password" name="user_pass_check"><br>
        <h3>E-mail:</h3><input type="email" name="user_email"><br>
        <input name ="form_val[signup]" type="submit"  value="SIGN UP" /><input type="submit" name="form_val[update]" value="UPDATE" />
     </form>';
}
else
{
    $errors = array(); 
     
    if(isset($_POST['user_name']))
    {
        if(!ctype_alnum($_POST['user_name']))
        {
            $errors[] = '<h3>The username can only contain letters and digits.</h3>';
        }
        if(strlen($_POST['user_name']) > 30)
        {
            $errors[] = '<h3>The username cannot be longer than 30 characters.</h3>';
        }
    }
    else
    {
        $errors[] = '<h3>The username field must not be empty.</h3>';
    }
     
     
    if(isset($_POST['user_pass']))
    {
        if($_POST['user_pass'] != $_POST['user_pass_check'])
        {
            $errors[] = '<h3>The two passwords did not match.</h3>';
        }
    }
    else
    {
        $errors[] = '<h3>The password field cannot be empty.</h3>';
    }
     
    if(!empty($errors)) 
	{
        echo '<h3> a couple of fields are not filled in correctly..</h3>';
        echo '<ul>';
        foreach($errors as $key => $value) 
		{
            echo '<li>' . $value . '</li>'; 
        }
        echo '</ul>';
     echo '<a href="signup.php">RETURN</a>';
	}
    else
    {
        if(isset($_POST['form_val']['signup']))
	  {
		$sql = "INSERT INTO
                    users(user_name, user_pass, user_email ,user_date, user_level)
                VALUES('" .($_POST['user_name']) . "',
                       '" .($_POST['user_pass']) . "',
                       '" .($_POST['user_email']) . "',
                        NOW(),
                        0)";
                         
        $result = mysql_query($sql);
        
		if(!$result)
        {
            echo 'Something went wrong while registering. Please try again later.';
        }
        else
        {
            echo '<h3>Successfully registered. You can now <a href="signin.php">sign in</a> and start posting! :-)</h3>';
		
		}
	  }
		 if(isset($_POST['form_val']['update']))
	  {
		$sql = "Update users
				set user_pass='".$_POST['user_pass']."'
				where user_email='".$_POST['user_email']."' ";
                         
        $result = mysql_query($sql);
        
		if(!$result)
        {
            echo 'Something went wrong while registering. Please try again later.';
        }
        else
        {
            echo '<h3>Successfully Updated.. You can now <a href="signin.php">sign in</a> and start posting! :-)</h3>';
		
		}
	  }	
	}
}
 
include 'footer.php';
?>